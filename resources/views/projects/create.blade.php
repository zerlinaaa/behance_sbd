@extends('layouts.app')
@section('title', 'Buat Project Baru')

@section('content')
<div style="max-width:720px;margin:40px auto;padding:0 16px 60px">

    <div style="margin-bottom:28px">
        <h1 style="font-size:24px;font-weight:800">Buat Project Baru</h1>
        <p style="color:#888;font-size:14px;margin-top:4px">Bagikan karya terbaikmu ke komunitas</p>
    </div>

    @if($errors->any())
    <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <div>
            @foreach($errors->all() as $e)
                <div>{{ $e }}</div>
            @endforeach
        </div>
    </div>
    @endif

    <form method="POST" action="{{ route('projects.store') }}">
        @csrf

        {{-- Title --}}
        <div class="form-group">
            <label class="form-label">Judul Project *</label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title') }}" placeholder="Nama project kamu" required>
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control"
                      placeholder="Ceritakan tentang project ini...">{{ old('description') }}</textarea>
        </div>

        {{-- Cover Image --}}
        <div class="form-group">
            <label class="form-label">URL Cover Image</label>
            <input type="url" name="cover_image" id="cover_image_input" class="form-control"
                   value="{{ old('cover_image') }}"
                   placeholder="https://..."
                   oninput="previewCover(this.value)">
            <p class="form-hint">Masukkan URL gambar untuk cover project</p>
            <div id="cover-preview" style="display:none;margin-top:10px">
                <img id="cover-img" src="" alt="Preview"
                     style="width:100%;max-height:280px;object-fit:cover;border-radius:8px;border:1px solid #e0e0e0">
            </div>
        </div>

        {{-- Categories --}}
        <div class="form-group">
            <label class="form-label">Kategori / Creative Fields</label>
            <div style="display:flex;flex-wrap:wrap;gap:8px">
                @foreach($categories as $cat)
                <label style="display:flex;align-items:center;gap:6px;padding:6px 12px;border:1.5px solid #e0e0e0;border-radius:20px;cursor:pointer;font-size:13px;font-weight:600;transition:all .12s"
                       class="cat-label">
                    <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                           {{ in_array($cat->id, old('categories', [])) ? 'checked' : '' }}
                           style="display:none" onchange="toggleCatLabel(this)">
                    {{ $cat->name }}
                </label>
                @endforeach
            </div>
        </div>

        {{-- Tools --}}
        <div class="form-group">
            <label class="form-label">Tools yang Digunakan</label>
            <div style="display:flex;flex-wrap:wrap;gap:8px">
                @foreach(['Figma','Adobe XD','Photoshop','Illustrator','Blender','After Effects','Sketch','Procreate','Cinema 4D','InDesign','Lightroom','Premiere Pro'] as $tool)
                <label style="display:flex;align-items:center;gap:6px;padding:6px 12px;border:1.5px solid #e0e0e0;border-radius:20px;cursor:pointer;font-size:13px;font-weight:600;transition:all .12s"
                       class="tool-label">
                    <input type="checkbox" name="tools[]" value="{{ $tool }}"
                           {{ in_array($tool, old('tools', [])) ? 'checked' : '' }}
                           style="display:none" onchange="toggleToolLabel(this)">
                    {{ $tool }}
                </label>
                @endforeach
            </div>
            <p class="form-hint">Pilih tools yang kamu gunakan dalam project ini</p>
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft"     {{ old('status') == 'draft'     ? 'selected' : '' }}>Draft</option>
            </select>
        </div>

        <div style="display:flex;gap:10px;margin-top:8px">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Publikasikan Project
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewCover(url) {
    const preview = document.getElementById('cover-preview');
    const img = document.getElementById('cover-img');
    if (url) {
        img.src = url;
        preview.style.display = 'block';
        img.onerror = () => { preview.style.display = 'none'; };
    } else {
        preview.style.display = 'none';
    }
}

function toggleCatLabel(input) {
    const label = input.closest('label');
    if (input.checked) {
        label.style.background = '#0057ff';
        label.style.color = '#fff';
        label.style.borderColor = '#0057ff';
    } else {
        label.style.background = '';
        label.style.color = '';
        label.style.borderColor = '#e0e0e0';
    }
}

function toggleToolLabel(input) {
    const label = input.closest('label');
    if (input.checked) {
        label.style.background = '#111';
        label.style.color = '#fff';
        label.style.borderColor = '#111';
    } else {
        label.style.background = '';
        label.style.color = '';
        label.style.borderColor = '#e0e0e0';
    }
}

// Init state untuk old() values
document.querySelectorAll('.cat-label input:checked').forEach(toggleCatLabel);
document.querySelectorAll('.tool-label input:checked').forEach(toggleToolLabel);
</script>
@endpush