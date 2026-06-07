@extends('layouts.app')

@section('title', 'Beranda')

@section('styles')
<style>
/* GRID LAYOUT */
.hero-grid { display: grid; grid-template-columns: 2fr 1fr; grid-template-rows: auto auto; gap: 2px; margin-bottom: 2px; }
.hero-main { grid-row: 1 / 3; position: relative; overflow: hidden; }
.hero-main img { width: 100%; height: 560px; object-fit: cover; object-position: top center; transition: transform 0.6s ease; filter: brightness(0.55); }
.hero-main:hover img { transform: scale(1.03); }
.hero-side { position: relative; overflow: hidden; }
.hero-side img { width: 100%; height: 279px; object-fit: cover; object-position: top center; transition: transform 0.6s ease; filter: brightness(0.55); }
.hero-side:hover img { transform: scale(1.03); }

.grid-overlay {
    position: absolute; bottom: 0; left: 0; right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.92));
    padding: 2rem 1.5rem 1.5rem;
}
.hero-main .grid-overlay { padding: 3rem 2rem 2rem; }

.grid-overlay .cat {
    font-size: 0.62rem; letter-spacing: 2.5px; font-weight: 700;
    text-transform: uppercase; color: var(--gold);
    border-left: 2px solid var(--gold); padding-left: 8px;
    display: inline-block; margin-bottom: 10px; text-decoration: none;
}
.hero-main .grid-overlay h2 {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem; font-weight: 900; color: white;
    line-height: 1.15; margin-bottom: 10px;
    text-decoration: none;
}
.hero-main .grid-overlay h2 a { color: white; text-decoration: none; }
.hero-main .grid-overlay h2 a:hover { color: var(--gold); }
.hero-side .grid-overlay h3 {
    font-family: 'Playfair Display', serif;
    font-size: 1.05rem; font-weight: 700; color: white;
    line-height: 1.3; margin-bottom: 6px;
}
.hero-side .grid-overlay h3 a { color: white; text-decoration: none; }
.hero-side .grid-overlay h3 a:hover { color: var(--gold); }
.grid-meta { font-size: 0.72rem; color: rgba(255,255,255,0.55); }

/* STRIP LATEST */
.strip-latest {
    background: var(--black-2);
    border-top: 2px solid var(--gold);
    border-bottom: 1px solid var(--border);
    padding: 12px 0;
    margin-bottom: 3rem;
}
.strip-latest .label {
    font-size: 0.65rem; letter-spacing: 3px; font-weight: 700;
    color: var(--gold); text-transform: uppercase;
    border-right: 1px solid var(--border); padding-right: 16px; margin-right: 16px;
    white-space: nowrap;
}
.strip-latest a {
    font-size: 0.78rem; color: var(--gray-light); text-decoration: none;
    padding: 0 14px; border-right: 1px solid var(--border);
    transition: color 0.2s; white-space: nowrap;
    font-weight: 500; letter-spacing: 0.3px;
}
.strip-latest a:hover { color: var(--gold); }

/* CARD HORIZONTAL */
.card-h {
    display: flex; gap: 0; background: var(--black-2);
    border: 1px solid var(--border) !important;
    border-radius: 0 !important;
    overflow: hidden; transition: border-color 0.25s;
    margin-bottom: 1px;
}
.card-h:hover { border-color: var(--gold) !important; }
.card-h img { width: 160px; height: 110px; object-fit: cover; object-position: top center; flex-shrink: 0; filter: brightness(0.9); }
.card-h .info { padding: 0.65rem 0.85rem; }
.card-h .cat { font-size: 0.6rem; letter-spacing: 2px; color: var(--gold); font-weight: 700; text-transform: uppercase; text-decoration: none; }
.card-h .title { font-family: 'Playfair Display', serif; font-size: 0.88rem; font-weight: 700; color: var(--white); line-height: 1.3; margin: 3px 0; }
.card-h .title a { color: inherit; text-decoration: none; }
.card-h .title a:hover { color: var(--gold); }
.card-h .meta-s { font-size: 0.68rem; color: var(--gray); }

/* CARD VERTICAL */
.card-v {
    background: var(--black-2);
    border: 1px solid var(--border) !important;
    border-radius: 0 !important;
    overflow: hidden; transition: border-color 0.25s, transform 0.25s;
    height: 100%;
}
.card-v:hover { border-color: var(--gold) !important; transform: translateY(-3px); }
.card-v img { width: 100%; height: 180px; object-fit: cover; object-position: top; filter: brightness(0.88); transition: filter 0.3s; }
.card-v:hover img { filter: brightness(1); }
.card-v .body { padding: 1rem; }
.card-v .cat { font-size: 0.6rem; letter-spacing: 2px; color: var(--gold); font-weight: 700; text-transform: uppercase; text-decoration: none; border-left: 2px solid var(--gold); padding-left: 6px; }
.card-v .title { font-family: 'Playfair Display', serif; font-size: 0.95rem; font-weight: 700; color: var(--white); line-height: 1.35; margin: 8px 0 6px; }
.card-v .title a { color: inherit; text-decoration: none; }
.card-v .title a:hover { color: var(--gold); }
.card-v .excerpt { font-size: 0.78rem; color: var(--gray); line-height: 1.5; }
.card-v .meta-s { font-size: 0.68rem; color: var(--gray); margin-top: 8px; border-top: 1px solid var(--border); padding-top: 8px; }
.card-v img { width: 100%; height: 180px; object-fit: cover; object-position: top; filter: brightness(0.88); transition: filter 0.3s; }

/* FADE IN ANIMATION */
.fade-up { opacity: 0; transform: translateY(24px); transition: opacity 0.5s ease, transform 0.5s ease; }
.fade-up.visible { opacity: 1; transform: translateY(0); }

/* NUMBER LIST */
.numbered-list { counter-reset: article-counter; }
.numbered-item {
    display: flex; align-items: flex-start; gap: 1rem;
    padding: 1rem 0; border-bottom: 1px solid var(--border);
    counter-increment: article-counter;
}
.numbered-item::before {
    content: counter(article-counter, decimal-leading-zero);
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem; font-weight: 900;
    color: var(--border); line-height: 1;
    flex-shrink: 0; width: 40px;
}
.numbered-item:hover::before { color: var(--gold); }
.numbered-item .title { font-family: 'Playfair Display', serif; font-size: 0.92rem; font-weight: 700; color: var(--white); line-height: 1.35; }
.numbered-item .title a { color: inherit; text-decoration: none; }
.numbered-item .title a:hover { color: var(--gold); }
</style>
@endsection

@section('content')

@php
    $heroMain = $articles->first();
    $heroSide = $articles->slice(1, 2);
    $rest = $articles->slice(3);
@endphp

{{-- HERO GRID --}}
@if($heroMain)
<div class="hero-grid">
    {{-- MAIN HERO --}}
    <div class="hero-main">
        <img src="{{ $heroMain->image ? asset('storage/'.$heroMain->image) : 'https://placehold.co/800x560/0a0a0a/c9a84c?text=THE OFF PITCH' }}" alt="{{ $heroMain->title }}">
        <div class="grid-overlay">
            <a href="{{ route('category.show', $heroMain->category->slug) }}" class="cat">{{ $heroMain->category->name }}</a>
            <h2><a href="{{ route('article.show', $heroMain->slug) }}">{{ $heroMain->title }}</a></h2>
            <p style="font-size:0.85rem;color:rgba(255,255,255,0.65);margin-bottom:8px;">{{ Str::limit($heroMain->excerpt, 100) }}</p>
            <div class="grid-meta"><i class="fas fa-user me-1"></i>{{ $heroMain->user->name }} &bull; {{ $heroMain->created_at->format('d M Y') }}</div>
        </div>
    </div>
    {{-- SIDE HEROES --}}
    @foreach($heroSide as $s)
    <div class="hero-side">
        <img src="{{ $s->image ? asset('storage/'.$s->image) : 'https://placehold.co/400x279/141414/c9a84c?text=THE OFF PITCH' }}" alt="{{ $s->title }}">
        <div class="grid-overlay">
            <a href="{{ route('category.show', $s->category->slug) }}" class="cat">{{ $s->category->name }}</a>
            <h3><a href="{{ route('article.show', $s->slug) }}">{{ $s->title }}</a></h3>
            <div class="grid-meta">{{ $s->created_at->format('d M Y') }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- STRIP --}}
<div class="strip-latest">
    <div class="container d-flex align-items-center overflow-hidden">
        <span class="label">Terbaru</span>
        @foreach($articles->take(5) as $a)
        <a href="{{ route('article.show', $a->slug) }}">{{ Str::limit($a->title, 45) }}</a>
        @endforeach
    </div>
</div>
@endif

<div class="container">
    <div class="row g-4">

        {{-- MAIN CONTENT --}}
        <div class="col-lg-8">

            {{-- BERITA TERBARU - HORIZONTAL LIST --}}
            <div class="section-title mb-3">Berita Terbaru</div>
            @foreach($rest->take(4) as $article)
            <div class="card-h card fade-up">
                <img src="{{ $article->image ? asset('storage/'.$article->image) : 'https://placehold.co/120x85/141414/c9a84c?text=GZ' }}" alt="{{ $article->title }}">
                <div class="info">
                    <a href="{{ route('category.show', $article->category->slug) }}" class="cat">{{ $article->category->name }}</a>
                    <div class="title"><a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a></div>
                    <div class="meta-s"><i class="fas fa-user me-1"></i>{{ $article->user->name }} &bull; {{ $article->created_at->format('d M Y') }}</div>
                </div>
            </div>
            @endforeach

            {{-- GRID CARDS --}}
            @if($rest->count() > 0)
            <div class="section-title mt-4 mb-3">Pilihan Editor</div>
            <div class="row g-2">
                @foreach($rest->skip(4) as $article)
                <div class="col-md-6 fade-up">
                    <div class="card-v card">
                        <img src="{{ $article->image ? asset('storage/'.$article->image) : 'https://placehold.co/400x180/141414/c9a84c?text=GZ' }}" alt="{{ $article->title }}">
                        <div class="body">
                            <a href="{{ route('category.show', $article->category->slug) }}" class="cat">{{ $article->category->name }}</a>
                            <div class="title"><a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a></div>
                            <p class="excerpt">{{ Str::limit($article->excerpt, 80) }}</p>
                            <div class="meta-s">{{ $article->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <div class="d-flex justify-content-center mt-4">
                {{ $articles->links() }}
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-4">
            {{-- MOST READ --}}
            <div class="section-title">Paling Banyak Dibaca</div>
            <div class="numbered-list mb-4">
                @foreach($articles->take(5) as $article)
                <div class="numbered-item fade-up">
                    <div>
                        <a href="{{ route('category.show', $article->category->slug) }}" class="cat" style="font-size:0.6rem;letter-spacing:2px;color:var(--gold);font-weight:700;text-transform:uppercase;text-decoration:none;">{{ $article->category->name }}</a>
                        <div class="title"><a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a></div>
                        <div style="font-size:0.68rem;color:var(--gray);margin-top:4px;">{{ $article->created_at->format('d M Y') }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- KATEGORI --}}
            <div class="section-title">Kategori</div>
            <div class="mb-4">
                @foreach($categories as $cat)
                <a href="{{ route('category.show', $cat->slug) }}"
                   class="d-flex justify-content-between align-items-center py-2 px-0 text-decoration-none"
                   style="border-bottom:1px solid var(--border);color:var(--gray-light);font-size:0.82rem;font-weight:500;letter-spacing:0.5px;transition:color 0.2s;"
                   onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='var(--gray-light)'">
                    <span><i class="fas fa-chevron-right me-2" style="font-size:0.6rem;color:var(--gold)"></i>{{ $cat->name }}</span>
                </a>
                @endforeach
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            setTimeout(() => entry.target.classList.add('visible'), i * 80);
        }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>
@endsection