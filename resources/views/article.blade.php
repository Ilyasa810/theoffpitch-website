@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container mt-4">
    <div class="row g-4">

        {{-- ARTIKEL --}}
        <div class="col-lg-8">
            <div style="background:var(--black-2);border:1px solid var(--border);padding:2rem;">

                {{-- META TOP --}}
                <a href="{{ route('category.show', $article->category->slug) }}"
                   style="font-size:0.62rem;letter-spacing:2.5px;font-weight:700;color:var(--gold);text-transform:uppercase;text-decoration:none;border-left:2px solid var(--gold);padding-left:8px;display:inline-block;margin-bottom:16px;">
                    {{ $article->category->name }}
                </a>

                {{-- JUDUL --}}
                <h1 style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:900;color:var(--white);line-height:1.2;margin-bottom:16px;">
                    {{ $article->title }}
                </h1>

                {{-- META --}}
                <div style="display:flex;align-items:center;gap:1.5rem;padding:12px 0;border-top:1px solid var(--border);border-bottom:1px solid var(--border);margin-bottom:1.5rem;">
                    <span style="font-size:0.75rem;color:var(--gray);display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-user" style="color:var(--gold);font-size:0.7rem;"></i>{{ $article->user->name }}
                    </span>
                    <span style="font-size:0.75rem;color:var(--gray);display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-calendar" style="color:var(--gold);font-size:0.7rem;"></i>{{ $article->created_at->format('d M Y, H:i') }}
                    </span>
                    <span style="font-size:0.75rem;color:var(--gray);display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-folder" style="color:var(--gold);font-size:0.7rem;"></i>{{ $article->category->name }}
                    </span>
                </div>

                {{-- GAMBAR --}}
                @if($article->image)
                <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}"
                    style="width:100%;max-height:450px;object-fit:cover;object-position:top;margin-bottom:1.5rem;border:1px solid var(--border);">
                @endif

                {{-- KONTEN --}}
                <div style="font-size:1rem;line-height:1.9;color:var(--gray-light);">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-4">

            {{-- KATEGORI --}}
            <div style="background:var(--black-2);border:1px solid var(--border);padding:1.5rem;margin-bottom:1.5rem;">
                <div class="section-title">Kategori</div>
                @foreach($categories as $cat)
                <a href="{{ route('category.show', $cat->slug) }}"
                   class="d-flex justify-content-between align-items-center py-2 px-0 text-decoration-none"
                   style="border-bottom:1px solid var(--border);color:var(--gray-light);font-size:0.82rem;font-weight:500;letter-spacing:0.5px;transition:color 0.2s;"
                   onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='var(--gray-light)'">
                    <span><i class="fas fa-chevron-right me-2" style="font-size:0.6rem;color:var(--gold)"></i>{{ $cat->name }}</span>
                </a>
                @endforeach
            </div>

            {{-- BERITA TERKAIT --}}
            @if($related->count() > 0)
            <div style="background:var(--black-2);border:1px solid var(--border);padding:1.5rem;">
                <div class="section-title">Berita Terkait</div>
                @foreach($related as $rel)
                <div style="display:flex;gap:12px;margin-bottom:1rem;padding-bottom:1rem;border-bottom:1px solid var(--border);">
                    <img src="{{ $rel->image ? asset('storage/'.$rel->image) : 'https://placehold.co/80x60/141414/c9a84c?text=GZ' }}"
                        style="width:80px;height:60px;object-fit:cover;object-position:top;flex-shrink:0;border:1px solid var(--border);">
                    <div>
                        <a href="{{ route('article.show', $rel->slug) }}"
                           style="font-family:'Playfair Display',serif;font-size:0.85rem;color:var(--white);text-decoration:none;line-height:1.3;display:block;transition:color 0.2s;"
                           onmouseover="this.style.color='var(--gold)'" onmouseout="this.style.color='var(--white)'">
                            {{ $rel->title }}
                        </a>
                        <small style="color:var(--gray);font-size:0.7rem;">{{ $rel->created_at->format('d M Y') }}</small>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>
</div>
@endsection