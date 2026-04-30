@extends('layouts.app')
@section('title', 'Explore')

@section('content')
<div class="section-head">
    <h2>Explore Projects</h2>
    <span style="font-size:13px;color:#888">{{ $projects->total() }} project ditemukan</span>
</div>

{{-- Search & Sort --}}
<form method="GET" action="{{ route('explore') }}" class="search-bar">
    <input type="text" name="q" class="form-control" placeholder="Cari project, kreator..."
           value="{{ request('q') }}">
    <select name="sort" onchange="this.form.submit()">
        <option value="trending"  {{ request('sort','trending')=='trending'  ? 'selected' : '' }}>Trending</option>
        <option value="newest"    {{ request('sort')=='newest'    ? 'selected' : '' }}>Terbaru</option>
        <option value="popular"   {{ request('sort')=='popular'   ? 'selected' : '' }}>Terpopuler</option>
        <option value="most_liked"{{ request('sort')=='most_liked'? 'selected' : '' }}>Paling Disukai</option>
    </select>
    <button type="submit" class="btn btn-primary">Cari</button>
    @if(request('q') || request('category') || request('sort'))
        <a href="{{ route('explore') }}" class="btn btn-outline">Reset</a>
    @endif
    <input type="hidden" name="category" value="{{ request('category') }}">
</form>

{{-- Filter kategori --}}
<div class="cat-pills">
    <a href="{{ route('explore', array_merge(request()->except('category'), [])) }}"
       class="cat-pill {{ !request('category') ? 'active' : '' }}">Semua</a>
    @foreach($categories as $cat)
        <a href="{{ route('explore', array_merge(request()->except('category'), ['category' => $cat->slug])) }}"
           class="cat-pill {{ request('category') == $cat->slug ? 'active' : '' }}">
            {{ $cat->name }}
            <span style="font-size:11px;opacity:.7">({{ $cat->project_count }})</span>
        </a>
    @endforeach
</div>

{{-- Grid project --}}
@if($projects->isEmpty())
    <div style="text-align:center;padding:60px;color:#888">
        <i class="fas fa-search" style="font-size:40px;margin-bottom:12px;display:block"></i>
        <p>Tidak ada project ditemukan.</p>
        <a href="{{ route('explore') }}" class="btn btn-primary" style="margin-top:12px">Lihat semua</a>
    </div>
@else
    <div class="grid-4">
        @foreach($projects as $project)
        <a href="{{ route('projects.show', $project->slug) }}" class="card">
            <img src="{{ $project->cover_image ?? 'https://picsum.photos/seed/'.$project->id.'/400/300' }}"
                 alt="{{ $project->title }}" class="card-img"
                 onerror="this.src='https://picsum.photos/seed/{{$project->id}}/400/300'">
            <div class="card-body">
                <div class="card-title">{{ $project->title }}</div>
                <div class="card-meta">
                    <img src="{{ $project->creator_avatar ?? 'https://i.pravatar.cc/40?u='.$project->creator_username }}"
                         alt="{{ $project->creator_name }}">
                    <span>{{ $project->creator_name }}</span>
                    <span style="margin-left:auto">
                        <i class="fas fa-heart" style="color:#ff4444"></i> {{ $project->likes_count }}
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="pagination">
        {{ $projects->withQueryString()->links() }}
    </div>
@endif
@endsection