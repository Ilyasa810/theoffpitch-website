@extends('layouts.admin')

@section('title', 'Kelola Artikel')

@section('content')

{{-- STAT CARDS --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-newspaper stat-icon"></i>
            <div class="stat-num">{{ App\Models\Article::count() }}</div>
            <div class="stat-label">Total Artikel</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-check-circle stat-icon"></i>
            <div class="stat-num">{{ App\Models\Article::where('status','published')->count() }}</div>
            <div class="stat-label">Published</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-edit stat-icon"></i>
            <div class="stat-num">{{ App\Models\Article::where('status','draft')->count() }}</div>
            <div class="stat-label">Draft</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="fas fa-tags stat-icon"></i>
            <div class="stat-num">{{ App\Models\Category::count() }}</div>
            <div class="stat-label">Kategori</div>
        </div>
    </div>
</div>

{{-- TABLE PANEL --}}
<div class="panel">
    <div class="panel-header">
        <h6>Semua Artikel</h6>
        <div class="d-flex gap-2 align-items-center">
            <form action="{{ route('admin.articles.index') }}" method="GET" class="d-flex gap-2">
                <div class="search-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari artikel..." value="{{ request('search') }}"
                        style="width:220px;">
                </div>
                <button type="submit" class="btn-gold"><i class="fas fa-search"></i></button>
                @if(request('search'))
                <a href="{{ route('admin.articles.index') }}" class="btn-outline-gold">Reset</a>
                @endif
            </form>
        </div>
    </div>
    <div style="overflow-x:auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                <tr>
                    <td style="color:var(--gray);font-size:0.75rem;">{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ $article->image ? asset('storage/'.$article->image) : 'https://placehold.co/60x45/141414/c9a84c?text=GZ' }}"
                            style="width:60px;height:45px;object-fit:cover;border:1px solid var(--border);">
                    </td>
                    <td style="max-width:280px;">
                        <span style="color:var(--white);font-weight:500;font-size:0.83rem;">{{ Str::limit($article->title, 55) }}</span>
                    </td>
                    <td>
                        <span style="font-size:0.65rem;letter-spacing:1.5px;color:var(--gold);font-weight:700;text-transform:uppercase;">{{ $article->category->name }}</span>
                    </td>
                    <td>{{ $article->user->name }}</td>
                    <td>
                        @if($article->status == 'published')
                        <span class="badge-pub">Published</span>
                        @else
                        <span class="badge-draft">Draft</span>
                        @endif
                    </td>
                    <td style="font-size:0.78rem;color:var(--gray);">{{ $article->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('article.show', $article->slug) }}" target="_blank" class="btn-act"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.articles.edit', $article) }}" class="btn-act"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                                onsubmit="return confirm('Hapus artikel ini?')">
                                @csrf @method('DELETE')
                                <button class="btn-act danger" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;padding:3rem;color:var(--gray);">
                        <i class="fas fa-newspaper" style="font-size:2rem;display:block;margin-bottom:8px;opacity:0.3;"></i>
                        Belum ada artikel.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($articles->hasPages())
    <div style="padding:1rem 1.5rem;border-top:1px solid var(--border);">
        {{ $articles->links() }}
    </div>
    @endif
</div>

@endsection