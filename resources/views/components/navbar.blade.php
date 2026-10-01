@php
    $categories = \App\Models\Category::active()->get();
    $companyName = \App\Models\Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED');
    $logo = \App\Models\Setting::get('logo');
@endphp

<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 transition-all shadow-xs" x-data="{ mobileOpen: false, productsOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    @if($logo && file_exists(public_path('storage/' . $logo)))
                        <img src="{{ asset('storage/' . $logo) }}" alt="{{ $companyName }}" class="h-12 w-auto object-contain">
                    @else
                        <img src="{{ asset('images/branding/logo.svg') }}" alt="{{ $companyName }}" class="h-12 w-auto object-contain">
                    @endif
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center space-x-1 xl:space-x-2">
                <a href="{{ route('home') }}" 
                   class="px-3.5 py-2 text-sm font-semibold tracking-wide transition-colors rounded-lg {{ request()->routeIs('home') ? 'text-sky-600 bg-sky-50' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                    HOME
                </a>

                <a href="{{ route('about') }}" 
                   class="px-3.5 py-2 text-sm font-semibold tracking-wide transition-colors rounded-lg {{ request()->routeIs('about') ? 'text-sky-600 bg-sky-50' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                    ABOUT US
                </a>

                <!-- Products Dropdown -->
                <div class="relative" @mouseenter="productsOpen = true" @mouseleave="productsOpen = false">
                    <a href="{{ route('products.index') }}" 
                       class="px-3.5 py-2 text-sm font-semibold tracking-wide transition-colors rounded-lg inline-flex items-center gap-1.5 {{ request()->routeIs('products.*') ? 'text-sky-600 bg-sky-50' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                        <span>PRODUCTS</span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="{'rotate-180 text-sky-600': productsOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>

                    <!-- Mega Dropdown -->
                    <div x-show="productsOpen" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         x-cloak
                         class="absolute left-0 mt-1 w-72 rounded-2xl bg-white shadow-2xl ring-1 ring-black/5 p-2 z-50 border border-slate-100 divide-y divide-slate-100">
                        <div class="py-1">
                            <a href="{{ route('products.index') }}" class="block px-3 py-2 text-xs font-bold text-sky-600 uppercase tracking-wider hover:bg-sky-50 rounded-lg">
                                View Full Catalog &rarr;
                            </a>
                        </div>
                        <div class="py-1">
                            @foreach($categories as $cat)
                                <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="group flex items-center justify-between px-3 py-2.5 text-sm text-slate-700 hover:text-sky-600 hover:bg-slate-50 rounded-xl transition-colors">
                                    <span class="font-medium">{{ $cat->name }}</span>
                                    <span class="text-xs text-slate-400 group-hover:text-sky-500 font-mono font-medium">{{ $cat->published_products_count ?? $cat->products()->published()->count() }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="{{ route('manufacturing') }}" 
                   class="px-3.5 py-2 text-sm font-semibold tracking-wide transition-colors rounded-lg {{ request()->routeIs('manufacturing') ? 'text-sky-600 bg-sky-50' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                    MANUFACTURING
                </a>

                <a href="{{ route('applications.index') }}" 
                   class="px-3.5 py-2 text-sm font-semibold tracking-wide transition-colors rounded-lg {{ request()->routeIs('applications.*') ? 'text-sky-600 bg-sky-50' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                    APPLICATIONS
                </a>

                <a href="{{ route('gallery.index') }}" 
                   class="px-3.5 py-2 text-sm font-semibold tracking-wide transition-colors rounded-lg {{ request()->routeIs('gallery.*') ? 'text-sky-600 bg-sky-50' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                    GALLERY
                </a>

                <a href="{{ route('contact.index') }}" 
                   class="px-3.5 py-2 text-sm font-semibold tracking-wide transition-colors rounded-lg {{ request()->routeIs('contact.*') ? 'text-sky-600 bg-sky-50' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                    CONTACT
                </a>
            </nav>

            <!-- Prominent Action Button -->
            <div class="hidden lg:flex items-center space-x-3">
                <a href="{{ route('quote.create') }}" 
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-sky-600 to-blue-700 text-white text-sm font-bold tracking-wide shadow-md shadow-sky-600/25 hover:from-sky-500 hover:to-blue-600 hover:shadow-lg hover:shadow-sky-600/35 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>REQUEST A QUOTE</span>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="flex lg:hidden items-center gap-2">
                <a href="{{ route('quote.create') }}" class="px-3 py-1.5 text-xs font-bold bg-sky-600 text-white rounded-lg shadow-sm">
                    Quote
                </a>
                <button @click="mobileOpen = !mobileOpen" type="button" class="p-2.5 rounded-xl text-slate-700 hover:text-sky-600 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-500" aria-label="Toggle Navigation">
                    <svg class="w-6 h-6" x-show="!mobileOpen" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="w-6 h-6" x-show="mobileOpen" x-cloak fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <div x-show="mobileOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         x-cloak
         class="lg:hidden border-t border-slate-200 bg-white shadow-xl px-4 pt-3 pb-6 space-y-2">
        <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('home') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
            HOME
        </a>
        <a href="{{ route('about') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('about') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
            ABOUT US
        </a>
        
        <div x-data="{ subOpen: false }" class="space-y-1">
            <button @click="subOpen = !subOpen" class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('products.*') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
                <span>PRODUCTS</span>
                <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': subOpen}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="subOpen" x-cloak class="pl-6 space-y-1 py-1">
                <a href="{{ route('products.index') }}" class="block px-3 py-2 text-sm font-semibold text-sky-600 hover:bg-sky-50 rounded-lg">
                    &rarr; All Products Catalog
                </a>
                @foreach($categories as $c)
                    <a href="{{ route('products.index', ['category' => $c->slug]) }}" class="block px-3 py-2 text-sm text-slate-600 hover:text-sky-600 hover:bg-slate-50 rounded-lg">
                        {{ $c->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <a href="{{ route('manufacturing') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('manufacturing') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
            MANUFACTURING
        </a>
        <a href="{{ route('applications.index') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('applications.*') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
            APPLICATIONS
        </a>
        <a href="{{ route('gallery.index') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('gallery.*') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
            GALLERY
        </a>
        <a href="{{ route('contact.index') }}" class="block px-4 py-2.5 rounded-xl text-base font-semibold {{ request()->routeIs('contact.*') ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-50' }}">
            CONTACT
        </a>

        <div class="pt-4 border-t border-slate-100">
            <a href="{{ route('quote.create') }}" class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-sky-600 text-white font-bold text-center shadow-md">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>REQUEST A QUOTE</span>
            </a>
        </div>
    </div>
</header>
