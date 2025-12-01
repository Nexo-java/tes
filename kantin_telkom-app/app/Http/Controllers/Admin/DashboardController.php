<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kantin;
use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Pengguna;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data kantin dari database
        $kantins = Kantin::all();

        // Total Orders
        $totalOrders = Transaksi::count();

        // Total Revenue - dari transaksi_details (gunakan subtotal)
        $totalRevenue = TransaksiDetail::sum('subtotal');

        // Active Users (unique NIS yang pernah transaksi)
        $activeUsers = Transaksi::distinct('nis')->count('nis');

        // Best Selling Products - Top 5 menu dengan transaksi terbanyak
        $bestSellers = TransaksiDetail::select(
                'menu_id',
                DB::raw('SUM(jml) as total_sold'),
                DB::raw('SUM(subtotal) as total_revenue')
            )
            ->with('menu.kantin')
            ->groupBy('menu_id')
            ->orderBy('total_sold', 'DESC')
            ->limit(5)
            ->get();

        // Recent Transactions - 5 transaksi terakhir
        $recentTransactions = Transaksi::with(['pengguna', 'transaksiDetails'])
            ->orderBy('tgl_transaksi', 'DESC')
            ->limit(5)
            ->get();

        // Data untuk chart Revenue (7 hari terakhir per kantin)
        $revenuePerKantin = [];

        foreach ($kantins as $kantin) {
            $dailyRevenue = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');

                // Query dengan join untuk mendapatkan revenue per kantin per hari
                $revenue = DB::table('transaksi_details')
                    ->join('transaksis', 'transaksi_details.id_transaksi', '=', 'transaksis.id_transaksi')
                    ->join('tb_menus', 'transaksi_details.menu_id', '=', 'tb_menus.menu_id')
                    ->whereDate('transaksis.tgl_transaksi', $date)
                    ->where('tb_menus.id_kantin', $kantin->id_kantin)
                    ->sum('transaksi_details.subtotal');

                $dailyRevenue[] = (float) $revenue;
            }

            $revenuePerKantin[] = [
                'nama_kantin' => $kantin->nama_kantin,
                'data' => $dailyRevenue
            ];
        }

        // Jika tidak ada data, buat dummy data agar chart tetap muncul
        if (empty($revenuePerKantin)) {
            foreach ($kantins as $kantin) {
                $revenuePerKantin[] = [
                    'nama_kantin' => $kantin->nama_kantin,
                    'data' => [0, 0, 0, 0, 0, 0, 0]
                ];
            }
        }

        // Labels untuk 7 hari terakhir
        $revenueLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $revenueLabels[] = now()->subDays($i)->format('d M');
        }

        // Data untuk chart Visitors per kantin (7 hari terakhir)
        $visitorPerKantin = [];

        foreach ($kantins as $kantin) {
            $dailyVisitors = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');

                // Hitung unique visitor (NIS) per kantin per hari
                $visitors = DB::table('transaksis')
                    ->join('transaksi_details', 'transaksis.id_transaksi', '=', 'transaksi_details.id_transaksi')
                    ->join('tb_menus', 'transaksi_details.menu_id', '=', 'tb_menus.menu_id')
                    ->whereDate('transaksis.tgl_transaksi', $date)
                    ->where('tb_menus.id_kantin', $kantin->id_kantin)
                    ->distinct()
                    ->count('transaksis.nis');

                $dailyVisitors[] = $visitors;
            }

            $visitorPerKantin[] = [
                'nama_kantin' => $kantin->nama_kantin,
                'data' => $dailyVisitors
            ];
        }

        // Jika tidak ada data, buat data kosong
        if (empty($visitorPerKantin)) {
            foreach ($kantins as $kantin) {
                $visitorPerKantin[] = [
                    'nama_kantin' => $kantin->nama_kantin,
                    'data' => [0, 0, 0, 0, 0, 0, 0]
                ];
            }
        }

        // Hitung jumlah notifikasi (hanya yang benar-benar 'belum' / unread)
        $notifCount = Transaksi::whereHas('transaksiDetails', function($query) {
            $query->where('status', 'belum');
        })->count();

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'kantins',
            'totalOrders',
            'totalRevenue',
            'activeUsers',
            'bestSellers',
            'recentTransactions',
            'revenuePerKantin',
            'revenueLabels',
            'visitorPerKantin',
            'notifCount'
        ));
    }

    public function getRevenueData(Request $request)
    {
        $period = $request->input('period', 'daily'); // daily, weekly, monthly
        $kantins = Kantin::all();
        $revenuePerKantin = [];
        $revenueLabels = [];

        switch ($period) {
            case 'daily':
                // 7 hari terakhir
                for ($i = 6; $i >= 0; $i--) {
                    $revenueLabels[] = now()->subDays($i)->format('d M');
                }

                foreach ($kantins as $kantin) {
                    $dailyRevenue = [];
                    for ($i = 6; $i >= 0; $i--) {
                        $date = now()->subDays($i)->format('Y-m-d');
                        $revenue = DB::table('transaksi_details')
                            ->join('transaksis', 'transaksi_details.id_transaksi', '=', 'transaksis.id_transaksi')
                            ->join('tb_menus', 'transaksi_details.menu_id', '=', 'tb_menus.menu_id')
                            ->whereDate('transaksis.tgl_transaksi', $date)
                            ->where('tb_menus.id_kantin', $kantin->id_kantin)
                            ->sum('transaksi_details.subtotal');
                        $dailyRevenue[] = (float) $revenue;
                    }
                    $revenuePerKantin[] = [
                        'nama_kantin' => $kantin->nama_kantin,
                        'data' => $dailyRevenue
                    ];
                }
                break;

            case 'weekly':
                // 8 minggu terakhir
                for ($i = 7; $i >= 0; $i--) {
                    $weekStart = now()->subWeeks($i)->startOfWeek();
                    $revenueLabels[] = 'Week ' . $weekStart->format('W');
                }

                foreach ($kantins as $kantin) {
                    $weeklyRevenue = [];
                    for ($i = 7; $i >= 0; $i--) {
                        $weekStart = now()->subWeeks($i)->startOfWeek()->format('Y-m-d');
                        $weekEnd = now()->subWeeks($i)->endOfWeek()->format('Y-m-d');

                        $revenue = DB::table('transaksi_details')
                            ->join('transaksis', 'transaksi_details.id_transaksi', '=', 'transaksis.id_transaksi')
                            ->join('tb_menus', 'transaksi_details.menu_id', '=', 'tb_menus.menu_id')
                            ->whereBetween('transaksis.tgl_transaksi', [$weekStart, $weekEnd])
                            ->where('tb_menus.id_kantin', $kantin->id_kantin)
                            ->sum('transaksi_details.subtotal');
                        $weeklyRevenue[] = (float) $revenue;
                    }
                    $revenuePerKantin[] = [
                        'nama_kantin' => $kantin->nama_kantin,
                        'data' => $weeklyRevenue
                    ];
                }
                break;

            case 'monthly':
                // 6 bulan terakhir
                for ($i = 5; $i >= 0; $i--) {
                    $revenueLabels[] = now()->subMonths($i)->format('M Y');
                }

                foreach ($kantins as $kantin) {
                    $monthlyRevenue = [];
                    for ($i = 5; $i >= 0; $i--) {
                        $monthStart = now()->subMonths($i)->startOfMonth()->format('Y-m-d');
                        $monthEnd = now()->subMonths($i)->endOfMonth()->format('Y-m-d');

                        $revenue = DB::table('transaksi_details')
                            ->join('transaksis', 'transaksi_details.id_transaksi', '=', 'transaksis.id_transaksi')
                            ->join('tb_menus', 'transaksi_details.menu_id', '=', 'tb_menus.menu_id')
                            ->whereBetween('transaksis.tgl_transaksi', [$monthStart, $monthEnd])
                            ->where('tb_menus.id_kantin', $kantin->id_kantin)
                            ->sum('transaksi_details.subtotal');
                        $monthlyRevenue[] = (float) $revenue;
                    }
                    $revenuePerKantin[] = [
                        'nama_kantin' => $kantin->nama_kantin,
                        'data' => $monthlyRevenue
                    ];
                }
                break;
        }

        return response()->json([
            'labels' => $revenueLabels,
            'datasets' => $revenuePerKantin
        ]);
    }
}
