<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Daftar Menu - {{ $kantin->nama_kantin }}</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
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
  background: black;
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



 .table-header {
      display: flex;
      justify-content: flex-start;
      align-items: center;

    }

    .btn-add {
      background: #256ECE;
      color: white;
      border: 1px solid #ccc;
      padding: 12px 18px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      transition: 0.2s;
      box-shadow: 0 2px 5px rgba(0,0,0,0.5);
        font-weight: 200;

    }

    .btn-add:hover {
      background: #dcdcdc;
    }

    table {
      width: 99%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      justify-self: center;


    }

    th, td {
      text-align: center;
      padding: 20px 23px;
      border-bottom: 1px solid #e0e0e0;
      font-size: 14px;
      color: #333;
    }

    th {
      background: #E7E7E7;
      font-weight: 700;
    }

    tr:hover {
      background: #f9f9f9;
    }

    .menu-thumb {
      width: 55px;
      height: 55px;
      border-radius: 6px;
      object-fit: cover;
    }

    .badge {
      display: inline-block;
      padding: 7px 16px;
      border-radius: 5px;
      font-size: 13px;
      font-weight: 600;
      color: white;
      cursor: pointer;
    }

    .aktif {
      background: #28a745;
    }

    .nonaktif {
      background: #dc3545;
    }

    .stok-badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
    }

    .stok-aman {
      color: #333;
    }

    .stok-rendah {
      color: #333;
    }

    .stok-habis {
      color: #333;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background: #fff;
      min-width: 140px;
      border-radius: 5x;
      box-shadow: 0 3px 10px rgba(0,0,0,0.15);
      z-index: 1000;
      right: 0;
      overflow: hidden;
    }

    .dropdown-content a,
    .dropdown-content button {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      text-align: center;
      background: none;
      border: none;
      padding: 10px 14px;
      color: #333;
      font-size: 13.5px;
      cursor: pointer;
    }

    .dropdown-content a svg,
    .dropdown-content button svg {
      width: 18px;
      height: 18px;
      flex-shrink: 0;
    }

    .dropdown-content a:hover,
    .dropdown-content button:hover {
      background: #f2f2f2;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .manage-btn {
      background: #0E6094;
      color: #fff;
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      font-size: 13px;
      cursor: pointer;
    }

    .manage-btn:hover {
      background: #0056b3;
    }

.content {
  padding: 20px;
}

.sub-header {
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 20px;
  color: #333;
}

.pagination-container {
  position: fixed;       /* tetap di layar */
  bottom: 30px;          /* jarak dari bawah */
  left: 50%;
  transform: translateX(-20%);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 999;          /* biar di atas elemen lain */
}


.table-wrapper {
  position: relative;
  padding-bottom: 80px; /* beri ruang untuk pagination */
}

.pagination-container nav ul {
  display: flex;
  list-style: none;
  padding: 0;
}

.pagination-container nav ul li a {
  display: inline-block;
  padding: 12px 12px;
  background: none;
  color: #333;
  font-size: 14px;
  text-decoration: none;
  transition: background 0.2s ease;
  border: none;
  border-radius: 6px;
}

.pagination-container nav ul li a:hover {
  background: #d4d4d4;
}

/* Aktif */
.pagination-container nav ul li.active a {
  background: #fff;
  border: 1px solid #000000;
  color: #000000;
  border-radius: 6px;
  font-weight: 600;
}

.table-header {
  display: flex;
  justify-content: space-around; /* search kiri, tombol kanan */
  align-items: center;
  flex-wrap: wrap;
  margin-bottom: 20px;
  gap: 70%;
}

.search-form {
  display: flex;
  align-items: center;
  background: #fff;
  border-radius: 30px;
  padding: 10px 18px;
  box-shadow: 0 3px 6px rgba(0,0,0,0.3);
  width: 260px;
  transition: all 0.2s ease;
}

.search-form:focus-within {
  box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.search-form i {
  color: #555;
  font-size: 16px;
  margin-right: 8px;
}

#searchInput {
  border: none;
  outline: none;
  font-size: 14px;
  color: #333;
  width: 100%;
  background: transparent;
}

#searchInput::placeholder {
  color: #aaa;
  font-size: 13px;
}

/* Tombol kanan (Add Menu + Sort) */
.table-actions {
  display: flex;
  align-items: center;
  gap: 10px;
}

.btn-add {
  background: #256ECE;
  color: white;
  padding: 10px 30px;
  border-radius: 12px;
  cursor: pointer;
  font-size: 12px;
  transition: 0.2s;
  box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    font-weight: 600;
    margin-top: 5px;
}


.btn-sort {
  background: yellow;
  color: #000;
  padding: 10px 28px;
  border-radius: 12px;
  cursor: pointer;
  font-size: 12px;
  transition: 0.2s;
  box-shadow: 0 2px 5px rgba(0,0,0,0.3);
  font-weight: 600;
}

.btn-add:hover {
  background: #0d3e9b;
}

.btn-sort:hover {
  background: #d8d65e;
}

/* Dropdown Sort */
.sort-container {
  position: relative;
  z-index: 999;
}

.sort-dropdown {
  position: absolute;
  right: 0;
  top: 110%;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 3px 8px rgba(0,0,0,0.2);
  display: none;
  flex-direction: column;
  width: 130px;
  overflow: hidden;
  z-index: 9999;
}

.sort-container.active .sort-dropdown {
  display: flex !important;
}

.sort-dropdown button {
  border: none;
  background: none;
  padding: 10px 14px;
  text-align: left;
  font-size: 14px;
  cursor: pointer;
  color: #333;
}

.sort-dropdown button:hover {
  background: #f2f2f2;
}


  </style>
</head>

<body>
  <div id="deleteModal" class="delete-modal">
    <div class="delete-modal-content">
      <div class="delete-modal-title">Yakin Untuk Hapus ?</div>
      <hr>
      <div class="delete-modal-actions">
        <button id="confirmDeleteBtn" class="delete-btn">
          <i class="fas fa-trash"></i> Hapus
        </button>
        <button id="cancelDeleteBtn" class="cancel-btn">Batal</button>
      </div>
    </div>
  </div>
  <div class="dashboard-container">
    @if (session('success'))
    <div id="popup-success"
      style="
        position: fixed;
        top: -100px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #c41616;
        color: white;
        padding: 1rem 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        font-weight: 600;
        font-size: 1.1rem;
        transition: top 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.6s ease;
        z-index: 9999;
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 250px;
      ">
      <span>{{ session('success') }}</span>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
      const popup = document.getElementById("popup-success");
      if (popup) {
        setTimeout(() => {
          popup.style.top = "40px";
          popup.style.opacity = "1";
        }, 200);
        setTimeout(() => {
          popup.style.top = "-150px";
          popup.style.opacity = "0";
        }, 2800);
      }
    });
    </script>
    @endif
    @if (session('success'))
    <div id="popup-success"
      style="
        position: fixed;
        top: -100px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #16a34a;
        color: white;
        padding: 1rem 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        font-weight: 600;
        font-size: 1.1rem;
        transition: top 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.6s ease;
        z-index: 9999;
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 250px;
      ">
      <span>{{ session('success') }}</span>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
      const popup = document.getElementById("popup-success");
      if (popup) {
        setTimeout(() => {
          popup.style.top = "40px";
          popup.style.opacity = "1";
        }, 200);
        setTimeout(() => {
          popup.style.top = "-150px";
          popup.style.opacity = "0";
        }, 2800);
      }
    });
    </script>
    @endif
    <!-- Sidebar -->
    <div class="sidebar" id="">
      <div class="menu-toggle" id="toggle-btn"><i class="fas fa-bars"></i></div>
      <div class="menu">
        <a href="{{ route('admin.dashboard') }}" class="menu-item">
          <span class="logo-mini">
            <span class="sq"></span><span class="sq"></span>
            <span class="sq"></span><span class="sq"></span>
          </span>
          <span>Beranda</span>
        </a>
        <a href="{{ route('admin.kantin.index') }}" class="menu-item active">
          <span class="logo-statistic">
            <span class="bar b1"></span>
            <span class="bar b2"></span>
            <span class="bar b3"></span>
          </span>
          <span>Data Produk</span>
        </a>
        <a href="{{ route('admin.riwayat.index') }}" class="menu-item "><i class="fas fa-clock-rotate-left"></i><span>Riwayat</span></a>
        <hr>
      </div>
      <hr>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      <a href="#" class="menu-item logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-right-from-bracket"></i>
        <span>Logout</span>
      </a>
    </div>

    <!-- Main Content -->
    <main class="main-content">
      <header class="header">
        <div class="logo-top">
          <img src="{{ asset('images/e6ca3c98-d691-4d68-a69c-fd205249ffca_removalai_preview.png') }}" alt="Logo">
        </div>
        <h1>DAFTAR KANTIN</h1>
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

<div class="sub-header">Daftar Menu {{ $kantin->nama_kantin }}</div>

    <div class="table-header">
  <div class="search-form">
    <i class="fas fa-search"></i>
    <input type="text" id="searchInput" placeholder="Cari menu...">
  </div>

  <div class="table-actions">
        <a href="{{ route('admin.kantin.menus.create', $kantin->id_kantin) }}">
          <button class="btn-add">+ Add Menu</button>
        </a>


    <div class="sort-container" id="sortContainerMain">
      <button class="btn-sort" onclick="toggleSortDropdown(event)">▼ Sort </button>
      <div class="sort-dropdown" id="sortDropdownMain">
        <button data-limit="5">Tampilkan 5</button>
        <button data-limit="10">Tampilkan 10</button>
        <button data-limit="all">Tampilkan Semua</button>
      </div>
    </div>
  </div>
</div>

    <div class="table-wrapper">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Gambar</th>
            <th>Nama Menu</th>
            <th>Harga</th>
            <th>Stok</th>

            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($menus as $menu)
          <tr>
            <td>
              @if($menu->gambar_menu)
                <img src="{{ asset('storage/'.$menu->gambar_menu) }}" alt="gambar menu" class="menu-thumb">
              @else
                Customer
              @endif
            </td>
            <td>{{ $menu->nama_menu }}</td>
            <td>{{ number_format($menu->harga, 0, ',', '.') }}</td>
            <td>
              <span class="stok-badge {{ $menu->stok == 0 ? 'stok-habis' : ($menu->stok <= 5 ? 'stok-rendah' : 'stok-aman') }}">
                {{ $menu->stok }}
              </span>
            </td>
            <td>
              <span class="badge {{ $menu->stok > 0 ? 'aktif' : 'nonaktif' }}">
                {{ $menu->stok > 0 ? 'Available' : 'Non Available' }}
              </span>
            </td>
            <td>
              <div class="dropdown">
                <button class="manage-btn">Manage <span style="color: #000;">▼</span></button>
                <div class="dropdown-content">
                  <a href="{{ route('admin.kantin.menus.edit', [$kantin->id_kantin, $menu->menu_id]) }}">
                    Edit
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844l2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565l6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/></svg>
                  </a>
                  <form action="{{ route('admin.kantin.menus.destroy', [$kantin->id_kantin, $menu->menu_id]) }}"
                        method="POST" class="delete-menu-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color: red;">
                      Hapus
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z"/></svg>
                    </button>
                    <button type="button" class="open-delete-modal" style="display:none;"></button>
                    </button>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
       <div class="pagination-container" id="custom-pagination"></div>
    </div>

      </section>
    </main>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
  // === Pagination ===
  const container = document.getElementById("custom-pagination");
  @if($menus instanceof \Illuminate\Pagination\LengthAwarePaginator)
    const total = {{ $menus->total() }};
    const perPage = @json($perPage);
    const current = {{ $menus->currentPage() }};
    const lastPage = {{ $menus->lastPage() }};
    const baseUrl = "{{ $menus->url(1) }}".replace(/page=1/, 'page=');

    let html = '<nav><ul>';
    for (let i = 1; i <= lastPage; i++) {
      let pageUrl = `${baseUrl}${i}`;
      if (perPage && perPage !== '5') {
        if (pageUrl.indexOf('?') === -1) {
          pageUrl += `?per_page=${perPage}`;
        } else {
          pageUrl += `&per_page=${perPage}`;
        }
      }
      html += `<li class="${i === current ? 'active' : ''}">
                 <a href="${pageUrl}">${i}</a>
               </li>`;
    }
    html += '</ul></nav>';
    container.innerHTML = html;
  @else
    container.innerHTML = ''; // kalau all, tidak perlu pagination
  @endif

  // === LIVE SEARCH (nama menu) ===
  const searchInput = document.getElementById('searchInput');
  const table = document.querySelector('table');
  const rows = Array.from(table.querySelectorAll('tbody tr'));
  const pagination = document.getElementById('custom-pagination');

  let currentLimit = 'all';

  function updateTableDisplay() {
    const keyword = searchInput.value.toLowerCase().trim();
    let hasKeyword = keyword.length > 0;
    let visibleIdx = 0;
    let limitNum = currentLimit === 'all' ? Infinity : parseInt(currentLimit);
    console.log('updateTableDisplay called, limit:', currentLimit, 'limitNum:', limitNum, 'keyword:', keyword);
    rows.forEach((row, idx) => {
      const namaMenuCell = row.querySelectorAll('td')[1];
      const namaMenu = namaMenuCell ? namaMenuCell.textContent.toLowerCase() : '';
      const match = namaMenu.includes(keyword);
      if (match) {
        if (currentLimit === 'all' || visibleIdx < limitNum) {
          row.style.display = '';
          visibleIdx++;
        } else {
          row.style.display = 'none';
        }
      } else {
        row.style.display = 'none';
      }
      console.log('Row', idx, 'namaMenu:', namaMenu, 'match:', match, 'display:', row.style.display);
    });
    console.log('Visible rows:', visibleIdx, 'Total rows:', rows.length);
    pagination.style.display = hasKeyword ? 'none' : 'flex';
  }

  searchInput.addEventListener('keyup', updateTableDisplay);

  const sortDropdown = document.getElementById('sortDropdownMain');
  sortDropdown.querySelectorAll('button').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      if (btn.type === 'submit') btn.type = 'button';
      const limit = btn.getAttribute('data-limit');
      console.log('Sort button clicked, limit:', limit);
      // Ubah URL dan reload halaman agar controller mengirim data sesuai pilihan
      const url = new URL(window.location.href);
      url.searchParams.set('per_page', limit);
      window.location.href = url.toString();
    });
  });

  updateTableDisplay();
});
</script>
<script>
    // Modal delete logic
    document.addEventListener('DOMContentLoaded', function() {
      const deleteModal = document.getElementById('deleteModal');
      const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
      const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
      let targetDeleteForm = null;

      // Attach to all delete buttons
      document.querySelectorAll('.delete-menu-form button[type="submit"]').forEach(btn => {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          targetDeleteForm = btn.closest('form');
          deleteModal.style.display = 'flex';
        });
      });

      cancelDeleteBtn.addEventListener('click', function() {
        deleteModal.style.display = 'none';
        targetDeleteForm = null;
      });

      confirmDeleteBtn.addEventListener('click', function() {
        if (targetDeleteForm) {
          deleteModal.style.display = 'none';
          targetDeleteForm.submit();
        }
      });

      // Close modal on outside click
      deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
          deleteModal.style.display = 'none';
          targetDeleteForm = null;
        }
      });
    });
// === LIMIT TABLE ROWS ===
</script>

<script>
// === SORT DROPDOWN (Global Function) ===
function toggleSortDropdown(event) {
  event.stopPropagation();
  const container = document.getElementById('sortContainerMain');
  const dropdown = document.getElementById('sortDropdownMain');

  console.log('Toggle called', container, dropdown);

  // Toggle display
  if (dropdown.style.display === 'flex') {
    dropdown.style.display = 'none';
  } else {
    dropdown.style.display = 'flex';
  }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
  const dropdown = document.getElementById('sortDropdownMain');
  const container = document.getElementById('sortContainerMain');

  if (dropdown && container && !container.contains(event.target)) {
    dropdown.style.display = 'none';
  }
});</script>
</body>
</html>
