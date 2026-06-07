<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — The Off Pitch</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --black: #0a0a0a;
            --black-2: #141414;
            --gold: #c9a84c;
            --gold-light: #e8c96d;
            --white: #f5f5f0;
            --gray: #888888;
            --border: #2a2a2a;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--black);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .login-wrapper {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* LEFT SIDE - IMAGE */
        .login-left {
        position: relative;
        overflow: hidden;
        background-color: var(--black);
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23c9a84c' fill-opacity='0.06'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .login-left::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse at 30% 70%, rgba(201,168,76,0.12) 0%, transparent 60%),
                    radial-gradient(ellipse at 70% 20%, rgba(201,168,76,0.07) 0%, transparent 50%);
    }
        .login-left-overlay {
        position: absolute; inset: 0;
        display: flex; flex-direction: column;
        justify-content: center;
        padding: 3rem;
        background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 60%);
    }
        .login-left-overlay .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem; font-weight: 900;
            color: var(--white); letter-spacing: 4px;
            text-decoration: none;
            position: absolute; top: 3rem; left: 3rem;
        }
        .login-left-overlay .logo span { color: var(--gold); }
        .login-left-overlay .tagline {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem; font-weight: 700;
            color: var(--white); line-height: 1.3;
            margin-bottom: 1rem;
        }
        .login-left-overlay .tagline span { color: var(--gold); }
        .login-left-overlay p {
            font-size: 0.85rem; color: rgba(255,255,255,0.55);
            letter-spacing: 0.5px; line-height: 1.6;
        }

        /* RIGHT SIDE - FORM */
        .login-right {
            display: flex; align-items: center; justify-content: center;
            padding: 3rem; background: var(--black-2);
            border-left: 1px solid var(--border);
        }
        .login-box { width: 100%; max-width: 400px; }
        .login-box .top-label {
            font-size: 0.65rem; letter-spacing: 3px; font-weight: 700;
            color: var(--gold); text-transform: uppercase;
            margin-bottom: 8px;
        }
        .login-box h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem; font-weight: 900;
            color: var(--white); margin-bottom: 0.5rem;
        }
        .login-box .subtitle {
            font-size: 0.82rem; color: var(--gray);
            margin-bottom: 2rem; letter-spacing: 0.3px;
        }

        /* FORM ELEMENTS */
        .form-group { margin-bottom: 1.25rem; }
        .form-group label {
            font-size: 0.7rem; letter-spacing: 2px; font-weight: 700;
            color: var(--gray); text-transform: uppercase;
            display: block; margin-bottom: 8px;
        }
        .form-control {
            background: var(--black) !important;
            border: 1px solid var(--border) !important;
            color: var(--white) !important;
            border-radius: 0 !important;
            padding: 0.75rem 1rem !important;
            font-size: 0.9rem !important;
            transition: border-color 0.2s !important;
        }
        .form-control:focus {
            border-color: var(--gold) !important;
            box-shadow: none !important;
            outline: none !important;
        }
        .form-control::placeholder { color: #444 !important; }

        .input-icon { position: relative; }
        .input-icon i {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--gray); font-size: 0.85rem;
            pointer-events: none;
        }

        .btn-login {
            background: var(--gold);
            color: var(--black);
            border: none; border-radius: 0;
            width: 100%; padding: 0.85rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.75rem; font-weight: 700;
            letter-spacing: 3px; text-transform: uppercase;
            transition: background 0.2s, transform 0.1s;
            cursor: pointer;
        }
        .btn-login:hover {
            background: var(--gold-light);
            transform: translateY(-1px);
        }
        .btn-login:active { transform: translateY(0); }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, var(--border), transparent);
            margin: 1.5rem 0;
        }

        .back-link {
            text-align: center; font-size: 0.78rem;
            color: var(--gray); text-decoration: none;
            display: block; transition: color 0.2s;
            letter-spacing: 0.5px;
        }
        .back-link:hover { color: var(--gold); }
        .back-link i { margin-right: 6px; }

        .alert-danger {
            background: rgba(220,53,69,0.1) !important;
            border: 1px solid rgba(220,53,69,0.3) !important;
            color: #ff6b6b !important;
            border-radius: 0 !important;
            font-size: 0.82rem !important;
            padding: 0.75rem 1rem !important;
        }

        /* FADE IN */
        .login-box { animation: fadeIn 0.5s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }

        @media (max-width: 768px) {
            .login-wrapper { grid-template-columns: 1fr; }
            .login-left { display: none; }
        }
    </style>
</head>
<body>
<div class="login-wrapper">

    {{-- LEFT --}}
    <div class="login-left">
        <div class="login-left-overlay">
            <a href="{{ route('home') }}" class="logo">GOAL<span>ZONE</span></a>
            <div class="tagline">Portal Berita<br><span>Sepakbola</span> Terkini</div>
            <p>Kelola konten berita sepakbola<br>dari seluruh penjuru dunia.</p>
        </div>
    </div>

    {{-- RIGHT --}}
    <div class="login-right">
        <div class="login-box">
            <div class="top-label">Admin Panel</div>
            <h2>Selamat Datang</h2>
            <p class="subtitle">Masuk untuk mengelola konten The Off Pitch</p>

            @if($errors->any())
            <div class="alert alert-danger mb-3">
                <i class="fas fa-exclamation-circle me-2"></i>Email atau password salah.
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-icon">
                        <input type="email" name="email" class="form-control"
                            placeholder="admin@off-the-pitch.com"
                            value="{{ old('email') }}" required autofocus>
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-icon">
                        <input type="password" name="password" class="form-control"
                            placeholder="••••••••" required>
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                <div class="form-group d-flex align-items-center">
                    <input type="checkbox" name="remember" id="remember" class="me-2" style="accent-color:var(--gold)">
                    <label for="remember" style="margin:0;font-size:0.78rem;color:var(--gray);text-transform:none;letter-spacing:0;cursor:pointer;">Ingat saya</label>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </button>
            </form>

            <div class="divider"></div>
            <a href="{{ route('home') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>Kembali ke The Off Pitch
            </a>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>