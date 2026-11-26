<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Mitra DUDI — Admin SMKN 1 Binong</title>
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

    /* CARDS & FORMS */
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
    .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; }
    .form-group { margin-bottom: 16px; }
    label { display: block; font-size: 0.84rem; font-weight: 600; margin-bottom: 6px; color: #334155; }
    .help-text { font-size: 0.76rem; color: #64748b; margin-top: 4px; }
    input[type="text"], input[type="number"], input[type="file"] {
      width: 100%; padding: 11px 14px; border: 1px solid #cbd5e1; border-radius: 10px;
      font-size: 0.92rem; color: #0f172a; background: #f8fafc; transition: all 0.2s;
    }
    input:focus {
      outline: none; background: #ffffff; border-color: #c8102e;
      box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.12);
    }

    /* BUTTONS & ALERTS */
    .btn-primary {
      display: inline-flex; align-items: center; gap: 8px;
      background: #c8102e; color: #fff; border: none; padding: 11px 20px;
      border-radius: 10px; font-weight: 600; font-size: 0.9rem; cursor: pointer;
      box-shadow: 0 4px 12px rgba(200, 16, 46, 0.22); transition: all 0.2s;
    }
    .btn-primary:hover { background: #a50d26; transform: translateY(-1px); }
    .btn-edit { background: #f59e0b; color: #fff; border: none; padding: 6px 12px; border-radius: 8px; font-size: 0.82rem; cursor: pointer; font-weight: 600; }
    .btn-edit:hover { background: #d97706; }
    .btn-danger { background: #ef4444; color: #fff; border: none; padding: 6px 12px; border-radius: 8px; font-size: 0.82rem; cursor: pointer; font-weight: 600; }
    .btn-danger:hover { background: #dc2626; }
    .alert {
      background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;
      padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 0.9rem; font-weight: 500;
    }

    /* TABLE */
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    th, td { text-align: left; padding: 14px 12px; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem; vertical-align: middle; }
    th { background: #f8fafc; font-weight: 600; color: #475569; font-size: 0.82rem; text-transform: uppercase; letter-spacing: 0.03em; }
    tr:hover td { background: #f8fafc; }
    .aksi-wrap { display: flex; gap: 6px; }

    /* MODAL */
    .modal-bg { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.55); backdrop-filter: blur(2px); align-items: center; justify-content: center; padding: 20px; z-index: 99; }
    .modal-bg.show { display: flex; }
    .modal-box { background: #fff; width: 100%; max-width: 480px; padding: 28px; border-radius: 16px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 40px rgba(0,0,0,0.18); }
    .modal-box h2 { font-size: 1.2rem; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; }
  </style>
</head>
<body>
  <div class="container">
    @include('admin.partials.navbar')

    @if(session('sukses'))
      <div class="alert">✓ {{ session('sukses') }}</div>
    @endif

    <div class="card">
      <div class="card-header">
        <h2>Tambah Mitra Industri / DUDI Baru</h2>
      </div>
      <form action="{{ route('admin.dudi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
          <div class="form-group">
            <label for="nama">Nama Perusahaan / Instansi</label>
            <input type="text" id="nama" name="nama" placeholder="Contoh: PT. Telkom Indonesia" required>
          </div>
          <div class="form-group">
            <label for="urutan">Urutan Tampil (Opsional)</label>
            <input type="number" id="urutan" name="urutan" value="0" min="0">
            <div class="help-text">Angka lebih kecil tampil lebih awal (0, 1, 2, dst).</div>
          </div>
          <div class="form-group">
            <label for="logo">Logo Perusahaan (Opsional)</label>
            <input type="file" id="logo" name="logo" accept="image/*">
          </div>
        </div>
        <button type="submit" class="btn-primary">
          <i data-lucide="plus" style="width:16px;height:16px;"></i> Simpan Mitra DUDI
        </button>
      </form>
    </div>

    <div class="card">
      <div class="card-header">
        <h2>Daftar Mitra DUDI Terdaftar ({{ $dudis->count() }})</h2>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Urutan</th>
              <th>Logo</th>
              <th>Nama Perusahaan / DUDI</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($dudis as $dudi)
              <tr>
                <td><strong>#{{ $dudi->urutan }}</strong></td>
                <td>
                  @if($dudi->logo)
                    <img src="{{ asset('storage/' . $dudi->logo) }}" alt="{{ $dudi->nama }}" style="height: 36px; width: auto; max-width: 90px; object-fit: contain; border-radius: 6px; border: 1px solid #e2e8f0; padding: 4px; background: #fff;">
                  @else
                    <span style="color: #94a3b8; font-size: 0.8rem;">Tanpa logo</span>
                  @endif
                </td>
                <td><strong>{{ strtoupper($dudi->nama) }}</strong></td>
                <td>
                  <div class="aksi-wrap">
                    <button type="button" class="btn-edit" onclick="bukaEditDudi({{ $dudi->id }}, {{ json_encode($dudi->nama) }}, {{ $dudi->urutan }})">Edit</button>
                    <form action="{{ route('admin.dudi.destroy', $dudi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mitra DUDI ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-danger">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" style="text-align: center; color: #64748b; padding: 24px;">
                  Belum ada data mitra DUDI di database (halaman depan masih menampilkan 6 mitra bawaan).
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- MODAL EDIT DUDI -->
  <div class="modal-bg" id="modalEditDudi">
    <div class="modal-box">
      <h2>Edit Mitra DUDI</h2>
      <form id="formEditDudi" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label>Nama Perusahaan / Instansi</label>
          <input type="text" id="editNamaDudi" name="nama" required>
        </div>
        <div class="form-group">
          <label>Urutan Tampil</label>
          <input type="number" id="editUrutanDudi" name="urutan" min="0" required>
        </div>
        <div class="form-group">
          <label>Ganti Logo (Kosongkan jika tidak ingin mengganti)</label>
          <input type="file" name="logo" accept="image/*">
        </div>
        <div style="display: flex; gap: 10px; justify-content: flex-end;">
          <button type="button" onclick="tutupEditDudi()" style="padding: 10px 16px; border: 1px solid #cbd5e1; background: #fff; border-radius: 10px; cursor: pointer; font-weight: 600;">Batal</button>
          <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    lucide.createIcons();
    function bukaEditDudi(id, nama, urutan) {
      document.getElementById('formEditDudi').action = '/admin/dudi/' + id;
      document.getElementById('editNamaDudi').value = nama;
      document.getElementById('editUrutanDudi').value = urutan;
      document.getElementById('modalEditDudi').classList.add('show');
    }
    function tutupEditDudi() {
      document.getElementById('modalEditDudi').classList.remove('show');
    }
  </script>
</body>
</html>