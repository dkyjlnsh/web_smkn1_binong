<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesan Masuk — Admin SMKN 1 Binong</title>
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
      background: #0f172a; color: #fff; border: none; padding: 8px 14px;
      border-radius: 10px; cursor: pointer; font-size: 0.85rem; font-weight: 600;
      transition: background 0.2s;
    }
    .btn-logout:hover { background: #334155; }

    /* DASHBOARD SUMMARY CARDS */
    .stats-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
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
    .stat-icon {
      width: 48px; height: 48px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .icon-red { background: #fee2e2; color: #c8102e; }
    .icon-blue { background: #dbeafe; color: #1d4ed8; }
    .icon-emerald { background: #d1fae5; color: #047857; }
    .icon-amber { background: #fef3c7; color: #b45309; }
    .icon-purple { background: #f3e8ff; color: #7e22ce; }

    /* CARDS */
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

    /* BUTTONS & ALERTS */
    .btn-danger { background: #ef4444; color: #fff; border: none; padding: 6px 12px; border-radius: 8px; font-size: 0.82rem; cursor: pointer; font-weight: 600; }
    .btn-danger:hover { background: #dc2626; }
    .alert {
      background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;
      padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 0.9rem; font-weight: 500;
    }

    /* TABLE */
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    th, td { text-align: left; padding: 14px 12px; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem; vertical-align: top; }
    th { background: #f8fafc; font-weight: 600; color: #475569; font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.03em; }
    tr:hover td { background: #f8fafc; }
    .email-link { color: #1d4ed8; text-decoration: none; font-weight: 500; }
    .email-link:hover { text-decoration: underline; }
  </style>
</head>
<body>
  <div class="container">
    @include('admin.partials.navbar')

    <!-- DASHBOARD RINGKASAN DATA -->
    <div class="stats-grid">
      <a href="{{ route('admin.pimpinan') }}" class="stat-card">
        <div class="stat-info">
          <div class="stat-label">Struktur Pimpinan</div>
          <div class="stat-value">{{ \App\Models\Pimpinan::count() }}</div>
        </div>
        <div class="stat-icon icon-amber">
          <i data-lucide="award"></i>
        </div>
      </a>

      <a href="{{ route('admin.guru') }}" class="stat-card">
        <div class="stat-info">
          <div class="stat-label">Tenaga Pendidik (Guru)</div>
          <div class="stat-value">{{ \App\Models\Guru::count() }}</div>
        </div>
        <div class="stat-icon icon-blue">
          <i data-lucide="users"></i>
        </div>
      </a>

      <a href="{{ route('admin.dudi') }}" class="stat-card">
        <div class="stat-info">
          <div class="stat-label">Mitra Industri (DUDI)</div>
          <div class="stat-value">{{ \App\Models\Dudi::count() }}</div>
        </div>
        <div class="stat-icon icon-purple">
          <i data-lucide="building-2"></i>
        </div>
      </a>

      <a href="{{ route('admin.pesan') }}" class="stat-card current">
        <div class="stat-info">
          <div class="stat-label">Pesan Masuk</div>
          <div class="stat-value">{{ \App\Models\Pesan::count() }}</div>
        </div>
        <div class="stat-icon icon-emerald">
          <i data-lucide="mail"></i>
        </div>
      </a>

      <a href="{{ route('admin.berita') }}" class="stat-card">
        <div class="stat-info">
          <div class="stat-label">Berita Terbit</div>
          <div class="stat-value">{{ \App\Models\Berita::tayang()->count() }}</div>
        </div>
        <div class="stat-icon icon-red">
          <i data-lucide="newspaper"></i>
        </div>
      </a>
    </div>

    @if(session('sukses'))
      <div class="alert">✓ {{ session('sukses') }}</div>
    @endif

    <div class="card">
      <div class="card-header">
        <h2>Daftar Pesan &amp; Pertanyaan Pengunjung ({{ $pesans->count() }})</h2>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Nama Pengirim</th>
              <th>Email</th>
              <th>Isi Pesan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pesans as $pesan)
              <tr>
                <td style="white-space: nowrap;">{{ $pesan->created_at->format('d M Y, H:i') }}</td>
                <td><strong>{{ $pesan->nama }}</strong></td>
                <td><a href="mailto:{{ $pesan->email }}" class="email-link">{{ $pesan->email }}</a></td>
                <td>{{ $pesan->pesan }}</td>
                <td>
                  <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Hapus</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" style="text-align: center; color: #64748b; padding: 24px;">Belum ada pesan masuk.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>