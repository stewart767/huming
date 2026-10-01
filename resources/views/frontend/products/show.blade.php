@extends('layouts.app')

@section('content')
    <!-- Breadcrumb & Top Bar -->
    <div class="bg-slate-100 border-b border-slate-200 py-3.5 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex items-center justify-between text-xs text-slate-500">
            <nav class="flex items-center space-x-2 truncate">
                <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
                <span>/</span>
                <a href="{{ route('products.index') }}" class="hover:text-sky-600">Products</a>
                <span>/</span>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-sky-600 truncate">
                    {{ $product->category->name }}
                </a>
                <span>/</span>
                <span class="text-slate-800 font-semibold truncate">{{ $product->name }}</span>
            </nav>
            <a href="{{ route('products.index') }}" class="text-sky-600 hover:underline font-semibold flex-shrink-0 ml-4 hidden sm:inline">
                &larr; Back to Catalog
            </a>
        </div>
    </div>

    <!-- Product Main Details Section -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 bg-white" x-data="{ activeImage: '{{ $product->image_url }}', lightboxOpen: false }">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Column: Image Gallery & Lightbox -->
            <div class="lg:col-span-6 space-y-4">
                <!-- Main Preview Image -->
                <div class="relative aspect-4/3 rounded-3xl overflow-hidden bg-slate-100 border border-slate-200 shadow-sm cursor-zoom-in group" @click="lightboxOpen = true">
                    <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute bottom-4 right-4 bg-slate-900/80 backdrop-blur-md text-white px-3 py-1.5 rounded-xl text-xs font-semibold flex items-center gap-1.5 opacity-80 group-hover:opacity-100 transition-opacity">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                        </svg>
                        <span>Click to Enlarge</span>
                    </div>
                </div>

                <!-- Thumbnails -->
                @if($product->images->count() > 0)
                    <div class="flex items-center gap-3 overflow-x-auto pb-2">
                        <button type="button" 
                                @click="activeImage = '{{ $product->image_url }}'"
                                :class="activeImage === '{{ $product->image_url }}' ? 'ring-2 ring-sky-600' : 'opacity-70 hover:opacity-100'"
                                class="w-20 h-16 rounded-xl overflow-hidden border border-slate-200 flex-shrink-0 transition-all">
                            <img src="{{ $product->image_url }}" alt="Main" class="w-full h-full object-cover">
                        </button>
                        @foreach($product->images as $img)
                            <button type="button" 
                                    @click="activeImage = '{{ $img->image_url }}'"
                                    :class="activeImage === '{{ $img->image_url }}' ? 'ring-2 ring-sky-600' : 'opacity-70 hover:opacity-100'"
                                    class="w-20 h-16 rounded-xl overflow-hidden border border-slate-200 flex-shrink-0 transition-all">
                                <img src="{{ $img->image_url }}" alt="{{ $img->alt_text ?: $product->name }}" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif

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
                    <button @click="lightboxOpen = false" class="absolute top-6 right-6 text-white/80 hover:text-white p-2 text-2xl">
                        &times;
                    </button>
                    <img :src="activeImage" alt="{{ $product->name }}" class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl object-contain">
                </div>
            </div>

            <!-- Right Column: Product Overview & Actions -->
            <div class="lg:col-span-6 flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <!-- Category Badge & Featured Tag -->
                    <div class="flex items-center gap-2">
                        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" 
                           class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-sky-100 text-sky-800 hover:bg-sky-200 transition-colors">
                            {{ $product->category->name }}
                        </a>
                        @if($product->is_featured)
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-900">
                                Featured Product
                            </span>
                        @endif
                    </div>

                    <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight leading-tight">
                        {{ $product->name }}
                    </h1>

                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        {{ $product->short_description }}
                    </p>

                    <!-- CTAs -->
                    <div class="pt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <a href="{{ route('quote.create', ['product_id' => $product->id]) }}" 
                           class="flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm shadow-md shadow-sky-600/20 transition-all transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Request Formal Quote</span>
                        </a>

                        @if($whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}?text={{ $product->whatsapp_message }}" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm shadow-md shadow-emerald-600/20 transition-all transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                </svg>
                                <span>Ask on WhatsApp</span>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Industrial Quality Guarantee Ribbon -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-900">Direct Factory Warranty &amp; Compliance</p>
                        <p class="text-xs text-slate-500">Manufactured with virgin raw materials under strict dimensional calibration.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Product Specifications & Description Tabs -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto space-y-12">
            <!-- Dynamic Specifications Table -->
            <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-xs">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600">Technical Data</span>
                        <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-0.5">
                            Product Technical Specifications
                        </h2>
                    </div>
                </div>

                @if($product->specifications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <tbody class="divide-y divide-slate-100">
                                @foreach($product->specifications as $spec)
                                    <tr class="{{ $loop->even ? 'bg-slate-50/50' : '' }}">
                                        <td class="py-3.5 px-4 font-bold text-slate-800 w-1/3 bg-slate-50/80 sm:w-1/4 rounded-l-xl">
                                            {{ $spec->specification_name }}
                                        </td>
                                        <td class="py-3.5 px-4 text-slate-700 font-medium rounded-r-xl">
                                            {{ $spec->specification_value }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-sm text-slate-500">
                        Standard manufacturing specifications applicable. Custom dimensions, colors, and pressure ratings can be produced upon request.
                    </p>
                @endif
            </div>

            <!-- Full Description & Applications -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-xs space-y-4">
                    <h3 class="text-lg font-black text-slate-900 tracking-tight">Full Product Description</h3>
                    <div class="text-slate-600 text-sm sm:text-base leading-relaxed space-y-3">
                        {!! nl2br(e($product->full_description ?: $product->short_description)) !!}
                    </div>
                </div>

                <!-- Linked Applications -->
                <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/90 shadow-xs space-y-4">
                    <h3 class="text-lg font-black text-slate-900 tracking-tight">Recommended Applications</h3>
                    <div class="space-y-3">
                        @forelse($product->applications as $app)
                            <a href="{{ route('applications.show', $app->slug) }}" class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 hover:bg-sky-50 border border-slate-200/80 hover:border-sky-200 transition-colors group">
                                <div class="w-8 h-8 rounded-lg bg-sky-100 text-sky-700 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-slate-900 group-hover:text-sky-600 transition-colors">{{ $app->title }}</p>
                                    <p class="text-xs text-slate-500 line-clamp-1">{{ $app->description }}</p>
                                </div>
                                <span class="text-xs text-slate-400 group-hover:text-sky-600">&rarr;</span>
                            </a>
                        @empty
                            <p class="text-xs text-slate-500">Suitable for general residential, commercial building, and plumbing installations.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="pt-8">
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-6">
                        Related Products in {{ $product->category->name }}
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $relProduct)
                            <x-product-card :product="$relProduct" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
