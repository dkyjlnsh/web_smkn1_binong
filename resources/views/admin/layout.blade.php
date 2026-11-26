<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') — Admin SMKN 1 Binong</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo.jpg.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
    body { background: #f1f5f9; color: #0f172a; padding: 24px 16px 48px; }
    .container { max-width: 1080px; margin: 0 auto; }

    /* TOPBAR */
    .topbar {
      display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px;
      background: #ffffff; padding: 16px 24px; border-radius: 16px;
      border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
      margin-bottom: 24px;
    }
    .brand-admin { display: flex; align-items: center; gap: 12px; }
    .brand-admin img { width: 40px; height: 40px; border-radius: 10px; object-fit: cover; border: 1px solid #e2e8f0; }
    .brand-admin h1 { font-size: 1.05rem; font-weight: 700; color: #0f172a; line-height: 1.2; }
    .brand-admin span { font-size: 0.78rem; color: #64748b; font-weight: 500; }

    .nav-links { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; }
    .nav-links a {
      display: inline-flex; align-items: center; gap: 6px;
      text-decoration: none; font-size: 0.86rem; font-weight: 600; color: #475569;
      padding: 8px 14px; border-radius: 10px; transition: all 0.2s ease;
    }
    .nav-links a.active { background: #fef2f2; color: #c8102e; box-shadow: inset 0 0 0 1px #fecaca; }
    .nav-links a:hover:not(.active) { background: #f8fafc; color: #0f172a; }
    .btn-logout {
      display: inline-flex; align-items: center; gap: 6px;
      background: #0f172a; color: #fff; border: none; padding: 8px 14px;
      border-radius: 10px; cursor: pointer; font-size: 0.85rem; font-weight: 600;
      transition: background 0.2s;
    }
    .btn-logout:hover { background: #334155; }

    /* DASHBOARD SUMMARY CARDS */
    .stats-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 16px; margin-bottom: 24px;
    }
    .stat-card {
      background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px;
      padding: 20px; display: flex; align-items: center; justify-content: space-between;
      text-decoration: none; color: inherit;
      box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
      transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 24px rgba(15, 23, 42, 0.07);
      border-color: #cbd5e1;
    }
    .stat-card.current { border-color: #fda4af; background: linear-gradient(to bottom right, #ffffff, #fff1f2); }
    .stat-info .stat-label { font-size: 0.82rem; font-weight: 600; color: #64748b; margin-bottom: 6px; }
    .stat-info .stat-value { font-size: 1.75rem; font-weight: 800; color: #0f172a; line-height: 1; }
    .stat-info .stat-sub { font-size: 0.75rem; color: #b45309; font-weight: 600; margin-top: 6px; }
    .stat-icon {
      width: 48px; height: 48px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .icon-red { background: #fee2e2; color: #c8102e; }
    .icon-blue { background: #dbeafe; color: #1d4ed8; }
    .icon-emerald { background: #d1fae5; color: #047857; }
    .icon-amber { background: #fef3c7; color: #b45309; }
    .icon-pink { background: #fce7f3; color: #be185d; }

    /* MAIN CARDS & FORMS */
    .card {
      background: #ffffff; padding: 28px; border-radius: 16px;
      border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(15, 23, 42, 0.03);
      margin-bottom: 24px;
    }
    .card-header {
      display: flex; justify-content: space-between; align-items: center;
      margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;
    }
    .card-header h2 { font-size: 1.15rem; font-weight: 700; color: #0f172a; }
    .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; }
    .form-group { margin-bottom: 16px; }
    label { display: block; font-size: 0.84rem; font-weight: 600; margin-bottom: 6px; color: #334155; }
    input[type="text"], input[type="number"], select, textarea, input[type="file"] {
      width: 100%; padding: 11px 14px; border: 1px solid #cbd5e1; border-radius: 10px;
      font-size: 0.92rem; color: #0f172a; background: #f8fafc; transition: all 0.2s;
    }
    input:focus, select:focus, textarea:focus {
      outline: none; background: #ffffff; border-color: #c8102e;
      box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.12);
    }
    textarea { min-height: 120px; resize: vertical; }

    /* BUTTONS & ALERTS */
    .btn-group-submit { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; }
    .btn-primary {
      display: inline-flex; align-items: center; gap: 8px;
      background: #c8102e; color: #fff; border: none; padding: 11px 20px;
      border-radius: 10px; font-weight: 600; font-size: 0.9rem; cursor: pointer;
      box-shadow: 0 4px 12px rgba(200, 16, 46, 0.22); transition: all 0.2s;
    }
    .btn-primary:hover { background: #a50d26; transform: translateY(-1px); }
    .btn-draft {
      display: inline-flex; align-items: center; gap: 8px;
      background: #ffffff; color: #334155; border: 1px solid #cbd5e1; padding: 11px 20px;
      border-radius: 10px; font-weight: 600; font-size: 0.9rem; cursor: pointer;
      transition: all 0.2s;
    }
    .btn-draft:hover { background: #f1f5f9; color: #0f172a; border-color: #94a3b8; }
    .btn-edit {
      background: #f59e0b; color: #fff; border: none; padding: 6px 12px;
      border-radius: 8px; font-size: 0.82rem; cursor: pointer; font-weight: 600;
    }
    .btn-edit:hover { background: #d97706; }
    .btn-danger {
      background: #ef4444; color: #fff; border: none; padding: 6px 12px;
      border-radius: 8px; font-size: 0.82rem; cursor: pointer; font-weight: 600;
    }
    .btn-danger:hover { background: #dc2626; }
    .alert {
      display: flex; align-items: center; gap: 10px;
      background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;
      padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 0.9rem; font-weight: 500;
    }

    /* TABLE & STATUS BADGES */
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    th, td { text-align: left; padding: 14px 12px; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem; vertical-align: middle; }
    th { background: #f8fafc; font-weight: 600; color: #475569; font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.03em; }
    tr:hover td { background: #f8fafc; }
    .badge-pill { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 0.78rem; font-weight: 600; background: #f1f5f9; color: #334155; }
    .badge-terbit { background: #dcfce7; color: #166534; }
    .badge-draf { background: #fef3c7; color: #92400e; }
    .aksi-wrap { display: flex; gap: 6px; }

    /* MODAL */
    .modal-bg { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.55); backdrop-filter: blur(2px); align-items: center; justify-content: center; padding: 20px; z-index: 99; }
    .modal-bg.show { display: flex; }
    .modal-box { background: #fff; width: 100%; max-width: 540px; padding: 28px; border-radius: 16px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 40px rgba(0,0,0,0.18); }
    .modal-box h2 { font-size: 1.2rem; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; }
  </style>
</head>
<body>
  <div class="container">
    <!-- NAVBAR ADMIN -->
    <div class="topbar">
      <div class="brand-admin">
        <img src="{{ asset('assets/logo.jpg.png') }}" alt="Logo">
        <div>
          <h1>Panel Admin SMKN 1 Binong</h1>
          <span>Sistem Manajemen Konten Sekolah</span>
        </div>
      </div>
      <div class="nav-links">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <i data-lucide="layout-dashboard" style="width:16px;height:16px;"></i> Dashboard
        </a>
        <a href="{{ route('admin.kuis') }}" class="{{ request()->routeIs('admin.kuis') ? 'active' : '' }}">
          <i data-lucide="help-circle" style="width:16px;height:16px;"></i> Kuis Jurusan
        </a>
        <a href="{{ route('admin.berita') }}" class="{{ request()->routeIs('admin.berita') ? 'active' : '' }}">
          <i data-lucide="newspaper" style="width:16px;height:16px;"></i> Berita
        </a>
        <a href="{{ route('admin.pimpinan') }}" class="{{ request()->routeIs('admin.pimpinan') ? 'active' : '' }}">
          <i data-lucide="award" style="width:16px;height:16px;"></i> Pimpinan
        </a>
        <a href="{{ route('admin.guru') }}" class="{{ request()->routeIs('admin.guru') ? 'active' : '' }}">
          <i data-lucide="users" style="width:16px;height:16px;"></i> Tenaga Pendidik
        </a>
        <a href="{{ route('admin.pesan') }}" class="{{ request()->routeIs('admin.pesan') ? 'active' : '' }}">
          <i data-lucide="mail" style="width:16px;height:16px;"></i> Pesan
        </a>
        <a href="{{ url('/') }}" target="_blank">
          Website ↗
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="btn-logout">Logout</button>
        </form>
      </div>
    </div>

    <!-- DASHBOARD RINGKASAN DATA -->
    <div class="stats-grid">
      <a href="{{ route('admin.kuis') }}" class="stat-card {{ request()->routeIs('admin.kuis') ? 'current' : '' }}">
        <div class="stat-info">
          <div class="stat-label">Soal Kuis Jurusan</div>
          <div class="stat-value">{{ \App\Models\KuisSoal::count() }}</div>
        </div>
        <div class="stat-icon icon-pink">
          <i data-lucide="help-circle"></i>
        </div>
      </a>

      <a href="{{ route('admin.berita') }}" class="stat-card {{ request()->routeIs('admin.berita') ? 'current' : '' }}">
        <div class="stat-info">
          <div class="stat-label">Berita Terbit</div>
          <div class="stat-value">{{ \App\Models\Berita::where('status', 'terbit')->count() }}</div>
          @php $jumlahDraf = \App\Models\Berita::where('status', 'draf')->count(); @endphp
          @if($jumlahDraf > 0)
            <div class="stat-sub">+ {{ $jumlahDraf }} tersimpan di draf</div>
          @endif
        </div>
        <div class="stat-icon icon-red">
          <i data-lucide="newspaper"></i>
        </div>
      </a>

      <a href="{{ route('admin.pimpinan') }}" class="stat-card {{ request()->routeIs('admin.pimpinan') ? 'current' : '' }}">
        <div class="stat-info">
          <div class="stat-label">Struktur Pimpinan</div>
          <div class="stat-value">{{ \App\Models\Pimpinan::count() }}</div>
        </div>
        <div class="stat-icon icon-amber">
          <i data-lucide="award"></i>
        </div>
      </a>

      <a href="{{ route('admin.guru') }}" class="stat-card {{ request()->routeIs('admin.guru') ? 'current' : '' }}">
        <div class="stat-info">
          <div class="stat-label">Tenaga Pendidik (Guru)</div>
          <div class="stat-value">{{ \App\Models\Guru::count() }}</div>
        </div>
        <div class="stat-icon icon-blue">
          <i data-lucide="users"></i>
        </div>
      </a>

      <a href="{{ route('admin.pesan') }}" class="stat-card {{ request()->routeIs('admin.pesan') ? 'current' : '' }}">
        <div class="stat-info">
          <div class="stat-label">Pesan Masuk</div>
          <div class="stat-value">{{ \App\Models\Pesan::count() }}</div>
        </div>
        <div class="stat-icon icon-emerald">
          <i data-lucide="mail"></i>
        </div>
      </a>
    </div>

    @if(session('sukses'))
      <div class="alert">✓ {{ session('sukses') }}</div>
    @endif

    @yield('content')
  </div>

  <script>
    lucide.createIcons();
  </script>
  @yield('scripts')
</body>
</html>