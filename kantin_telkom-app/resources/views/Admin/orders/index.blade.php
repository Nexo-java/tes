<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Management - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
  width: 31px;
  height: 29px;
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

.notif-btn.active {
  background: transparent;
  border: 0.5px solid #000;
}

.notif-btn.active svg {
  color: #000;
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
    max-width: 1810px;
    margin: 0 auto;
    margin-right: 20px;
}

.card {
  background: #fff;
  padding: 20px;
  border-radius: 12px;

}

.search-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  gap: 15px;
  flex-wrap: wrap;
}

.search-box {
  flex: 1;
  min-width: 280px;
  max-width: 400px;
  position: relative;
}

.search-box input {
  width: 100%;
  padding: 12px 50px 12px 40px;
  border: 1px solid #e5e7eb;
  border-radius: 25px;
  font-size: 14px;
  background: #f9fafb;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
  transition: all 0.3s ease;
}

.search-box input:focus {
  outline: none;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
  border-color: #d1d5db;
}

.search-box input::placeholder {
  color: #9ca3af;
}

.search-box i {
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #9ca3af;
}

.search-box button {
  position: absolute;
  right: 5px;
  top: 50%;
  transform: translateY(-50%);
  background: transparent;
  border: none;
  padding: 8px 15px;
  border-radius: 4px;
  cursor: pointer;
  color: #6b7280;
}

/* Order List Styles */
.order-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.order-item {
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  padding: 16px;
  background: #fff;
  transition: all 0.2s;
}

.order-item:hover {
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  border-color: #d1d5db;
}

.order-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 12px;
}

.order-time {
  color: #f97316;
  font-size: 13px;
  font-weight: 600;
  margin-bottom: 8px;
}

.order-info {
  flex: 1;
}

.order-title {
  font-size: 14px;
  font-weight: 500;
  color: #111827;
  margin-bottom: 4px;
  line-height: 1.5;
}

.order-meta {
  font-size: 13px;
  color: #6b7280;
  line-height: 1.6;
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 4px;
}

.order-meta span {
  display: inline-flex;
  align-items: center;
  gap: 4px;
}

.order-actions {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 12px;
  padding-top: 12px;
  border-top: 1px solid #f3f4f6;
}

.status-badge {
  display: inline-block;
  padding: 4px 12px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: 500;
  background: #f3f4f6;
  color: #333;
  transition: background 0.2s, color 0.2s;
}

.status-belum {
  background: #fef3c7 !important;
  color: #92400e !important;
}

.status-proses {
  background: #dbeafe !important;
  color: #1e40af !important;
}

.status-selesai {
  background: #d1fae5 !important;
  color: #065f46 !important;
}

.status-batal {
  background: #fee2e2 !important;
  color: #991b1b !important;
}

.status-select {
  padding: 6px 12px;
  border: 1px solid #e5e7eb;
  border-radius: 6px;
  font-size: 13px;
  cursor: pointer;
  transition: all 0.2s;
}

.status-select:focus {
  outline: none;
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.empty-state {
  text-align: center;
  padding: 40px 20px;
  color: #6b7280;
  border: 0.1px solid gray;
  border-radius: 8px;
  background: #fff;
  margin: 20px 0;
}

.empty-state p {
  font-size: 14px;
  margin: 0;
  color: #6b7280;
}

.mark-read-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 20px;
  background: #10b981;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
}

.mark-read-btn:hover {
  background: #059669;
  transform: translateY(-1px);
  box-shadow: 0 4px 8px rgba(16, 185, 129, 0.3);
}

.mark-read-btn:active {
  transform: translateY(0);
}

/* Pagination Styles */
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 30px;
  margin-bottom: 20px;
}

.pagination nav ul {
  display: flex;
  list-style: none;
  padding: 0;
  gap: 8px;
  margin: 0;
}

.pagination nav ul li a,
.pagination nav ul li span {
  display: inline-block;
  padding: 12px 16px;
  background: none;
  color: #333;
  font-size: 14px;
  text-decoration: none;
  transition: background 0.2s ease;
  border: none;
  border-radius: 6px;
  min-width: 40px;
  text-align: center;
}

.pagination nav ul li a:hover {
  background: #d4d4d4;
}

.pagination nav ul li.active span {
  background: #fff;
  border: 1px solid #000000;
  color: #000000;
  border-radius: 6px;
  font-weight: 600;
}

.content .title {
  font-size: 30px;
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 5px;
}

.payment-status-badge {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 4px 10px;
  border-radius: 9px;
  font-size: 12px;
  font-weight: 500;
}

.payment-status-badge.paid {
  background: #d1fae5;
  color: #065f46;
}

.payment-status-badge.unpaid {
  background: #fef3c7;
  color: #92400e;
}

.view-proof-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 12px;
  background: #3b82f6;
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 13px;
  cursor: pointer;
  transition: all 0.2s;
}

.view-proof-btn:hover {
  background: #2563eb;
  transform: translateY(-1px);
  box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
}

.no-proof-text {
  font-size: 12px;
  color: #ef4444;
  font-style: italic;
}

.payment-status-select {
  padding: 6px 12px;
  border: 2px solid #e5e7eb;
  border-radius: 6px;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
}

.payment-status-select.pending {
  border-color: #fbbf24;
  background: #fef3c7;
  color: #92400e;
}

.payment-status-select.verified {
  border-color: #10b981;
  background: #d1fae5;
  color: #065f46;
}

.payment-status-select:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Modal Styles */
.proof-modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  animation: fadeIn 0.3s;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.proof-modal-content {
  position: relative;
  background-color: #fff;
  margin: 5% auto;
  padding: 0;
  width: 90%;
  max-width: 600px;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
  animation: slideDown 0.3s;
}

@keyframes slideDown {
  from {
    transform: translateY(-50px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

.proof-modal-header {
  padding: 20px;
  border-bottom: 1px solid #e5e7eb;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.proof-modal-header h3 {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
  color: #111827;
}

.close-modal {
  background: transparent;
  border: none;
  font-size: 28px;
  font-weight: bold;
  color: #6b7280;
  cursor: pointer;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 6px;
  transition: all 0.2s;
}

.close-modal:hover {
  background: #f3f4f6;
  color: #111827;
}

.proof-modal-body {
  padding: 20px;
  text-align: center;
}

.proof-modal-body img {
  max-width: 100%;
  height: auto;
  max-height: 500px;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.status-dropdown {
  position: relative;
  display: inline-block;
}
.status-dropdown .status-badge {
  cursor: pointer;
  min-width: 80px;
  text-align: center;
}
.status-options {
  margin-top: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  border: 1px solid #e5e7eb;
  padding: 4px 0;
}
.status-option {
  display: block;
  width: 100%;
  border: none;
  background: none;
  padding: 8px 16px;
  font-size: 13px;
  text-align: left;
  cursor: pointer;
  transition: background 0.2s;
}
.status-option:hover {
  background: #f3f4f6;
}
</style>

<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="menu-toggle" id="toggle-btn"><i class="fas fa-bars"></i></div>
      <div class="menu">
        <a href="{{ route('admin.dashboard') }}" class="menu-item">
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
        <h1>NOFITIKASI</h1>
        <div class="header-right">
          <a href="{{ route('admin.orders.index') }}" class="notif-btn active" title="Notifikasi">
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
        <div class="card">
          <div class="search-section">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="search-box">
              <i class="fas fa-search"></i>
              <input type="text" name="search" placeholder="Search anything here..." value="{{ request('search') }}">
              <button type="submit" style="display: none;"></button>
            </form>

            @if($notifCount > 0)
            <button id="markAllReadBtn" class="mark-read-btn">
            </i> Mark All as Read
            </button>
            @endif
          </div>

          <div class="order-list" style="min-height: 600px;">
            @forelse($transaksis as $transaksi)
              @php
                $status = $transaksi->transaksiDetails->first()->status ?? 'belum';
                $menus = [];
                $totalHarga = 0;
                foreach($transaksi->transaksiDetails as $detail) {
                  $menus[] = $detail->menu->nama_menu . ' ' . $detail->jml . 'x';
                  $totalHarga += $detail->subtotal;
                }
                $menuText = implode(' + ', $menus);

                // Determine payment method
                $metodeBayar = strtoupper($transaksi->metode_bayar ?? 'QRIS');
                if ($metodeBayar === 'TUNAI') {
                  $metodeBayar = 'CASH';
                }

                // Format waktu transaksi
                $tglTransaksi = \Carbon\Carbon::parse($transaksi->tgl_transaksi);
                $isToday = $tglTransaksi->isToday();
                $isYesterday = $tglTransaksi->isYesterday();

                if ($isToday) {
                  $displayTime = 'Today - ' . $tglTransaksi->format('H:i');
                } elseif ($isYesterday) {
                  $displayTime = 'Yesterday - ' . $tglTransaksi->format('H:i');
                } else {
                  $displayTime = $tglTransaksi->format('d/m/Y - H:i');
                }
              @endphp
              <div class="order-item">
                <div class="order-time">
                  {{ $displayTime }}
                </div>
                <div class="order-header">
                  <div class="order-info">
                    <div class="order-title">
                      {{ $transaksi->pengguna->nama_siswa ?? 'N/A' }} Membeli {{ $menuText }} Rp{{ number_format($totalHarga, 0, ',', '.') }}
                    </div>
                    <div class="order-meta">
                      <span><i class="fas fa-user"></i> NIS: {{ $transaksi->nis }}</span>
                      <span><i class="fas fa-credit-card"></i> VIA: {{ $metodeBayar }}</span>
                      <span><i class="fas fa-hashtag"></i> Order ID: {{ $transaksi->karcis->karcis_id ?? $transaksi->id_transaksi }}</span>
                      <span class="payment-status-badge {{ $transaksi->status_pembayaran === 'bayar' ? 'paid' : 'unpaid' }}">
                        <i class="fas fa-{{ $transaksi->status_pembayaran === 'bayar' ? 'check-circle' : 'clock' }}"></i>
                        Payment: {{ $transaksi->status_pembayaran === 'bayar' ? 'Verified' : 'Pending' }}
                      </span>
                    </div>
                  </div>
                </div>
                <hr class="my-3 border-t-2 border-gray-300 w-full">
                <div class="order-actions">
                  <div class="status-dropdown">
                    <button type="button" class="status-badge status-{{ $status }}" onclick="toggleStatusDropdown(this)">
                      {{ ucfirst($status) }}
                    </button>
                    <div class="status-options" style="display:none;position:absolute;z-index:10;background:#fff;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);min-width:100px;">
                      <button type="button" class="status-option status-belum" onclick="changeStatus(this, '{{ $transaksi->id_transaksi }}', 'belum')">Belum</button>
                      <button type="button" class="status-option status-proses" onclick="changeStatus(this, '{{ $transaksi->id_transaksi }}', 'proses')">Proses</button>
                      <button type="button" class="status-option status-selesai" onclick="changeStatus(this, '{{ $transaksi->id_transaksi }}', 'selesai')">Selesai</button>
                      <button type="button" class="status-option status-batal" onclick="changeStatus(this, '{{ $transaksi->id_transaksi }}', 'batal')">Batal</button>
                    </div>
                  </div>
    <script>
    function toggleStatusDropdown(btn) {
      // Close all other dropdowns
      document.querySelectorAll('.status-options').forEach(opt => opt.style.display = 'none');
      // Toggle current dropdown
      const options = btn.parentElement.querySelector('.status-options');
      options.style.display = options.style.display === 'block' ? 'none' : 'block';
    }

    function changeStatus(optionBtn, transaksiId, newStatus) {
      // Disable all option buttons
      const optionsDiv = optionBtn.parentElement;
      Array.from(optionsDiv.children).forEach(btn => btn.disabled = true);
      fetch(`/admin/orders/${transaksiId}/update-status`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status: newStatus })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          location.reload();
        } else {
          alert('Gagal update status: ' + data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat update status');
      });
    }
    // Close dropdown if click outside
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.status-dropdown')) {
        document.querySelectorAll('.status-options').forEach(opt => opt.style.display = 'none');
      }
    });
    </script>

                  @if($transaksi->metode_bayar === 'non-tunai' && $transaksi->bukti_transfer)
                    <button class="view-proof-btn" onclick="viewProof('{{ asset('storage/' . $transaksi->bukti_transfer) }}')">
                      <i class="fas fa-image"></i> View Proof
                    </button>
                  @endif

                  <select
                    class="payment-status-select {{ $transaksi->status_pembayaran === 'bayar' ? 'verified' : 'pending' }}"
                    data-id="{{ $transaksi->id_transaksi }}"
                    data-current="{{ $transaksi->status_pembayaran }}"
                    data-metode="{{ $transaksi->metode_bayar }}">
                    <option value="belum" {{ $transaksi->status_pembayaran == 'belum' ? 'selected' : '' }}>Payment Pending</option>
                    <option value="bayar" {{ $transaksi->status_pembayaran == 'bayar' ? 'selected' : '' }}>Payment Verified</option>
                  </select>
                </div>
              </div>
            @empty
              <div class="empty-state">
                <p>~ No notification ~</p>
              </div>
            @endforelse
          </div>

          <!-- Pagination -->
          @if($transaksis->hasPages())
          <div class="pagination mt-8">
            <nav>
              <ul style="display: flex; gap: 8px; justify-content: center;">
                @foreach(range(1, $transaksis->lastPage()) as $page)
                  <li class="{{ $page == $transaksis->currentPage() ? 'active' : '' }}">
                    @if($page == $transaksis->currentPage())
                      <span>{{ $page }}</span>
                    @else
                      <a href="{{ $transaksis->url($page) }}">{{ $page }}</a>
                    @endif
                  </li>
                @endforeach
              </ul>
            </nav>
          </div>
          @endif
        </div>
      </section>

      <!-- Proof Modal -->
      <div id="proofModal" class="proof-modal">
        <div class="proof-modal-content">
          <div class="proof-modal-header">
            <h3><i class="fas fa-receipt"></i> Payment Proof</h3>
            <button class="close-modal" onclick="closeProofModal()">&times;</button>
          </div>
          <div class="proof-modal-body">
            <img id="proofImage" src="" alt="Payment Proof">
          </div>
        </div>
      </div>
    </main>
  </div>

    <script>
        // Proof Modal Functions
        function viewProof(imageUrl) {
            const modal = document.getElementById('proofModal');
            const proofImage = document.getElementById('proofImage');
            proofImage.src = imageUrl;
            modal.style.display = 'block';
        }

        function closeProofModal() {
            const modal = document.getElementById('proofModal');
            modal.style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('proofModal');
            if (event.target === modal) {
                closeProofModal();
            }
        }

        // Main Logic
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelects = document.querySelectorAll('.status-select');
            const paymentStatusSelects = document.querySelectorAll('.payment-status-select');
            const markAllReadBtn = document.getElementById('markAllReadBtn');

            // Mark All as Read Button
            if (markAllReadBtn) {
                markAllReadBtn.addEventListener('click', function() {
                    if (confirm('Tandai semua pesanan pending sebagai sudah dibaca (status akan berubah menjadi Proses)?')) {
                        markAllAsRead();
                    }
                });
            }

            // Order Status Update
              statusSelects.forEach(select => {
                select.addEventListener('change', function() {
                  const transaksiId = this.dataset.id;
                  const newStatus = this.value;
                  updateStatus(transaksiId, newStatus, this);
                });
              });

            // Payment Status Update
              paymentStatusSelects.forEach(select => {
                select.addEventListener('change', function() {
                  const transaksiId = this.dataset.id;
                  const newPaymentStatus = this.value;
                  updatePaymentStatus(transaksiId, newPaymentStatus, this);
                });
              });

            function updateStatus(id, status, selectElement) {
                fetch(`/admin/orders/${id}/update-status`, {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                  },
                  body: JSON.stringify({ status: status })
                })
                .then(response => response.json())
                .then(data => {
                  if (data.success) {
                    // Update current status
                    selectElement.dataset.current = status;
                    // Reload page to update list
                    location.reload();
                  } else {
                    alert('Gagal update status: ' + data.message);
                    selectElement.value = selectElement.dataset.current;
                  }
                })
                .catch(error => {
                  console.error('Error:', error);
                  alert('Terjadi kesalahan saat update status');
                  selectElement.value = selectElement.dataset.current;
                });
            }

            function updatePaymentStatus(id, paymentStatus, selectElement) {
                // Disable select to prevent double click
                selectElement.disabled = true;

                fetch(`/admin/orders/${id}/update-payment-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ status_pembayaran: paymentStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update current status
                        selectElement.dataset.current = paymentStatus;
                        // Reload page to update badge
                        location.reload();
                    } else {
                        alert('Gagal update payment status: ' + data.message);
                        selectElement.value = selectElement.dataset.current;
                        selectElement.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat update payment status');
                    selectElement.value = selectElement.dataset.current;
                    selectElement.disabled = false;
                });
            }

            function markAllAsRead() {
                fetch('/admin/orders/mark-all-read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert('Gagal menandai sebagai dibaca: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menandai sebagai dibaca');
                });
            }
        });
    </script>
      </section>
    </main>
  </div>
</body>
</html>
