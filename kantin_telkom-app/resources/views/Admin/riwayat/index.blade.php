<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Riwayat Transaksi - Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
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

.content .title {
  font-size: 30px;
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 5px;
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

.action-buttons {
  display: flex;
  gap: 10px;
}

.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  transition: all 0.3s;
}

.btn-danger {
  background: #ef4444;
  color: white;
}

.btn-danger:hover {
  background: #dc2626;
}

.btn-warning {
  background: #f59e0b;
  color: white;
}

.btn-warning:hover {
  background: #d97706;
}

/* Transaction List Styles */
.transaction-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.transaction-item {
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  padding: 16px;
  background: #fff;
  transition: all 0.2s;
}

.transaction-item:hover {
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  border-color: #d1d5db;
}

.transaction-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 8px;
}

.transaction-time {
  color: #f97316;
  font-size: 13px;
  font-weight: 600;
  margin-bottom: 8px;
}

.transaction-info {
  flex: 1;
}

.transaction-title {
  font-size: 14px;
  font-weight: 500;
  color: #111827;
  margin-bottom: 4px;
  line-height: 1.5;
}

.transaction-meta {
  font-size: 13px;
  color: #6b7280;
  line-height: 1.6;
}

.checkbox {
  width: 18px;
  height: 18px;
  cursor: pointer;
  margin-top: 4px;
}

.badge {
  display: inline-block;
  padding: 4px 12px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: 500;
}

.badge-success {
  background: #d1fae5;
  color: #065f46;
}

.badge-danger {
  background: #fee2e2;
  color: #991b1b;
}

.btn-delete {
  background: transparent;
  color: #ef4444;
  padding: 6px 12px;
  border: 1px solid #ef4444;
  border-radius: 6px;
  cursor: pointer;
  font-size: 13px;
  transition: all 0.2s;
}

.btn-delete:hover {
  background: #ef4444;
  color: white;
}

.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: #9ca3af;
}

.empty-state i {
  font-size: 64px;
  margin-bottom: 16px;
  display: block;
  opacity: 0.5;
}

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

/* Hide Previous/Next text arrows */
.pagination nav ul li:first-child,
.pagination nav ul li:last-child {
  display: none;
}
  </style>
</head>

<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar" id="">
      <div class="menu-toggle" id=""><i class="fas fa-bars"></i></div>
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
        <a href="{{ route('admin.riwayat.index') }}" class="menu-item active"><i class="fas fa-clock-rotate-left"></i><span>Riwayat</span></a>
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
        <h1>RIWAYAT</h1>
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
        </div>
      </header>

      <!-- Content -->
      <section class="content">
        <div class="card">
          <div class="search-section">
            <form action="{{ route('admin.riwayat.index') }}" method="GET" class="search-box">
              <i class="fas fa-search"></i>
              <input type="text" name="search" placeholder="Search anything here..." value="{{ $search ?? '' }}">
              <button type="submit" style="display: none;"></button>
            </form>

            <div class="action-buttons">
              <!-- Tombol Delete All dengan trigger modal -->
              <button class="btn btn-danger" onclick="showDeleteAllModal()">
                Delete All
              </button>
              <!-- Modal Konfirmasi Hapus Semua -->
              <div id="deleteModal" class="delete-modal">
                <div class="delete-modal-content">
                  <div class="delete-modal-title">Yakin Untuk Hapus Semua Riwayat?</div>
                  <hr>
                  <div class="delete-modal-actions">
                    <button id="confirmDeleteBtn" class="delete-btn">
                      <i class="fas fa-trash"></i> Hapus Semua
                    </button>
                    <button id="cancelDeleteBtn" class="cancel-btn">Batal</button>
                  </div>
                </div>
              </div>
              <style>
              .delete-modal {
                display: none;
                position: fixed;
                z-index: 9999;
                left: 0; top: 0;
                width: 100vw; height: 100vh;
                background: rgba(0,0,0,0.8);
                align-items: center;
                justify-content: center;
              }
              .delete-modal-content {
                background: #fff;
                border-radius: 16px;
                max-width: 400px;
                width: 90%;
                margin: auto;
                padding: 42px 24px 27px 24px;
                box-shadow: 0 4px 24px rgba(0,0,0,0.2);
                position: relative;
              }
              .delete-modal-title {
                font-size: 1.2rem;
                font-weight: 600;
                margin-bottom: 18px;
                text-align: left;
              }
              .delete-modal-actions {
                display: flex;
                gap: 10px;
                justify-content: flex-end;
                margin-top: 32px;
              }
              .delete-btn, .cancel-btn {
                padding: 7px 10px;
                font-size: 0.95rem;
                border-radius: 8px;
              }
              .delete-btn {
                background: #ef4444;
                color: #fff;
                border: none;
                border-radius: 10px;
                padding: 7px 20px;
                font-size: 12px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 8px;
                box-shadow: 0 2px 6px rgba(239,68,68,0.15);
                cursor: pointer;
              }
              .cancel-btn {
                background: #f9fafb;
                color: #222;
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 7px 20px;
                font-size: 12pxrem;
                font-weight: 500;
                box-shadow: 0 2px 6px rgba(0,0,0,0.08);
                cursor: pointer;
              }
              </style>
            </div>
          </div>

          <div class="transaction-list">
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
              <div class="transaction-item">
                <div class="transaction-time">
                  {{ $displayTime }}
                </div>
                <div class="transaction-header">
                  <div class="transaction-info">
                    <div class="transaction-title">
                      {{ $transaksi->pengguna->nama_siswa ?? 'N/A' }} Membeli {{ $menuText }} Rp{{ number_format($totalHarga, 0, ',', '.') }}
                    </div>
                    <div class="transaction-meta">
                      VIA : {{ $metodeBayar }}
                      @php
                        $statusDetail = $transaksi->transaksiDetails->first()->status ?? '';
                        $statusColors = [
                          'selesai' => 'bg-green-100 text-green-800',
                          'batal' => 'bg-red-100 text-red-800',
                          'proses' => 'bg-blue-100 text-blue-800',
                          'belum' => 'bg-yellow-100 text-yellow-800'
                        ];
                      @endphp
                      @if($statusDetail)
                        <span class="ml-2 inline-block px-2 py-1 rounded-full text-xs font-semibold {{ $statusColors[$statusDetail] ?? 'bg-gray-100 text-gray-800' }}">
                          {{ ucfirst($statusDetail) }}
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <div class="empty-state">
                <p>~ Tidak Ada Riwayat Pembelian ~</p>
              </div>
            @endforelse
          </div>
        </div>

        @if($transaksis->lastPage() > 1)
        <div class="pagination" style="position: fixed; bottom: 30px; left: 50%; transform: translateX(-20%); display: flex; justify-content: center; align-items: center; z-index: 999;">
          <nav>
            <ul style="display: flex; list-style: none; padding: 0; gap: 0; margin: 0;">
              @foreach(range(1, $transaksis->lastPage()) as $page)
                @if($page == $transaksis->currentPage())
                  <li class="active" style="display: inline-block;">
                    <span style="display: inline-block; padding: 12px 12px; background: #fff; color: #000; font-size: 14px; border: 1px solid #000; border-radius: 6px; font-weight: 600;">{{ $page }}</span>
                  </li>
                @else
                  <li style="display: inline-block;">
                    <a href="{{ $transaksis->appends(['search' => $search])->url($page) }}" style="display: inline-block; padding: 12px 12px; background: none; color: #333; font-size: 14px; text-decoration: none; border: none; border-radius: 6px; transition: background 0.2s ease;">{{ $page }}</a>
                  </li>
                @endif
              @endforeach
            </ul>
          </nav>
        </div>
        @endif
      </section>
    </main>
  </div>

  <script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Toggle all checkboxes
    function toggleAll(source) {
      const checkboxes = document.querySelectorAll('.row-checkbox');
      checkboxes.forEach(cb => cb.checked = source.checked);
    }

    // Delete single transaction
    function deleteSingle(id) {
      if (!confirm('Yakin ingin menghapus riwayat transaksi ini?')) return;

      fetch(`/admin/riwayat/${id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert(data.message);
          location.reload();
        } else {
          alert(data.message);
        }
      })
      .catch(err => alert('Terjadi kesalahan: ' + err.message));
    }

    // Delete selected transactions
    function deleteSelected() {
      const selected = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);

      if (selected.length === 0) {
        alert('Pilih minimal 1 riwayat untuk dihapus');
        return;
      }

      if (!confirm(`Yakin ingin menghapus ${selected.length} riwayat terpilih?`)) return;

      fetch('/admin/riwayat/bulk-delete', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ ids: selected })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert(data.message);
          location.reload();
        } else {
          alert(data.message);
        }
      })
      .catch(err => alert('Terjadi kesalahan: ' + err.message));
    }

    // Tampilkan modal konfirmasi hapus semua
    function showDeleteAllModal() {
      document.getElementById('deleteModal').style.display = 'flex';
    }

    // Sembunyikan modal
    document.getElementById('cancelDeleteBtn').onclick = function() {
      document.getElementById('deleteModal').style.display = 'none';
    };

    // Proses hapus semua riwayat saat tombol konfirmasi di modal ditekan
    document.getElementById('confirmDeleteBtn').onclick = function() {
      document.getElementById('deleteModal').style.display = 'none';
      fetch('/admin/riwayat/delete-all', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert(data.message);
          location.reload();
        } else {
          alert(data.message);
        }
      })
      .catch(err => alert('Terjadi kesalahan: ' + err.message));
    };
  </script>
</body>
</html>
