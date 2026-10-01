@extends('layouts.app')

@section('content')
    <!-- Page Header Header Banner -->
    <section class="bg-slate-950 text-white py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 industrial-grid-dark opacity-30 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/10 border border-sky-400/30 text-sky-400 text-xs font-bold tracking-widest uppercase">
                Corporate Profile
            </span>
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white mt-3">
                About HUMING INTERNATIONAL LIMITED
            </h1>
            <p class="text-slate-300 text-base sm:text-lg max-w-3xl mt-4 leading-relaxed">
                A dedicated manufacturing and supply company delivering high-standard construction, interior finishing, and plumbing materials for modern building infrastructure.
            </p>
        </div>
    </section>

    <!-- Company Overview -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600">Company Overview</span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    Manufacturing Quality. Building the Future.
                </h2>
                <div class="prose prose-slate max-w-none text-slate-600 text-sm sm:text-base leading-relaxed space-y-4">
                    <p>
                        {{ \App\Models\Setting::get('company_overview', 'Huming International Limited is an industrial manufacturing and supply company dedicated to engineering and distributing superior building, finishing, and plumbing materials. With modern production facilities and rigorous quality control protocols, we supply contractors, developers, architects, and commercial distributors with dependable products engineered to meet international building standards.') }}
                    </p>
                    <p>
                        Our primary product portfolio spans high-gloss UV marble sheets for architectural walls, acoustic and decorative fluted wall panels, industrial watertight PVC sealing profiles, heavy-duty hydraulic flash evacuation tanks, and certified pressure &amp; drainage PVC piping systems.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-4">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                        <p class="text-2xl font-black text-sky-600">100%</p>
                        <p class="text-xs font-bold text-slate-700 uppercase tracking-wider mt-1">Batch Verified</p>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                        <p class="text-2xl font-black text-sky-600">Custom</p>
                        <p class="text-xs font-bold text-slate-700 uppercase tracking-wider mt-1">Specifications Available</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="rounded-3xl overflow-hidden shadow-2xl border border-slate-200 bg-slate-100 p-2">
                    <img src="{{ asset('images/hero/hero-factory.jpg') }}" alt="Huming Manufacturing" class="w-full h-auto rounded-2xl object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Vision Card -->
            <div class="p-8 sm:p-10 rounded-3xl bg-slate-800/90 border border-slate-700 space-y-4 relative overflow-hidden">
                <div class="w-12 h-12 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-white tracking-tight">Our Vision</h3>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    {{ \App\Models\Setting::get('company_vision', 'To be the most trusted manufacturing and building solutions partner across Africa and global markets, recognized for precision engineering, sustainable manufacturing, and unmatched product durability.') }}
                </p>
            </div>

            <!-- Mission Card -->
            <div class="p-8 sm:p-10 rounded-3xl bg-slate-800/90 border border-slate-700 space-y-4 relative overflow-hidden">
                <div class="w-12 h-12 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-white tracking-tight">Our Mission</h3>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    {{ \App\Models\Setting::get('company_mission', 'To manufacture and supply world-class construction, finishing, and plumbing solutions that enhance structural integrity, aesthetic elegance, and long-term value for our clients and communities.') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600">Guiding Principles</span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-1">
                    Our Core Values
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-3">
                    These foundational values govern our manufacturing operations, client partnerships, and technical support.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($values as $val)
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-xs hover:border-sky-300 hover:shadow-md transition-all">
                        <div class="w-10 h-10 rounded-lg bg-sky-50 text-sky-600 font-bold flex items-center justify-center mb-4 border border-sky-100">
                            <span class="text-sm font-mono">0{{ $loop->iteration }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">{{ $val->title }}</h3>
                        <p class="text-sm text-slate-600 mt-2 leading-relaxed">{{ $val->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


@endsection
