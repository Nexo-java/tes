<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Edit Menu</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* CSS dari create.blade.php */
    .form-card {
      background: #fff;
      border-radius: 8px;
      padding: 25px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      max-width: 900px;
      margin: 80px auto;
      position: relative;
      border: #949494 solid 1px;
    }
    .form-card h2 {
      text-align: center;
      margin-bottom: 60px;
      font-size: 18px;
      font-weight: 600;
    }
    .form-content {
      margin-top: 10px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
      align-items: flex-start;
    }
    .form-left {
      display: flex;
      flex-direction: column;
    }
    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 10px;
    }
    .form-group label {
      font-size: 12px;
      font-weight: 500;
      margin-bottom: 6px;
      color: #000;
    }
    .form-group input[type="text"],
    .form-group input[type="number"] {
      width: 95%;
      padding: 9px;
      border: 0.5px solid #aca9a9;
      border-radius: 6px;
      background: #f2f2f2;
      font-size: 14px;
      color: #333;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    textarea {
      resize: none;
      width: 95%;
      padding: 10px;
      border: none;
      border: 0.5px solid #aca9a9;
      border-radius: 6px;
      background: #f2f2f2;
      box-shadow: 0 2px 3px rgba(0,0,0,0.2);
        height: 80px;
    }

    .icon-upload {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        color: #cfcfcf;
        padding: 10px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        box-shadow: 0 2px 3px rgba(0,0,0,0.2);
        border: none;
        cursor: pointer;
        border: 0.5px solid #aca9a9;
        width: 95%;
    }
    .form-right .image-preview {
        width: 100%;
        height: 350px;
        background: #f5f5f5;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        border: 1px solid #787878;
        font-size: 14px;
        box-shadow:  0 2px 3px rgba(0,0,0,0.2);
        overflow: hidden;
      }
    .form-right .image-preview input[type="file"] {
      position: absolute;
      width: 100%;
      height: 100%;
      opacity: 0;
      cursor: pointer;
    }
    .form-right .image-preview img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
    .form-footer {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: 12px;
      margin-top: 15px;
      padding-right: 5px;
    }
    .submit-btn {
      background:#03B12F;
      color: white;
      padding: 10px 24px;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 2px 2px 4px rgba(0,0,0,0.3);
      transition: background 0.2s ease;
    }
    .submit-btn:hover {
      background: #028823;
    }
    .back-btn {
      background: red;
      color: white;
      padding: 10px 18px;
      border-radius: 6px;
      font-weight: 600;
      text-decoration: none;
      font-size: 14px;
      box-shadow: 2px 2px 4px rgba(0,0,0,0.3);
      transition: background 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .back-btn:hover {
      background: #780C0C;
    }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }
    <style>
      /* Satu set CSS bersih, tanpa duplikasi, diambil dari create.blade.php */
      .form-card {
        background: #fff;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        max-width: 900px;
        margin: 80px auto;
        position: relative;
        border: #949494 solid 1px;
      }
      .form-content {
        margin-top: 10px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        align-items: flex-start;
      }
      .form-left {
        display: flex;
        flex-direction: column;
      }
      .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
      }
      .form-group label {
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 6px;
        color: #000;
      }
      .form-group input[type="text"],
      .form-group input[type="number"] {
        width: 95%;
        padding: 9px;
        border: 0.5px solid #aca9a9;
        border-radius: 6px;
        background: #f2f2f2;
        font-size: 14px;
        color: #333;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      }

      input::placeholder,
      textarea::placeholder {
        color: #999;
        font-size: 11px;
      }
      textarea {
        resize: none;
        width: 95%;
        padding: 10px;
        border: none;
        border-radius: 6px;
        background: #f2f2f2;
        box-shadow: 0 2px 3px rgba(0,0,0,0.2);
        height: 80px;
      }

      .icon-upload {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        color: #cfcfcf;
        padding: 10px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        box-shadow: 0 2px 3px rgba(0,0,0,0.2);
        border: none;
        cursor: pointer;
        border: 0.5px solid #aca9a9;
        width: 95%;
      }
      

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

    .submit-btn {
  background:#03B12F;
  color: white;
  padding: 10px 24px;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  box-shadow: 2px 2px 4px rgba(0,0,0,0.3);
  transition: background 0.2s ease;
}
.submit-btn:hover {
  background: #028823;
}

/* Back button (removed absolute positioning) */
.back-btn {
  background: red;
  color: white;
  padding: 10px 18px;
  border-radius: 6px;
  font-weight: 600;
  text-decoration: none;
  font-size: 14px;
  box-shadow: 2px 2px 4px rgba(0,0,0,0.3);
  transition: background 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.back-btn:hover {
  background: #780C0C;
}
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

/* === Sidebar === */
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
  z-index: 1000;
}
.sidebar.active {
  width: 220px;
  align-items: flex-start;
  padding-left: 15px;
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
  transition: 0.3s;
}
.sidebar.active .menu-item {
  flex-direction: row;
  font-size: 14px;
  gap: 12px;
  justify-content: flex-start;
  padding: 10px;
}
.menu-item.active {
  color: #000;
  background: #f0f0f0;
  border-radius: 6px;
}
.menu-item i {
  font-size: 20px;
  margin-bottom: 5px;
}
.sidebar.active .menu-item i {
  margin-bottom: 0;
}
hr {
  width: 60%;
  border: 0.5px solid #ddd;
  margin: 15px 0;
  transition: width 0.3s;
}
.sidebar.active hr {
  width: 90%;
}
.logout {
  margin-bottom: 20px;
}

/* === Logo style === */
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
  border: 2px solid #000;
}
.menu-item.active .logo-mini .sq {
  background: transparent;
  border: 2px solid #000;
  box-shadow: 0 2px 4px rgba(0,0,0,0.12);
}
.sidebar.active .logo-mini {
  margin-bottom: 0;
}

/* Statistik icon */
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
  width: 6px;
  background: transparent;
  border: 2px solid #374151;
}
.logo-statistic .bar.b1 { height: 10px; }
.logo-statistic .bar.b2 { height: 20px; }
.logo-statistic .bar.b3 { height: 16px; }
.menu-item.active .logo-statistic .bar {
  background: black;
  border: none;
}
.sidebar.active .logo-statistic {
  margin-bottom: 0;
}

/* === Header === */
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

.main-content {
  margin-left: 80px;
  width: calc(100% - 80px);
  transition: all 0.3s;
}
.sidebar.active ~ .main-content {
  margin-left: 220px;
  width: calc(100% - 220px);
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


    </style>


  </style>
</head>

<body>
  <div class="dashboard-container">
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

    <main class="main-content">
      <header class="header">
        <div class="logo-top">
          <img src="{{ asset('images/e6ca3c98-d691-4d68-a69c-fd205249ffca_removalai_preview.png') }}" alt="Logo">
        </div>
        <h1>DAFTAR MENU</h1>
        <div class="header-right">
          <a href="{{ route('admin.orders.index') }}" class="notif-btn" title="Notifikasi">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M13.479 5.749A4.5 4.5 0 0 1 16.5 10v3.7l2.073 1.935a.5.5 0 0 1-.341.865H5.769a.5.5 0 0 1-.342-.866L7.5 13.7V10a4.5 4.5 0 0 1 3.021-4.251a1.5 1.5 0 0 1 2.958 0"/><path d="M10.585 18.5a1.5 1.5 0 0 0 2.83 0z"/></g></svg>
            @php
              $notifCount = \App\Models\TransaksiDetail::whereHas('transaksi')
                ->where('status', 'belum')
                ->count();
            @endphp
            @if($notifCount > 0)
            <span class="notif-badge">{{ $notifCount > 99 ? '99+' : $notifCount }}</span>
            @endif
          </a>
          <div class="profile">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="32" viewBox="0 0 36 32"><path fill="currentColor" d="M.5 31.983a.503.503 0 0 0 .612-.354c1.03-3.843 5.216-4.839 7.718-5.435c.627-.149 1.122-.267 1.444-.406c2.85-1.237 3.779-3.227 4.057-4.679a.5.5 0 0 0-.165-.473c-1.484-1.281-2.736-3.204-3.526-5.416a.5.5 0 0 0-.103-.171c-1.045-1.136-1.645-2.337-1.645-3.294c0-.559.211-.934.686-1.217a.5.5 0 0 0 .243-.408C10.042 5.036 13.67 1.026 18.12 1l.107.007c4.472.062 8.077 4.158 8.206 9.324a.5.5 0 0 0 .178.369c.313.265.459.601.459 1.057c0 .801-.427 1.786-1.201 2.772a.5.5 0 0 0-.084.158c-.8 2.536-2.236 4.775-3.938 6.145a.5.5 0 0 0-.178.483c.278 1.451 1.207 3.44 4.057 4.679c.337.146.86.26 1.523.403c2.477.536 6.622 1.435 7.639 5.232a.5.5 0 0 0 .966-.26c-1.175-4.387-5.871-5.404-8.393-5.95c-.585-.127-1.09-.236-1.336-.344c-1.86-.808-3.006-2.039-3.411-3.665c1.727-1.483 3.172-3.771 3.998-6.337c.877-1.14 1.359-2.314 1.359-3.317c0-.669-.216-1.227-.644-1.663C27.189 4.489 23.19.076 18.227.005l-.149-.002c-4.873.026-8.889 4.323-9.24 9.83c-.626.46-.944 1.105-.944 1.924c0 1.183.669 2.598 1.84 3.896c.809 2.223 2.063 4.176 3.556 5.543c-.403 1.632-1.55 2.867-3.414 3.676c-.241.105-.721.22-1.277.352c-2.541.604-7.269 1.729-8.453 6.147a.5.5 0 0 0 .354.612"/></svg>
          </div>
        </div>
      </header>

      <div class="form-card">
        <form action="{{ route('admin.kantin.menus.update', [$kantin->id_kantin, $menu->menu_id]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-content">
            <!-- Kiri -->
            <div class="form-left">
              <div class="form-group">
                <label>Nama Menu</label>
                <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" required placeholder="Tambah data">
              </div>
              <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" value="{{ $menu->stok }}" required placeholder="Tambah data">
              </div>
              <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" step="0.01" value="{{ $menu->harga }}" required placeholder="Tambah data">
              </div>
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deks_menu" rows="4" style="resize:none; padding:8px;  border: 0.5px solid #aca9a9; border-radius:6px; background:#f2f2f2; box-shadow: 0 2px 3px rgba(0,0,0,0.2);" placeholder="Tambah Deksripsi">{{ $menu->deks_menu }}</textarea>
              </div>
              <div class="form-group">
                <label for="gambar_menu">Gambar Menu</label>
                <input type="file" id="gambar_menu" name="gambar_menu" hidden>
                <label for="gambar_menu" class="icon-upload" id="gambar_menu_label">
                  <i class="fas fa-download"></i> <span id="gambar_menu_text">{{ $menu->gambar_menu ? basename($menu->gambar_menu) : 'Tambah Data' }}</span>
                </label>
              </div>
            </div>
            <!-- Kanan -->
            <div class="form-right">
              <label>Gambar</label>
              <div class="image-preview" id="preview-box">
                @if($menu->gambar_menu)
                  <img src="{{ asset('storage/' . $menu->gambar_menu) }}" alt="Preview">
                @else
                  No Image
                @endif
              </div>
            </div>
          </div>
          <div class="form-footer">
            <a href="{{ route('admin.kantin.menus.index', $kantin->id_kantin) }}" class="back-btn">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="submit-btn">Konfirmasi</button>
          </div>
        </form>
      </div>
    </main>
  </div>

  <script>
    const fileInput = document.getElementById("gambar_menu");
    const previewBox = document.getElementById("preview-box");
    const gambarMenuText = document.getElementById("gambar_menu_text");

    fileInput.addEventListener("change", function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewBox.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        }
        reader.readAsDataURL(file);
        gambarMenuText.textContent = file.name;
      } else {
        previewBox.innerHTML = "No Image";
        gambarMenuText.textContent = "Tambah Data";
      }
    });
  </script>
</body>
</html>
