@extends('layouts.app')

@section('title', $category->name)

@section('styles')
<style>
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
.card-v .title a { color: var(--white); text-decoration: none; }
.card-v .title a:hover { color: var(--gold); }
.card-v .excerpt { font-size: 0.78rem; color: var(--gray); line-height: 1.5; }
.card-v .meta-s { font-size: 0.68rem; color: var(--gray); margin-top: 8px; border-top: 1px solid var(--border); padding-top: 8px; }
</style>
@endsection

@section('content')
<div class="container mt-4">

    {{-- CATEGORY HEADER --}}
    <div style="background:var(--black-2);border:1px solid var(--border);padding:2rem;margin-bottom:2rem;display:flex;align-items:center;gap:2rem;">
        @if($category->logo)
        <img src="{{ asset('storage/'.$category->logo) }}"
            style="width:80px;height:80px;object-fit:contain;filter:drop-shadow(0 0 12px rgba(201,168,76,0.3));">
        @else
        <div style="width:80px;height:80px;background:rgba(201,168,76,0.08);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;">
            <i class="fas fa-futbol" style="font-size:2rem;color:var(--gold);"></i>
        </div>
        @endif
        <div>
            <div style="font-size:0.62rem;letter-spacing:3px;color:var(--gold);font-weight:700;text-transform:uppercase;margin-bottom:6px;">Kategori</div>
            <h1 style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:900;color:var(--white);margin:0;line-height:1;">{{ $category->name }}</h1>
            <div style="font-size:0.78rem;color:var(--gray);margin-top:6px;">{{ $articles->total() }} artikel</div>
        </div>
    </div>

    @if($articles->count() > 0)
    <div class="row g-3 mb-4">
        @foreach($articles as $article)
        <div class="col-md-4">
            <div class="card-v card">
                <img src="{{ $article->image ? asset('storage/'.$article->image) : 'https://placehold.co/400x180/141414/c9a84c?text=GZ' }}"
                    alt="{{ $article->title }}">
                <div class="body">
                    <a href="{{ route('category.show', $article->category->slug) }}" class="cat">{{ $article->category->name }}</a>
                    <div class="title"><a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a></div>
                    <p class="excerpt">{{ Str::limit($article->excerpt, 80) }}</p>
                    <div class="meta-s">
                        <i class="fas fa-user me-1"></i>{{ $article->user->name }}
                        &bull; {{ $article->created_at->format('d M Y') }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
    @else
    <div style="text-align:center;padding:4rem;background:var(--black-2);border:1px solid var(--border);">
        <i class="fas fa-futbol" style="font-size:3rem;color:var(--border);display:block;margin-bottom:1rem;"></i>
        <p style="font-family:'Playfair Display',serif;font-size:1.2rem;color:var(--gray);">Belum ada artikel di kategori ini.</p>
    </div>
    @endif

</div>
@endsection