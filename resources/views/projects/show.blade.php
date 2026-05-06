@extends('layouts.app')
@section('title', $project->title)

@section('content')

<div style="max-width:900px;margin:0 auto;padding:0 16px;position:relative">

    {{-- ══ FLOATING SIDEBAR KANAN (seperti Behance) ══ --}}
    <div style="position:fixed;right:24px;top:50%;transform:translateY(-50%);z-index:100;display:flex;flex-direction:column;gap:8px;align-items:center">

        <button onclick="toggleFollow({{ $project->user_id }}, this)"
            style="width:48px;height:48px;border-radius:50%;background:#fff;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,0,0,.1);flex-direction:column;font-size:9px;font-weight:600;color:#333;gap:2px">
            <i class="fas fa-plus" style="font-size:14px"></i>
            <span>Follow</span>
        </button>

        <button style="width:48px;height:48px;border-radius:50%;background:#fff;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,0,0,.1);flex-direction:column;font-size:9px;font-weight:600;color:#333;gap:2px">
            <i class="fas fa-briefcase" style="font-size:14px"></i>
            <span>Hire</span>
        </button>

        <button onclick="toggleBookmark({{ $project->id }}, this)"
            style="width:48px;height:48px;border-radius:50%;background:#fff;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,0,0,.1);flex-direction:column;font-size:9px;font-weight:600;color:#333;gap:2px">
            <i class="fas fa-bookmark" style="font-size:14px"></i>
            <span>Save</span>
        </button>

        <button style="width:48px;height:48px;border-radius:50%;background:#fff;border:1px solid #e0e0e0;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,0,0,.1);flex-direction:column;font-size:9px;font-weight:600;color:#333;gap:2px"
            onclick="shareProject()">
            <i class="fas fa-share-alt" style="font-size:14px"></i>
            <span>Share</span>
        </button>

        <button onclick="toggleLike({{ $project->id }}, this)"
            style="width:48px;height:48px;border-radius:50%;background:#0057ff;border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:0 2px 8px rgba(0,86,255,.3);flex-direction:column;font-size:9px;font-weight:600;color:#fff;gap:2px">
            <i class="fas fa-thumbs-up" style="font-size:14px"></i>
            <span>{{ number_format($project->likes_count) }}</span>
        </button>

    </div>

    {{-- Cover Image --}}
    <div style="border-radius:12px;overflow:hidden;margin-bottom:24px;background:#111">
        <img src="{{ $project->cover_image ?? 'https://picsum.photos/seed/'.$project->id.'/900/500' }}"
             alt="{{ $project->title }}"
             style="width:100%;max-height:500px;object-fit:cover;display:block"
             onerror="this.src='https://picsum.photos/seed/{{$project->id}}/900/500'">
    </div>

    {{-- Project Images --}}
    @if($images->count() > 1)
    <div style="display:flex;flex-direction:column;gap:16px;margin-bottom:32px">
        @foreach($images->skip(1) as $img)
        <img src="{{ $img->image_path }}"
             alt="{{ $img->caption ?? $project->title }}"
             style="width:100%;border-radius:8px;display:block"
             onerror="this.style.display='none'">
        @endforeach
    </div>
    @endif

    {{-- Title & Meta --}}
    <div style="margin-bottom:24px">
        <h1 style="font-size:28px;font-weight:800;margin-bottom:12px;line-height:1.3">
            {{ $project->title }}
        </h1>

        <div style="display:flex;gap:20px;color:#aaa;font-size:14px;margin-bottom:16px">
            <span><i class="fas fa-eye"></i> {{ number_format($project->views_count) }} views</span>
            <span><i class="fas fa-heart" style="color:#e74c3c"></i> {{ number_format($project->likes_count) }} likes</span>
            <span><i class="fas fa-comment"></i> {{ number_format($project->comments_count) }} comments</span>
        </div>

        {{-- Creator --}}
        <div style="display:flex;align-items:center;gap:12px;padding:16px;background:#f8f8f8;border-radius:10px">
            <img src="{{ $project->creator_avatar ?? 'https://i.pravatar.cc/60?u='.$project->creator_username }}"
                 alt="{{ $project->creator_name }}"
                 style="width:48px;height:48px;border-radius:50%;object-fit:cover"
                 onerror="this.src='https://i.pravatar.cc/60?u={{ $project->creator_username }}'">
            <div>
                <div style="font-weight:700;font-size:15px">{{ $project->creator_name }}</div>
                <div style="color:#aaa;font-size:13px">{{ $project->creator_username }}</div>
            </div>
        </div>
    </div>

    {{-- Description --}}
    @if($project->description)
    <div style="margin-bottom:32px;padding:20px;background:#fafafa;border-radius:10px;border-left:4px solid #0057ff">
        <h3 style="font-size:16px;font-weight:700;margin-bottom:8px">Tentang Project</h3>
        <p style="color:#555;line-height:1.7;white-space:pre-line">{{ $project->description }}</p>
    </div>
    @endif

    {{-- Comments --}}
    <div style="margin-bottom:40px">
        <h3 style="font-size:18px;font-weight:700;margin-bottom:20px">
            Komentar ({{ $comments->count() }})
        </h3>

        @auth
        <form method="POST" action="/projects/{{ $project->id }}/comments" style="margin-bottom:24px">
            @csrf
            <textarea name="content" placeholder="Tulis komentar..."
                style="width:100%;padding:12px;border:1px solid #ddd;border-radius:8px;font-size:14px;resize:vertical;min-height:80px"></textarea>
            <button type="submit" class="btn btn-primary" style="margin-top:8px">Kirim</button>
        </form>
        @endauth

        @forelse($comments as $comment)
        <div style="display:flex;gap:12px;margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #f0f0f0">
            <img src="{{ $comment->avatar ?? 'https://i.pravatar.cc/40?u='.$comment->username }}"
                 alt="{{ $comment->name }}"
                 style="width:40px;height:40px;border-radius:50%;object-fit:cover;flex-shrink:0"
                 onerror="this.src='https://i.pravatar.cc/40?u={{$comment->username}}'">
            <div>
                <div style="font-weight:700;font-size:14px">{{ $comment->name }}
                    <span style="color:#aaa;font-weight:400;font-size:12px">
                        · {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                    </span>
                </div>
                <p style="color:#444;font-size:14px;margin-top:4px;line-height:1.6">{{ $comment->content }}</p>
            </div>
        </div>
        @empty
        <p style="color:#aaa;text-align:center;padding:20px">Belum ada komentar.</p>
        @endforelse
    </div>

    {{-- Related Projects --}}
    @if($related->count())
    <div style="margin-bottom:40px">
        <h3 style="font-size:18px;font-weight:700;margin-bottom:20px">Project Lainnya</h3>
        <div class="projects-grid">
            @foreach($related as $rel)
            <a href="{{ route('projects.show', $rel->slug) }}" class="project-card">
                <div class="card-img-wrap">
                    <img src="{{ $rel->cover_image ?? 'https://picsum.photos/seed/'.$rel->id.'/480/360' }}"
                         alt="{{ $rel->title }}"
                         class="card-img-inner"
                         onerror="this.src='https://picsum.photos/seed/{{$rel->id}}/480/360'">
                </div>
                <div class="card-body">
                    <div class="card-title">{{ $rel->title }}</div>
                    <div class="card-meta">
                        <span class="card-likes"><i class="fas fa-heart"></i> {{ number_format($rel->likes_count) }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <a href="{{ route('explore') }}" class="btn btn-outline" style="margin-bottom:40px;display:inline-block">
        ← Kembali ke Explore
    </a>

</div>

@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function toggleLike(id, btn) {
    const res = await fetch(`/projects/${id}/like`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    });
    if (res.status === 401) { window.location = '/login'; return; }
    if (res.ok) {
        const d = await res.json();
        const liked = d.action === 'liked';
        btn.style.background = liked ? '#e74c3c' : '#0057ff';
        btn.querySelector('span').textContent = d.likes_count;
    }
}

async function toggleBookmark(id, btn) {
    const res = await fetch(`/projects/${id}/bookmark`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    });
    if (res.status === 401) { window.location = '/login'; return; }
    if (res.ok) {
        const d = await res.json();
        const saved = d.action === 'saved';
        btn.style.background = saved ? '#0057ff' : '#fff';
        btn.style.color = saved ? '#fff' : '#333';
        btn.querySelector('span').textContent = saved ? 'Saved' : 'Save';
    }
}

async function toggleFollow(userId, btn) {
    const res = await fetch(`/users/${userId}/follow`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    });
    if (res.status === 401) { window.location = '/login'; return; }
    if (res.ok) {
        const d = await res.json();
        const following = d.action === 'followed';
        btn.style.background = following ? '#0057ff' : '#fff';
        btn.style.color = following ? '#fff' : '#333';
        btn.querySelector('span').textContent = following ? 'Following' : 'Follow';
    }
}

function shareProject() {
    if (navigator.share) {
        navigator.share({
            title: document.title,
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link copied to clipboard!');
        });
    }
}
</script>
@endpush