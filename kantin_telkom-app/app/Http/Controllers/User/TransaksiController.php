<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Karcis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    // Proses simpan transaksi baru
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Parse items dari JSON jika perlu
            $items = is_string($request->items) ? json_decode($request->items, true) : $request->items;

            // Validasi stok sebelum transaksi
            foreach ($items as $item) {
                $menu = \App\Models\Menu::find(intval($item['id']));

                if (!$menu) {
                    throw new \Exception("Menu dengan ID {$item['id']} tidak ditemukan");
                }

                if ($menu->status_menu !== 'aktif') {
                    throw new \Exception("Menu {$menu->nama_menu} tidak tersedia");
                }

                if ($menu->stok < $item['qty']) {
                    throw new \Exception("Stok menu {$menu->nama_menu} tidak mencukupi. Stok tersedia: {$menu->stok}");
                }
            }

            // Handle upload bukti transfer untuk pembayaran non-tunai
            $buktiTransferPath = null;
            if ($request->metode_bayar === 'non-tunai' && $request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $fileName = 'bukti_' . time() . '_' . auth()->guard('pengguna')->user()->nis . '.' . $file->getClientOriginalExtension();
                $buktiTransferPath = $file->storeAs('bukti_transfer', $fileName, 'public');

                Log::info('Bukti Transfer Uploaded', [
                    'path' => $buktiTransferPath,
                    'metode' => $request->metode_bayar
                ]);
            }

            // Tentukan status pembayaran
            // Non-tunai dengan bukti transfer = otomatis verified (bayar)
            // Non-tunai tanpa bukti = pending (belum)
            // Tunai = pending, admin harus verifikasi manual (belum)
            if ($request->metode_bayar === 'non-tunai' && $buktiTransferPath) {
                $statusPembayaran = 'bayar'; // Auto-verified jika ada bukti
                Log::info('Auto-verify payment', ['status' => $statusPembayaran]);
            } else {
                $statusPembayaran = 'belum'; // Pending untuk tunai atau non-tunai tanpa bukti
                Log::info('Payment pending', [
                    'metode' => $request->metode_bayar,
                    'has_bukti' => $buktiTransferPath !== null,
                    'status' => $statusPembayaran
                ]);
            }

            // Simpan data transaksi utama
            $transaksi = Transaksi::create([
                'nis' => auth()->guard('pengguna')->user()->nis,
                'metode_bayar' => $request->metode_bayar,
                'bukti_transfer' => $buktiTransferPath,
                'status_pembayaran' => $statusPembayaran,
                'tgl_transaksi' => Carbon::now(),
            ]);

            // Simpan detail transaksi & kurangi stok menu
            foreach ($items as $item) {
                $statusDetail = ($request->metode_bayar === 'non-tunai') ? 'proses' : 'belum';
                TransaksiDetail::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'menu_id' => intval($item['id']), // Convert to integer explicitly
                    'jml' => $item['qty'],
                    'subtotal' => $item['qty'] * $item['price'],
                    'status' => $statusDetail,
                ]);

                // Kurangi stok menu (otomatis nonaktifkan jika habis)
                $menu = \App\Models\Menu::find(intval($item['id']));
                if ($menu) {
                    $stokSebelum = $menu->stok;
                    $menu->kurangiStok($item['qty']);

                    // Log jika stok habis
                    if ($menu->stok <= 0 && $stokSebelum > 0) {
                        Log::info("Menu {$menu->nama_menu} (ID: {$menu->menu_id}) stok habis dan dinonaktifkan");
                    }
                }
            }

            // Otomatis buat karcis
            Karcis::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'tgl_cetak' => Carbon::now(),
            ]);

            DB::commit();
            // Berhasil simpan transaksi
            return response()->json(['success' => true, 'message' => 'Transaksi berhasil disimpan!']);
        } catch (\Exception $e) {
            DB::rollBack();
            // Gagal simpan transaksi
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    // Menampilkan riwayat transaksi user
    public function history()
    {
        $nis = auth()->guard('pengguna')->user()->nis;

        $transaksis = Transaksi::where('nis', $nis)
            ->with(['transaksiDetails.menu', 'karcis'])
            ->orderBy('tgl_transaksi', 'desc')
            ->paginate(5);

        // Tampilkan view riwayat transaksi
        return view('User.history', compact('transaksis'));
    }

    // Hapus riwayat transaksi user
    public function deleteHistory($id)
    {
        $nis = auth()->guard('pengguna')->user()->nis;

        // Cari transaksi berdasarkan id dan pastikan milik user
        $transaksi = Transaksi::where('id_transaksi', $id)
            ->where('nis', $nis)
            ->first();

        if (!$transaksi) {
            // Transaksi tidak ditemukan atau tidak berhak
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found or unauthorized'
            ], 404);
        }

        try {
            // Hapus detail dan karcis terkait
            $transaksi->transaksiDetails()->delete();
            if ($transaksi->karcis) {
                $transaksi->karcis->delete();
            }
            $transaksi->delete();

            // Berhasil dihapus
            return response()->json([
                'success' => true,
                'message' => 'History deleted successfully'
            ]);
        } catch (\Exception $e) {
            // Gagal dihapus
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete history: ' . $e->getMessage()
            ], 500);
        }
    }

    // Ambil notifikasi status pesanan terbaru (24 jam terakhir)
    public function getNotifications()
    {
        $nis = auth()->guard('pengguna')->user()->nis;

        // Ambil semua transaksi dalam 24 jam terakhir
        $notifications = collect();
        $transaksis = Transaksi::where('nis', $nis)
            ->with(['transaksiDetails.menu', 'karcis'])
            ->whereHas('transaksiDetails', function($query) {
                $query->whereIn('status', ['belum', 'proses', 'selesai', 'batal'])
                      ->where('updated_at', '>=', now()->subDay());
            })
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->transaksiDetails as $detail) {
                if (in_array($detail->status, ['belum', 'proses', 'selesai', 'batal']) && $detail->updated_at >= now()->subDay()) {
                    $messages = [
                        'belum' => 'Pesanan Anda telah dikonfirmasi',
                        'proses' => ($transaksi->metode_bayar === 'non-tunai') ? 'Pesanan Anda telah diterima' : 'Pesanan Anda sedang diproses',
                        'selesai' => 'Pesanan Anda sudah selesai! Silakan ambil pesanan',
                        'batal' => 'Pesanan Anda dibatalkan'
                    ];
                    $notifications->push([
                        'id' => $transaksi->id_transaksi,
                        'message' => $messages[$detail->status] ?? 'Update pesanan',
                        'status' => $detail->status,
                        'time' => $detail->updated_at->diffForHumans(),
                        'order_number' => $transaksi->karcis->karcis_id ?? $transaksi->id_transaksi,
                        'isNonTunaiProses' => ($detail->status === 'proses' && $transaksi->metode_bayar === 'non-tunai') ? true : false
                    ]);
                }
            }
        }

        // Return notifikasi dalam format JSON
        return response()->json([
            'success' => true,
            'notifications' => $notifications,
            'unread_count' => $notifications->count()
        ]);
    }

    // Tandai semua notifikasi sebagai sudah dibaca
    public function markAllRead()
    {
        $nis = auth()->guard('pengguna')->user()->nis;

        // Update all transaksi as read (sebaiknya tambahkan kolom 'is_read' di database)
        // Untuk sekarang hanya return sukses
        // Produksi: tambahkan kolom 'is_read' untuk tracking

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read'
        ]);
    }

    // Hapus semua notifikasi (dengan cara update updated_at agar tidak muncul di notifikasi)
    public function deleteAll()
    {
        $nis = auth()->guard('pengguna')->user()->nis;

        // Update only recent notifications (last 24 hours) dengan mengubah updated_at lebih lama
        // Agar tidak muncul di getNotifications()
        Transaksi::where('nis', $nis)
            ->whereHas('transaksiDetails', function($query) {
                $query->where('updated_at', '>=', now()->subDay());
            })
            ->get()
            ->each(function($transaksi) {
                // Update updated_at agar lebih dari 24 jam
                $transaksi->transaksiDetails()->update([
                    'updated_at' => now()->subDays(2)
                ]);
            });

        // Return sukses
        return response()->json([
            'success' => true,
            'message' => 'All notifications cleared'
        ]);
    }
}
