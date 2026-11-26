<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Berita — Admin SMKN 1 Binong</title>
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
    .stat-info .stat-sub { font-size: 0.75rem; color: #b45309; font-weight: 600; margin-top: 6px; }
    .stat-icon {
      width: 48px; height: 48px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .icon-red { background: #fee2e2; color: #c8102e; }
    .icon-blue { background: #dbeafe; color: #1d4ed8; }
    .icon-emerald { background: #d1fae5; color: #047857; }
    .icon-amber { background: #fef3c7; color: #b45309; }
    .icon-purple { background: #f3e8ff; color: #7e22ce; }

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
    .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; }
    .form-group { margin-bottom: 16px; }
    label { display: block; font-size: 0.84rem; font-weight: 600; margin-bottom: 6px; color: #334155; }
    .help-text { font-size: 0.76rem; color: #64748b; margin-top: 4px; }
    input[type="text"], input[type="datetime-local"], select, textarea, input[type="file"] {
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
    .btn-edit { background: #f59e0b; color: #fff; border: none; padding: 6px 12px; border-radius: 8px; font-size: 0.82rem; cursor: pointer; font-weight: 600; }
    .btn-edit:hover { background: #d97706; }
    .btn-danger { background: #ef4444; color: #fff; border: none; padding: 6px 12px; border-radius: 8px; font-size: 0.82rem; cursor: pointer; font-weight: 600; }
    .btn-danger:hover { background: #dc2626; }
    .alert {
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
    .badge-terjadwal { background: #dbeafe; color: #1d4ed8; }
    .badge-draf { background: #fef3c7; color: #92400e; }
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

    <!-- DASHBOARD RINGKASAN DATA -->
    <div class="stats-grid">
      @if(auth()->user()->isAdmin())
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

        <a href="{{ route('admin.pesan') }}" class="stat-card">
          <div class="stat-info">
            <div class="stat-label">Pesan Masuk</div>
            <div class="stat-value">{{ \App\Models\Pesan::count() }}</div>
          </div>
          <div class="stat-icon icon-emerald">
            <i data-lucide="mail"></i>
          </div>
        </a>
      @endif

      <a href="{{ route('admin.berita') }}" class="stat-card current">
        <div class="stat-info">
          <div class="stat-label">Berita Tayang</div>
          <div class="stat-value">{{ \App\Models\Berita::tayang()->count() }}</div>
          @php
            $jumlahTerjadwal = \App\Models\Berita::where('status', 'terbit')->where('jadwal_tayang', '>', now())->count();
            $jumlahDraf = \App\Models\Berita::where('status', 'draf')->count();
          @endphp
          @if($jumlahTerjadwal > 0 || $jumlahDraf > 0)
            <div class="stat-sub">
              @if($jumlahTerjadwal > 0) {{ $jumlahTerjadwal }} terjadwal @endif
              @if($jumlahTerjadwal > 0 && $jumlahDraf > 0) · @endif
              @if($jumlahDraf > 0) {{ $jumlahDraf }} draf @endif
            </div>
          @endif
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
        <h2>Tambah Berita / Kegiatan Baru</h2>
      </div>
      <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
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
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label for="jadwal_tayang">Jadwal Tayang (Opsional)</label>
            <input type="datetime-local" id="jadwal_tayang" name="jadwal_tayang">
            <div class="help-text">Kosongkan jika ingin langsung tayang sekarang. Isi tanggal &amp; jam jika ingin dijadwalkan (misal Senin, Selasa, dst).</div>
          </div>
          <div class="form-group">
            <label for="gambar">Foto Utama Berita (Opsional)</label>
            <input type="file" id="gambar" name="gambar" accept="image/*">
          </div>
        </div>
        <div class="form-group">
          <label for="isi">Isi Berita</label>
          <textarea id="isi" name="isi" placeholder="Tulis isi lengkap berita di sini..." required></textarea>
        </div>
        <div class="btn-group-submit">
          <button type="submit" name="status" value="terbit" class="btn-primary">
            <i data-lucide="send" style="width:16px;height:16px;"></i> Terbitkan / Jadwalkan Berita
          </button>
          <button type="submit" name="status" value="draf" class="btn-draft">
            <i data-lucide="file-text" style="width:16px;height:16px;"></i> Simpan ke Draf
          </button>
        </div>
      </form>
    </div>

    <div class="card">
      <div class="card-header">
        <h2>Daftar Semua Berita, Jadwal &amp; Draf ({{ $beritas->count() }})</h2>
      </div>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Foto</th>
              <th>Judul</th>
              <th>Kategori</th>
              <th>Status</th>
              <th>Jadwal Tayang</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($beritas as $berita)
              @php
                $isTerjadwal = ($berita->status ?? 'terbit') === 'terbit' && $berita->jadwal_tayang && $berita->jadwal_tayang->isFuture();
                $waktuTampil = $berita->jadwal_tayang ?? $berita->created_at;
              @endphp
              <tr>
                <td><img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : asset('assets/logo.jpg.png') }}" alt="" style="width: 64px; height: 46px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;"></td>
                <td><strong>{{ $berita->judul }}</strong></td>
                <td><span class="badge-pill">{{ $berita->kategori }}</span></td>
                <td>
                  @if(($berita->status ?? 'terbit') === 'draf')
                    <span class="badge-pill badge-draf">Draf</span>
                  @elseif($isTerjadwal)
                    <span class="badge-pill badge-terjadwal">Terjadwal</span>
                  @else
                    <span class="badge-pill badge-terbit">Tayang</span>
                  @endif
                </td>
                <td style="white-space: nowrap; font-size: 0.84rem;">
                  {{ $waktuTampil->translatedFormat('l, d M Y') }}<br>
                  <span style="color: #64748b; font-size: 0.78rem;">Pukul {{ $waktuTampil->format('H:i') }} WIB</span>
                </td>
                <td>
                  <div class="aksi-wrap">
                    <button type="button" class="btn-edit" onclick="bukaEditBerita({{ $berita->id }}, {{ json_encode($berita->judul) }}, {{ json_encode($berita->kategori) }}, {{ json_encode($berita->isi) }}, {{ json_encode($berita->status ?? 'terbit') }}, {{ json_encode($berita->jadwal_tayang ? $berita->jadwal_tayang->format('Y-m-d\TH:i') : '') }})">Edit</button>
                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-danger">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" style="text-align: center; color: #64748b; padding: 24px;">Belum ada berita yang ditambahkan.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
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
        <div class="form-grid">
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
            <label>Status Publikasi</label>
            <select id="editStatus" name="status" required>
              <option value="terbit">Terbit / Terjadwal</option>
              <option value="draf">Draf (Simpan Dulu)</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Jadwal Tayang (Opsional)</label>
          <input type="datetime-local" id="editJadwalTayang" name="jadwal_tayang">
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
          <button type="button" onclick="tutupEditBerita()" style="padding: 10px 16px; border: 1px solid #cbd5e1; background: #fff; border-radius: 10px; cursor: pointer; font-weight: 600;">Batal</button>
          <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    lucide.createIcons();
    function bukaEditBerita(id, judul, kategori, isi, status, jadwalTayang) {
      document.getElementById('formEditBerita').action = '/admin/berita/' + id;
      document.getElementById('editJudul').value = judul;
      document.getElementById('editKategori').value = kategori;
      document.getElementById('editIsi').value = isi;
      document.getElementById('editStatus').value = status || 'terbit';
      document.getElementById('editJadwalTayang').value = jadwalTayang || '';
      document.getElementById('modalEditBerita').classList.add('show');
    }
    function tutupEditBerita() {
      document.getElementById('modalEditBerita').classList.remove('show');
    }
  </script>
</body>
</html>