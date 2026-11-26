<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kompetensi Keahlian (Jurusan) — Admin SMKN 1 Binong</title>
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
    input[type="text"], input[type="number"], select, textarea, input[type="file"] {
      width: 100%; padding: 11px 14px; border: 1px solid #cbd5e1; border-radius: 10px;
      font-size: 0.92rem; color: #0f172a; background: #f8fafc; transition: all 0.2s;
    }
    textarea { min-height: 95px; resize: vertical; line-height: 1.5; }
    input:focus, select:focus, textarea:focus {
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
    .badge-kode { display: inline-block; padding: 4px 10px; border-radius: 8px; font-size: 0.82rem; font-weight: 700; background: #fee2e2; color: #c8102e; }
    .badge-pill { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 0.78rem; font-weight: 600; background: #f1f5f9; color: #334155; }
    .aksi-wrap { display: flex; gap: 6px; }

    /* MODAL */
    .modal-bg { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.55); backdrop-filter: blur(2px); align-items: center; justify-content: center; padding: 20px; z-index: 99; }
    .modal-bg.show { display: flex; }
    .modal-box { background: #fff; width: 100%; max-width: 560px; padding: 28px; border-radius: 16px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 40px rgba(0,0,0,0.18); }
    .modal-box h2 { font-size: 1.2rem; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; }
  </style>
</head>
<body>
  <div class="container">
    @include('admin.partials.navbar')

    @if(session('sukses'))
      <div class="alert">✓ {{ session('sukses') }}</div>
    @endif

    <!-- FORM TAMBAH JURUSAN -->
    <div class="card">
      <div class="card-header">
        <h2>Tambah Kompetensi Keahlian (Jurusan) Baru</h2>
      </div>
      <form action="{{ route('admin.jurusan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
          <div class="form-group">
            <label for="kode">Singkatan / Kode Jurusan</label>
            <input type="text" id="kode" name="kode" placeholder="Contoh: PPLG" required>
          </div>
          <div class="form-group">
            <label for="nama">Nama Lengkap Jurusan</label>
            <input type="text" id="nama" name="nama" placeholder="Contoh: Pengembangan Perangkat Lunak dan Gim" required>
          </div>
        </div>

        <div class="form-grid">
          <div class="form-group">
            <label for="ikon">Ikon Lucide (Opsional)</label>
            <select id="ikon" name="ikon">
              <option value="code-2">code-2 (Komputer / Coding / PPLG)</option>
              <option value="wrench">wrench (Otomotif / Bengkel / TKR)</option>
              <option value="calculator">calculator (Akuntansi / Keuangan / AKL)</option>
              <option value="shopping-bag">shopping-bag (Bisnis / Pemasaran / BDP)</option>
              <option value="cpu">cpu (Elektronika / Jaringan / TKJ)</option>
              <option value="briefcase">briefcase (Perkantoran / Manajemen)</option>
              <option value="layers">layers (Umum / Lainnya)</option>
            </select>
          </div>
          <div class="form-group">
            <label for="urutan">Urutan Tampil</label>
            <input type="number" id="urutan" name="urutan" value="{{ ($jurusans->max('urutan') ?? 0) + 1 }}" min="1" required>
          </div>
          <div class="form-group">
            <label for="gambar">Foto / Banner Jurusan (Opsional)</label>
            <input type="file" id="gambar" name="gambar" accept="image/*">
          </div>
        </div>

        <div class="form-group">
          <label for="deskripsi">Deskripsi Singkat Jurusan</label>
          <textarea id="deskripsi" name="deskripsi" placeholder="Jelaskan kompetensi utama, praktik kejuruan, dan prospek kerja lulusan..." required></textarea>
        </div>

        <div class="form-group">
          <label for="prospek">Prospek Karir (Pisahkan dengan koma, Opsional)</label>
          <input type="text" id="prospek" name="prospek" placeholder="Contoh: Web Developer, Mobile App Developer, UI/UX Designer, Game Programmer">
          <div class="help-text">Gunakan tanda koma (,) untuk memisahkan setiap profesi/prospek kerja.</div>
        </div>

        <button type="submit" class="btn-primary">
          <i data-lucide="plus" style="width:16px;height:16px;"></i> Simpan Jurusan
        </button>
      </form>
    </div>

    <!-- DAFTAR JURUSAN -->
    <div class="card">
      <div class="card-header">
        <h2>Daftar Kompetensi Keahlian ({{ $jurusans->count() }})</h2>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Urutan</th>
              <th>Kode</th>
              <th>Nama Jurusan</th>
              <th>Deskripsi Singkat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($jurusans as $jurusan)
              <tr>
                <td><span class="badge-pill">#{{ $jurusan->urutan }}</span></td>
                <td><span class="badge-kode">{{ strtoupper($jurusan->kode) }}</span></td>
                <td><strong>{{ $jurusan->nama }}</strong></td>
                <td style="max-width: 340px; color: #475569;">{{ \Illuminate\Support\Str::limit($jurusan->deskripsi, 95) }}</td>
                <td>
                  <div class="aksi-wrap">
                    <button type="button" class="btn-edit" onclick="bukaEditJurusan(
                      {{ $jurusan->id }},
                      {{ json_encode($jurusan->kode) }},
                      {{ json_encode($jurusan->nama) }},
                      {{ json_encode($jurusan->ikon ?? 'layers') }},
                      {{ $jurusan->urutan }},
                      {{ json_encode($jurusan->deskripsi) }},
                      {{ json_encode($jurusan->prospek ?? '') }}
                    )">Edit</button>
                    <form action="{{ route('admin.jurusan.destroy', $jurusan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jurusan ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-danger">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" style="text-align: center; color: #64748b; padding: 24px;">
                  Belum ada data jurusan di database. Silakan tambahkan kompetensi keahlian melalui form di atas.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- MODAL EDIT JURUSAN -->
  <div class="modal-bg" id="modalEditJurusan">
    <div class="modal-box">
      <h2>Edit Kompetensi Keahlian (Jurusan)</h2>
      <form id="formEditJurusan" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-grid">
          <div class="form-group">
            <label>Singkatan / Kode Jurusan</label>
            <input type="text" id="editKodeJurusan" name="kode" required>
          </div>
          <div class="form-group">
            <label>Urutan Tampil</label>
            <input type="number" id="editUrutanJurusan" name="urutan" min="1" required>
          </div>
        </div>
        <div class="form-group">
          <label>Nama Lengkap Jurusan</label>
          <input type="text" id="editNamaJurusan" name="nama" required>
        </div>
        <div class="form-group">
          <label>Ikon Lucide</label>
          <select id="editIkonJurusan" name="ikon">
            <option value="code-2">code-2 (Komputer / Coding / PPLG)</option>
            <option value="wrench">wrench (Otomotif / Bengkel / TKR)</option>
            <option value="calculator">calculator (Akuntansi / Keuangan / AKL)</option>
            <option value="shopping-bag">shopping-bag (Bisnis / Pemasaran / BDP)</option>
            <option value="cpu">cpu (Elektronika / Jaringan / TKJ)</option>
            <option value="briefcase">briefcase (Perkantoran / Manajemen)</option>
            <option value="layers">layers (Umum / Lainnya)</option>
          </select>
        </div>
        <div class="form-group">
          <label>Ganti Foto / Banner (Kosongkan jika tidak ingin mengganti)</label>
          <input type="file" name="gambar" accept="image/*">
        </div>
        <div class="form-group">
          <label>Deskripsi Singkat Jurusan</label>
          <textarea id="editDeskripsiJurusan" name="deskripsi" required></textarea>
        </div>
        <div class="form-group">
          <label>Prospek Karir (Pisahkan dengan koma)</label>
          <input type="text" id="editProspekJurusan" name="prospek">
        </div>
        <div style="display: flex; gap: 10px; justify-content: flex-end;">
          <button type="button" onclick="tutupEditJurusan()" style="padding: 10px 16px; border: 1px solid #cbd5e1; background: #fff; border-radius: 10px; cursor: pointer; font-weight: 600;">Batal</button>
          <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    lucide.createIcons();

    function bukaEditJurusan(id, kode, nama, ikon, urutan, deskripsi, prospek) {
      document.getElementById('formEditJurusan').action = '/admin/jurusan/' + id;
      document.getElementById('editKodeJurusan').value = kode;
      document.getElementById('editNamaJurusan').value = nama;
      document.getElementById('editIkonJurusan').value = ikon || 'layers';
      document.getElementById('editUrutanJurusan').value = urutan;
      document.getElementById('editDeskripsiJurusan').value = deskripsi;
      document.getElementById('editProspekJurusan').value = prospek;
      document.getElementById('modalEditJurusan').classList.add('show');
    }

    function tutupEditJurusan() {
      document.getElementById('modalEditJurusan').classList.remove('show');
    }
  </script>
</body>
</html>