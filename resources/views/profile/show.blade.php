@extends('layouts.app')
@section('title', $user->name)

@push('styles')
<style>
    .profile-banner {
        width: 100%;
        height: 220px;
        background: linear-gradient(135deg, #0057ff, #00c6ff);
        position: relative;
        overflow: hidden;
    }
    .profile-banner-letter {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.12);
        font-size: 160px;
        font-weight: 900;
        user-select: none;
        letter-spacing: -8px;
    }
    .profile-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 32px 60px;
    }
    .profile-header {
        display: flex;
        align-items: flex-end;
        gap: 24px;
        margin-top: -52px;
        margin-bottom: 32px;
        flex-wrap: wrap;
    }
    .profile-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 4px solid #fff;
        object-fit: cover;
        flex-shrink: 0;
        box-shadow: 0 4px 20px rgba(0,0,0,.18);
        background: #eee;
    }
    .profile-info { flex: 1; padding-bottom: 8px; min-width: 200px; }
    .profile-name { font-size: 26px; font-weight: 800; margin-bottom: 4px; color: #111; }
    .profile-username { color: #999; font-size: 14px; margin-bottom: 8px; }
    .profile-meta { display: flex; gap: 16px; flex-wrap: wrap; align-items: center; }
    .profile-meta-item { font-size: 13px; color: #666; display: flex; align-items: center; gap: 5px; }
    .profile-meta-item a { color: #0057ff; text-decoration: none; }
    .profile-actions { display: flex; gap: 10px; padding-bottom: 8px; flex-shrink: 0; }
    .btn-follow {
        padding: 9px 22px; border-radius: 20px; font-size: 13px;
        font-weight: 700; cursor: pointer; font-family: inherit;
        border: 1.5px solid #ddd; background: #fff; color: #333;
        transition: all .15s;
    }
    .btn-follow:hover { border-color: #0057ff; color: #0057ff; }
    .btn-follow.following { background: #0057ff; color: #fff; border-color: #0057ff; }
    .btn-add-project {
        padding: 9px 22px; border-radius: 20px; font-size: 13px;
        font-weight: 700; cursor: pointer; background: #0057ff;
        color: #fff; border: none; text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px;
        transition: background .15s;
    }
    .btn-add-project:hover { background: #0041cc; }

    .profile-stats {
        display: flex;
        gap: 0;
        margin-bottom: 32px;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding: 20px 0;
    }
    .profile-stat {
        flex: 1;
        text-align: center;
        padding: 0 16px;
        border-right: 1px solid #eee;
    }
    .profile-stat:last-child { border-right: none; }
    .profile-stat-num { font-size: 22px; font-weight: 800; color: #111; margin-bottom: 4px; }
    .profile-stat-label { font-size: 12px; color: #999; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; }

    .profile-bio {
        margin-bottom: 32px;
        color: #555;
        font-size: 14px;
        line-height: 1.8;
        max-width: 640px;
        padding: 16px 20px;
        background: #f8f8f8;
        border-radius: 10px;
        border-left: 3px solid #0057ff;
    }

    .profile-work-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .profile-work-title { font-size: 20px; font-weight: 800; color: #111; }
    .profile-work-count { font-size: 13px; color: #aaa; font-weight: 600; }

    .profile-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }
    .profile-card {
        display: block;
        border-radius: 10px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,.08);
        transition: transform .2s, box-shadow .2s;
    }
    .profile-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 28px rgba(0,0,0,.14);
    }
    .profile-card-img {
        width: 100%;
        aspect-ratio: 4/3;
        object-fit: cover;
        display: block;
    }
    .profile-card-body { padding: 14px 16px; }
    .profile-card-title {
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 8px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #111;
    }
    .profile-card-meta { display: flex; gap: 14px; color: #bbb; font-size: 12px; font-weight: 600; }
    .profile-card-meta i { margin-right: 3px; }

    .profile-empty {
        text-align: center;
        padding: 80px 20px;
        color: #ccc;
    }
    .profile-empty i { font-size: 56px; margin-bottom: 16px; display: block; }
    .profile-empty p { font-size: 15px; font-weight: 600; color: #aaa; margin-bottom: 20px; }
</style>
@endpush

@section('content')

{{-- Banner --}}
<div class="profile-banner">
    <div class="profile-banner-letter">
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
</div>

{{-- Profile Header --}}
<div class="profile-container">
    <div class="profile-header">

        {{-- Avatar --}}
        <img src="{{ $user->avatar ?? 'https://i.pravatar.cc/120?u='.$user->username }}"
             alt="{{ $user->name }}"
             class="profile-avatar"
             onerror="this.src='https://i.pravatar.cc/120?u={{ $user->username }}'">

        {{-- Info --}}
        <div class="profile-info">
            <div class="profile-name">{{ $user->name }}</div>
            <div class="profile-username">&#64;{{ $user->username }}</div>
            <div class="profile-meta">
                @if($user->location)
                <span class="profile-meta-item">
                    <i class="fas fa-map-marker-alt" style="color:#ccc"></i>
                    {{ $user->location }}
                </span>
                @endif
                @if($user->availability)
                <span class="profile-meta-item" style="color:#27ae60;font-weight:700">
                    <i class="fas fa-circle" style="font-size:7px"></i>
                    {{ ucfirst(str_replace('_', ' ', $user->availability)) }}
                </span>
                @endif
                @if($user->website)
                <span class="profile-meta-item">
                    <i class="fas fa-link" style="color:#ccc"></i>
                    <a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a>
                </span>
                @endif
            </div>
        </div>

        {{-- Actions --}}
        <div class="profile-actions">
            @auth
                @if(auth()->id() !== $user->id)
                <button onclick="toggleFollow({{ $user->id }}, this)"
                    class="btn-follow {{ $isFollowing ? 'following' : '' }}">
                    {{ $isFollowing ? 'Following' : '+ Follow' }}
                </button>
                @else
                <a href="{{ route('projects.create') }}" class="btn-add-project">
                    <i class="fas fa-plus"></i> Add Project
                </a>
                @endif
            @endauth
        </div>
    </div>

    {{-- Stats --}}
    <div class="profile-stats">
        <div class="profile-stat">
            <div class="profile-stat-num">{{ $projects->count() }}</div>
            <div class="profile-stat-label">Projects</div>
        </div>
        <div class="profile-stat">
            <div class="profile-stat-num">{{ number_format($user->followers_count) }}</div>
            <div class="profile-stat-label">Followers</div>
        </div>
        <div class="profile-stat">
            <div class="profile-stat-num">{{ number_format($user->following_count) }}</div>
            <div class="profile-stat-label">Following</div>
        </div>
        <div class="profile-stat">
            <div class="profile-stat-num">{{ number_format($projects->sum('likes_count')) }}</div>
            <div class="profile-stat-label">Likes</div>
        </div>
        <div class="profile-stat">
            <div class="profile-stat-num">{{ number_format($projects->sum('views_count')) }}</div>
            <div class="profile-stat-label">Views</div>
        </div>
    </div>

    {{-- Bio --}}
    @if($user->bio)
    <div class="profile-bio">{{ $user->bio }}</div>
    @endif

    {{-- Work --}}
    <div class="profile-work-header">
        <div class="profile-work-title">Work</div>
        <div class="profile-work-count">{{ $projects->count() }} projects</div>
    </div>

    @if($projects->isEmpty())
    <div class="profile-empty">
        <i class="fas fa-folder-open"></i>
        <p>Belum ada project yang dipublikasikan</p>
        @auth
            @if(auth()->id() === $user->id)
            <a href="{{ route('projects.create') }}" class="btn-add-project">
                <i class="fas fa-plus"></i> Buat Project Pertama
            </a>
            @endif
        @endauth
    </div>
    @else
    <div class="profile-grid">
        @foreach($projects as $project)
        <a href="{{ route('projects.show', $project->slug) }}" class="profile-card">
            <img src="{{ $project->cover_image ?? 'https://picsum.photos/seed/'.$project->id.'/400/300' }}"
                 alt="{{ $project->title }}"
                 class="profile-card-img"
                 onerror="this.src='https://picsum.photos/seed/{{$project->id}}/400/300'">
            <div class="profile-card-body">
                <div class="profile-card-title">{{ $project->title }}</div>
                <div class="profile-card-meta">
                    <span><i class="fas fa-heart" style="color:#e74c3c"></i>{{ number_format($project->likes_count) }}</span>
                    <span><i class="fas fa-eye"></i>{{ number_format($project->views_count) }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function toggleFollow(userId, btn) {
    const res = await fetch(`/users/${userId}/follow`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    });
    if (res.status === 401) { window.location = '/login'; return; }
    if (res.ok) {
        const d = await res.json();
        const following = d.action === 'followed';
        btn.classList.toggle('following', following);
        btn.textContent = following ? 'Following' : '+ Follow';
    }
}
</script>
@endpush