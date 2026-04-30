<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources to grow your creative career | Behance</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --color-primary: #1473e6;
            --color-primary-hover: #0d66d0;
            --color-accent: #eb1000;
            --color-text: #2c2c2c;
            --color-muted: #6e6e6e;
            --color-border: #e1e1e1;
            --color-bg: #ffffff;
            --color-card-bg: #f5f5f5;
            --color-orange: #e68619;
            --font-main: 'Inter', sans-serif;
            --radius: 6px;
            --max-width: 1200px;
        }

        body {
            font-family: var(--font-main);
            -webkit-font-smoothing: antialiased;
            color: var(--color-text);
            background: var(--color-bg);
            font-size: 16px;
            line-height: 1.5;
        }

        a { text-decoration: none; color: inherit; }

        .btn-trial {
            background: var(--color-primary);
            color: #fff;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: background .15s;
        }
        .btn-trial:hover { background: var(--color-primary-hover); }
        .btn-signin {
            font-size: 14px;
            font-weight: 700;
            color: var(--color-primary);
            cursor: pointer;
        }
        .adobe-logo {
            font-size: 18px;
            font-weight: 900;
            color: var(--color-text);
            letter-spacing: -0.5px;
        }
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="antialiased tracking-tight">

    @include('partials.navbar')

    <section class="relative h-[280px] flex items-center justify-center text-white overflow-hidden bg-zinc-900">
        <img src="https://picsum.photos/seed/creative-jobs/1200/400" class="absolute inset-0 w-full h-full object-cover opacity-60">
        <div class="relative z-10 text-center">
            <h1 class="text-[52px] font-[900] leading-tight mb-2">Creative Jobs</h1>
            <p class="text-[20px] font-bold opacity-90">Browse and discover your next opportunity</p>
        </div>
        <div class="absolute bottom-4 right-6 flex items-center gap-2 text-[10px] font-bold opacity-70">
            <span class="bg-white/20 p-1 rounded">📷</span> Image by Vicente García Morillo
        </div>
    </section>

    <main class="flex min-h-screen bg-[#f9f9f9]">
        
        <aside class="w-[280px] bg-white border-r border-gray-100 p-6 sticky top-14 h-[calc(100vh-56px)] overflow-y-auto no-scrollbar hidden md:block">
            <button class="w-full bg-[#0057ff] text-white py-3 rounded-full font-bold text-sm mb-8 flex items-center justify-center gap-2">
                <span class="text-lg">+</span> New Job
            </button>

            <div class="mb-8">
                <h4 class="font-bold text-[13px] flex items-center justify-between mb-4">
                    Categories <span class="text-lg">⌄</span>
                </h4>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 text-sm font-bold">
                        <input type="radio" name="cat" checked class="w-4 h-4 accent-blue-600"> All
                    </label>
                    <p class="text-[10px] font-black text-gray-400 tracking-wider uppercase mt-4 mb-2">Popular</p>
                    @foreach(['Logo Design', 'Branding Services', 'Social Media Design', 'Website Design', 'Illustrations', 'Packaging Design', 'Landing Page Design', 'UI/UX Design'] as $cat)
                        <label class="flex items-center gap-3 text-sm font-medium text-gray-600 hover:text-black cursor-pointer">
                            <input type="radio" name="cat" class="w-4 h-4 accent-blue-600"> {{ $cat }}
                        </label>
                    @endforeach
                    <p class="text-blue-600 text-sm font-bold mt-4 cursor-pointer hover:underline">View All Categories</p>
                </div>
            </div>

            <div class="border-t pt-6">
                <h4 class="font-bold text-[13px] flex items-center justify-between mb-4">
                    Location <span class="text-lg">⌄</span>
                </h4>
            </div>
        </aside>

        <div class="flex-1 p-8">
            
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-[15px] font-[900]">Your Recommended Freelance Jobs</h2>
                <div class="flex gap-2">
                    <button class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center">‹</button>
                    <button class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center">›</button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-12">
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm relative">
                    <span class="bg-blue-600 text-white text-[10px] font-black px-2 py-0.5 rounded absolute top-6 left-6">PRO</span>
                    <h3 class="mt-8 font-black text-[18px] mb-4 leading-tight">Get Behance Pro to Unlock</h3>
                    <ul class="space-y-3 mb-6">
                        <li class="flex items-center gap-2 text-sm font-medium">✅ Access to exclusive opportunities</li>
                        <li class="flex items-center gap-2 text-sm font-medium">✅ Insights on who's seen your work</li>
                    </ul>
                    <button class="bg-[#0057ff] text-white px-6 py-2 rounded-full font-bold text-sm">Get Pro</button>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-[11px] font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded">Website Design</span>
                        <span class="text-[11px] font-bold text-orange-400">Ends in 11 days</span>
                    </div>
                    <h3 class="font-black text-[17px] mb-1">Website Redesign Service for Existing Website</h3>
                    <p class="text-blue-600 font-bold text-sm mb-4">US$1,000-2,500</p>
                    <button class="w-full border-2 border-blue-500 text-blue-600 py-2 rounded-full font-bold text-sm mt-4">Unlock with Behance Pro</button>
                </div>
            </div>

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-[15px] font-[900]">Full-Time or Contract Jobs <span class="text-gray-400 font-bold ml-1">(909)</span></h2>
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
                    <input type="text" placeholder="Search Jobs..." class="bg-gray-100 rounded-full py-2 pl-9 pr-4 text-sm font-bold w-[250px] outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                @php
                    $jobs = [
                        ['The Artemist', 'Kolkata, India', 'Sales Executive - Art & Design', '2 hours ago', 'bg-red-900', 'A'],
                        ['Highminded Agency', 'Anywhere', 'Senior Graphic Designer', '16 hours ago', 'bg-cyan-500', 'H'],
                        ['Tractian', 'São Paulo, Brazil', 'Videomaker', '17 hours ago', 'bg-blue-600', 'AI'],
                        ['Acroterion Labs', 'New Delhi, India', 'Interior Architect', 'a day ago', 'bg-slate-800', 'AL'],
                        ['Seven Marine Phuket', 'Phuket, Thailand', 'Graphic Designer', '3 days ago', 'bg-blue-900', 'S'],
                        ['EKO Agency', 'Cairo, Egypt', 'Motion graphic designer', '3 days ago', 'bg-black', 'EKO']
                    ];
                @endphp

                @foreach($jobs as $j)
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 {{$j[4]}} rounded-full flex items-center justify-center text-white font-black text-xs">{{$j[5]}}</div>
                        <div>
                            <h4 class="font-bold text-[14px] leading-tight">{{$j[0]}}</h4>
                            <p class="text-[11px] text-gray-400 font-bold flex items-center gap-1">📍 {{$j[1]}}</p>
                        </div>
                    </div>
                    <h3 class="font-[900] text-[16px] mb-2 leading-tight h-10">{{$j[2]}}</h3>
                    <p class="text-[11px] text-gray-500 font-bold mt-4">{{$j[3]}}</p>
                </div>
                @endforeach
            </div>
            
            <div class="flex justify-center mt-12 mb-20">
                <button class="border-2 border-gray-200 px-8 py-2.5 rounded-full font-bold text-sm hover:bg-gray-50">View more jobs</button>
            </div>
        </div>
    </main>

    @include('partials.footer')

</body>
</html>