<header class="header">
  <div class="logo-top">
    <img src="{{ asset('images/e6ca3c98-d691-4d68-a69c-fd205249ffca_removalai_preview.png') }}" alt="Logo">
  </div>
  <h1>DATA PRODUK</h1>
  <div class="header-right">
    <a href="{{ route('admin.orders.index') }}" class="notif-btn" title="Notifikasi">
      <i class="fas fa-bell"></i>
      @if(isset($notifCount) && $notifCount > 0)
      <span class="notif-badge">{{ $notifCount > 99 ? '99+' : $notifCount }}</span>
      @endif
    </a>
    <div class="profile">
      <svg viewBox="0 0 36 32" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M18 16C21.866 16 25 12.866 25 9C25 5.134 21.866 2 18 2C14.134 2 11 5.134 11 9C11 12.866 14.134 16 18 16ZM18 19C13.33 19 4 21.34 4 26V28C4 28.55 4.45 29 5 29H31C31.55 29 32 28.55 32 28V26C32 21.34 22.67 19 18 19Z" fill="currentColor"/>
      </svg>
    </div>
  </div>
</header>
