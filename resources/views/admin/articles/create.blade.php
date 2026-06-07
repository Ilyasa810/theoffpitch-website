@extends('layouts.admin')

@section('title', 'Tambah Artikel')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="panel">
            <div class="panel-header"><h6>Konten Artikel</h6></div>
            <div class="panel-body">
                <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul Artikel</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" placeholder="Masukkan judul artikel...">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ringkasan</label>
                        <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror"
                            rows="3" placeholder="Ringkasan singkat artikel...">{{ old('excerpt') }}</textarea>
                        @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Artikel</label>
                        <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                            rows="14" placeholder="Tulis isi artikel di sini...">{{ old('content') }}</textarea>
                        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel mb-3">
            <div class="panel-header"><h6>Publikasi</h6></div>
            <div class="panel-body">
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_id" form="articleForm" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" form="articleForm" class="form-select">
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" form="articleForm" class="btn-gold flex-grow-1">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="btn-outline-gold">Batal</a>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header"><h6>Gambar Artikel</h6></div>
            <div class="panel-body">
                <div id="preview-wrap" style="display:none;margin-bottom:12px;">
                    <img id="preview" src="" style="width:100%;height:160px;object-fit:cover;border:1px solid var(--border);">
                </div>
                <div style="border:2px dashed var(--border);padding:1.5rem;text-align:center;cursor:pointer;transition:all 0.2s;"
                id="drop-zone"
                onclick="document.getElementById('imageInput').click()">
                <i class="fas fa-cloud-upload-alt" style="font-size:1.2rem;color:var(--gray);display:block;margin-bottom:6px;"></i>
                <span style="font-size:0.72rem;color:var(--gray);letter-spacing:1px;display:block;">Drag & drop atau klik untuk ganti</span>
                <span style="font-size:0.68rem;color:var(--border);letter-spacing:1px;margin-top:4px;display:block;">JPG, PNG, WEBP — Max 2MB</span>
            </div>
                <input type="file" name="image" id="imageInput" form="articleForm"
                    class="form-control @error('image') is-invalid @enderror"
                    accept="image/*" style="display:none;" onchange="previewImage(this)">
                @error('image')<div class="text-danger" style="font-size:0.78rem;margin-top:6px;">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function initDragDrop(dropZoneId, inputId, previewId, previewWrapId) {
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
            showPreview(file, previewId, previewWrapId);
        }
    });

    dropZone.addEventListener('dragover', e => e.preventDefault());
}

function showPreview(file, previewId, previewWrapId) {
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById(previewId).src = e.target.result;
        document.getElementById(previewWrapId).style.display = 'block';
    }
    reader.readAsDataURL(file);
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        showPreview(input.files[0], 'preview', 'preview-wrap');
    }
}

initDragDrop('drop-zone', 'imageInput', 'preview', 'preview-wrap');
</script>
@endsection