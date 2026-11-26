<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Kuis Jurusan — Admin SMKN 1 Binong</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo.jpg.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    *, *::before, *::after { box-sizing: border-box; }
    body { font-family: 'Inter', system-ui, -apple-system, sans-serif; background: #f1f5f9; color: #0f172a; margin: 0; padding: 24px 16px 48px; }
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
    .brand-admin h1 { font-size: 1.05rem; font-weight: 700; color: #0f172a; line-height: 1.2; margin: 0; }
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

    .card { background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(15,23,42,0.03); }
    .card h2 { margin-top: 0; font-size: 1.15rem; margin-bottom: 16px; }
    .alert-success { background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-weight: 500; font-size: 0.9rem; }
    .alert-error { background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 0.9rem; }
    .row-grid { display: grid; grid-template-columns: 1fr 120px; gap: 14px; margin-bottom: 16px; }
    @media (max-width: 640px) { .row-grid { grid-template-columns: 1fr; } }
    label { display: block; font-size: 0.85rem; font-weight: 600; margin-bottom: 6px; color: #334155; }
    input[type="text"], input[type="number"], select { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 0.9rem; background: #f8fafc; }
    input:focus, select:focus { outline: none; background: #fff; border-color: #c8102e; box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.12); }
    .opsi-item { display: grid; grid-template-columns: 1fr 240px 90px auto; gap: 10px; align-items: center; margin-bottom: 10px; background: #f8fafc; padding: 10px; border-radius: 10px; border: 1px solid #e2e8f0; }
    @media (max-width: 768px) { .opsi-item { grid-template-columns: 1fr; } }
    .btn { border: none; border-radius: 10px; padding: 10px 16px; font-size: 0.875rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
    .btn-primary { background: #c8102e; color: #fff; }
    .btn-primary:hover { background: #a50d26; }
    .btn-secondary { background: #e2e8f0; color: #1e293b; }
    .btn-danger { background: #fee2e2; color: #b91c1c; }
    .btn-sm { padding: 6px 11px; font-size: 0.8rem; border-radius: 8px; }
    .soal-list-item { border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; margin-bottom: 14px; background: #fff; }
    .soal-header { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 10px; }
    .badge-urutan { background: #fef2f2; color: #b91c1c; font-weight: 700; font-size: 0.78rem; padding: 4px 10px; border-radius: 999px; }
    .opsi-preview { list-style: none; padding: 0; margin: 8px 0 0; display: grid; gap: 6px; }
    .opsi-preview li { font-size: 0.88rem; color: #475569; background: #f8fafc; padding: 8px 12px; border-radius: 8px; display: flex; justify-content: space-between; gap: 10px; flex-wrap: wrap; }
    .jurusan-tag { font-weight: 700; color: #0f172a; background: #e2e8f0; padding: 2px 8px; border-radius: 6px; font-size: 0.78rem; }
    .edit-panel { display: none; margin-top: 14px; padding-top: 14px; border-top: 1px dashed #cbd5e1; }
    .edit-panel.open { display: block; }
  </style>
</head>
<body>
<div class="container">
  @include('admin.partials.navbar')

  @if(session('sukses'))
    <div class="alert-success">✓ {{ session('sukses') }}</div>
  @endif

  @if($errors->any())
    <div class="alert-error">
      <strong>Periksa kembali inputan kamu:</strong>
      <ul style="margin: 6px 0 0; padding-left: 18px;">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if($jurusans->isEmpty())
    <div class="alert-error">
      Belum ada data <strong>Kompetensi Keahlian (Jurusan)</strong>. Tambahkan jurusan terlebih dahulu di menu <strong>Jurusan</strong> agar pilihan jawaban kuis bisa diarahkan ke jurusan.
    </div>
  @endif

  <!-- FORM TAMBAH SOAL KUIS -->
  <div class="card">
    <h2>Tambah Soal Kuis Baru</h2>
    <form action="{{ route('admin.kuis.store') }}" method="POST" id="createSoalForm">
      @csrf
      <div class="row-grid">
        <div>
          <label for="pertanyaan">Pertanyaan Kuis</label>
          <input type="text" id="pertanyaan" name="pertanyaan" placeholder="Contoh: Aktivitas apa yang paling bikin kamu bersemangat?" required>
        </div>
        <div>
          <label for="urutan">Urutan</label>
          <input type="number" id="urutan" name="urutan" min="1" value="{{ ($soals->max('urutan') ?? 0) + 1 }}">
        </div>
      </div>

      <label>Pilihan Jawaban &amp; Target Jurusan</label>
      <div id="createOpsiContainer">
        <div class="opsi-item">
          <input type="text" name="opsi_teks[]" placeholder="Teks pilihan jawaban..." required>
          <select name="opsi_jurusan_id[]" required>
            <option value="">-- Pilih Jurusan Target --</option>
            @foreach($jurusans as $j)
              <option value="{{ $j->id }}">{{ strtoupper($j->kode) }} — {{ $j->nama }}</option>
            @endforeach
          </select>
          <input type="number" name="opsi_bobot[]" min="1" max="10" value="1" title="Bobot skor" placeholder="Bobot">
          <button type="button" class="btn btn-danger btn-sm" onclick="removeOpsiRow(this)">Hapus</button>
        </div>
        <div class="opsi-item">
          <input type="text" name="opsi_teks[]" placeholder="Teks pilihan jawaban..." required>
          <select name="opsi_jurusan_id[]" required>
            <option value="">-- Pilih Jurusan Target --</option>
            @foreach($jurusans as $j)
              <option value="{{ $j->id }}">{{ strtoupper($j->kode) }} — {{ $j->nama }}</option>
            @endforeach
          </select>
          <input type="number" name="opsi_bobot[]" min="1" max="10" value="1" title="Bobot skor" placeholder="Bobot">
          <button type="button" class="btn btn-danger btn-sm" onclick="removeOpsiRow(this)">Hapus</button>
        </div>
      </div>

      <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
        <button type="button" class="btn btn-secondary btn-sm" onclick="addOpsiRow('createOpsiContainer')">+ Tambah Pilihan Jawaban</button>
        <button type="submit" class="btn btn-primary">Simpan Soal Kuis</button>
      </div>
    </form>
  </div>

  <!-- DAFTAR SOAL KUIS -->
  <div class="card">
    <h2>Daftar Pertanyaan Kuis ({{ $soals->count() }})</h2>

    @forelse($soals as $soal)
      <div class="soal-list-item">
        <div class="soal-header">
          <div>
            <span class="badge-urutan">Soal #{{ $soal->urutan }}</span>
            <h3 style="margin: 8px 0 0; font-size: 1.05rem;">{{ $soal->pertanyaan }}</h3>
          </div>
          <div style="display: flex; gap: 8px; flex-shrink: 0;">
            <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEditPanel({{ $soal->id }})">Edit</button>
            <form action="{{ route('admin.kuis.destroy', $soal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus soal kuis ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
          </div>
        </div>

        <ul class="opsi-preview">
          @foreach($soal->opsis as $opsi)
            <li>
              <span>{{ $opsi->teks_opsi }}</span>
              <span class="jurusan-tag">
                {{ $opsi->jurusan ? strtoupper($opsi->jurusan->kode) . ' · ' . $opsi->jurusan->nama : 'Jurusan Dihapus' }} (Bobot: {{ $opsi->bobot }})
              </span>
            </li>
          @endforeach
        </ul>

        <!-- FORM EDIT SOAL -->
        <div class="edit-panel" id="editPanel-{{ $soal->id }}">
          <form action="{{ route('admin.kuis.update', $soal->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row-grid">
              <div>
                <label>Edit Pertanyaan</label>
                <input type="text" name="pertanyaan" value="{{ $soal->pertanyaan }}" required>
              </div>
              <div>
                <label>Urutan</label>
                <input type="number" name="urutan" min="1" value="{{ $soal->urutan }}">
              </div>
            </div>

            <label>Pilihan Jawaban</label>
            <div id="editOpsiContainer-{{ $soal->id }}">
              @foreach($soal->opsis as $opsi)
                <div class="opsi-item">
                  <input type="text" name="opsi_teks[]" value="{{ $opsi->teks_opsi }}" required>
                  <select name="opsi_jurusan_id[]" required>
                    <option value="">-- Pilih Jurusan Target --</option>
                    @foreach($jurusans as $j)
                      <option value="{{ $j->id }}" {{ (string) $opsi->jurusan_id === (string) $j->id ? 'selected' : '' }}>
                        {{ strtoupper($j->kode) }} — {{ $j->nama }}
                      </option>
                    @endforeach
                  </select>
                  <input type="number" name="opsi_bobot[]" min="1" max="10" value="{{ $opsi->bobot ?: 1 }}">
                  <button type="button" class="btn btn-danger btn-sm" onclick="removeOpsiRow(this)">Hapus</button>
                </div>
              @endforeach
            </div>

            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
              <button type="button" class="btn btn-secondary btn-sm" onclick="addOpsiRow('editOpsiContainer-{{ $soal->id }}')">+ Tambah Opsi</button>
              <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
              <button type="button" class="btn btn-secondary btn-sm" onclick="toggleEditPanel({{ $soal->id }})">Batal</button>
            </div>
          </form>
        </div>
      </div>
    @empty
      <p style="color: #64748b; margin: 0;">Belum ada soal kuis yang dibuat. Tambahkan soal pertama kamu di form atas.</p>
    @endforelse
  </div>
</div>

<template id="opsiRowTemplate">
  <div class="opsi-item">
    <input type="text" name="opsi_teks[]" placeholder="Teks pilihan jawaban..." required>
    <select name="opsi_jurusan_id[]" required>
      <option value="">-- Pilih Jurusan Target --</option>
      @foreach($jurusans as $j)
        <option value="{{ $j->id }}">{{ strtoupper($j->kode) }} — {{ $j->nama }}</option>
      @endforeach
    </select>
    <input type="number" name="opsi_bobot[]" min="1" max="10" value="1" title="Bobot skor" placeholder="Bobot">
    <button type="button" class="btn btn-danger btn-sm" onclick="removeOpsiRow(this)">Hapus</button>
  </div>
</template>

<script>
  lucide.createIcons();

  function addOpsiRow(containerId) {
    const container = document.getElementById(containerId);
    const template = document.getElementById('opsiRowTemplate');
    if (container && template) {
      container.appendChild(template.content.cloneNode(true));
    }
  }

  function removeOpsiRow(button) {
    const row = button.closest('.opsi-item');
    const container = row ? row.parentElement : null;
    if (container && container.querySelectorAll('.opsi-item').length <= 2) {
      alert('Minimal harus ada 2 pilihan jawaban dalam satu soal.');
      return;
    }
    if (row) row.remove();
  }

  function toggleEditPanel(soalId) {
    const panel = document.getElementById('editPanel-' + soalId);
    if (panel) panel.classList.toggle('open');
  }
</script>
</body>
</html>