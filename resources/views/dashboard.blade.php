@if(request()->ajax())
    {{-- 1. BAGIAN AJAX: Hanya mengirimkan kartu project saat scroll --}}
    @foreach($feedProjects as $project)
    <a href="{{ route('projects.show', $project->slug) }}" class="project-card">
        <img src="{{ $project->cover_image }}"
             alt="{{ $project->title }}"
             onerror="this.src='https://picsum.photos/seed/{{ $project->id }}/400/300'">
        <div class="project-info">
            <div class="project-title">{{ $project->title }}</div>
            <div class="project-meta">
                <img src="https://i.pravatar.cc/40?u={{ $project->creator_name }}"
                     alt="{{ $project->creator_name }}">
                <span>{{ $project->creator_name }}</span>
                <span class="likes">
                    <i class="fas fa-heart" style="color:#ff4444;font-size:11px"></i>
                    {{ $project->likes_count }}
                </span>
            </div>
        </div>
    </a>
    @endforeach
@else
    {{-- 2. BAGIAN UTAMA: Tampilan penuh saat halaman pertama kali dibuka --}}
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <script src="https://cdn.tailwindcss.com"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Behance — Portofolio Kreatif</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            * { box-sizing: border-box; margin: 0; padding: 0; }
            body { font-family: 'Segoe UI', sans-serif; background: #f8f8f8; color: #1a1a1a; }
            a { text-decoration: none; color: inherit; }

            /* NAVBAR */
            .navbar { background: #fff; border-bottom: 1px solid #e5e5e5; padding: 0 32px; height: 56px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
            

            /* FILTER BAR */
            /* FILTER BAR REVISION */
.filter-bar {
    background: #fff;
    border-bottom: 1px solid #e5e5e5;
    padding: 12px 32px;
    display: flex;
    align-items: center;
    gap: 12px;
    position: sticky;
    top: 56px; /* Sesuaikan dengan tinggi navbar kamu (tadi kamu tulis 56px di CSS navbar) */
    z-index: 1000;
    width: 100%; /* Pastikan full width */
}

/* Tombol Filter Kiri */
.btn-filter-pill {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    border: 1px solid #e5e5e5;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 700;
    color: #111;
    background: #fff;
}

/* Container Search Utama */
.search-container-pill {
    display: flex;
    align-items: center;
    flex: 1;
    background: #f5f5f5;
    border: 1px solid #e5e5e5;
    border-radius: 50px;
    padding: 4px 6px 4px 16px;
    gap: 10px;
}

.search-container-pill input {
    border: none;
    background: transparent;
    outline: none;
    flex: 1;
    font-size: 14px;
    font-weight: 500;
}

/* Tab di dalam Search Bar */
.inner-tabs {
    display: flex;
    align-items: center;
    gap: 2px;
}

.inner-tab {
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 700;
    color: #555;
    text-decoration: none;
    transition: all 0.2s ease;
}

.inner-tab:hover {
    color: #111;
}

.inner-tab.active {
    background: #fff;
    color: #111;
    box-shadow: 0 1px 4px rgba(0,0,0,0.1);
}

.divider-line {
    width: 1px;
    height: 20px;
    background: #ddd;
    margin: 0 8px;
}

.btn-upload-search {
    color: #555;
    font-size: 16px;
    margin-right: 10px;
    cursor: pointer;
}

/* Container Dropdown Recommended */
.bh-recommended-wrap {
    position: relative;
    display: inline-block;
}

/* Tombol Dropdown */
.bh-recommended-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: none;
    border: none;
    font-size: 14px;
    font-weight: 700;
    color: #111;
    cursor: pointer;
    white-space: nowrap;
    padding: 8px 0;
}

.bh-recommended-btn i {
    font-size: 13px;
    color: #111;
}

/* Kotak Dropdown (Hidden by Default) */
.bh-recommended-dd {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background: #ffffff;
    min-width: 180px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    border-radius: 12px;
    padding: 8px 0;
    z-index: 2000; /* Pastikan di atas segalanya */
    border: 1px solid #eee;
}

/* Munculkan saat hover pada wrap */
.bh-recommended-wrap:hover .bh-recommended-dd {
    display: block;
}

/* Item di dalam Dropdown */
.bh-recommended-dd a {
    display: block;
    padding: 10px 20px;
    color: #444;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: background 0.2s;
}

.bh-recommended-dd a:hover {
    background: #f5f5f5;
    color: #000;
}

           /* CONTAINER KATEGORI */
.category-tabs-container {
    background: #fff;
    padding: 20px 32px;
    display: flex;
    gap: 12px;
    overflow-x: auto;
    scrollbar-width: none; /* Sembunyikan scrollbar Firefox */
    align-items: center;
    position: relative;
    z-index: 10;
    background: #fff;
}

.category-tabs-container::-webkit-scrollbar {
    display: none; /* Sembunyikan scrollbar Chrome/Safari */
}

/* KARTU KATEGORI */
.category-card {
    position: relative;
    min-width: 160px;
    height: 48px;
    border-radius: 8px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: transform 0.2s ease;
    flex-shrink: 0;
}

.category-card:hover {
    transform: scale(1.02);
}

/* Gambar Latar & Overlay */
.category-card img {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
}

.category-card .overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5); /* Overlay gelap standar */
    z-index: 2;
}

/* Khusus tab 'For You' atau 'Active' biasanya lebih terang/biru */
.category-card.active .overlay {
    background: rgba(0, 87, 255, 0.8); /* Warna biru Behance */
}

/* Teks Kategori */
.category-card span {
    position: relative;
    z-index: 3;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 8px;
}

.category-card i {
    font-size: 14px;
}

            /* PROJECTS GRID */
            .projects-section { padding: 28px 32px; }
            .projects-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
            .project-card { background: white; border-radius: 8px; overflow: hidden; transition: transform .2s, box-shadow .2s; }
            .project-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.12); }
            .project-card img { width: 100%; height: 200px; object-fit: cover; }
            .project-info { padding: 12px 14px; }
            .project-title { font-weight: 600; font-size: 14px; margin-bottom: 6px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
            .project-meta { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #888; }
            .project-meta img { width: 20px; height: 20px; border-radius: 50%; }
            .project-meta .likes { margin-left: auto; display: flex; align-items: center; gap: 4px; }

            /* FOOTER */
            .footer { background: #fff; border-top: 1px solid #e5e5e5; padding: 32px; margin-top: 40px; display: flex; justify-content: space-between; align-items: center; }
        </style>
    </head>

    <body>

    @include('partials.navbarlogin')

   <!-- CUKUP SATU FILTER BAR SAJA -->
<div class="filter-bar">
    <!-- 1. Tombol Filter -->
    <button class="btn-filter-pill">
        <i class="fas fa-sliders-h"></i> Filter
    </button>

    <!-- 2. Search Bar Capsule -->
    <div class="search-container-pill">
        <i class="fas fa-search" style="color: #777;"></i>
        <form action="{{ route('explore') }}" method="GET" style="flex:1; display:flex;">
            @if(request('type'))
                <input type="hidden" name="type" value="{{ request('type') }}">
            @endif
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search Behance..." style="width: 100%;">
        </form>
        
        <div class="inner-tabs">
            <a href="{{ route('explore', array_merge(request()->except('type'), ['type'=>'projects'])) }}"
               class="inner-tab {{ (!request('type') || request('type')==='projects') ? 'active' : '' }}">
               Projects
            </a>
            <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'people'])) }}"
               class="inner-tab {{ request('type')==='people' ? 'active' : '' }}">
               People
            </a>
            <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'assets'])) }}"
               class="inner-tab {{ request('type')==='assets' ? 'active' : '' }}">
               Assets
            </a>
        </div>

        <div class="divider-line"></div>

        <div class="btn-upload-search">
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </div>
    </div>

    <!-- 3. Sort/Recommended (Dropdown) -->
    <div class="bh-recommended-wrap">
        @php
            $sortLabels = [
                'trending'   => 'Trending',
                'newest'     => 'Terbaru',
                'popular'    => 'Paling Dilihat',
                'most_liked' => 'Paling Disukai',
            ];
            $currentSort = request('sort', 'trending');
        @endphp
        
        <button class="bh-recommended-btn">
            <i class="fas fa-bars-staggered"></i>
            {{ $sortLabels[$currentSort] ?? 'Recommended' }}
            <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 4px;"></i>
        </button>

        <div class="bh-recommended-dd">
            @foreach($sortLabels as $val => $label)
            <a href="{{ route('explore', array_merge(request()->except('sort','page'), ['sort'=>$val])) }}"
               style="{{ $currentSort === $val ? 'font-weight:800; color:#0057ff;' : '' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>
</div>

    <div class="category-tabs-container">
    {{-- Tombol Statis: For You --}}
    <a href="{{ route('explore', request()->except('category')) }}" 
       class="category-card {{ !request('category') ? 'active' : '' }}">
        <img src="https://picsum.photos/seed/foryou/200/100" alt="For You">
        <div class="overlay"></div>
        <span><i class="far fa-star"></i> For You</span>
    </a>

    {{-- Tombol Statis: Following --}}
    <a href="{{ route('explore', ['sort' => 'following']) }}" class="category-card">
        <img src="https://picsum.photos/seed/following/200/100" alt="Following">
        <div class="overlay"></div>
        <span><i class="far fa-heart"></i> Following</span>
    </a>

    {{-- Loop Kategori Dinamis --}}
    @foreach($categories as $cat)
        <a href="{{ route('explore', array_merge(request()->except('category','page'), ['category' => $cat->slug])) }}"
           class="category-card {{ request('category') === $cat->slug ? 'active' : '' }}">
            
            {{-- Pastikan model Category punya field 'thumbnail' atau gunakan placeholder --}}
            <img src="{{ $cat->thumbnail ?? 'https://picsum.photos/seed/'.$cat->slug.'/200/100' }}" 
                 alt="{{ $cat->name }}">
            
            <div class="overlay"></div>
            
            <span>
                @if($cat->icon) 
                    <i class="{{ $cat->icon }}"></i> 
                @endif
                {{ $cat->name }}
            </span>
        </a>
    @endforeach
</div>

    <section class="projects-section">
        <div class="projects-grid" id="projects-container">
            {{-- Loop pertama kali (SSR) --}}
            @foreach($feedProjects as $project)
            <a href="{{ route('projects.show', $project->slug) }}" class="project-card">
                <img src="{{ $project->cover_image }}"
                     alt="{{ $project->title }}"
                     onerror="this.src='https://picsum.photos/seed/{{ $project->id }}/400/300'">
                <div class="project-info">
                    <div class="project-title">{{ $project->title }}</div>
                    <div class="project-meta">
                        <img src="https://i.pravatar.cc/40?u={{ $project->creator_name }}" alt="{{ $project->creator_name }}">
                        <span>{{ $project->creator_name }}</span>
                        <span class="likes">
                            <i class="fas fa-heart" style="color:#ff4444;font-size:11px"></i>
                            {{ $project->likes_count }}
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div id="loading" style="text-align:center;padding:30px;display:none;">Loading...</div>
    </section>

    <footer class="footer">
        <div style="font-size: 13px; color: #888; display:flex; gap:20px;">
            <a href="#">Try Behance Pro</a>
            <a href="#">Privacy</a>
            <a href="#">Help</a>
        </div>
        <div style="font-size: 12px; color: #bbb;">© 2026 Adobe Inc. All rights reserved.</div>
    </footer>

    <script>
        let page = 2;
        let loading = false;
        let hasMore = true;

        async function loadMoreProjects() {
            if (loading || !hasMore) return;
            loading = true;
            document.getElementById('loading').style.display = 'block';

            try {
                // Fetch memanggil route yang sama
                const res = await fetch(`/dashboard?page=${page}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                const html = await res.text();

                if (html.trim() === '') {
                    hasMore = false;
                } else {
                    document.getElementById('projects-container')
                            .insertAdjacentHTML('beforeend', html);
                    page++;
                }
            } catch(err) {
                console.error(err);
            } finally {
                loading = false;
                document.getElementById('loading').style.display = 'none';
            }
        }

        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 1000) {
                loadMoreProjects();
            }
        });
    </script>

    </body>
    </html>
@endif