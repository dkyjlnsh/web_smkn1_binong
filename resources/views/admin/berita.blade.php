<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Berita — Admin SMKN 1 Binong</title>
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
    input[type="text"], select, textarea, input[type="file"] { width: 100%; padding: 10px 12px; border: 1px solid #d4d4d8; border-radius: 8px; font-size: 0.92rem; }
    textarea { min-height: 120px; resize: vertical; }
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
    .modal-box { background: #fff; width: 100%; max-width: 560px; padding: 24px; border-radius: 14px; max-height: 90vh; overflow-y: auto; }
  </style>
</head>
<body>
  <div class="container">
    <div class="topbar">
      <div><strong style="font-size: 1.05rem;">Panel Admin SMKN 1 Binong</strong></div>
      <div class="nav-links">
        <a href="{{ route('admin.berita') }}" class="active">Kelola Berita</a>
        <a href="{{ route('admin.pimpinan') }}">Struktur Pimpinan</a>
        <a href="{{ route('admin.guru') }}">Tenaga Pendidik</a>
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
      <h2>Tambah Berita / Kegiatan Baru</h2>
      <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="judul">Judul Berita</label>
          <input type="text" id="judul" name="judul" placeholder="Contoh: Siswa PPLG Raih Juara LKS Tingkat Provinsi" required>
        </div>
        <div class="form-group">
          <label for="kategori">Kategori</label>
          <select id="kategori" name="kategori" required>
            <option value="Kegiatan Sekolah">Kegiatan Sekolah</option>
            <option value="Prestasi">Prestasi</option>
            <option value="Pengumuman">Pengumuman</option>
            <option value="PPDB">PPDB</option>
          </select>
        </div>
        <div class="form-group">
          <label for="gambar">Foto Utama Berita (Opsional)</label>
          <input type="file" id="gambar" name="gambar" accept="image/*">
        </div>
        <div class="form-group">
          <label for="isi">Isi Berita</label>
          <textarea id="isi" name="isi" placeholder="Tulis isi lengkap berita di sini..." required></textarea>
        </div>
        <button type="submit" class="btn-primary">Terbitkan Berita</button>
      </form>
    </div>

    <div class="card">
      <h2>Daftar Berita Terbit</h2>
      <table>
        <thead>
          <tr>
            <th>Foto</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($beritas as $berita)
            <tr>
              <td><img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : asset('assets/logo.jpg.png') }}" alt="" style="width: 60px; height: 42px; object-fit: cover; border-radius: 6px;"></td>
              <td><strong>{{ $berita->judul }}</strong></td>
              <td>{{ $berita->kategori }}</td>
              <td>{{ $berita->created_at->format('d M Y') }}</td>
              <td>
                <div class="aksi-wrap">
                  <button type="button" class="btn-edit" onclick="bukaEditBerita({{ $berita->id }}, {{ json_encode($berita->judul) }}, {{ json_encode($berita->kategori) }}, {{ json_encode($berita->isi) }})">Edit</button>
                  <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" style="text-align: center; color: #71717a;">Belum ada berita yang ditambahkan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL EDIT BERITA -->
  <div class="modal-bg" id="modalEditBerita">
    <div class="modal-box">
      <h2>Edit Berita</h2>
      <form id="formEditBerita" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label>Judul Berita</label>
          <input type="text" id="editJudul" name="judul" required>
        </div>
        <div class="form-group">
          <label>Kategori</label>
          <select id="editKategori" name="kategori" required>
            <option value="Kegiatan Sekolah">Kegiatan Sekolah</option>
            <option value="Prestasi">Prestasi</option>
            <option value="Pengumuman">Pengumuman</option>
            <option value="PPDB">PPDB</option>
          </select>
        </div>
        <div class="form-group">
          <label>Ganti Foto (Kosongkan jika tidak ingin mengganti foto)</label>
          <input type="file" name="gambar" accept="image/*">
        </div>
        <div class="form-group">
          <label>Isi Berita</label>
          <textarea id="editIsi" name="isi" required></textarea>
        </div>
        <div style="display: flex; gap: 10px; justify-content: flex-end;">
          <button type="button" onclick="tutupEditBerita()" style="padding: 10px 16px; border: 1px solid #d4d4d8; background: #fff; border-radius: 8px; cursor: pointer;">Batal</button>
          <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function bukaEditBerita(id, judul, kategori, isi) {
      document.getElementById('formEditBerita').action = '/admin/berita/' + id;
      document.getElementById('editJudul').value = judul;
      document.getElementById('editKategori').value = kategori;
      document.getElementById('editIsi').value = isi;
      document.getElementById('modalEditBerita').classList.add('show');
    }
    function tutupEditBerita() {
      document.getElementById('modalEditBerita').classList.remove('show');
    }
  </script>
</body>
</html>