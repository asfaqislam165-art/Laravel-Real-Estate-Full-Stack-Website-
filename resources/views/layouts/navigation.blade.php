<nav x-data="{ open: false }" class="bg-[#173F35] text-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <!-- Logo & Main Desktop Links -->
            <div class="flex items-center space-x-8">
                <a href="{{ Auth::check() && Auth::user()->usertype == 'admin' ? route('admin.dashboard') : route('home') }}" class="text-2xl font-serif font-bold text-[#C5A46D] tracking-wider">
                    LUXE<span class="text-white">ESTATE</span>
                </a>
                
                <!-- Desktop Navigation (Hidden on Mobile) -->
                <div class="hidden md:flex items-center space-x-6">
                    @if (Auth::check() && Auth::user()->usertype == 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white hover:text-[#C5A46D]">Dashboard</x-nav-link>
                        <x-nav-link :href="route('admin.properties.index')" :active="request()->routeIs('admin.properties*')" class="text-white hover:text-[#C5A46D]">Properties</x-nav-link>
                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories*')" class="text-white hover:text-[#C5A46D]">Categories</x-nav-link>
                        <x-nav-link :href="route('admin.inquiries.index')" :active="request()->routeIs('admin.inquiries*')" class="text-white hover:text-[#C5A46D]">Inquiries</x-nav-link>
                        <x-nav-link :href="route('admin.reviews.index')" :active="request()->routeIs('admin.reviews*')" class="text-white hover:text-[#C5A46D]">Reviews</x-nav-link>
                        <x-nav-link :href="route('admin.settings.edit')" :active="request()->routeIs('admin.settings*')" class="text-white hover:text-[#C5A46D]">Settings</x-nav-link>
                    @else
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:text-[#C5A46D]">Home</x-nav-link>
                        <x-nav-link :href="route('properties')" :active="request()->routeIs('properties')" class="text-white hover:text-[#C5A46D]">Portfolio</x-nav-link>
                        <x-nav-link :href="route('services')" :active="request()->routeIs('services')" class="text-white hover:text-[#C5A46D]">Services</x-nav-link>
                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-white hover:text-[#C5A46D]">About Us</x-nav-link>
                        <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="text-white hover:text-[#C5A46D]">Contact</x-nav-link>
                        
                        @auth
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-[#C5A46D]">My Dashboard</x-nav-link>
                        @endauth
                    @endif
                </div>
            </div>

            <!-- Right Side Desktop Auth & CTA -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('contact') }}" class="bg-[#C5A46D] text-[#173F35] text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-sm hover:bg-[#b3925c] transition">
                    Inquire Now
                </a>

                @auth
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-white hover:text-[#C5A46D] flex items-center gap-1">
                            👤 {{ Auth::user()->name }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-white hover:text-[#C5A46D] font-semibold transition">Log Out</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-white hover:text-[#C5A46D]">Sign In</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold text-[#173F35] bg-[#C5A46D] px-5 py-2.5 rounded-sm hover:bg-[#b3925c] transition">Register</a>
                @endauth
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="-mr-2 flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-[#C5A46D] hover:bg-[#102b24] focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Dropdown Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-[#102b24] border-t border-[#C5A46D]/20 px-4 pt-2 pb-6 space-y-2">
        @if (Auth::check() && Auth::user()->usertype == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">Dashboard</a>
            <a href="{{ route('admin.properties.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">Properties</a>
            <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">Categories</a>
            <a href="{{ route('admin.inquiries.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">Inquiries</a>
            <a href="{{ route('admin.reviews.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">Reviews</a>
            <a href="{{ route('admin.settings.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">Settings</a>
        @else
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">Home</a>
            <a href="{{ route('properties') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">Portfolio</a>
            <a href="{{ route('services') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">Services</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">About Us</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">Contact</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:text-[#C5A46D] hover:bg-[#173F35]">My Dashboard</a>
            @endauth
        @endif

        <div class="pt-4 border-t border-gray-700 space-y-3">
            <a href="{{ route('contact') }}" class="block w-full text-center bg-[#C5A46D] text-[#173F35] font-bold text-xs uppercase py-2.5 rounded-sm">
                Inquire Now
            </a>

            @auth
                <div class="px-3 py-1 flex items-center justify-between text-sm">
                    <a href="{{ route('profile.edit') }}" class="text-white hover:text-[#C5A46D] font-medium">
                        👤 {{ Auth::user()->name }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-red-300 hover:text-red-100 font-bold uppercase">Log Out</button>
                    </form>
                </div>
            @else
                <div class="grid grid-cols-2 gap-3 pt-2">
                    <a href="{{ route('login') }}" class="text-center py-2 text-sm font-semibold text-white border border-white/20 rounded-sm hover:border-[#C5A46D]">Sign In</a>
                    <a href="{{ route('register') }}" class="text-center py-2 text-sm font-semibold text-[#173F35] bg-[#C5A46D] rounded-sm">Register</a>
                </div>
            @endauth
        </div>
    </div>
</nav>