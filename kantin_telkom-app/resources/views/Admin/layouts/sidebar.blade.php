<!-- sidebar-header.blade.php -->
<div class="sidebar" id="sidebar">
  <div class="menu-toggle" id="toggle-btn"><i class="fas fa-bars"></i></div>
  <div class="menu">
    <a href="{{ route('admin.dashboard') }}" class="menu-item active">
      <span class="logo-mini">
        <span class="sq"></span><span class="sq"></span>
        <span class="sq"></span><span class="sq"></span>
      </span>
      <span>Beranda</span>
    </a>
    <a href="{{ route('admin.kantin.index') }}" class="menu-item le">
      <span class="logo-statistic">
        <span class="bar b1"></span>
        <span class="bar b2"></span>
        <span class="bar b3"></span>
      </span>
      <span>Data Produk</span>
    </a>
    <a href="{{ route('admin.riwayat.index') }}" class="menu-item"><i class="fas fa-clock-rotate-left"></i><span>Riwayat</span></a>
  </div>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  <a href="#" class="menu-item logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-right-from-bracket"></i>
    <span>Logout</span>
  </a>
</div>


