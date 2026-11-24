<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Struktur Pimpinan — Admin SMKN 1 Binong</title>
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
        <a href="{{ route('admin.pimpinan') }}" class="active">Struktur Pimpinan</a>
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
      <h2>Tambah Data Kepala Sekolah / Wakasek</h2>
      <form action="{{ route('admin.pimpinan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="nama">Nama Lengkap &amp; Gelar</label>
          <input type="text" id="nama" name="nama" placeholder="Contoh: Drs. H. Ahmad Fauzi, M.Pd." required>
        </div>
        <div class="form-group">
          <label for="jabatan">Jabatan</label>
          <input type="text" id="jabatan" name="jabatan" placeholder="Contoh: Kepala Sekolah / Wakasek Kurikulum" required>
        </div>
        <div class="form-group">
          <label for="nip">NIP (Opsional)</label>
          <input type="text" id="nip" name="nip" placeholder="Contoh: 19700101 199501 1 001">
        </div>
        <div class="form-group">
          <label for="urutan">Urutan Tampil (Isi 1 untuk Kepala Sekolah agar tampil pertama)</label>
          <input type="number" id="urutan" name="urutan" value="2" min="1" required>
        </div>
        <div class="form-group">
          <label for="foto">Foto Resmi</label>
          <input type="file" id="foto" name="foto" accept="image/*">
        </div>
        <button type="submit" class="btn-primary">Simpan Data Pimpinan</button>
      </form>
    </div>

    <div class="card">
      <h2>Daftar Pimpinan Sekolah</h2>
      <table>
        <thead>
          <tr>
            <th>Urutan</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>NIP</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pimpinans as $pimpinan)
            <tr>
              <td>{{ $pimpinan->urutan }}</td>
              <td><img src="{{ $pimpinan->foto ? asset('storage/' . $pimpinan->foto) : asset('assets/logo.jpg.png') }}" alt="" style="width: 48px; height: 48px; object-fit: cover; border-radius: 50%;"></td>
              <td><strong>{{ $pimpinan->nama }}</strong></td>
              <td>{{ $pimpinan->jabatan }}</td>
              <td>{{ $pimpinan->nip ?? '-' }}</td>
              <td>
                <div class="aksi-wrap">
                  <button type="button" class="btn-edit" onclick="bukaEditPimpinan({{ $pimpinan->id }}, {{ json_encode($pimpinan->nama) }}, {{ json_encode($pimpinan->jabatan) }}, {{ json_encode($pimpinan->nip ?? '') }}, {{ $pimpinan->urutan }})">Edit</button>
                  <form action="{{ route('admin.pimpinan.destroy', $pimpinan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pimpinan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" style="text-align: center; color: #71717a;">Belum ada data pimpinan sekolah.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL EDIT PIMPINAN -->
  <div class="modal-bg" id="modalEditPimpinan">
    <div class="modal-box">
      <h2>Edit Data Pimpinan</h2>
      <form id="formEditPimpinan" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label>Nama Lengkap &amp; Gelar</label>
          <input type="text" id="editNamaPimpinan" name="nama" required>
        </div>
        <div class="form-group">
          <label>Jabatan</label>
          <input type="text" id="editJabatanPimpinan" name="jabatan" required>
        </div>
        <div class="form-group">
          <label>NIP (Opsional)</label>
          <input type="text" id="editNipPimpinan" name="nip">
        </div>
        <div class="form-group">
          <label>Urutan Tampil</label>
          <input type="number" id="editUrutanPimpinan" name="urutan" min="1" required>
        </div>
        <div class="form-group">
          <label>Ganti Foto (Kosongkan jika tidak ingin mengganti foto)</label>
          <input type="file" name="foto" accept="image/*">
        </div>
        <div style="display: flex; gap: 10px; justify-content: flex-end;">
          <button type="button" onclick="tutupEditPimpinan()" style="padding: 10px 16px; border: 1px solid #d4d4d8; background: #fff; border-radius: 8px; cursor: pointer;">Batal</button>
          <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function bukaEditPimpinan(id, nama, jabatan, nip, urutan) {
      document.getElementById('formEditPimpinan').action = '/admin/pimpinan/' + id;
      document.getElementById('editNamaPimpinan').value = nama;
      document.getElementById('editJabatanPimpinan').value = jabatan;
      document.getElementById('editNipPimpinan').value = nip;
      document.getElementById('editUrutanPimpinan').value = urutan;
      document.getElementById('modalEditPimpinan').classList.add('show');
    }
    function tutupEditPimpinan() {
      document.getElementById('modalEditPimpinan').classList.remove('show');
    }
  </script>
</body>
</html>