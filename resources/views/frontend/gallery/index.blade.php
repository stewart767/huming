@extends('layouts.app')

@section('content')
    <!-- Header -->
    <section class="bg-slate-950 text-white py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 industrial-grid-dark opacity-30 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/10 border border-sky-400/30 text-sky-400 text-xs font-bold tracking-widest uppercase">
                Media &amp; Portfolio
            </span>
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white mt-3">
                Manufacturing &amp; Project Media Gallery
            </h1>
            <p class="text-slate-300 text-base sm:text-lg max-w-3xl mt-4 leading-relaxed">
                Explore real photography of our automated manufacturing lines, quality testing lab, finished products, and commercial installations.
            </p>
        </div>
    </section>

    <!-- Gallery Grid with Lightbox -->
    <section class="py-14 px-4 sm:px-6 lg:px-8 bg-slate-50 min-h-screen" x-data="{ lightboxOpen: false, modalImg: '', modalTitle: '', modalDesc: '' }">
        <div class="max-w-7xl mx-auto space-y-10">
            <!-- Category Filter Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pb-2 flex-wrap">
                <a href="{{ route('gallery.index') }}" 
                   class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all {{ !request('category') ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                    All Media
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('gallery.index', ['category' => $cat->slug]) }}" 
                       class="px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all {{ request('category') == $cat->slug ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <!-- Photos Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($items as $item)
                    <div class="group bg-white rounded-3xl overflow-hidden border border-slate-200/90 shadow-xs hover:shadow-xl hover:border-sky-300 transition-all duration-300 flex flex-col justify-between cursor-pointer"
                         @click="modalImg = '{{ $item->image_url }}'; modalTitle = '{{ addslashes($item->title) }}'; modalDesc = '{{ addslashes($item->description) }}'; lightboxOpen = true">
                        <div class="aspect-4/3 w-full bg-slate-100 overflow-hidden relative">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-slate-950/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="p-3 bg-white/90 backdrop-blur-md rounded-full shadow-lg text-slate-900">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="p-5">
                            @if($item->category)
                                <span class="text-[10px] font-bold uppercase tracking-wider text-sky-600">
                                    {{ $item->category->name }}
                                </span>
                            @endif
                            <h3 class="font-bold text-slate-900 text-base mt-1 group-hover:text-sky-600 transition-colors">{{ $item->title }}</h3>
                            @if($item->description)
                                <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $item->description }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-200 p-8 text-slate-500">
                        No gallery images found in this category.
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $items->links() }}
            </div>
        </div>

        <!-- Lightbox Modal -->
        <div x-show="lightboxOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak
             @click.self="lightboxOpen = false"
             @keydown.escape.window="lightboxOpen = false"
             class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md flex items-center justify-center p-4">
            <div class="relative max-w-4xl w-full max-h-[90vh] flex flex-col items-center">
                <button @click="lightboxOpen = false" class="absolute -top-12 right-0 text-white/80 hover:text-white p-2 text-3xl font-light">
                    &times;
                </button>
                <img :src="modalImg" :alt="modalTitle" class="max-w-full max-h-[70vh] rounded-2xl shadow-2xl object-contain">
                <div class="mt-4 text-center max-w-xl">
                    <h3 class="text-lg font-bold text-white" x-text="modalTitle"></h3>
                    <p class="text-xs text-slate-400 mt-1" x-text="modalDesc"></p>
                </div>
            </div>
        </div>
    </section>
@endsection
