<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tenaga Pendidik — Admin SMKN 1 Binong</title>
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
    .card { background: #fff; padding: 24px; border-radius: 12px; border: 1px solid #e4e4e7; margin-bottom: 24px; }
    h2 { font-size: 1.25rem; margin-bottom: 16px; }
    .form-group { margin-bottom: 14px; }
    label { display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 6px; color: #3f3f46; }
    input[type="text"], input[type="number"], input[type="file"] { width: 100%; padding: 10px 12px; border: 1px solid #d4d4d8; border-radius: 8px; font-size: 0.92rem; }
    .btn-primary { background: #c8102e; color: #fff; border: none; padding: 10px 18px; border-radius: 8px; font-weight: 600; cursor: pointer; }
    .btn-primary:hover { background: #a50d26; }
    .btn-edit { background: #f59e0b; color: #fff; border: none; padding: 6px 12px; border-radius: 6px; font-size: 0.82rem; cursor: pointer; font-weight: 600; }
    .btn-danger { background: #ef4444; color: #fff; border: none; padding: 6px 12px; border-radius: 6px; font-size: 0.82rem; cursor: pointer; font-weight: 600; }
    .alert { background: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem; }
    table { width: 100%; border-collapse: collapse; margin-top: 8px; }
    th, td { text-align: left; padding: 12px; border-bottom: 1px solid #e4e4e7; font-size: 0.9rem; }
    th { background: #fafafa; font-weight: 600; color: #52525b; }
    .aksi-wrap { display: flex; gap: 6px; }
    .modal-bg { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); align-items: center; justify-content: center; padding: 20px; z-index: 99; }
    .modal-bg.show { display: flex; }
    .modal-box { background: #fff; width: 100%; max-width: 520px; padding: 24px; border-radius: 14px; }
  </style>
</head>
<body>
  <div class="container">
    <div class="topbar">
      <div><strong style="font-size: 1.05rem;">Panel Admin SMKN 1 Binong</strong></div>
      <div class="nav-links">
        <a href="{{ route('admin.berita') }}">Kelola Berita</a>
        <a href="{{ route('admin.pimpinan') }}">Struktur Pimpinan</a>
        <a href="{{ route('admin.guru') }}" class="active">Tenaga Pendidik</a>
        <a href="{{ route('admin.pesan') }}">Pesan Masuk</a>
        <a href="{{ url('/') }}" target="_blank">Lihat Website ↗</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" style="background: #18181b; color: #fff; border: none; padding: 8px 14px; border-radius: 6px; cursor: pointer; font-size: 0.85rem;">Logout</button>
        </form>
      </div>
    </div>

    @if(session('sukses'))
      <div class="alert">✓ {{ session('sukses') }}</div>
    @endif

    <div class="card">
      <h2>Tambah Data Guru &amp; Tenaga Pendidik</h2>
      <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="nama">Nama Lengkap &amp; Gelar</label>
          <input type="text" id="nama" name="nama" placeholder="Contoh: Budi Santoso, S.Pd." required>
        </div>
        <div class="form-group">
          <label for="mapel">Mata Pelajaran / Bidang Keahlian</label>
          <input type="text" id="mapel" name="mapel" placeholder="Contoh: Guru Produktif PPLG" required>
        </div>
        <div class="form-group">
          <label for="nip">NIP (Opsional)</label>
          <input type="text" id="nip" name="nip" placeholder="Contoh: 19850101 201001 1 002">
        </div>
        <div class="form-group">
          <label for="urutan">Urutan Tampil</label>
          <input type="number" id="urutan" name="urutan" value="1" min="1" required>
        </div>
        <div class="form-group">
          <label for="foto">Foto Profil (Opsional)</label>
          <input type="file" id="foto" name="foto" accept="image/*">
        </div>
        <button type="submit" class="btn-primary">Simpan Data Guru</button>
      </form>
    </div>

    <div class="card">
      <h2>Daftar Tenaga Pendidik ({{ $gurus->count() }})</h2>
      <table>
        <thead>
          <tr>
            <th>Urutan</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Mata Pelajaran</th>
            <th>NIP</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($gurus as $guru)
            <tr>
              <td>{{ $guru->urutan }}</td>
              <td><img src="{{ $guru->foto ? asset('storage/' . $guru->foto) : asset('assets/logo.jpg.png') }}" alt="" style="width: 48px; height: 48px; object-fit: cover; border-radius: 50%;"></td>
              <td><strong>{{ $guru->nama }}</strong></td>
              <td>{{ $guru->mapel }}</td>
              <td>{{ $guru->nip ?? '-' }}</td>
              <td>
                <div class="aksi-wrap">
                  <button type="button" class="btn-edit" onclick="bukaEditGuru({{ $guru->id }}, {{ json_encode($guru->nama) }}, {{ json_encode($guru->mapel) }}, {{ json_encode($guru->nip ?? '') }}, {{ $guru->urutan }})">Edit</button>
                  <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data guru ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" style="text-align: center; color: #71717a;">Belum ada data tenaga pendidik.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL EDIT GURU -->
  <div class="modal-bg" id="modalEditGuru">
    <div class="modal-box">
      <h2>Edit Data Tenaga Pendidik</h2>
      <form id="formEditGuru" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label>Nama Lengkap &amp; Gelar</label>
          <input type="text" id="editNamaGuru" name="nama" required>
        </div>
        <div class="form-group">
          <label>Mata Pelajaran / Bidang Keahlian</label>
          <input type="text" id="editMapelGuru" name="mapel" required>
        </div>
        <div class="form-group">
          <label>NIP (Opsional)</label>
          <input type="text" id="editNipGuru" name="nip">
        </div>
        <div class="form-group">
          <label>Urutan Tampil</label>
          <input type="number" id="editUrutanGuru" name="urutan" min="1" required>
        </div>
        <div class="form-group">
          <label>Ganti Foto (Kosongkan jika tidak ingin mengganti foto)</label>
          <input type="file" name="foto" accept="image/*">
        </div>
        <div style="display: flex; gap: 10px; justify-content: flex-end;">
          <button type="button" onclick="tutupEditGuru()" style="padding: 10px 16px; border: 1px solid #d4d4d8; background: #fff; border-radius: 8px; cursor: pointer;">Batal</button>
          <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function bukaEditGuru(id, nama, mapel, nip, urutan) {
      document.getElementById('formEditGuru').action = '/admin/guru/' + id;
      document.getElementById('editNamaGuru').value = nama;
      document.getElementById('editMapelGuru').value = mapel;
      document.getElementById('editNipGuru').value = nip;
      document.getElementById('editUrutanGuru').value = urutan;
      document.getElementById('modalEditGuru').classList.add('show');
    }
    function tutupEditGuru() {
      document.getElementById('modalEditGuru').classList.remove('show');
    }
  </script>
</body>
</html>