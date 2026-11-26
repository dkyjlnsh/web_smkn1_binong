<div class="topbar">
  <div class="brand-admin">
    <img src="{{ asset('assets/logo.jpg.png') }}" alt="Logo">
    <div>
      <h1>Panel Admin SMKN 1 Binong</h1>
      <span>{{ auth()->user()->isAdmin() ? 'Sistem Manajemen Konten Sekolah' : 'Kontributor Berita & Publikasi' }}</span>
    </div>
  </div>
  <div class="nav-links">
    @if(auth()->user()->isAdmin())
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i data-lucide="layout-dashboard" style="width:16px;height:16px;"></i> Dashboard
      </a>
      <a href="{{ route('admin.visimisi') }}" class="{{ request()->routeIs('admin.visimisi') ? 'active' : '' }}">
        <i data-lucide="target" style="width:16px;height:16px;"></i> Visi &amp; Misi
      </a>
      <a href="{{ route('admin.jurusan') }}" class="{{ request()->routeIs('admin.jurusan') ? 'active' : '' }}">
        <i data-lucide="layers" style="width:16px;height:16px;"></i> Jurusan
      </a>
      <a href="{{ route('admin.kuis') }}" class="{{ request()->routeIs('admin.kuis') ? 'active' : '' }}">
        <i data-lucide="help-circle" style="width:16px;height:16px;"></i> Kuis Jurusan
      </a>
      <a href="{{ route('admin.faq') }}" class="{{ request()->routeIs('admin.faq') ? 'active' : '' }}">
        <i data-lucide="message-circle-question" style="width:16px;height:16px;"></i> FAQ
      </a>
      <a href="{{ route('admin.pimpinan') }}" class="{{ request()->routeIs('admin.pimpinan') ? 'active' : '' }}">
        <i data-lucide="award" style="width:16px;height:16px;"></i> Pimpinan
      </a>
      <a href="{{ route('admin.guru') }}" class="{{ request()->routeIs('admin.guru') ? 'active' : '' }}">
        <i data-lucide="users" style="width:16px;height:16px;"></i> Tenaga Pendidik
      </a>
      <a href="{{ route('admin.dudi') }}" class="{{ request()->routeIs('admin.dudi') ? 'active' : '' }}">
        <i data-lucide="building-2" style="width:16px;height:16px;"></i> Mitra DUDI
      </a>
      <a href="{{ route('admin.pesan') }}" class="{{ request()->routeIs('admin.pesan') ? 'active' : '' }}">
        <i data-lucide="mail" style="width:16px;height:16px;"></i> Pesan
      </a>
    @endif

    <a href="{{ route('admin.berita') }}" class="{{ request()->routeIs('admin.berita') ? 'active' : '' }}">
      <i data-lucide="newspaper" style="width:16px;height:16px;"></i> Berita
    </a>
    <a href="{{ url('/') }}" target="_blank">Website ↗</a>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
  </div>
</div>