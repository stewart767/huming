@extends('layouts.app')

@section('content')
    <!-- Page Header Header -->
    <section class="bg-slate-950 text-white py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 industrial-grid-dark opacity-30 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/10 border border-sky-400/30 text-sky-400 text-xs font-bold tracking-widest uppercase">
                Industrial Infrastructure
            </span>
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white mt-3">
                Manufacturing Capabilities &amp; Production Flow
            </h1>
            <p class="text-slate-300 text-base sm:text-lg max-w-3xl mt-4 leading-relaxed">
                Huming International Limited operates high-precision automated extrusion, UV curing, and composite panel fabrication lines engineered for high-volume supply and strict dimensional tolerance.
            </p>
        </div>
    </section>

    <!-- Manufacturing Overview -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600">Operations &amp; Equipment</span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    Engineered for Precision, Volume &amp; Durability
                </h2>
                <div class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-4">
                    <p>
                        {{ \App\Models\Setting::get('manufacturing_overview', 'Our manufacturing operations integrate advanced processing lines, high-grade polymer and composite formulations, and stringent quality assurance frameworks to guarantee peak performance in every product delivered.') }}
                    </p>
                    <p>
                        From computerized raw material batching to automated high-speed pipe extrusion and continuous UV topcoat curing, our manufacturing plant delivers dependable consistency for commercial developers, contractors, and regional distributors.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                        <p class="text-xs font-bold text-sky-600 uppercase">Automation</p>
                        <p class="text-sm font-bold text-slate-900 mt-1">High-Precision In-Line Calibration</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                        <p class="text-xs font-bold text-sky-600 uppercase">Raw Materials</p>
                        <p class="text-sm font-bold text-slate-900 mt-1">Virgin Polymers &amp; Stone Composites</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                        <p class="text-xs font-bold text-sky-600 uppercase">Standards</p>
                        <p class="text-sm font-bold text-slate-900 mt-1">Full Batch Quality Control</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="rounded-3xl overflow-hidden shadow-2xl border border-slate-200 bg-slate-100 p-2">
                    <img src="{{ asset('images/hero/hero-factory.jpg') }}" alt="Factory Floor" class="w-full h-80 object-cover rounded-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- 7-Step Production Process -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-extrabold uppercase tracking-widest text-sky-400">Step-by-Step Flow</span>
                <h2 class="text-3xl sm:text-4xl font-black tracking-tight text-white mt-1">
                    Our Production &amp; Supply Process
                </h2>
                <p class="text-slate-400 text-sm sm:text-base mt-3">
                    A rigorous manufacturing sequence engineered to eliminate defects, maintain exact dimensions, and ensure reliable on-time delivery.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($processes as $proc)
                    <div class="p-6 rounded-3xl bg-slate-800/90 border border-slate-700/80 hover:border-sky-500 transition-all duration-300 relative group flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="w-10 h-10 rounded-xl bg-sky-500/20 text-sky-400 font-mono font-bold flex items-center justify-center text-base border border-sky-400/30">
                                    0{{ $proc->step_number }}
                                </span>
                                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Phase {{ $proc->step_number }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-white group-hover:text-sky-300 transition-colors">
                                {{ $proc->title }}
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-300 mt-2 leading-relaxed">
                                {{ $proc->description }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Quality Control Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="p-8 sm:p-12 rounded-3xl bg-gradient-to-br from-slate-900 to-slate-950 text-white border border-slate-800 shadow-xl">
                <div class="max-w-3xl space-y-4">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-sky-400">Quality Assurance Protocols</span>
                    <h2 class="text-2xl sm:text-4xl font-black tracking-tight text-white">
                        Standardized Quality Inspection
                    </h2>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        {{ \App\Models\Setting::get('quality_control_text', 'Every production batch undergoes comprehensive physical testing, dimensional calibration, load and pressure validation, and aesthetic inspection before packaging and dispatch.') }}
                    </p>
                    
                    <div class="pt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="p-4 rounded-xl bg-white/5 border border-white/10">
                            <h4 class="text-sm font-bold text-sky-400">Hydrostatic Pressure Testing</h4>
                            <p class="text-xs text-slate-400 mt-1">Verified burst pressure ratings for all PVC pipe classes.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-white/5 border border-white/10">
                            <h4 class="text-sm font-bold text-sky-400">UV Topcoat Durability</h4>
                            <p class="text-xs text-slate-400 mt-1">Scratch resistance and gloss retention checks on marble sheets.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-white/5 border border-white/10">
                            <h4 class="text-sm font-bold text-sky-400">Joint Sealing Imperviousness</h4>
                            <p class="text-xs text-slate-400 mt-1">100% moisture barrier testing on elastomeric PVC profiles.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Factory Showcase Gallery -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600">Visual Tour</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">
                        Factory &amp; Operations Media
                    </h2>
                </div>
                <a href="{{ route('gallery.index') }}" class="text-sm font-bold text-sky-600 hover:text-sky-700 transition-colors">
                    View Full Gallery &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($gallery as $item)
                    <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-xs group">
                        <div class="aspect-16/10 overflow-hidden bg-slate-100">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-slate-900 text-sm">{{ $item->title }}</h3>
                            <p class="text-xs text-slate-500 mt-1 line-clamp-1">{{ $item->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
