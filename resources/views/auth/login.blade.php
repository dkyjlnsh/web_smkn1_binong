<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin — SMKN 1 Binong</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
    body { background: #f4f4f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
    .login-card { background: #fff; width: 100%; max-width: 400px; padding: 36px 32px; border-radius: 16px; border: 1px solid #e4e4e7; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
    .logo { width: 56px; height: 56px; object-fit: contain; display: block; margin: 0 auto 14px; }
    h1 { font-size: 1.35rem; text-align: center; color: #18181b; margin-bottom: 6px; }
    p.sub { font-size: 0.88rem; text-align: center; color: #71717a; margin-bottom: 24px; }
    .form-group { margin-bottom: 16px; }
    label { display: block; font-size: 0.85rem; font-weight: 600; color: #3f3f46; margin-bottom: 6px; }
    input { width: 100%; padding: 11px 14px; border: 1px solid #d4d4d8; border-radius: 8px; font-size: 0.95rem; outline: none; }
    input:focus { border-color: #c8102e; }
    button { width: 100%; background: #c8102e; color: #fff; border: none; padding: 12px; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; margin-top: 8px; }
    button:hover { background: #a50d26; }
    .error { background: #fee2e2; color: #b91c1c; padding: 10px 12px; border-radius: 8px; font-size: 0.85rem; margin-bottom: 16px; }
    .back-link { display: block; text-align: center; margin-top: 18px; font-size: 0.85rem; color: #71717a; text-decoration: none; }
    .back-link:hover { color: #18181b; }
  </style>
</head>
<body>
  <div class="login-card">
    <img src="{{ asset('assets/logo.jpg.png') }}" alt="Logo SMKN 1 Binong" class="logo">
    <h1>Login Admin Sekolah</h1>
    <p class="sub">SMKN 1 Binong · Panel Pengelola Konten</p>

    @if($errors->any())
      <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      <div class="form-group">
        <label for="email">Email Admin</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@smkn1binong.sch.id" required autofocus>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required>
      </div>
      <button type="submit">Masuk ke Dashboard</button>
    </form>

    <a href="{{ url('/') }}" class="back-link">&larr; Kembali ke Halaman Utama</a>
  </div>
</body>
</html>