<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMKN 1 Binong — Sekolah Menengah Kejuruan</title>
  <meta name="description" content="Website resmi SMKN 1 Binong (STARBIN), Kabupaten Subang. Informasi profil sekolah, 6 kompetensi keahlian, mitra industri, dan pendaftaran PPDB.">
  
  <!-- LOGO DI TAB BROWSER (FAVICON) -->
  <link rel="icon" type="image/png" href="{{ asset('assets/logo.jpg.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('assets/logo.jpg.png') }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

<div id="progress-bar"></div>
<div class="menu-overlay" id="menuOverlay"></div>

<header id="siteHeader">
  <div class="navbar">
    <a href="#home" class="brand">
      <div class="brand-mark">
        <img src="{{ asset('assets/logo.jpg.png') }}" onerror="this.onerror=null;this.src='https://cdn.phototourl.com/member/2026-11-13-bd86ef61-c82c-4190-a94c-c898334d6e83.png';" alt="Logo SMKN 1 Binong">
      </div>
      <div class="brand-text">
        <span class="name">SMKN 1 Binong</span>
        <span class="tag">Sekolah Kejuruan Unggul</span>
      </div>
    </a>

    <nav class="nav-menu" id="navMenu" aria-label="Navigasi Utama">
      <a href="#home" class="nav-link">Home</a>
      <a href="#profil" class="nav-link">Profil</a>
      <a href="#jurusan" class="nav-link">Jurusan</a>
      <a href="#berita" class="nav-link">Berita</a>
      <a href="#faq" class="nav-link">FAQ</a>
      <a href="#kontak" class="nav-link">Kontak</a>
      <a href="#kontak" class="nav-link cta-link">Daftar Sekarang</a>
    </nav>

    <button type="button" class="hamburger" id="hamburgerBtn" aria-label="Buka menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<section class="hero" id="home">
  <div class="blueprint-bg"></div>
  <div class="hero-inner container">
    <div class="eyebrow">STARBIN (Sekolah Ketarunaan Binong)</div>
    <h1>Merakit Keterampilan &amp;<br>Membangun <span class="accent">Masa Depan.</span></h1>
    <p class="lede">SMKN 1 Binong mendidik generasi siap kerja dan siap wirausaha dengan fasilitas praktik modern serta tenaga pengajar berpengalaman di bidangnya.</p>
    <div class="hero-actions">
      <a href="#profil" class="btn btn-primary">Jelajahi Sekolah <span class="btn-arrow">→</span></a>
      <a href="#jurusan" class="btn btn-ghost">Lihat Jurusan</a>
    </div>
    <div class="hero-stats">
      <div class="stat">
        <div class="num"><span class="count-up" data-target="500">0</span>+</div>
        <div class="label">Siswa Aktif</div>
      </div>
      <div class="stat">
        <div class="num count-up" data-target="{{ isset($jurusans) && $jurusans->isNotEmpty() ? $jurusans->count() : 6 }}">0</div>
        <div class="label">Kompetensi Keahlian</div>
      </div>
      <div class="stat">
        <div class="num"><span class="count-up" data-target="85">0</span>%</div>
        <div class="label">Lulusan Terserap Kerja</div>
      </div>
    </div>
  </div>
</section>

<!-- ================= SEKSI LOGO MITRA INDUSTRI (DUDI) ================= -->
<section id="mitra" class="section-mitra">
  <div class="container">
    <div class="mitra-head">
      <span class="eyebrow-dark">Jejaring Industri</span>
      <h3>Bekerja Sama Dengan Dunia Usaha &amp; Industri (DUDI)</h3>
    </div>
    <div class="logo-slider">
      <div class="logo-slide-track">
        @if(isset($dudis) && $dudis->isNotEmpty())
          @foreach($dudis as $dudi)
            <div class="logo-item" style="display: inline-flex; align-items: center; gap: 10px;">
              @if($dudi->logo)
                <img src="{{ asset('storage/' . $dudi->logo) }}" alt="{{ $dudi->nama }}" style="height: 26px; width: auto; object-fit: contain;">
              @endif
              <span>{{ strtoupper($dudi->nama) }}</span>
            </div>
          @endforeach
          <!-- Duplikasi otomatis agar putaran tidak putus -->
          @foreach($dudis as $dudi)
            <div class="logo-item" aria-hidden="true" style="display: inline-flex; align-items: center; gap: 10px;">
              @if($dudi->logo)
                <img src="{{ asset('storage/' . $dudi->logo) }}" alt="" style="height: 26px; width: auto; object-fit: contain;">
              @endif
              <span>{{ strtoupper($dudi->nama) }}</span>
            </div>
          @endforeach
        @else
          <div class="logo-item">BANK BJB</div>
          <div class="logo-item">FAVEHOTEL</div>
          <div class="logo-item">PT. INOVINDO DIGITAL MEDIA</div>
          <div class="logo-item">BANK BRI</div>
          <div class="logo-item">PT. GOTHRU MEDIA INDONESIA</div>
          <div class="logo-item">PT. PLN</div>
          <!-- Duplikasi logo agar putaran tidak putus -->
          <div class="logo-item" aria-hidden="true">BANK BJB</div>
          <div class="logo-item" aria-hidden="true">FAVEHOTEL</div>
          <div class="logo-item" aria-hidden="true">PT. INOVINDO DIGITAL MEDIA</div>
          <div class="logo-item" aria-hidden="true">BANK BRI</div>
          <div class="logo-item" aria-hidden="true">PT. GOTHRU MEDIA INDONESIA</div>
          <div class="logo-item" aria-hidden="true">PT. PLN</div>
        @endif
      </div>
    </div>
  </div>
</section>

<section id="profil">
  <div class="container">
    <!-- ================= 1. STRUKTUR PIMPINAN (KEPALA SEKOLAH & WAKASEK) ================= -->
    <div style="margin-bottom: 64px;">
      <div class="section-head reveal" style="margin-bottom: 32px; max-width: 100%;">
        <span class="eyebrow-dark">Tentang Kami · Struktur Pimpinan</span>
        <h2>Kepala Sekolah &amp; Wakil Kepala Sekolah</h2>
        <p style="max-width: 650px;">Jajaran pimpinan yang mengarahkan kebijakan dan mutu pendidikan di SMKN 1 Binong.</p>
      </div>

      @if(isset($pimpinans) && $pimpinans->isNotEmpty())
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 320px)); gap: 24px;">
          @foreach($pimpinans as $pimpinan)
            <div class="reveal" style="background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 24px 20px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
              <img 
                src="{{ $pimpinan->foto ? asset('storage/' . $pimpinan->foto) : asset('assets/logo.jpg.png') }}" 
                alt="{{ $pimpinan->nama }}" 
                style="width: 185px; height: 225px; border-radius: 14px; object-fit: cover; object-position: top; margin: 0 auto 18px; border: 3px solid {{ $pimpinan->urutan == 1 ? '#c8102e' : '#e5e7eb' }}; background: #f8fafc;">
              <div style="display: inline-block; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em; color: #c8102e; background: #fee2e2; padding: 4px 12px; border-radius: 6px; margin-bottom: 10px;">
                {{ $pimpinan->jabatan }}
              </div>
              <h4 style="font-size: 1.08rem; font-weight: 700; color: #18181b; margin-bottom: 4px;">
                {{ $pimpinan->nama }}
              </h4>
              @if($pimpinan->nip)
                <p style="font-size: 0.8rem; color: #64748b; font-family: 'JetBrains Mono', monospace;">
                  NIP. {{ $pimpinan->nip }}
                </p>
              @endif
            </div>
          @endforeach
        </div>
      @else
        <p style="color: #6b7280; font-size: 0.92rem;">Data pimpinan sekolah belum ditambahkan.</p>
      @endif
    </div>

    <!-- ================= 2. DAFTAR TENAGA PENDIDIK (DI BAWAH KEPALA SEKOLAH) ================= -->
    <div style="margin-bottom: 64px;">
      <div class="section-head reveal" style="margin-bottom: 32px; max-width: 100%;">
        <span class="eyebrow-dark">Tentang Kami · Tenaga Pendidik</span>
        <h2>Daftar Guru &amp; Tenaga Pendidik</h2>
        <p style="max-width: 650px;">Pendidik profesional yang membimbing siswa secara akademik maupun praktik kejuruan di SMKN 1 Binong.</p>
      </div>

      @if(isset($gurus) && $gurus->isNotEmpty())
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 280px)); gap: 22px;">
          @foreach($gurus as $guru)
            <div class="reveal" style="background: #fff; border: 1px solid #e5e7eb; border-radius: 16px; padding: 22px 18px; text-align: center; box-shadow: 0 4px 16px rgba(0,0,0,0.03);">
              <img 
                src="{{ $guru->foto ? asset('storage/' . $guru->foto) : asset('assets/logo.jpg.png') }}" 
                alt="{{ $guru->nama }}" 
                style="width: 155px; height: 190px; border-radius: 12px; object-fit: cover; object-position: top; margin: 0 auto 16px; border: 2px solid #e5e7eb; background: #f8fafc;">
              <div style="display: inline-block; font-size: 0.72rem; font-weight: 600; color: #1d4ed8; background: #eff6ff; padding: 3px 10px; border-radius: 6px; margin-bottom: 8px;">
                {{ $guru->mapel }}
              </div>
              <h4 style="font-size: 1rem; font-weight: 700; color: #18181b; margin-bottom: 4px;">
                {{ $guru->nama }}
              </h4>
              @if($guru->nip)
                <p style="font-size: 0.78rem; color: #64748b; font-family: 'JetBrains Mono', monospace;">
                  NIP. {{ $guru->nip }}
                </p>
              @endif
            </div>
          @endforeach
        </div>
      @else
        <p style="color: #6b7280; font-size: 0.92rem;">Data tenaga pendidik belum ditambahkan.</p>
      @endif
    </div>

    <!-- ================= 3. VISI & MISI SEKOLAH (DINAMIS DARI ADMIN) ================= -->
    <div class="section-head reveal" style="max-width: 100%;">
      <span class="eyebrow-dark">Arah &amp; Tujuan</span>
      <h2>Visi &amp; Misi Sekolah</h2>
      <p style="max-width: 650px;">Landasan yang mengarahkan setiap proses belajar-mengajar dan praktik keahlian di SMKN 1 Binong.</p>
    </div>

    <div class="profil-grid">
      <div class="profil-card reveal">
        <div class="icon-tag">V</div>
        <h3>Visi</h3>
        <p>{{ $visi->isi ?? 'Menjadi lembaga pendidikan kejuruan unggul yang menghasilkan lulusan kompeten, berkarakter, mandiri, dan berdaya saing tinggi di tingkat nasional maupun global.' }}</p>
      </div>

      <div class="profil-card alt reveal">
        <div class="icon-tag">M</div>
        <h3>Misi</h3>
        <ul class="misi-list">
          @if(isset($misis) && $misis->isNotEmpty())
            @foreach($misis as $misi)
              <li>
                <span class="idx">{{ str_pad($misi->urutan, 2, '0', STR_PAD_LEFT) }}</span>
                <span>{{ $misi->isi }}</span>
              </li>
            @endforeach
          @else
            <li><span class="idx">01</span><span>Menyelenggarakan pembelajaran berbasis kompetensi dan dunia industri.</span></li>
            <li><span class="idx">02</span><span>Membentuk karakter disiplin, jujur, dan etos kerja tinggi.</span></li>
            <li><span class="idx">03</span><span>Menjalin kemitraan aktif dengan dunia usaha dan industri (DUDI).</span></li>
            <li><span class="idx">04</span><span>Mendorong inovasi, kreativitas, dan jiwa kewirausahaan siswa.</span></li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ================= SEKSI KEUNGGULAN UTAMA ================= -->
<section id="keunggulan" class="section-keunggulan">
  <div class="container">
    <div class="section-head reveal" style="max-width: 100%;">
      <span class="eyebrow-dark">Mengapa Starbin</span>
      <h2>Keunggulan SMKN 1 Binong</h2>
      <p style="max-width: 650px;">Komitmen kami dalam membentuk lulusan yang siap bersaing secara global melalui sistem pendidikan terpadu.</p>
    </div>
    
    <div class="keunggulan-grid">
      <div class="k-card reveal">
        <div class="k-badge">01</div>
        <h3>Pendidikan Ketarunaan</h3>
        <p>Menerapkan basis ketarunaan untuk membentuk kedisiplinan tingkat tinggi, fisik prima, dan mental tangguh siap industri.</p>
      </div>
      <div class="k-card reveal">
        <div class="k-badge">02</div>
        <h3>Kurikulum Berbasis Industri</h3>
        <p>Materi pembelajaran diselaraskan langsung dengan kebutuhan dunia bisnis masa kini agar materi praktik selalu relevan.</p>
      </div>
      <div class="k-card reveal">
        <div class="k-badge">03</div>
        <h3>Fasilitas Bengkel &amp; Lab Modern</h3>
        <p>Setiap program keahlian ditunjang dengan ruang praktik kerja komparatif yang lengkap sesuai standar operasional perusahaan.</p>
      </div>
    </div>
  </div>
</section>

<section id="jurusan">
  <div class="container">
    <div class="section-head reveal" style="max-width: 100%;">
      <span class="eyebrow-dark">Kompetensi Keahlian</span>
      <h2>Jurusan Pilihan</h2>
      <p style="max-width: 650px;">{{ isset($jurusans) && $jurusans->isNotEmpty() ? $jurusans->count() : 'Enam' }} program keahlian yang dirancang mengikuti kebutuhan industri terkini.</p>
    </div>

    <div class="jurusan-grid">
      @if(isset($jurusans) && $jurusans->isNotEmpty())
        @foreach($jurusans as $index => $jurusan)
          <div class="jur-card reveal">
            <div class="jur-code">{{ strtoupper($jurusan->kode) }} · {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
            <div class="jur-icon"><i data-lucide="{{ $jurusan->ikon ?: 'graduation-cap' }}"></i></div>
            <h3>{{ $jurusan->nama }}</h3>
            <p>{{ $jurusan->deskripsi }}</p>
          </div>
        @endforeach
      @else
        <p style="color: #6b7280; font-size: 0.92rem;">Data kompetensi keahlian belum ditambahkan.</p>
      @endif
    </div>
  </div>
</section>

<!-- ================= INTERACTIVE QUIZ JURUSAN ================= -->
<section id="kuis-jurusan" class="section-quiz">
  <div class="blueprint-bg blueprint-subtle"></div>
  <div class="container container-narrow">
    <div class="section-head section-head-center reveal">
      <span class="eyebrow-dark eyebrow-light">Smart System Finder</span>
      <h2 class="text-white">Bingung Pilih Jurusan?</h2>
      <p class="text-white-muted">Ikuti kuis rekomendasi berbasis minat ini untuk menemukan kompetensi keahlian terbaikmu di Starbin!</p>
    </div>

    <div class="quiz-box reveal" id="quizBox">
      <div class="quiz-step active" id="quizStartView">
        <div class="quiz-center">
          <div class="quiz-emoji">🎯</div>
          <h3>Temukan Passion Teknis Kamu</h3>
          <p class="quiz-sub">Hanya butuh waktu kurang dari 1 menit untuk menganalisis kecocokan karir masa depanmu.</p>
          <button type="button" class="btn btn-primary" id="startQuizBtn">Mulai Analisis Minat <span class="btn-arrow">→</span></button>
        </div>
      </div>

      <div class="quiz-step" id="quizQuestionView">
        <div class="quiz-progress-wrapper">
          <span class="mono" id="quizStepIndicator">Soal 1 dari 4</span>
          <div class="quiz-progress-track"><div class="quiz-progress-fill" id="quizProgressFill"></div></div>
        </div>
        <h3 id="quizQuestionText" class="quiz-q-title">Pertanyaan akan muncul di sini...</h3>
        <div class="quiz-options" id="quizOptionsContainer"></div>
      </div>

      <div class="quiz-step" id="quizResultView">
        <div class="quiz-center">
          <div class="k-badge badge-dark">Hasil Analisis Sistem</div>
          <h3 class="quiz-res-title" id="resultTitle">Nama Jurusan</h3>
          <p id="resultDesc" class="quiz-sub">Deskripsi hasil kecocokan kuis...</p>
          <div class="quiz-res-actions">
            <button type="button" class="btn btn-primary" id="resetQuizBtn">Ulangi Kuis</button>
            <a href="#kontak" class="btn btn-ghost" id="quizCtaLink">Daftar Jurusan Ini</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= SEKSI BERITA & KEGIATAN SEKOLAH ================= -->
<section id="berita" style="padding: 80px 0; background: #fafafa;">
  <div class="container">
    <div class="section-head reveal" style="max-width: 100%;">
      <span class="eyebrow-dark">Kabar Terkini</span>
      <h2>Berita &amp; Kegiatan Sekolah</h2>
      <p style="max-width: 650px;">Informasi prestasi siswa, pengumuman akademik, dan aktivitas terbaru di SMKN 1 Binong.</p>
    </div>

    @if(isset($beritas) && $beritas->isNotEmpty())
      <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 360px)); gap: 24px;">
        @foreach($beritas as $berita)
          <article class="reveal" style="background: #fff; border: 1px solid #e5e7eb; border-radius: 14px; overflow: hidden; display: flex; flex-direction: column;">
            <img 
              src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : asset('assets/logo.jpg.png') }}" 
              alt="{{ $berita->judul }}" 
              style="width: 100%; height: 240px; object-fit: contain; background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
            <div style="padding: 22px; flex: 1; display: flex; flex-direction: column;">
              <div style="display: flex; justify-content: space-between; font-size: 0.78rem; color: #64748b; margin-bottom: 10px;">
                <span style="color: #c8102e; font-weight: 600;">{{ $berita->kategori }}</span>
                <span>{{ ($berita->jadwal_tayang ?? $berita->created_at)->format('d M Y') }}</span>
              </div>
              <h3 style="font-size: 1.15rem; line-height: 1.4; margin-bottom: 10px;">
                <a href="{{ route('berita.show', $berita->slug) }}" style="text-decoration: none; color: inherit;">
                  {{ $berita->judul }}
                </a>
              </h3>
              <p style="font-size: 0.92rem; color: #52525b; margin-bottom: 18px; flex: 1;">
                {{ \Illuminate\Support\Str::limit($berita->isi, 110) }}
              </p>
              <a href="{{ route('berita.show', $berita->slug) }}" style="text-decoration: none; color: #c8102e; font-weight: 600; font-size: 0.9rem;">
                Baca Selengkapnya &rarr;
              </a>
            </div>
          </article>
        @endforeach
      </div>
    @else
      <p style="color: #6b7280;">Belum ada berita terbaru yang diterbitkan saat ini.</p>
    @endif
  </div>
</section>

<!-- ================= SEKSI FAQ ================= -->
<section id="faq" class="section-faq">
  <div class="container container-narrow">
    <div class="section-head section-head-center reveal">
      <span class="eyebrow-dark">Bantuan</span>
      <h2>Pertanyaan Umum (FAQ)</h2>
      <p>Informasi cepat seputar pendaftaran dan kegiatan belajar di SMKN 1 Binong.</p>
    </div>

    @php
      $daftarFaq = (isset($faqs) && $faqs->isNotEmpty())
        ? $faqs
        : collect([
            (object) [
              'pertanyaan' => 'Kapan pendaftaran siswa baru (PPDB) dibuka?',
              'jawaban' => 'Pendaftaran biasanya dibuka dalam 2–3 gelombang mulai bulan Mei hingga Juli setiap tahunnya. Informasi resmi tanggal pelaksanaan akan diupdate berkala di halaman utama website.',
            ],
            (object) [
              'pertanyaan' => 'Apakah siswa PPLG mendapatkan fasilitas laptop dari sekolah?',
              'jawaban' => 'Sekolah menyediakan fasilitas Lab Komputer modern dengan spesifikasi tinggi yang dapat digunakan selama jam pelajaran. Namun, siswa sangat disarankan memiliki perangkat mandiri untuk belajar di rumah.',
            ],
            (object) [
              'pertanyaan' => 'Bagaimana dengan penyaluran kerja bagi lulusan?',
              'jawaban' => 'Melalui BKK (Bursa Kerja Khusus) SMKN 1 Binong, kami bekerja sama dengan puluhan perusahaan nasional untuk menyelenggarakan rekrutmen langsung sebelum siswa dinyatakan lulus.',
            ],
          ]);
    @endphp

    <div class="faq-container reveal">
      @foreach($daftarFaq as $item)
        <div class="faq-item">
          <button type="button" class="faq-question">{{ $item->pertanyaan }} <span class="faq-arrow">+</span></button>
          <div class="faq-answer">
            <p>{{ $item->jawaban }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section id="kontak">
  <div class="blueprint-bg blueprint-medium"></div>
  <div class="container container-rel">
    <div class="section-head reveal" style="max-width: 100%;">
      <span class="eyebrow-dark">Hubungi Kami</span>
      <h2>Kontak &amp; Lokasi</h2>
      <p style="max-width: 650px;">Ada pertanyaan seputar pendaftaran atau program keahlian? Kirimkan pesan kepada kami.</p>
    </div>

    <div class="kontak-grid">
      <form class="reveal" id="contactForm" method="POST" action="{{ route('pesan.store') }}">
        @csrf
        <div class="form-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
        </div>
        <div class="form-group">
          <label for="email">Alamat Email</label>
          <input type="email" id="email" name="email" placeholder="nama@email.com" required>
        </div>
        <div class="form-group">
          <label for="pesan">Pesan</label>
          <textarea id="pesan" name="pesan" placeholder="Tulis pertanyaan atau pesan Anda di sini..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pesan <span class="btn-arrow">→</span></button>

        @if(session('sukses'))
          <div class="form-msg show" id="formMsg">✓ {{ session('sukses') }}</div>
        @endif
      </form>

      <div class="reveal">
        <div class="info-block">
          <div class="label">Alamat</div>
          <div class="value">Jl. Raya Binong No. 64, Belakang Polsek, Binong, Kabupaten Subang, Jawa Barat 41253</div>
        </div>
        <div class="info-block">
          <div class="label">Telepon</div>
          <div class="value">(0260) 453392</div>
        </div>
        <div class="info-block">
          <div class="label">Email</div>
          <div class="value">info@smkn1binong.sch.id</div>
        </div>
        <div class="map-frame">
          <iframe
            src="https://maps.google.com/maps?q=SMKN%201%20Binong,%20Jl.%20Raya%20Binong%20No.%2064,%20Subang&t=&z=16&ie=UTF8&iwloc=&output=embed"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Peta Lokasi SMKN 1 Binong">
          </iframe>
        </div>
        <a href="https://www.google.com/maps/search/?api=1&query=SMKN+1+Binong+Jl.+Raya+Binong+No.+64+Subang" target="_blank" rel="noopener noreferrer" class="map-direct-link">
          Buka Rute di Google Maps ↗
        </a>
      </div>
    </div>
  </div>
</section>

<footer>
  <div class="container footer-row">
    <div>© {{ date('Y') }} SMKN 1 Binong. Seluruh hak cipta dilindungi.</div>
    <div class="mono">Terakreditasi A · Kabupaten Subang</div>
  </div>
</footer>

<script>
  <?php
    $starbinJurusanPayload = isset($jurusans)
      ? $jurusans->map(function ($j) {
          return [
            'id' => (string) $j->id,
            'kode' => strtoupper($j->kode),
            'nama' => $j->nama,
            'deskripsi' => $j->deskripsi,
            'prospek' => $j->prospek,
          ];
        })->values()->all()
      : [];

    $starbinKuisPayload = isset($kuisSoals)
      ? $kuisSoals->map(function ($s) {
          return [
            'id' => $s->id,
            'pertanyaan' => $s->pertanyaan,
            'options' => $s->opsis->map(function ($o) {
              return [
                'text' => $o->teks_opsi,
                'jurusan_id' => (string) $o->jurusan_id,
                'bobot' => (int) ($o->bobot ?: 1),
              ];
            })->values()->all(),
          ];
        })->values()->all()
      : [];
  ?>
  window.STARBIN_JURUSANS = <?= json_encode($starbinJurusanPayload, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG); ?>;
  window.STARBIN_KUIS_SOALS = <?= json_encode($starbinKuisPayload, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG); ?>;
</script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>