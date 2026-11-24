<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesan Masuk — Admin SMKN 1 Binong</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
    body { background: #f4f4f5; color: #18181b; padding: 24px; }
    .container { max-width: 1000px; margin: 0 auto; }
    .topbar { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 12px; background: #fff; padding: 16px 24px; border-radius: 12px; border: 1px solid #e4e4e7; margin-bottom: 24px; }
    .nav-links { display: flex; flex-wrap: wrap; align-items: center; gap: 12px; }
    .nav-links a { text-decoration: none; font-size: 0.88rem; font-weight: 600; color: #52525b; padding: 8px 12px; border-radius: 6px; }
    .nav-links a.active { background: #fee2e2; color: #c8102e; }
    .nav-links a:hover:not(.active) { background: #f4f4f5; }
    .card { background: #fff; padding: 24px; border-radius: 12px; border: 1px solid #e4e4e7; }
    h2 { font-size: 1.25rem; margin-bottom: 16px; }
    .btn-danger { background: #ef4444; color: #fff; border: none; padding: 6px 12px; border-radius: 6px; font-size: 0.82rem; cursor: pointer; }
    .alert { background: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem; }
    table { width: 100%; border-collapse: collapse; margin-top: 8px; }
    th, td { text-align: left; padding: 12px; border-bottom: 1px solid #e4e4e7; font-size: 0.9rem; vertical-align: top; }
    th { background: #fafafa; font-weight: 600; color: #52525b; }
  </style>
</head>
<body>
  <div class="container">
    <div class="topbar">
      <div>
        <strong style="font-size: 1.05rem;">Panel Admin SMKN 1 Binong</strong>
      </div>
      <div class="nav-links">
        <a href="{{ route('admin.berita') }}">Kelola Berita</a>
        <a href="{{ route('admin.pimpinan') }}">Struktur Pimpinan</a>
        <a href="{{ route('admin.guru') }}">Tenaga Pendidik</a>
        <a href="{{ route('admin.pesan') }}" class="active">Pesan Masuk</a>
        <a href="{{ url('/') }}" target="_blank">Lihat Website ↗</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" style="background: #18181b; color: #fff; border: none; padding: 8px 14px; border-radius: 6px; cursor: pointer; font-size: 0.85rem;">
            Logout
          </button>
        </form>
      </div>
    </div>

    @if(session('sukses'))
      <div class="alert">✓ {{ session('sukses') }}</div>
    @endif

    <div class="card">
      <h2>Daftar Pesan &amp; Pertanyaan Pengunjung</h2>
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
              <td>{{ $pesan->email }}</td>
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
              <td colspan="5" style="text-align: center; color: #71717a;">Belum ada pesan masuk.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>