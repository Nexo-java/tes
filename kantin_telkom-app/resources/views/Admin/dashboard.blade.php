<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

body {
  background: #f5f5f5;
  color: #333;
}

.dashboard-container {
  display: flex;
}

/* Sidebar */
.sidebar {
  position: fixed;
  left: 0;
  top: 0;
  height: 100%;
  width: 80px;
  background: #fff;
  border-right: 1px solid #ddd;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 20px;
  transition: width 0.3s;
  overflow: hidden;
}

.logo-mini {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 3px;
  width: 22px;
  height: 22px;
  margin-bottom: 6px;
  align-items: center;
  justify-items: center;
}

.logo-mini .sq {
  width: 100%;
  height: 100%;
  border-radius: 3px;
  background: transparent;
  border: 2px solid #000000;
  box-sizing: border-box;
}

.menu-item.active .logo-mini .sq {
  background: linear-gradient(180deg,#000000,#000000);
  border: none;
  box-shadow: 0 2px 4px rgba(0,0,0,0.12);
}

.sidebar.active {
  width: 220px;
  align-items: flex-start;
  padding-left: 15px;
}

.menu-item.active {
  background: #f0f0f0;
  color: #000;
  border-radius: 6px;
}

.menu-toggle {
  font-size: 22px;
  margin-bottom: 20px;
  cursor: pointer;
  align-self: center;
}

.sidebar.active .menu-toggle {
  align-self: flex-end;
  margin-right: 15px;
}

.menu {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 15px;
  width: 100%;
  align-items: center;
}

.sidebar.active .menu {
  align-items: flex-start;
}

.menu-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  color: #333;
  font-size: 12px;
  padding: 10px 0;
  width: 100%;
  transition: background 0.3s, color 0.3s, flex-direction 0.3s;
}

.menu-item i {
  font-size: 20px;
  margin-bottom: 5px;
}

.logo-statistic {
  display: flex;
  gap: 4px;
  align-items: flex-end;
  width: 26px;
  height: 24px;
  margin-bottom: 6px;
  justify-content: center;
}

.logo-statistic .bar {
  width: 12px;
  background: transparent;
  box-shadow: none;
  border: 2px solid #374151;
  box-sizing: border-box;
}

.logo-statistic .bar.b1 { height: 10px; }
.logo-statistic .bar.b2 { height: 20px; }
.logo-statistic .bar.b3 { height: 16px; }

.menu-item.active .logo-statistic .bar {
  background: linear-gradient(180deg,#6b7280,#374151);
  border: none;
  box-shadow: 0 1px 2px rgba(0,0,0,0.12);
}

.sidebar.active ~ .main-content {
  margin-left: 220px;
  width: calc(100% - 220px);
}

.main-content {
  margin-left: 80px;
  width: calc(100% - 80px);
  transition: all 0.3s;
}

.sidebar hr {
  width: 80%;
  border: none;
  border-top: 2px solid #ddd;
  margin: 5px 0;
  transition: width 0.3s;
}

.sidebar.active hr {
  width: 90%;
}

.logout {
  margin-bottom: 20px;
}

/* Header */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #fff;
  padding: 10px 15px;
  border-bottom: 1px solid #dddd;
}

.header h1 {
  font-size: 24px;
  font-weight: bold;
}

.logo-top img {
  height: 56px;
  max-width: 360px;
  object-fit: contain;
}

.header-right {
  display: flex;
  align-items: center;
  gap: 35px;
}

.profile {
  display: flex;
  align-items: center;
  justify-content: center;
}

.profile svg {
  width: 32px;
  height: 28px;
  color: #374151;
}

.notif-btn {
  position: relative;
  background: transparent;
  border: none;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
}

.notif-btn:hover {
  background: #f3f4f6;
  transform: scale(1.05);
}

.notif-btn svg {
  width: 24px;
  height: 24px;
  color: #374151;
}

.notif-badge {
  position: absolute;
  top: -5px;
  right: -5px;
  background: #ef4444;
  color: white;
  font-size: 11px;
  font-weight: bold;
  min-width: 20px;
  height: 20px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0 6px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.content {
  padding: 20px;
}

.content .title {
  font-size: 30px;
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 5px;
}

.stats-container {
  display: flex;
  gap: 20px;
  margin-bottom: 20px;
}

.card {
  flex: 1;
  background: #fff;
  padding: 15px;
  border-radius: 6px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);
  border: 1px solid #CCCCCC;
}

table {
  width: 100%;
  border-collapse: collapse;
}|
.revenue-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  margin-bottom: 12px;
  padding: 0 5px;
}

.revenue-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
  padding: 0 10px;
}

.revenue-title {
  font-size: 22px;
  font-weight: 600;
  color: #222;
  margin: 0;
}

.revenue-buttons.segmented {
  display: inline-flex;
  justify-content: flex-end;
  align-items: center;
  border-radius: 5px;
  overflow: hidden;
  background: #e5e7eb; /* biar sisi luar tetap terlihat */
  margin-bottom: 10px;
}

.rev-btn {
  background: transparent;
  border: none;
  color: #333;
  padding: 8px 20px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: background 0.2s ease, color 0.2s ease;
}

.rev-btn:not(:last-child) {
  border-right: 1px solid #ddd;
}

.rev-btn:hover {
  background: #e0e0e0;
}

.rev-btn.active {
  background: #fbbf24;
  color: #000;
}


</style>

<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="menu-toggle" ><i class="fas fa-bars"></i></div>
      <div class="menu">
        <a href="#" class="menu-item active">
          <span class="logo-mini">
            <span class="sq"></span><span class="sq"></span>
            <span class="sq"></span><span class="sq"></span>
          </span>
          <span>Beranda</span>
        </a>
        <a href="{{ route('admin.kantin.index') }}" class="menu-item">
          <span class="logo-statistic">
            <span class="bar b1"></span>
            <span class="bar b2"></span>
            <span class="bar b3"></span>
          </span>
          <span>Data Produk</span>
        </a>
        <a href="{{ route('admin.riwayat.index') }}" class="menu-item"><i class="fas fa-clock-rotate-left"></i><span>Riwayat</span></a>
        <hr>
      </div>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      <a href="#" class="menu-item logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-right-from-bracket"></i>
        <span>Logout</span>
      </a>
    </div>

    <script>
      const toggleBtn = document.getElementById("toggle-btn");
      const sidebar = document.getElementById("sidebar");
      toggleBtn.addEventListener("click", () => sidebar.classList.toggle("active"));
    </script>

    <!-- Main Content -->
    <main class="main-content">
      <header class="header">
        <div class="logo-top">
          <img src="{{ asset('images/e6ca3c98-d691-4d68-a69c-fd205249ffca_removalai_preview.png') }}" alt="Logo">
        </div>
        <h1>DASHBOARD</h1>
        <div class="header-right">
          <a href="{{ route('admin.orders.index') }}" class="notif-btn" title="Notifikasi">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M13.479 5.749A4.5 4.5 0 0 1 16.5 10v3.7l2.073 1.935a.5.5 0 0 1-.341.865H5.769a.5.5 0 0 1-.342-.866L7.5 13.7V10a4.5 4.5 0 0 1 3.021-4.251a1.5 1.5 0 0 1 2.958 0"/><path d="M10.585 18.5a1.5 1.5 0 0 0 2.83 0z"/></g></svg>
            @if($notifCount > 0)
            <span class="notif-badge">{{ $notifCount > 99 ? '99+' : $notifCount }}</span>
            @endif
          </a>
          <div class="profile">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="32" viewBox="0 0 36 32"><path fill="currentColor" d="M.5 31.983a.503.503 0 0 0 .612-.354c1.03-3.843 5.216-4.839 7.718-5.435c.627-.149 1.122-.267 1.444-.406c2.85-1.237 3.779-3.227 4.057-4.679a.5.5 0 0 0-.165-.473c-1.484-1.281-2.736-3.204-3.526-5.416a.5.5 0 0 0-.103-.171c-1.045-1.136-1.645-2.337-1.645-3.294c0-.559.211-.934.686-1.217a.5.5 0 0 0 .243-.408C10.042 5.036 13.67 1.026 18.12 1l.107.007c4.472.062 8.077 4.158 8.206 9.324a.5.5 0 0 0 .178.369c.313.265.459.601.459 1.057c0 .801-.427 1.786-1.201 2.772a.5.5 0 0 0-.084.158c-.8 2.536-2.236 4.775-3.938 6.145a.5.5 0 0 0-.178.483c.278 1.451 1.207 3.44 4.057 4.679c.337.146.86.26 1.523.403c2.477.536 6.622 1.435 7.639 5.232a.5.5 0 0 0 .966-.26c-1.175-4.387-5.871-5.404-8.393-5.95c-.585-.127-1.09-.236-1.336-.344c-1.86-.808-3.006-2.039-3.411-3.665c1.727-1.483 3.172-3.771 3.998-6.337c.877-1.14 1.359-2.314 1.359-3.317c0-.669-.216-1.227-.644-1.663C27.189 4.489 23.19.076 18.227.005l-.149-.002c-4.873.026-8.889 4.323-9.24 9.83c-.626.46-.944 1.105-.944 1.924c0 1.183.669 2.598 1.84 3.896c.809 2.223 2.063 4.176 3.556 5.543c-.403 1.632-1.55 2.867-3.414 3.676c-.241.105-.721.22-1.277.352c-2.541.604-7.269 1.729-8.453 6.147a.5.5 0 0 0 .354.612"/></svg>
          </div>
        </div>
      </header>

      <!-- Content -->
      <section class="content">
        <h2 class="title">Statistics</h2>

        <div class="stats-container">
         <div class="card">

  <div class="revenue-header">
  <h2 class="revenue-title">Revenue</h2>
  <div class="revenue-buttons segmented">
    <button class="rev-btn active" data-period="daily">Daily</button>
    <button class="rev-btn" data-period="weekly">Weekly</button>
    <button class="rev-btn" data-period="monthly">Monthly</button>
  </div>
</div>

<div style="position: relative; width: 100%; height: 400px;">
  <canvas id="revenueChart"></canvas>
</div>
</div>


 <div class="card">
      <div class="revenue-header">
        <h2 class="revenue-title">Pengunjung</h2>
      </div>
      <div style="position: relative; width: 100%; height: 400px;">
        <canvas id="visitorChart"></canvas>
      </div>
    </div>
  </div>




        <!-- Tables Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

          <!-- Best Selling Products -->
          <div class="card">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-bold text-gray-800">Best Selling Products</h3>

            </div>
            <div class="overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Product</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Sold</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Revenue</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">


                  @forelse($bestSellers as $index => $seller)
                  <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">
                      <span class="inline-flex items-center justify-center w-6 h-6 rounded-full {{ $index == 0 ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700' }} text-xs font-bold">
                        {{ $index + 1 }}
                      </span>
                    </td>
                    <td class="px-4 py-3">
                      <div class="flex items-center">

                        <div>
                          <p class="font-semibold text-gray-800">{{ $seller->menu->nama_menu ?? 'N/A' }}</p>
                          <p class="text-xs text-gray-500">{{ $seller->menu->kantin->nama_kantin ?? 'N/A' }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 font-semibold text-gray-700">{{ number_format($seller->total_sold) }}</td>
                    <td class="px-4 py-3 font-bold text-green-600">
                      Rp
                      {{ number_format($seller->total_revenue) }}
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                      <div class="flex flex-col items-center">
                        <i class="fas fa-box-open text-4xl mb-2 text-gray-300"></i>
                        <p>Belum ada data penjualan</p>
                      </div>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>

          <!-- Recent Transactions -->
          <div class="card">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-bold text-gray-800">Recent Transactions</h3>
              <a href="{{ route('admin.orders.index') }}" class="text-xs text-blue-600 hover:text-blue-800 font-semibold">View All →</a>
            </div>
            <div class="overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Order ID</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Customer</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Total</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  @php
                    $avatarGradients = [
                      'from-purple-400 to-pink-500',
                      'from-blue-400 to-cyan-500',
                      'from-green-400 to-emerald-500',
                      'from-red-400 to-pink-500',
                      'from-yellow-400 to-orange-500',
                    ];
                  @endphp

                  @forelse($recentTransactions as $index => $transaction)
                  @php
                    $status = $transaction->transaksiDetails->first()->status ?? 'belum';
                    $statusConfig = [
                      'belum' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'dot' => 'bg-gray-500', 'label' => 'Belum'],
                      'proses' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'dot' => 'bg-yellow-500', 'label' => 'Proses'],
                      'selesai' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'dot' => 'bg-green-500', 'label' => 'Selesai'],
                      'batal' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'dot' => 'bg-red-500', 'label' => 'Batal'],
                    ];
                    $config = $statusConfig[$status] ?? $statusConfig['belum'];

                    // Get initials
                    $namaLengkap = $transaction->pengguna->nama_siswa ?? 'Unknown';
                    $words = explode(' ', $namaLengkap);
                    $initials = count($words) >= 2
                      ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                      : strtoupper(substr($namaLengkap, 0, 2));
                  @endphp
                  <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">
                      <span class="font-mono text-xs font-semibold text-gray-700">#{{ $transaction->id_transaksi }}</span>
                    </td>
                    <td class="px-4 py-3">
                      <div class="flex items-center">
                        <div class="w-9 h-9 flex items-center justify-center mr-3">
                          <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 20 20"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></g></svg>
                        </div>
                        <div>
                          <p class="font-semibold text-gray-800 text-sm">{{ $namaLengkap }}</p>
                          <p class="text-xs text-gray-500">{{ $transaction->nis }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 font-semibold text-gray-700">
                      @php
                        $totalHarga = $transaction->transaksiDetails->sum('subtotal');
                      @endphp
                      Rp
                      @if($totalHarga >= 1000000)
                        {{ number_format($totalHarga / 1000000, 1) }}M
                      @elseif($totalHarga >= 1000)
                        {{ number_format($totalHarga / 1000, 0) }}K
                      @else
                        {{ number_format($totalHarga) }}
                      @endif
                    </td>
                    <td class="px-4 py-3">
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $config['bg'] }} {{ $config['text'] }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $config['dot'] }} mr-1.5"></span>
                        {{ $config['label'] }}
                      </span>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                      <div class="flex flex-col items-center">
                        <i class="fas fa-receipt text-4xl mb-2 text-gray-300"></i>
                        <p>Belum ada transaksi</p>
                      </div>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </section>

     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
window.addEventListener('load', function() {
  console.log('Page loaded, initializing charts...');

  // Check if Chart.js loaded
  if (typeof Chart === 'undefined') {
    console.error('Chart.js tidak ter-load!');
    return;
  }
  console.log('Chart.js loaded successfully!');

  // === DATA REAL DARI DATABASE ===
  const revenueLabels = @json($revenueLabels ?? []);
  const revenuePerKantin = @json($revenuePerKantin ?? []);

  console.log('Revenue Labels:', revenueLabels);
  console.log('Revenue Per Kantin:', revenuePerKantin);

  // === REVENUE CHART ===
  const revenueCanvas = document.getElementById('revenueChart');
  console.log('Revenue Canvas:', revenueCanvas);

  if (!revenueCanvas) {
    console.error('Canvas #revenueChart tidak ditemukan!');
    return;
  }

  // === WARNA UNTUK SETIAP KANTIN ===
  const baseColors = [
    { border: 'rgba(255,99,132,1)', background: 'rgba(255,99,132,0.2)' },
    { border: 'rgba(255,205,86,1)', background: 'rgba(255,205,86,0.2)' },
    { border: 'rgba(128,128,128,1)', background: 'rgba(128,128,128,0.4)' },
    { border: 'rgba(54,162,235,1)', background: 'rgba(54,162,235,0.2)' },
    { border: 'rgba(153,102,255,1)', background: 'rgba(153,102,255,0.2)' }
  ];

  // Buat datasets dari data real
  const datasets = revenuePerKantin.map((kantin, i) => {
    const color = baseColors[i % baseColors.length];
    return {
      label: kantin.nama_kantin,
      data: kantin.data,
      fill: true,
      borderColor: color.border,
      backgroundColor: color.background,
      borderWidth: 2,
      tension: 0.4,
      pointRadius: 4,
      pointHoverRadius: 6,
      pointBackgroundColor: color.border,
      pointBorderColor: '#fff',
      pointBorderWidth: 2
    };
  });

  console.log('Datasets:', datasets);

  let revenueChart; // Declare outside try block

  try {
    revenueChart = new Chart(revenueCanvas, {
    type: 'line',
    data: {
      labels: revenueLabels,
      datasets: datasets
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            usePointStyle: true,
            padding: 15,
            font: {
              size: 12,
              weight: 'bold'
            }
          }
        },
        tooltip: {
          mode: 'index',
          intersect: false,
          callbacks: {
            label: function(context) {
              let label = context.dataset.label || '';
              if (label) {
                label += ': ';
              }
              if (context.parsed.y !== null) {
                label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
              }
              return label;
            }
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              if (value >= 1000000) {
                return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
              } else if (value >= 1000) {
                return 'Rp ' + (value / 1000).toFixed(0) + 'K';
              }
              return 'Rp ' + value;
            }
          }
        },
        x: {
          grid: {
            display: false
          }
        }
      },
      interaction: {
        mode: 'nearest',
        axis: 'x',
        intersect: false
      }
    }
  });

  console.log('Revenue chart created successfully!');

  } catch (error) {
    console.error('Error creating revenue chart:', error);
  }

  // === IMPLEMENTASI FILTER DAILY/WEEKLY/MONTHLY ===
  console.log('Setting up filter buttons...');
  console.log('Revenue chart available:', !!revenueChart);
  console.log('Base colors available:', !!baseColors);

  document.querySelectorAll('.rev-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      console.log('Button clicked:', this.textContent);

      // Update active button
      document.querySelectorAll('.rev-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      // Get period from data attribute
      const period = this.dataset.period || this.textContent.trim().toLowerCase();
      console.log('Filter selected:', period);
      console.log('Fetching URL:', `/admin/dashboard/revenue-data?period=${period}`);

      // Fetch new data via AJAX
      fetch(`/admin/dashboard/revenue-data?period=${period}`)
        .then(response => {
          console.log('Response status:', response.status);
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json();
        })
        .then(data => {
          console.log('New data received:', data);

          if (!data.labels || !data.datasets) {
            throw new Error('Invalid data format received');
          }

          if (!revenueChart) {
            throw new Error('Chart not initialized');
          }

          // Update chart data
          revenueChart.data.labels = data.labels;

          // Update datasets
          revenueChart.data.datasets = data.datasets.map((kantin, i) => {
            const color = baseColors[i % baseColors.length];
            return {
              label: kantin.nama_kantin,
              data: kantin.data,
              fill: true,
              borderColor: color.border,
              backgroundColor: color.background,
              borderWidth: 2,
              tension: 0.4,
              pointRadius: 4,
              pointHoverRadius: 6,
              pointBackgroundColor: color.border,
              pointBorderColor: '#fff',
              pointBorderWidth: 2
            };
          });

          // Refresh chart
          revenueChart.update();
          console.log('Chart updated successfully!');
        })
        .catch(error => {
          console.error('Error fetching revenue data:', error);
          console.error('Error details:', error.message);
          alert('Gagal memuat data revenue: ' + error.message);
        });
    });
  });

  // === VISITOR CHART (DATA REAL) ===
  console.log('Creating visitor chart...');

  const visitorCanvas = document.getElementById('visitorChart');
  console.log('Visitor Canvas:', visitorCanvas);

  if (!visitorCanvas) {
    console.error('Canvas #visitorChart tidak ditemukan!');
    return;
  }

  // Data real dari database (sama dengan revenue labels - 7 hari terakhir)
  const visitorLabels = revenueLabels; // Gunakan labels yang sama
  const visitorPerKantin = @json($visitorPerKantin ?? []);

  console.log('Visitor Labels:', visitorLabels);
  console.log('Visitor Per Kantin:', visitorPerKantin);

  // Warna untuk setiap kantin (sesuaikan dengan jumlah kantin)
  const visitorColors = ['#f87171', '#fbbf24', '#9ca3af', '#60a5fa', '#a78bfa']; // merah, kuning, abu, biru, ungu

  // Buat datasets dari data real per kantin
  const visitorDatasets = visitorPerKantin.map((kantin, i) => ({
    label: kantin.nama_kantin,
    data: kantin.data,
    backgroundColor: visitorColors[i % visitorColors.length],
    borderRadius: 4,
    borderWidth: 0
  }));

  console.log('Visitor Datasets:', visitorDatasets);

  let visitorChart; // Declare outside try block

  try {
    visitorChart = new Chart(visitorCanvas, {
    type: 'bar',
    data: { labels: visitorLabels, datasets: visitorDatasets },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            usePointStyle: true,
            pointStyle: 'circle',
            boxWidth: 8,
            padding: 15,
            font: {
              size: 12,
              weight: 'bold'
            }
          }
        },
        title: { display: false },
        tooltip: {
          mode: 'index',
          intersect: false,
          callbacks: {
            label: function(context) {
              let label = context.dataset.label || '';
              if (label) {
                label += ': ';
              }
              if (context.parsed.y !== null) {
                label += context.parsed.y + ' pengunjung';
              }
              return label;
            }
          }
        }
      },
      scales: {
        x: {
          stacked: false,
          title: {
            display: true,
            text: 'Tanggal',
            font: {
              size: 13,
              weight: 'bold'
            }
          },
          grid: {
            display: false
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Jumlah Pengunjung (Unique NIS)',
            font: {
              size: 13,
              weight: 'bold'
            }
          },
          ticks: {
            stepSize: 1,
            callback: function(value) {
              if (Number.isInteger(value)) {
                return value;
              }
            }
          }
        }
      },
      interaction: {
        mode: 'nearest',
        axis: 'x',
        intersect: false
      }
    }
  });

  console.log('Visitor chart created successfully!');

  } catch (error) {
    console.error('Error creating visitor chart:', error);
  }

}); // END window.load
</script>
    </main>
  </div>
</body>
</html>
