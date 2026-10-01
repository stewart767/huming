@extends('layouts.app')

@section('content')
    <!-- Hero Slider / Section -->
    <section class="relative bg-slate-950 text-white overflow-hidden" 
             x-data="{ 
                 currentSlide: 0, 
                 total: {{ $slides->count() > 0 ? $slides->count() : 1 }}, 
                 paused: false,
                 progress: 0,
                 timerInterval: null,
                 progressInterval: null,
                 slideDuration: 5000,
                 startAutoPlay() {
                     clearInterval(this.timerInterval);
                     clearInterval(this.progressInterval);
                     this.progress = 0;
                     
                     // Progress step every 50ms
                     this.progressInterval = setInterval(() => {
                         if (!this.paused) {
                             this.progress = Math.min(100, this.progress + (50 / this.slideDuration) * 100);
                         }
                     }, 50);

                     // Slide transition interval
                     this.timerInterval = setInterval(() => {
                         if (!this.paused) {
                             this.nextSlide();
                         }
                     }, this.slideDuration);
                 },
                 nextSlide() {
                     this.currentSlide = (this.currentSlide + 1) % this.total;
                     this.progress = 0;
                 },
                 prevSlide() {
                     this.currentSlide = (this.currentSlide - 1 + this.total) % this.total;
                     this.progress = 0;
                 },
                 goToSlide(index) {
                     this.currentSlide = index;
                     this.progress = 0;
                 }
             }" 
             x-init="startAutoPlay()"
             @mouseenter="paused = true" 
             @mouseleave="paused = false"
             class="select-none">

        <!-- Ambient Glow & Industrial Grid Background -->
        <div class="absolute inset-0 industrial-grid-dark opacity-25 pointer-events-none"></div>
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-sky-600/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Slider Main Viewport -->
        <div class="relative min-h-[600px] lg:min-h-[680px] flex items-center">
            @forelse($slides as $index => $slide)
                <div x-show="currentSlide === {{ $index }}"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 translate-x-8 scale-98"
                     x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                     x-transition:leave="transition ease-in duration-500 absolute inset-0"
                     x-transition:leave-start="opacity-100 translate-x-0 scale-100"
                     x-transition:leave-end="opacity-0 -translate-x-8 scale-98"
                     class="w-full py-16 lg:py-24 px-4 sm:px-6 lg:px-8">
                    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                        
                        <!-- Left Content Column -->
                        <div class="lg:col-span-7 space-y-6 z-10">
                            @if($slide->badge_text)
                                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/15 border border-sky-400/30 text-sky-400 text-xs font-bold tracking-widest uppercase shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-sky-400 animate-ping"></span>
                                    <span>{{ $slide->badge_text }}</span>
                                </div>
                            @endif

                            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white leading-[1.15]">
                                {{ $slide->title }}
                            </h1>

                            <p class="text-base sm:text-lg text-slate-300 max-w-2xl leading-relaxed">
                                {{ $slide->subtitle }}
                            </p>

                            <div class="pt-4 flex flex-wrap items-center gap-4">
                                <a href="{{ $slide->button_url ?: route('products.index') }}" 
                                   class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-gradient-to-r from-sky-500 via-sky-600 to-blue-700 hover:from-sky-400 hover:to-blue-600 text-white font-bold text-sm tracking-wide shadow-xl shadow-sky-600/30 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                                    <span>{{ $slide->button_text ?: 'Explore Products' }}</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </a>
                                <a href="{{ $slide->secondary_button_url ?: route('quote.create') }}" 
                                   class="inline-flex items-center gap-2 px-7 py-4 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm border border-white/20 hover:border-white/30 transition-all backdrop-blur-sm">
                                    <span>{{ $slide->secondary_button_text ?: 'Request a Quote' }}</span>
                                </a>
                            </div>

                            <!-- Trust Badges Under CTA -->
                            <div class="pt-6 border-t border-slate-800/80 flex flex-wrap items-center gap-6 text-xs text-slate-400">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-sky-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    <span>Direct Manufacturer Supply</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-sky-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    <span>Certified Quality Controls</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-sky-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    <span>Commercial &amp; Bulk Dispatch</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Image Showcase Column -->
                        <div class="lg:col-span-5">
                            <div class="relative group">
                                <!-- Glowing Border Ring -->
                                <div class="absolute -inset-1 bg-gradient-to-r from-sky-500 to-blue-600 rounded-3xl blur-md opacity-30 group-hover:opacity-60 transition duration-500"></div>
                                
                                <div class="relative rounded-2xl overflow-hidden border border-white/15 bg-slate-900 shadow-2xl">
                                    <img src="{{ $slide->image_url }}" 
                                         alt="{{ $slide->title }}" 
                                         class="w-full h-72 sm:h-96 lg:h-[420px] object-cover object-center transform group-hover:scale-105 transition-transform duration-700 ease-out">
                                    
                                    <!-- Overlay Gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>

                                    <!-- Bottom Info Tag -->
                                    <div class="absolute bottom-4 left-4 right-4 p-4 rounded-xl bg-slate-950/85 backdrop-blur-md border border-white/10 flex items-center justify-between">
                                        <div>
                                            <p class="text-[10px] font-extrabold text-sky-400 uppercase tracking-widest">Huming Manufacturing Protocol</p>
                                            <p class="text-xs sm:text-sm font-bold text-white mt-0.5">{{ $slide->title }}</p>
                                        </div>
                                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-sky-500/20 text-sky-300 border border-sky-400/30">
                                            0{{ $index + 1 }}/0{{ $slides->count() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="w-full py-20 px-4 sm:px-6 lg:px-8">
                    <div class="max-w-7xl mx-auto space-y-6">
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/10 border border-sky-400/30 text-sky-400 text-xs font-bold tracking-widest uppercase">
                            HUMING INTERNATIONAL LIMITED
                        </div>
                        <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white max-w-3xl">
                            Quality Manufacturing Solutions for Modern Construction
                        </h1>
                        <p class="text-lg text-slate-300 max-w-2xl">
                            Reliable building, finishing and plumbing products manufactured and supplied for modern construction and development.
                        </p>
                        <div class="pt-4 flex flex-wrap gap-4">
                            <a href="{{ route('products.index') }}" class="px-7 py-3.5 rounded-xl bg-sky-600 text-white font-bold text-sm">Explore Products</a>
                            <a href="{{ route('quote.create') }}" class="px-7 py-3.5 rounded-xl bg-white/10 text-white font-semibold text-sm">Request a Quote</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Slider Progress Bar & Controls -->
        @if($slides->count() > 1)
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 z-20">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-slate-800/80">
                    
                    <!-- Slide Indicators with Timer Progress -->
                    <div class="flex items-center space-x-3 w-full sm:w-auto">
                        @foreach($slides as $index => $slide)
                            <button @click="goToSlide({{ $index }})" 
                                    class="group flex flex-col items-start gap-1 py-2 focus:outline-none flex-1 sm:flex-initial"
                                    aria-label="Go to slide {{ $index + 1 }}">
                                <div class="flex items-center gap-2">
                                    <span class="text-[11px] font-mono font-bold transition-colors" 
                                          :class="currentSlide === {{ $index }} ? 'text-sky-400' : 'text-slate-500 group-hover:text-slate-300'">
                                        0{{ $index + 1 }}
                                    </span>
                                    <span class="hidden md:inline text-xs font-semibold transition-colors" 
                                          :class="currentSlide === {{ $index }} ? 'text-white' : 'text-slate-500 group-hover:text-slate-300'">
                                        {{ Str::limit($slide->title, 24) }}
                                    </span>
                                </div>
                                <div class="w-full sm:w-28 lg:w-36 h-1 rounded-full bg-slate-800 overflow-hidden">
                                    <div class="h-full bg-sky-400 transition-all duration-75"
                                         :style="currentSlide === {{ $index }} ? `width: ${progress}%` : (currentSlide > {{ $index }} ? 'width: 100%' : 'width: 0%')"></div>
                                </div>
                            </button>
                        @endforeach
                    </div>

                    <!-- Manual Controls: Prev, Pause/Play, Next -->
                    <div class="flex items-center space-x-2">
                        <button @click="prevSlide()" 
                                class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-700/80 hover:border-sky-500 flex items-center justify-center text-slate-300 hover:text-white transition-all shadow-sm"
                                aria-label="Previous Slide">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        <button @click="paused = !paused" 
                                class="h-10 px-3.5 rounded-xl bg-slate-900 border border-slate-700/80 hover:border-sky-500 flex items-center gap-1.5 text-slate-300 hover:text-white text-xs font-semibold transition-all shadow-sm"
                                :title="paused ? 'Resume auto scroll' : 'Pause auto scroll'">
                            <template x-if="!paused">
                                <div class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span class="text-[11px]">Auto</span>
                                </div>
                            </template>
                            <template x-if="paused">
                                <div class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                    <span class="text-[11px]">Paused</span>
                                </div>
                            </template>
                        </button>

                        <button @click="nextSlide()" 
                                class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-700/80 hover:border-sky-500 flex items-center justify-center text-slate-300 hover:text-white transition-all shadow-sm"
                                aria-label="Next Slide">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>

                </div>
            </div>
        @endif
    </section>

    <!-- Key Statistics / Trust Bar (Admin Editable) -->
    @if(\App\Models\Setting::get('show_statistics', '1') == '1')
        <section class="bg-slate-900 border-y border-slate-800 py-10 px-4 sm:px-6 lg:px-8 text-white">
            <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="space-y-1">
                    <p class="text-3xl sm:text-4xl font-black text-sky-400 tracking-tight">{{ \App\Models\Setting::get('stat_experience', '10+') }}</p>
                    <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-slate-400">Industry Experience</p>
                </div>
                <div class="space-y-1">
                    <p class="text-3xl sm:text-4xl font-black text-amber-400 tracking-tight">{{ \App\Models\Setting::get('stat_products', '50+') }}</p>
                    <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-slate-400">Product Specifications</p>
                </div>
                <div class="space-y-1">
                    <p class="text-3xl sm:text-4xl font-black text-sky-400 tracking-tight">{{ \App\Models\Setting::get('stat_projects', '500+') }}</p>
                    <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-slate-400">Projects Supplied</p>
                </div>
                <div class="space-y-1">
                    <p class="text-3xl sm:text-4xl font-black text-emerald-400 tracking-tight">{{ \App\Models\Setting::get('stat_capacity', '100%') }}</p>
                    <p class="text-xs sm:text-sm font-semibold uppercase tracking-wider text-slate-400">Quality Inspection Rate</p>
                </div>
            </div>
        </section>
    @endif

    <!-- Category Highlights Grid -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600">Product Portfolio</span>
                    <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight mt-1">
                        Engineered Manufacturing Lines
                    </h2>
                </div>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-sky-600 hover:text-sky-700 transition-colors">
                    <span>Browse All Product Categories</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <div class="group relative rounded-2xl overflow-hidden border border-slate-200 bg-slate-900 text-white shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between min-h-[300px]">
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-40">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/70 to-transparent"></div>

                        <div class="relative p-6 z-10">
                            <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white/10 backdrop-blur-md border border-white/15 text-sky-300">
                                Category #0{{ $loop->iteration }}
                            </span>
                        </div>

                        <div class="relative p-6 z-10 space-y-3">
                            <h3 class="text-xl font-bold text-white group-hover:text-sky-300 transition-colors">
                                {{ $category->name }}
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-300 line-clamp-2 leading-relaxed">
                                {{ $category->description }}
                            </p>
                            <div class="pt-2">
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="inline-flex items-center gap-2 text-xs font-bold text-white group-hover:text-sky-400 transition-colors">
                                    <span>Explore Range ({{ $category->published_products_count ?? 0 }})</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 industrial-grid-bg">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600">Certified Quality</span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-1">
                    Featured Industrial Products
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-3">
                    Discover our primary manufactured building, finishing, and plumbing lines engineered for high durability, weather resistance, and architectural precision.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="col-span-full py-12 text-center text-slate-500">
                        No featured products marked yet.
                    </div>
                @endforelse
            </div>

            <div class="mt-14 text-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm tracking-wide shadow-md transition-all">
                    <span>View Complete Product Catalog</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Manufacturing Process Overview Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 space-y-5">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-sky-400">Strict Quality Assurance</span>
                    <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-white leading-tight">
                        Precision Manufacturing &amp; Production Flow
                    </h2>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Every batch of PVC pipes, marble sheets, and structural sealing profiles produced by Huming International Limited is subjected to standardized dimensional, chemical, and mechanical stress evaluations.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('manufacturing') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm transition-all shadow-md">
                            <span>Learn About Our Manufacturing</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($processes as $proc)
                        <div class="p-5 rounded-2xl bg-slate-800/80 border border-slate-700/80 hover:border-sky-500/50 transition-colors">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="w-8 h-8 rounded-lg bg-sky-500/20 text-sky-400 font-mono font-bold flex items-center justify-center text-sm border border-sky-400/20">
                                    0{{ $proc->step_number }}
                                </span>
                                <h3 class="font-bold text-white text-base">{{ $proc->title }}</h3>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">{{ $proc->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>



    <!-- Quick Quote Request CTA -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-sky-900 via-slate-900 to-slate-950 text-white relative overflow-hidden">
        <div class="max-w-5xl mx-auto text-center space-y-6 relative z-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/20 border border-sky-400/30 text-sky-300 text-xs font-bold uppercase tracking-wider">
                Direct Manufacturer Quotes
            </span>
            <h2 class="text-3xl sm:text-5xl font-black tracking-tight text-white">
                Ready to Order or Inquire About Custom Specifications?
            </h2>
            <p class="text-sky-100 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Submit your quotation request online with required dimensions, quantities, and attachments. Our team reviews and responds with comprehensive pricing and lead times.
            </p>
            <div class="pt-4 flex flex-wrap justify-center gap-4">
                <a href="{{ route('quote.create') }}" class="px-8 py-4 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 font-bold text-base shadow-xl shadow-sky-500/25 transition-all transform hover:-translate-y-0.5">
                    Start a Quotation Request
                </a>
                <a href="{{ route('contact.index') }}" class="px-8 py-4 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-base border border-white/20 transition-all">
                    Contact Us Direct
                </a>
            </div>
        </div>
    </section>
@endsection
