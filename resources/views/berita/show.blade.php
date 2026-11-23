<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $berita->judul }} — SMKN 1 Binong</title>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Inter', sans-serif; background: #fff; color: #18181b; line-height: 1.75; }
    .wrap { max-width: 760px; margin: 0 auto; padding: 48px 24px 80px; }
    .back { display: inline-block; text-decoration: none; color: #c8102e; font-weight: 600; font-size: 0.9rem; margin-bottom: 24px; }
    .meta { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #64748b; }
    .cat { background: #fee2e2; color: #b91c1c; padding: 3px 10px; border-radius: 6px; font-weight: 600; }
    h1 { font-family: 'Space Grotesk', sans-serif; font-size: clamp(1.7rem, 4vw, 2.4rem); line-height: 1.25; margin-bottom: 24px; }
    .cover { width: 100%; max-height: 420px; object-fit: cover; border-radius: 14px; margin-bottom: 28px; border: 1px solid #e5e7eb; }
    .content { font-size: 1.05rem; color: #27272a; white-space: pre-line; }
  </style>
</head>
<body>
  <article class="wrap">
    <a href="{{ url('/#berita') }}" class="back">&larr; Kembali ke Beranda</a>
    <div class="meta">
      <span class="cat">{{ $berita->kategori }}</span>
      <span>Dipublikasikan {{ $berita->created_at->format('d M Y') }}</span>
    </div>
    <h1>{{ $berita->judul }}</h1>

    @if($berita->gambar)
      <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="cover">
    @endif

    <div class="content">{{ $berita->isi }}</div>
  </article>
</body>
</html>