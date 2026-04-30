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
        body { 
            font-family: 'Inter', sans-serif; 
            -webkit-font-smoothing: antialiased; 
        }
        .no-scrollbar::-webkit-scrollbar { 
            display: none; 
        }
    </style>
</head>
<body class="antialiased tracking-tight">

    @include('partials.navbar')

    <main class="flex-grow">
        <section class="relative pt-20 pb-16 px-6 overflow-hidden">
            {{-- Dekorasi Gambar Samping (Kiri) --}}
            <div class="absolute left-4 top-10 flex flex-col gap-4 hidden xl:block">
                <div class="w-32 h-24 bg-gray-200 rounded-lg -rotate-3 mb-10 overflow-hidden">
                    <img src="https://picsum.photos/seed/1/200/150" class="w-full h-full object-cover">
                </div>
                <div class="w-44 h-44 bg-gray-100 rounded-xl rotate-3 overflow-hidden ml-10">
                    <img src="https://picsum.photos/seed/2/300/300" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="max-w-4xl mx-auto text-center relative z-10">
                <h1 class="text-[60px] md:text-[80px] font-[900] leading-[1.05] tracking-tight mb-6">
                    The World's <br>
                    <span class="text-[#0057ff]">Best Creators</span> <br>
                    Are On Behance
                </h1>
                <p class="text-gray-600 text-[18px] max-w-xl mx-auto mb-10 font-medium">
                    A comprehensive platform to help hirers and creators navigate the creative world.
                </p>
                <div class="flex justify-center gap-3">
                    <button class="bg-[#0057ff] text-white px-8 py-3 rounded-full font-bold hover:bg-blue-700 transition">Hire a Freelancer</button>
                    <button class="border border-gray-200 text-[#0057ff] px-8 py-3 rounded-full font-bold hover:bg-gray-50 transition">Try Behance Pro</button>
                </div>
            </div>

            {{-- Dekorasi Gambar Samping (Kanan) --}}
            <div class="absolute right-4 top-10 flex flex-col gap-4 hidden xl:block">
                <div class="w-48 h-60 bg-gray-200 rounded-xl rotate-2 overflow-hidden">
                    <img src="https://picsum.photos/seed/4/300/400" class="w-full h-full object-cover">
                </div>
                <div class="w-32 h-32 bg-gray-100 rounded-lg -rotate-6 ml-10 overflow-hidden">
                    <img src="https://picsum.photos/seed/5/200/200" class="w-full h-full object-cover">
                </div>
            </div>
        </section>

        <div class="sticky top-14 bg-white z-50 border-t border-b border-gray-100 px-6 py-4">
            <div class="flex items-center justify-between gap-4 mb-4">
                <div class="flex items-center gap-4">
                    <button class="flex items-center gap-2 border border-gray-200 px-4 py-2 rounded-full font-bold text-sm hover:bg-gray-50">
                        <span>≡</span> Filter
                    </button>
                    <div class="relative w-[300px] md:w-[400px]">
                        <span class="absolute left-4 top-2 text-gray-400">🔍</span>
                        <input type="text" placeholder="Search Behance..." class="w-full bg-gray-100 rounded-full py-2 pl-10 pr-4 outline-none font-bold text-sm focus:bg-white border border-transparent focus:border-gray-200">
                    </div>
                </div>
                <div class="hidden lg:flex items-center gap-6 text-[13px] font-bold text-gray-400">
                    <span class="text-black border-b-2 border-black pb-1 cursor-pointer">Projects</span>
                    <span class="hover:text-black cursor-pointer transition">People</span>
                    <span class="hover:text-black cursor-pointer transition">Assets</span>
                </div>
            </div>
            
            <div class="flex items-center gap-2 overflow-x-auto no-scrollbar">
                <button class="bg-black text-white px-4 py-2 rounded-lg text-xs font-bold whitespace-nowrap">★ For You</button>
                @foreach(['Following', 'Best of Behance', 'Graphic Design', 'Photography', 'Illustration', 'UI/UX', 'Motion'] as $tag)
                    <button class="bg-gray-100 px-4 py-2 rounded-lg text-xs font-bold whitespace-nowrap hover:bg-gray-200">{{ $tag }}</button>
                @endforeach
            </div>
        </div>

        <section class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @for ($i = 0; $i < 15; $i++)
                <div class="group cursor-pointer">
                    <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden mb-2 shadow-sm relative">
                        <img src="https://picsum.photos/seed/{{$i+20}}/800/600" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="flex justify-between items-start">
                        <div class="max-w-[70%]">
                            <h3 class="font-bold text-[14px] leading-tight truncate hover:underline">Creative Project {{ $i+1 }}</h3>
                            <p class="text-[12px] text-gray-500 font-bold hover:text-black transition">Creator Name <span class="bg-blue-600 text-white text-[8px] px-1 rounded ml-1">PRO</span></p>
                        </div>
                        <div class="flex items-center gap-2 text-[11px] font-extrabold text-gray-400">
                            <span class="flex items-center gap-1">👍 150</span>
                            <span class="flex items-center gap-1">👁️ 2.4k</span>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </section>
    </main>

</body>

 @include('partials.footer')
 
</html>