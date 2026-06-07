<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Off Pitch - @yield('title', 'Berita Sepakbola Terkini')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --black: #0a0a0a;
            --black-2: #141414;
            --black-3: #1e1e1e;
            --gold: #c9a84c;
            --gold-light: #e8c96d;
            --white: #f5f5f0;
            --gray: #888888;
            --gray-light: #cccccc;
            --border: #2a2a2a;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--black); color: var(--white); }

        /* NAVBAR */
        .navbar-off-the-pitch {
            background: var(--black);
            border-bottom: 1px solid var(--border);
            padding: 0;
        }
        .navbar-brand-wrap {
            border-right: 1px solid var(--border);
            padding: 1rem 2rem 1rem 0;
            margin-right: 1rem;
        }
        .logo {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        font-weight: 900;
        color: var(--white) !important;
        text-decoration: none;
        letter-spacing: 2px;
        text-transform: uppercase;
        white-space: nowrap;
    }
        .logo span { color: var(--gold); }
        .navbar-off-the-pitch .nav-link {
        font-family: 'Inter', sans-serif;
        color: var(--gray-light) !important;
        font-size: 0.72rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-weight: 600;
        padding: 1.2rem 0.6rem !important;
        transition: color 0.2s;
        border-bottom: 2px solid transparent;
    }
        .navbar-off-the-pitch .nav-link:hover {
            color: var(--gold) !important;
            border-bottom-color: var(--gold);
        }

        /* TICKER */
        .ticker {
        background: var(--gold);
        color: var(--black);
        padding: 5px 0;
        overflow: hidden;
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 1px;
        white-space: nowrap;
    }
    .ticker .container {
        display: flex;
        align-items: center;
        overflow: hidden;
    }
        .ticker-label {
            background: var(--black);
            color: var(--gold);
            padding: 2px 14px;
            font-weight: 700;
            margin-right: 16px;
            white-space: nowrap;
            letter-spacing: 2px;
            font-size: 0.7rem;
        }
        .ticker-content { animation: ticker 35s linear infinite; white-space: nowrap; display: inline-block; }
        @keyframes ticker { 0% { transform: translateX(100vw); } 100% { transform: translateX(-100%); } }

        /* HERO */
        .hero-article { position: relative; overflow: hidden; }
        .hero-article img { width: 100%; height: 520px; object-fit: cover; filter: brightness(0.6); }
        .hero-overlay {
            position: absolute; bottom: 0; left: 0; right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.95));
            padding: 3rem 2rem 2rem;
        }
        .hero-overlay .category-badge {
            background: var(--gold);
            color: var(--black);
            font-family: 'Inter', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 2px;
            padding: 4px 12px;
            text-transform: uppercase;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 12px;
        }
        .hero-overlay h2 {
            font-family: 'Playfair Display', serif;
            color: var(--white);
            font-size: 2.4rem;
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 10px;
        }
        .hero-overlay .meta { color: rgba(255,255,255,0.55); font-size: 0.78rem; letter-spacing: 0.5px; }

        /* SECTION TITLE */
        .section-title {
            font-family: 'Inter', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--gold);
            border-bottom: 1px solid var(--border);
            padding-bottom: 10px;
            margin-bottom: 1.5rem;
        }

        /* CARDS */
        .article-card {
            background: var(--black-2);
            border: 1px solid var(--border) !important;
            border-radius: 0 !important;
            overflow: hidden;
            transition: border-color 0.2s, transform 0.2s;
            height: 100%;
        }
        .article-card:hover { border-color: var(--gold) !important; transform: translateY(-2px); }
        .article-card img { width: 100%; height: 190px; object-fit: cover; filter: brightness(0.9); }
        .article-card .card-body { padding: 1rem; background: var(--black-2); }
        .article-card .category-badge {
            background: transparent;
            color: var(--gold);
            font-family: 'Inter', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 8px;
            border-left: 2px solid var(--gold);
            padding-left: 8px;
        }
        .article-card .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.35;
            margin-bottom: 8px;
            color: var(--white);
        }
        .article-card .card-title a { color: var(--white); text-decoration: none; }
        .article-card .card-title a:hover { color: var(--gold); }
        .article-card .excerpt { font-size: 0.8rem; color: var(--gray); line-height: 1.5; }
        .article-card .meta { font-size: 0.72rem; color: var(--gray); margin-top: 10px; border-top: 1px solid var(--border); padding-top: 8px; }

        /* DIVIDER */
        .gold-divider { height: 1px; background: linear-gradient(to right, var(--gold), transparent); margin: 2rem 0; }

        /* FOOTER */
        .footer {
            background: var(--black-2);
            border-top: 1px solid var(--border);
            color: var(--gray);
            padding: 2.5rem 0;
            margin-top: 4rem;
        }
        .footer .logo { font-size: 1.4rem; color: var(--white); }
        .footer .logo span { color: var(--gold); }

        /* PAGINATION */
        .page-link { background: var(--black-2); border-color: var(--border); color: var(--gray-light); }
        .page-link:hover { background: var(--black-3); color: var(--gold); border-color: var(--gold); }
        .page-item.active .page-link { background: var(--gold); border-color: var(--gold); color: var(--black); }

        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--black); }
        ::-webkit-scrollbar-thumb { background: var(--gold); }
    </style>
    @yield('styles')
</head>
<body>

<nav class="navbar navbar-off-the-pitch navbar-expand-lg">
    <div class="container">
        <div class="navbar-brand-wrap">
            <a class="logo" href="{{ route('home') }}">THE OFF <span>PITCH</span></a>
        </div>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" style="color:var(--white)">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav">
                @foreach($categories ?? [] as $cat)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', $cat->slug) }}">{{ $cat->name }}</a>
                </li>
                @endforeach
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}" style="color:var(--gold) !important;">
                        <i class="fas fa-cog me-1"></i>Admin
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="ticker">
    <div class="container">
        <span class="ticker-label">LIVE</span>
        <div style="overflow:hidden;display:inline-block;width:calc(100% - 80px);vertical-align:middle;">
            <span class="ticker-content">Selamat datang di The Off Pitch — Portal Berita Sepakbola Terkini &nbsp;&nbsp;&nbsp;⚽&nbsp;&nbsp;&nbsp; Dapatkan update terbaru seputar liga-liga top dunia &nbsp;&nbsp;&nbsp;⚽&nbsp;&nbsp;&nbsp; Premier League &bull; La Liga &bull; Serie A &bull; Bundesliga &bull; Liga Champions</span>
        </div>
    </div>
</div>

<main>
    @yield('content')
</main>

<footer class="footer">
    <div class="container text-center">
        <div class="logo mb-2">THE OFF <span>PITCH</span></div>
        <p style="font-size:0.78rem;letter-spacing:1px;">© {{ date('Y') }} THE OFF PITCH &mdash; PORTAL BERITA SEPAKBOLA TERKINI</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>