@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-header"><h6>Tambah Kategori</h6></div>
            <div class="panel-body">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" placeholder="Contoh: Liga 1 Indonesia">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Logo Kategori</label>
                        <div style="border:2px dashed var(--border);padding:1.5rem;text-align:center;cursor:pointer;transition:all 0.2s;"
                        id="logoDropZone"
                        onclick="document.getElementById('logoInput').click()">
                        <img id="logoPreview" src="" style="display:none;width:60px;height:60px;object-fit:contain;margin:0 auto 8px;">
                        <i class="fas fa-image" style="font-size:1.2rem;color:var(--gray);display:block;margin-bottom:6px;" id="logoIcon"></i>
                        <span style="font-size:0.72rem;color:var(--gray);letter-spacing:1px;display:block;">Drag & drop atau klik untuk upload</span>
                        <span style="font-size:0.68rem;color:var(--border);letter-spacing:1px;margin-top:4px;display:block;">PNG transparan lebih bagus</span>
                    </div>
                        <input type="file" name="logo" id="logoInput" accept="image/*" style="display:none;"
                            onchange="previewLogo(this)">
                        <small style="font-size:0.7rem;color:var(--gray);display:block;margin-top:4px;">Opsional. Max 1MB.</small>
                    </div>
                    <button type="submit" class="btn-gold w-100">
                        <i class="fas fa-plus"></i> Tambah Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="panel">
            <div class="panel-header"><h6>Semua Kategori</h6></div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Artikel</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td style="color:var(--gray);font-size:0.75rem;">{{ $loop->iteration }}</td>
                        <td>
                            @if($category->logo)
                            <img src="{{ asset('storage/'.$category->logo) }}"
                                style="width:36px;height:36px;object-fit:contain;">
                            @else
                            <div style="width:36px;height:36px;background:rgba(201,168,76,0.1);display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-futbol" style="color:var(--gold);font-size:0.8rem;"></i>
                            </div>
                            @endif
                        </td>
                        <td style="color:var(--white);font-weight:500;">{{ $category->name }}</td>
                        <td><code style="color:var(--gold);font-size:0.78rem;background:rgba(201,168,76,0.08);padding:2px 8px;">{{ $category->slug }}</code></td>
                        <td><span class="badge-pub">{{ $category->articles_count }}</span></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn-act"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                    onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-act danger" type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:3rem;color:var(--gray);">
                            <i class="fas fa-tags" style="font-size:2rem;display:block;margin-bottom:8px;opacity:0.3;"></i>
                            Belum ada kategori.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function initDragDrop(dropZoneId, inputId, previewId, iconId) {
    const dropZone = document.getElementById(dropZoneId);
    const input = document.getElementById(inputId);

    ['dragenter', 'dragover'].forEach(e => {
        dropZone.addEventListener(e, () => {
            dropZone.style.borderColor = 'var(--gold)';
            dropZone.style.background = 'rgba(201,168,76,0.05)';
        });
    });

    ['dragleave', 'drop'].forEach(e => {
        dropZone.addEventListener(e, () => {
            dropZone.style.borderColor = 'var(--border)';
            dropZone.style.background = 'transparent';
        });
    });

    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            showLogoPreview(file, previewId, iconId);
        }
    });

    dropZone.addEventListener('dragover', e => e.preventDefault());
}

function showLogoPreview(file, previewId, iconId) {
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById(previewId);
        const icon = document.getElementById(iconId);
        preview.src = e.target.result;
        preview.style.display = 'block';
        icon.style.display = 'none';
    }
    reader.readAsDataURL(file);
}

function previewLogo(input) {
    if (input.files && input.files[0]) {
        showLogoPreview(input.files[0], 'logoPreview', 'logoIcon');
    }
}

initDragDrop('logoDropZone', 'logoInput', 'logoPreview', 'logoIcon');
</script>
@endsection