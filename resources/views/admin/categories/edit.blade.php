@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="panel">
            <div class="panel-header"><h6>Edit Kategori</h6></div>
            <div class="panel-body">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Logo Kategori</label>
                        @if($category->logo)
                        <div style="margin-bottom:12px;padding:1rem;background:var(--black);border:1px solid var(--border);text-align:center;">
                            <img src="{{ asset('storage/'.$category->logo) }}"
                                style="width:80px;height:80px;object-fit:contain;">
                            <div style="font-size:0.7rem;color:var(--gray);margin-top:6px;">Logo saat ini</div>
                        </div>
                        @endif
                        <div style="border:2px dashed var(--border);padding:1.5rem;text-align:center;cursor:pointer;transition:all 0.2s;"
                            id="logoDropZone"
                            onclick="document.getElementById('logoInput').click()">
                            <img id="logoPreview" src="" style="display:none;width:60px;height:60px;object-fit:contain;margin:0 auto 8px;">
                            <i class="fas fa-cloud-upload-alt" style="font-size:1.2rem;color:var(--gray);display:block;margin-bottom:6px;" id="logoIcon"></i>
                            <span style="font-size:0.72rem;color:var(--gray);letter-spacing:1px;display:block;">Drag & drop atau klik untuk ganti</span>
                            <span style="font-size:0.68rem;color:var(--border);letter-spacing:1px;margin-top:4px;display:block;">PNG transparan lebih bagus</span>
                        </div>
                        <input type="file" name="logo" id="logoInput" accept="image/*" style="display:none;"
                            onchange="previewLogo(this)">
                        <small style="font-size:0.7rem;color:var(--gray);display:block;margin-top:4px;">Kosongkan jika tidak ingin mengubah logo.</small>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-gold flex-grow-1">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn-outline-gold">Batal</a>
                    </div>
                </form>
            </div>
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
        if(icon) icon.style.display = 'none';
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