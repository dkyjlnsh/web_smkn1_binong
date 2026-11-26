<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — Admin SMKN 1 Binong</title>
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

    /* WELCOME BANNER */
    .welcome-card {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
      color: #ffffff; border-radius: 20px; padding: 32px;
      margin-bottom: 24px; display: flex; flex-wrap: wrap;
      justify-content: space-between; align-items: center; gap: 20px;
      box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
    }
    .welcome-card h2 { font-size: 1.5rem; font-weight: 800; margin-bottom: 8px; }
    .welcome-card p { color: #cbd5e1; font-size: 0.94rem; max-width: 560px; line-height: 1.5; }
    .btn-visit {
      display: inline-flex; align-items: center; gap: 8px;
      background: #c8102e; color: #fff; text-decoration: none;
      padding: 12px 20px; border-radius: 12px; font-weight: 600; font-size: 0.9rem;
      transition: all 0.2s; white-space: nowrap;
    }
    .btn-visit:hover { background: #a50d26; transform: translateY(-2px); }

    /* MENU GRID UTAMA */
    .section-title { font-size: 1.05rem; font-weight: 700; color: #334155; margin-bottom: 14px; }
    .menu-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 18px;
    }
    .menu-card {
      background: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px;
      padding: 24px; text-decoration: none; color: inherit;
      display: flex; flex-direction: column; justify-content: space-between;
      box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
      transition: all 0.25s ease;
    }
    .menu-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 14px 28px rgba(15, 23, 42, 0.08);
      border-color: #cbd5e1;
    }
    .menu-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 18px; }
    .menu-icon {
      width: 52px; height: 52px; border-radius: 14px;
      display: flex; align-items: center; justify-content: center;
    }
    .icon-red { background: #fee2e2; color: #c8102e; }
    .icon-amber { background: #fef3c7; color: #b45309; }
    .icon-blue { background: #dbeafe; color: #1d4ed8; }
    .icon-emerald { background: #d1fae5; color: #047857; }
    .icon-purple { background: #f3e8ff; color: #7e22ce; }
    .icon-teal { background: #ccfbf1; color: #0f766e; }
    .icon-indigo { background: #e0e7ff; color: #4338ca; }
    .icon-pink { background: #fce7f3; color: #be185d; }
    .icon-cyan { background: #cffafe; color: #0e7490; }

    .menu-count { font-size: 1.85rem; font-weight: 800; color: #0f172a; line-height: 1; text-align: right; }
    .menu-sub { font-size: 0.75rem; font-weight: 600; color: #b45309; margin-top: 4px; text-align: right; }
    .menu-card h3 { font-size: 1.08rem; font-weight: 700; color: #0f172a; margin-bottom: 6px; }
    .menu-card p { font-size: 0.84rem; color: #64748b; line-height: 1.45; margin-bottom: 16px; }
    .menu-action {
      display: inline-flex; align-items: center; gap: 6px;
      font-size: 0.84rem; font-weight: 700; color: #c8102e;
    }
  </style>
</head>
<body>
  <div class="container">
    @include('admin.partials.navbar')

    <!-- BANNER SAMBUTAN -->
    <div class="welcome-card">
      <div>
        <h2>Selamat Datang di Panel Admin!</h2>
        <p>Pilih menu pengelolaan konten di bawah ini untuk memperbarui visi &amp; misi, kompetensi keahlian (jurusan), kuis rekomendasi jurusan, FAQ, struktur pimpinan, data tenaga pendidik, mitra industri (DUDI), memeriksa pesan masuk, atau menulis berita sekolah.</p>
      </div>
      <a href="{{ url('/') }}" target="_blank" class="btn-visit">
        Lihat Halaman Publik <i data-lucide="external-link" style="width:16px;height:16px;"></i>
      </a>
    </div>

    <!-- PILIHAN MENU UTAMA -->
    <div class="section-title">Menu Pengelolaan Konten</div>
    <div class="menu-grid">
      <a href="{{ route('admin.visimisi') }}" class="menu-card">
        <div>
          <div class="menu-top">
            <div class="menu-icon icon-teal"><i data-lucide="target"></i></div>
            <div>
              <div class="menu-count">{{ \App\Models\VisiMisi::where('jenis', 'misi')->count() }}</div>
              <div class="menu-sub">poin misi</div>
            </div>
          </div>
          <h3>Visi &amp; Misi Sekolah</h3>
          <p>Perbarui pernyataan Visi dan kelola daftar poin Misi sekolah secara fleksibel.</p>
        </div>
        <span class="menu-action">Buka Menu Visi &amp; Misi →</span>
      </a>

      <a href="{{ route('admin.jurusan') }}" class="menu-card">
        <div>
          <div class="menu-top">
            <div class="menu-icon icon-indigo"><i data-lucide="layers"></i></div>
            <div>
              <div class="menu-count">{{ \App\Models\Jurusan::count() }}</div>
              <div class="menu-sub">jurusan</div>
            </div>
          </div>
          <h3>Kompetensi Keahlian</h3>
          <p>Tambah, ubah, atau atur urutan program keahlian (jurusan) yang tampil di beranda.</p>
        </div>
        <span class="menu-action">Buka Menu Jurusan →</span>
      </a>

      <a href="{{ route('admin.kuis') }}" class="menu-card">
        <div>
          <div class="menu-top">
            <div class="menu-icon icon-pink"><i data-lucide="help-circle"></i></div>
            <div>
              <div class="menu-count">{{ \App\Models\KuisSoal::count() }}</div>
              <div class="menu-sub">soal kuis</div>
            </div>
          </div>
          <h3>Kuis Rekomendasi Jurusan</h3>
          <p>Tambah, edit, atau hapus soal dan pilihan jawaban kuis minat jurusan di halaman beranda.</p>
        </div>
        <span class="menu-action">Buka Menu Kuis Jurusan →</span>
      </a>

      <a href="{{ route('admin.faq') }}" class="menu-card">
        <div>
          <div class="menu-top">
            <div class="menu-icon icon-cyan"><i data-lucide="message-circle-question"></i></div>
            <div>
              <div class="menu-count">{{ \App\Models\Faq::count() }}</div>
              <div class="menu-sub">pertanyaan</div>
            </div>
          </div>
          <h3>Pertanyaan Umum (FAQ)</h3>
          <p>Tambah, edit, atau hapus daftar pertanyaan dan jawaban umum yang tampil di beranda.</p>
        </div>
        <span class="menu-action">Buka Menu FAQ →</span>
      </a>

      <a href="{{ route('admin.pimpinan') }}" class="menu-card">
        <div>
          <div class="menu-top">
            <div class="menu-icon icon-amber"><i data-lucide="award"></i></div>
            <div class="menu-count">{{ \App\Models\Pimpinan::count() }}</div>
          </div>
          <h3>Struktur Pimpinan</h3>
          <p>Atur profil dan urutan tampil Kepala Sekolah beserta jajaran Wakil Kepala Sekolah.</p>
        </div>
        <span class="menu-action">Buka Menu Pimpinan →</span>
      </a>

      <a href="{{ route('admin.guru') }}" class="menu-card">
        <div>
          <div class="menu-top">
            <div class="menu-icon icon-blue"><i data-lucide="users"></i></div>
            <div class="menu-count">{{ \App\Models\Guru::count() }}</div>
          </div>
          <h3>Tenaga Pendidik</h3>
          <p>Kelola direktori data guru, mata pelajaran yang diampu, NIP, dan foto profil.</p>
        </div>
        <span class="menu-action">Buka Menu Guru →</span>
      </a>

      <a href="{{ route('admin.dudi') }}" class="menu-card">
        <div>
          <div class="menu-top">
            <div class="menu-icon icon-purple"><i data-lucide="building-2"></i></div>
            <div class="menu-count">{{ \App\Models\Dudi::count() }}</div>
          </div>
          <h3>Mitra Industri (DUDI)</h3>
          <p>Tambah atau perbarui daftar perusahaan dan instansi yang bekerja sama dengan sekolah.</p>
        </div>
        <span class="menu-action">Buka Menu DUDI →</span>
      </a>

      <a href="{{ route('admin.pesan') }}" class="menu-card">
        <div>
          <div class="menu-top">
            <div class="menu-icon icon-emerald"><i data-lucide="mail"></i></div>
            <div class="menu-count">{{ \App\Models\Pesan::count() }}</div>
          </div>
          <h3>Pesan Masuk</h3>
          <p>Baca pertanyaan, kritik, atau saran dari pengunjung yang dikirim melalui form kontak.</p>
        </div>
        <span class="menu-action">Buka Kotak Masuk →</span>
      </a>

      <a href="{{ route('admin.berita') }}" class="menu-card">
        <div>
          <div class="menu-top">
            <div class="menu-icon icon-red"><i data-lucide="newspaper"></i></div>
            <div>
              <div class="menu-count">{{ \App\Models\Berita::tayang()->count() }}</div>
              @php
                $jumlahTerjadwal = \App\Models\Berita::where('status', 'terbit')->where('jadwal_tayang', '>', now())->count();
                $jumlahDraf = \App\Models\Berita::where('status', 'draf')->count();
              @endphp
              @if($jumlahTerjadwal > 0 || $jumlahDraf > 0)
                <div class="menu-sub">
                  @if($jumlahTerjadwal > 0) +{{ $jumlahTerjadwal }} terjadwal @endif
                  @if($jumlahTerjadwal > 0 && $jumlahDraf > 0) · @endif
                  @if($jumlahDraf > 0) +{{ $jumlahDraf }} draf @endif
                </div>
              @endif
            </div>
          </div>
          <h3>Kelola Berita &amp; Jadwal</h3>
          <p>Tulis artikel kegiatan sekolah, atur jadwal tayang otomatis (Senin, Selasa, dst.), atau simpan draf.</p>
        </div>
        <span class="menu-action">Buka Menu Berita →</span>
      </a>
    </div>
  </div>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>