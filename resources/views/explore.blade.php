@extends('layouts.app')
@section('title', 'Explore')

@section('content')

{{-- ══ SEARCH BAR ══ --}}
<form method="GET" action="{{ route('explore') }}" class="search-bar">
    <input type="text" name="q" placeholder="Cari project, kreator, kategori..."
           value="{{ request('q') }}">
    <select name="sort" onchange="this.form.submit()">
        <option value="trending"   {{ request('sort','trending')=='trending'   ? 'selected':'' }}>🔥 Trending</option>
        <option value="newest"     {{ request('sort')=='newest'     ? 'selected':'' }}>🆕 Terbaru</option>
        <option value="popular"    {{ request('sort')=='popular'    ? 'selected':'' }}>👁 Paling Dilihat</option>
        <option value="most_liked" {{ request('sort')=='most_liked' ? 'selected':'' }}>❤️ Paling Disukai</option>
    </select>
    <button type="submit" class="btn btn-primary">Cari</button>
    @if(request('q') || request('category') || (request('sort') && request('sort')!='trending'))
        <a href="{{ route('explore') }}" class="btn btn-outline">Reset</a>
    @endif
    <input type="hidden" name="category" value="{{ request('category') }}">
</form>

{{-- ══ KATEGORI PILLS ══ --}}
<div class="cat-pills">
    <a href="{{ route('explore', array_merge(request()->except('category','page'), [])) }}"
       class="cat-pill {{ !request('category') ? 'active' : '' }}">
       ✦ Semua
    </a>
    @foreach($categories as $cat)
        <a href="{{ route('explore', array_merge(request()->except('category','page'), ['category'=>$cat->slug])) }}"
           class="cat-pill {{ request('category')==$cat->slug ? 'active' : '' }}">
            @if($cat->icon)<span>{{ $cat->icon }}</span> @endif
            {{ $cat->name }}
            <span style="opacity:.65;font-size:10px">({{ $cat->project_count }})</span>
        </a>
    @endforeach
</div>

{{-- ══ HEADER ══ --}}
<div class="section-head">
    <h2>
        @if(request('category'))
            {{ $categories->firstWhere('slug', request('category'))->name ?? 'Kategori' }}
        @elseif(request('q'))
            Hasil: "{{ request('q') }}"
        @else
            Explore Projects
        @endif
    </h2>
    <span style="font-size:13px;color:#aaa;font-weight:600">{{ $projects->total() }} project ditemukan</span>
</div>

{{-- ══ GRID PROJECT ══ --}}
@if($projects->isEmpty())
    <div class="empty-state">
        <i class="fas fa-search"></i>
        <p>Tidak ada project ditemukan.</p>
        <a href="{{ route('explore') }}" class="btn btn-primary">Lihat semua project</a>
    </div>
@else
    <div class="projects-grid">
        @foreach($projects as $project)
        <a href="{{ route('projects.show', $project->slug) }}" class="project-card">
            <div class="card-img-wrap">
                <img src="{{ $project->cover_image ?? 'https://picsum.photos/seed/'.$project->id.'/480/360' }}"
                     alt="{{ $project->title }}"
                     class="card-img-inner"
                     onerror="this.src='https://picsum.photos/seed/{{$project->id}}/480/360'">
                <div class="card-overlay">
                    @auth
                    <button class="overlay-btn" onclick="event.preventDefault();toggleLike({{ $project->id }},this)">
                        <i class="fas fa-heart" style="color:#e74c3c"></i>
                        <span>{{ $project->likes_count }}</span>
                    </button>
                    <button class="overlay-btn" onclick="event.preventDefault();toggleBookmark({{ $project->id }},this)">
                        <i class="fas fa-bookmark"></i>
                    </button>
                    @endauth
                    <span style="margin-left:auto;color:rgba(255,255,255,.8);font-size:11px;font-weight:700">
                        <i class="fas fa-eye"></i> {{ number_format($project->views_count) }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="card-title">{{ $project->title }}</div>
                <div class="card-meta">
                    <img src="{{ $project->creator_avatar ?? 'https://i.pravatar.cc/40?u='.$project->creator_username }}"
                         alt="" class="card-avatar"
                         onerror="this.src='https://i.pravatar.cc/40?u={{$project->creator_username}}'">
                    <span class="card-author">{{ $project->creator_name }}</span>
                    <span class="card-likes">
                        <i class="fas fa-heart"></i> {{ number_format($project->likes_count) }}
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="pagination">
        {{ $projects->withQueryString()->links() }}
    </div>
@endif

@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function toggleLike(id, btn) {
    const res = await fetch(`/projects/${id}/like`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    });
    if (res.ok) {
        const d = await res.json();
        btn.classList.toggle('liked', d.liked);
        btn.querySelector('span').textContent = d.count;
    }
}

async function toggleBookmark(id, btn) {
    const res = await fetch(`/projects/${id}/bookmark`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    });
    if (res.ok) {
        const d = await res.json();
        btn.classList.toggle('bookmarked', d.bookmarked);
    }
}
</script>
@endpush