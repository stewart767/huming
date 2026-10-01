@extends('layouts.app')

@section('content')
    <!-- Page Header Header -->
    <section class="bg-slate-950 text-white py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 industrial-grid-dark opacity-30 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/10 border border-sky-400/30 text-sky-400 text-xs font-bold tracking-widest uppercase">
                Industry Sectors
            </span>
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white mt-3">
                Building &amp; Architectural Applications
            </h1>
            <p class="text-slate-300 text-base sm:text-lg max-w-3xl mt-4 leading-relaxed">
                Discover where Huming International products deliver proven durability, aesthetic elegance, and reliable plumbing infrastructure.
            </p>
        </div>
    </section>

    <!-- Applications Grid -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-slate-50">
        <div class="max-w-7xl mx-auto space-y-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($applications as $app)
                    <div class="bg-white rounded-3xl border border-slate-200/90 overflow-hidden shadow-xs hover:shadow-xl hover:border-sky-300 transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="aspect-16/10 w-full bg-slate-100 overflow-hidden relative">
                                <img src="{{ $app->image_url }}" alt="{{ $app->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-3 left-3">
                                    <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-slate-900/80 backdrop-blur-md text-white border border-white/10">
                                        Sector
                                    </span>
                                </div>
                            </div>
                            <div class="p-6 space-y-3">
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-sky-600 transition-colors">
                                    <a href="{{ route('applications.show', $app->slug) }}">
                                        {{ $app->title }}
                                    </a>
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    {{ $app->description }}
                                </p>
                            </div>
                        </div>

                        <div class="p-6 pt-0 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('applications.show', $app->slug) }}" class="text-xs font-bold text-sky-600 hover:text-sky-700 flex items-center gap-1">
                                <span>Explore Related Products</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
