<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    // Menampilkan daftar riwayat transaksi (selesai/batal) dengan fitur pencarian
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil keyword pencarian

        // Ambil transaksi yang statusnya selesai/batal, filter dengan pencarian jika ada
        $transaksis = Transaksi::with(['transaksiDetails.menu', 'pengguna', 'karcis'])
            ->whereHas('transaksiDetails', function($query) {
                $query->whereIn('status', ['selesai', 'batal']);
            })
            ->when($search, function($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('nis', 'like', "%{$search}%")
                      ->orWhere('id_transaksi', 'like', "%{$search}%")
                      ->orWhereHas('pengguna', function($q2) use ($search) {
                          $q2->where('nama_siswa', 'like', "%{$search}%");
                      });
                });
            })
            ->orderBy('tgl_transaksi', 'desc')
            ->paginate(5);

        // Hitung jumlah notifikasi (hanya yang benar-benar 'belum' / unread)
        $notifCount = Transaksi::whereHas('transaksiDetails', function($query) {
            $query->where('status', 'belum');
        })->count();

        // Tampilkan view riwayat transaksi
        return view('Admin.riwayat.index', compact('transaksis', 'search', 'notifCount'));
    }

    // Hapus satu riwayat transaksi
    public function destroy($id)
    {
        try {
            $transaksi = Transaksi::findOrFail($id); // Cari transaksi
            $transaksi->delete(); // Hapus transaksi

            // Berhasil dihapus
            return response()->json([
                'success' => true,
                'message' => 'Riwayat berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            // Gagal dihapus
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus riwayat: ' . $e->getMessage()
            ], 500);
        }
    }

    // Hapus banyak riwayat transaksi sekaligus
    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->input('ids', []); // Ambil array id transaksi

            if (empty($ids)) {
                // Tidak ada data yang dipilih
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada data yang dipilih'
                ], 400);
            }

            // Hapus semua transaksi yang dipilih
            Transaksi::whereIn('id_transaksi', $ids)->delete();

            // Berhasil dihapus
            return response()->json([
                'success' => true,
                'message' => count($ids) . ' riwayat berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            // Gagal dihapus
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus riwayat: ' . $e->getMessage()
            ], 500);
        }
    }

    // Hapus semua riwayat transaksi (selesai/batal)
    public function deleteAll(Request $request)
    {
        try {
            // Hapus semua transaksi yang statusnya selesai/batal
            $deleted = Transaksi::whereHas('transaksiDetails', function($query) {
                $query->whereIn('status', ['selesai', 'batal']);
            })->delete();

            // Berhasil dihapus
            return response()->json([
                'success' => true,
                'message' => $deleted . ' riwayat berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            // Gagal dihapus
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus semua riwayat: ' . $e->getMessage()
            ], 500);
        }
    }
}
