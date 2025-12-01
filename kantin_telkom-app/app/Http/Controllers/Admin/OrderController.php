<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan daftar order yang belum selesai/batal
    public function index()
    {
        // Hanya tampilkan transaksi yang statusnya BUKAN 'selesai' atau 'batal'
        // Transaksi selesai/batal akan otomatis pindah ke riwayat
        $transaksis = Transaksi::with(['transaksiDetails.menu', 'pengguna', 'karcis'])
            ->whereHas('transaksiDetails', function($query) {
                $query->whereIn('status', ['belum', 'proses']);
            })
            ->orderBy('tgl_transaksi', 'desc')
            ->paginate(5);

        // Hitung jumlah notifikasi (hanya yang benar-benar 'belum' / unread)
        $notifCount = Transaksi::whereHas('transaksiDetails', function($query) {
                $query->where('status', 'belum');
            })->count();

        // Tampilkan view index order
        return view('Admin.orders.index', compact('transaksis', 'notifCount'));
    }

    // Update status pesanan (belum, proses, selesai, batal)
    public function updateStatus(Request $request, $id)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:belum,proses,selesai,batal'
        ]);

        $transaksiDetail = TransaksiDetail::where('id_transaksi', $id)->first();

        if ($transaksiDetail) {
            // Update semua detail transaksi dengan transaksi yang sama
            TransaksiDetail::where('id_transaksi', $id)->update([
                'status' => $request->status
            ]);

            // Berhasil update status
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate!',
                'status' => $request->status
            ]);
        }

        // Jika transaksi tidak ditemukan
        return response()->json([
            'success' => false,
            'message' => 'Transaksi tidak ditemukan'
        ], 404);
    }

    // Menampilkan detail transaksi/order
    public function show($id)
    {
        $transaksi = Transaksi::with(['transaksiDetails.menu', 'pengguna', 'karcis'])
            ->where('id_transaksi', $id)
            ->firstOrFail();

        // Tampilkan view detail order
        return view('Admin.orders.show', compact('transaksi'));
    }

    // Update status pembayaran pesanan
    public function updatePaymentStatus(Request $request, $id)
    {
        // Validasi input status pembayaran
        $request->validate([
            'status_pembayaran' => 'required|in:belum,bayar'
        ]);

        $transaksi = Transaksi::where('id_transaksi', $id)->first();

        if ($transaksi) {
            // Update payment status untuk semua metode pembayaran
            $transaksi->update([
                'status_pembayaran' => $request->status_pembayaran
            ]);

            $statusText = $request->status_pembayaran === 'bayar' ? 'Verified' : 'Pending';
            $metodeText = strtoupper($transaksi->metode_bayar);

            // Berhasil update status pembayaran
            return response()->json([
                'success' => true,
                'message' => "Payment status ({$metodeText}) berhasil diupdate menjadi {$statusText}!",
                'status_pembayaran' => $request->status_pembayaran
            ]);
        }

        // Jika transaksi tidak ditemukan
        return response()->json([
            'success' => false,
            'message' => 'Transaksi tidak ditemukan'
        ], 404);
    }

    // Tandai semua pesanan dengan status 'belum' menjadi 'proses' (dibaca)
    public function markAllAsRead()
    {
        // Update semua transaksi dengan status 'belum' menjadi 'proses'
        $updatedCount = TransaksiDetail::whereIn('status', ['belum'])
            ->update(['status' => 'proses']);

        // Berhasil update status semua pesanan
        return response()->json([
            'success' => true,
            'message' => "{$updatedCount} pesanan telah ditandai sebagai dibaca",
            'count' => $updatedCount
        ]);
    }
}
