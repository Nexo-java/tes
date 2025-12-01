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
  width: 60%;
  border: none;
  border-top: 1px solid #ddd;
  margin: 5px 0;
  transition: width 0.3s;
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



  .card-container {
    display: flex;
    gap: 30px;
    overflow-x: auto;
    padding: 20px;
    margin: 100px auto 0; /* top margin tetap, horizontal auto */
    scroll-snap-type: x mandatory;
    overflow: visible; /* biar dropdown bisa keluar grid */
    justify-content: center; /* ini biar card di tengah */
  }

  .card-container::-webkit-scrollbar {
    height: 10px;
  }
  .card-container::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 6px;
  }

  .kantin-card {
    flex: 0 20px auto;
    width: 340px ;
    border-radius: 8px;
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(71, 71, 71, 0.15);
    text-align: center;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    scroll-snap-align: start;
    position: relative;
    overflow: visible;
     z-index: 1;
     padding-bottom:20px;
      display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 400px;
  }

  .kantin-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
  }

  .kantin-card h3 {

    background: #ffffff;
    padding: 16px;
    font-size: 17px;
    font-weight: 600;

    border-radius: 8px 8px 0 0;
  }

  .kantin-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;

  }

  .manage-btn {
    margin-top: auto;
    margin-bottom: 3px;
    padding: 15px 66px;
    border: none;
    border-radius: 10px;
    background: #00A6E7;
    color: #ffffff;
    font-size: 14px;
    font-weight: 300;
    cursor: pointer;
    box-shadow: 0 3px 6px rgba(0,0,0,0.25);
    transition: all 0.2s ease;
    align-self: center;
    position: relative;
    z-index: 10;
  }

  .manage-btn:hover {
    background: #026b94;
  }

  .manage-btn:active {
    transform: scale(0.98);
  }

  .dropdown {
    position: relative;
    width: 100%;
    z-index: 999;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    top: calc(100% + 8px);
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    min-width: 180px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    border-radius: 12px;
    z-index: 9999;
    padding: 8px 0;
    border: 1px solid rgba(255, 255, 255, 0.3);
  }

  .dropdown.active .dropdown-content {
    display: block !important;
  }

  .kantin-card:hover .dropdown {
    z-index: 1000;
  }

  .dropdown-content a,
  .dropdown-content button {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    width: 100%;
    padding: 10px 16px;
    border: none;
    background: transparent;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    color: #333;
    text-decoration: none;
    transition: background 0.2s ease;
  }

  .dropdown-content a:hover,
  .dropdown-content button:hover {
    background: rgba(0,0,0,0.05);
  }

  .dropdown-content .delete-btn {
    color: #c0392b;
    font-weight: 600;
  }

  .dropdown-content .delete-btn:hover {
    background: rgba(192, 57, 43, 0.1);
  }

  .add-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 12px 28px;
    background: #0369B3;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 300;
    cursor: pointer;
    box-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    transition: all 0.2s ease;
    border: 1px solid #000000;
  }

  .add-btn:hover {
    background: #063557;
  }

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
  padding: 42px 24px 27px 24px;;
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
</head>

<body>
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
       <!-- Card Container -->
      <main class="content">
        <div class="card-container">
          @foreach($kantins as $kantin)
          <div class="kantin-card">
            <h3>{{ $kantin->nama_kantin }}</h3>
            <img src="{{ asset('storage/'.$kantin->gambar_kantin) }}" alt="{{ $kantin->nama_kantin }}">
            <div class="dropdown" data-dropdown>
              <button class="manage-btn" data-dropdown-button>Manage</button>
              <div class="dropdown-content">
                <a href="{{ route('admin.kantin.menus.index', $kantin->id_kantin) }}">👀 Lihat Menu</a>
                <a href="{{ route('admin.kantin.edit', $kantin->id_kantin) }}">✏ Edit</a>
                <form action="{{ route('admin.kantin.destroy', $kantin->id_kantin) }}" method="POST" style="margin: 0;" class="kantin-delete-form">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="delete-btn" onclick="showDeleteModal(this.form)">🗑 Hapus</button>
                </form>
              <script>
              document.addEventListener('DOMContentLoaded', function() {
                let deleteForm = null;
                window.showDeleteModal = function(form) {
                  deleteForm = form;
                  document.getElementById('deleteModal').style.display = 'flex';
                };
                document.getElementById('cancelDeleteBtn').onclick = function() {
                  document.getElementById('deleteModal').style.display = 'none';
                  deleteForm = null;
                };
                document.getElementById('confirmDeleteBtn').onclick = function() {
                  if (deleteForm) {
                    deleteForm.submit();
                  }
                };
                document.getElementById('deleteModal').addEventListener('click', function(e) {
                  if (e.target === this) {
                    this.style.display = 'none';
                    deleteForm = null;
                  }
                });
              });
              </script>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <!-- Button Tambahkan Kantin -->
        <a href="{{ route('admin.kantin.create') }}" class="add-btn">+ Tambahkan Kantin</a>
      </main>
        </div>
      </header>
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

    </main>
  </div>

  <script>
    // Sidebar toggle
    const toggleBtn = document.getElementById("toggle-btn");
    const sidebar = document.getElementById("sidebar");

    if (toggleBtn && sidebar) {
      toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("active");
      });
    }

    // SIMPLE DROPDOWN
    window.addEventListener('load', function() {
      const buttons = document.querySelectorAll('[data-dropdown-button]');

      buttons.forEach(btn => {
        btn.onclick = function(e) {
          e.stopPropagation();
          const parent = this.parentElement;
          const wasActive = parent.classList.contains('active');

          // Close all
          document.querySelectorAll('[data-dropdown]').forEach(d => d.classList.remove('active'));

          // Open this one
          if (!wasActive) parent.classList.add('active');
        };
      });

      // Close on outside click
      window.onclick = function() {
        document.querySelectorAll('[data-dropdown]').forEach(d => d.classList.remove('active'));
      };
    });  </script>
</body>
</html>
