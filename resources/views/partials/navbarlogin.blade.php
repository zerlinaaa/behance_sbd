<header class="flex items-center justify-between h-16 px-5 bg-white border-b border-gray-200 sticky top-0 z-[1001] font-['Inter'] tracking-normal">
    <div class="flex items-center space-x-7">
        <div class="text-[22px] font-black tracking-tighter cursor-pointer" style="min-width: 89px;">Bēhance</div>
        <nav class="hidden md:flex items-center space-x-6 text-[15px] font-bold">
            <a href="{{ route('explore') }}" class="hover:text-gray-500 transition">Explore</a>
            <a href="{{ route('jobs') }}" class="hover:text-gray-500 transition">Jobs</a>
            <a href="{{ route('client-work') }}" class="hover:text-gray-500 transition">Client Work</a>

            <div class="group relative py-5 cursor-pointer">
                <span class="flex items-center hover:text-gray-500">Resources 
                    <svg class="w-3.5 h-3.5 ml-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                </span>
                <div class="absolute hidden group-hover:block top-[40px] left-0 w-64 bg-white shadow-2xl rounded-xl py-2 border border-gray-100">
                    <a href="{{ route('resources.overview') }}" class="block px-5 py-2.5 hover:bg-gray-50 text-[14px] font-bold">Overview</a>
                    <a href="{{ route('resources.guides') }}" class="block px-5 py-2.5 hover:bg-gray-50 text-[14px] font-bold">Career Guides</a>
                    <a href="{{ route('resources.commissioned') }}" class="block px-5 py-2.5 hover:bg-gray-50 text-[14px] font-bold">Commissioned Projects</a>
                    <a href="{{ route('resources.creative') }}" class="block px-5 py-2.5 hover:bg-gray-50 text-[14px] font-bold">Creative Apprenticeship</a>
                </div>
            </div>

            <div class="h-5 w-[1px] bg-gray-200"></div>
            
           <div class="group relative py-5 cursor-pointer">
                <span class="flex items-center hover:text-gray-500">Hire 
                    <svg class="w-3.5 h-3.5 ml-1.5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                </span>
   <div class="absolute hidden group-hover:block top-[40px] left-0 w-64 bg-white shadow-2xl rounded-xl py-2 border border-gray-100">
                    <a href="{{ route('hire.my-jobs') }}" class="block px-5 py-2.5 hover:bg-gray-50 text-[14px] font-bold">My Job</a>
                    <a href="{{ route('hire.freelance') }}" class="block px-5 py-2.5 hover:bg-gray-50 text-[14px] font-bold">Freelancers</a>
                    <a href="{{ route('hire.hiring') }}" class="block px-5 py-2.5 hover:bg-gray-50 text-[14px] font-bold">Hiring on Behance</a>
                    <a href="{{ route('register') }}" class="block px-5 py-2.5 hover:bg-gray-50 text-[14px] font-bold">Create New Job</a>
        
        <div class="my-1.5 border-t border-gray-50"></div>
    
        <a href="{{ route('explore') }}?category=branding" class="block px-4 py-1 hover:bg-gray-50 text-gray-400 hover:text-black font-semibold text-[12px] transition-colors">Brand Designers</a>
        <a href="{{ route('explore') }}?category=web-design" class="block px-4 py-1 hover:bg-gray-50 text-gray-400 hover:text-black font-semibold text-[12px] transition-colors">Website Designers</a>
        <a href="{{ route('explore') }}?category=illustrators" class="block px-4 py-1 hover:bg-gray-50 text-gray-400 hover:text-black font-semibold text-[12px] transition-colors">Illustrators</a>

    </div>
</div>
        </nav>
    </div>
    <!-- RIGHT SECTION -->
    <div class="flex items-center space-x-3">
        
        @auth
    <a href="{{ route('projects.create') }}" class="border border-gray-200 px-4 py-2 rounded-full text-[14px] font-bold hover:text-gray-500 transition">+ Project</a>
    <a href="{{ route('dashboard') }}" class="border border-gray-200 px-4 py-2 rounded-full text-[14px] font-bold hover:text-gray-500 transition">{{ auth()->user()->name }}</a>
    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="border border-gray-200 px-4 py-2 rounded-full text-[14px] font-bold hover:text-gray-500 transition">Logout</button>
    </form>
@else
    <a href="{{ route('login') }}" class="border border-gray-200 px-4 py-2 rounded-full text-[14px] font-bold hover:text-gray-500 transition">Sign In</a>
    <a href="{{ route('register') }}" class="bg-[#0057ff] text-white px-5 py-2 rounded-full text-[14px] font-bold hover:bg-blue-700 transition">Start Free Trial</a>
@endauth

        <!-- Adobe Logo -->
        <div class="flex items-center space-x-1.5 ml-4 cursor-pointer">
            <svg width="18" height="18" viewBox="0 0 20 20" fill="black">
                <path d="M12.7 3H19V17L12.7 3Z"/>
                <path d="M7.3 3H1V17L7.3 3Z"/>
                <path d="M10 8.5L14.2 17H11.5L10.7 15.1H9.3L8.5 17H5.8L10 8.5Z"/>
            </svg>
            <span class="font-black text-[14px] tracking-tighter">Adobe</span>
        </div>
    </div>
</header>

