@props(['product'])

<div class="group bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-xs hover:shadow-xl hover:border-sky-300 transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1">
    <!-- Image Area -->
    <div class="relative aspect-4/3 w-full bg-slate-100 overflow-hidden">
        <img src="{{ $product->image_url }}" 
             alt="{{ $product->name }}" 
             loading="lazy" 
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        
        <!-- Category Badge -->
        <div class="absolute top-3 left-3">
            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-slate-900/80 backdrop-blur-md text-white border border-white/10 shadow-sm">
                {{ $product->category->name ?? 'Industrial' }}
            </span>
        </div>

        @if($product->is_featured)
            <div class="absolute top-3 right-3">
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wider bg-amber-500 text-slate-950 shadow-sm">
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Featured
                </span>
            </div>
        @endif
    </div>

    <!-- Content Area -->
    <div class="p-5 flex-1 flex flex-col justify-between">
        <div>
            <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-sky-600 transition-colors line-clamp-2">
                <a href="{{ route('products.show', $product->slug) }}">
                    {{ $product->name }}
                </a>
            </h3>

            <p class="mt-2 text-xs sm:text-sm text-slate-600 line-clamp-2 leading-relaxed">
                {{ $product->short_description ?: 'Engineered with high standards for modern construction and building applications.' }}
            </p>
        </div>

        <!-- Card Buttons -->
        <div class="mt-5 pt-4 border-t border-slate-100 grid grid-cols-2 gap-2">
            <a href="{{ route('products.show', $product->slug) }}" 
               class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                View Details
            </a>
            <a href="{{ route('quote.create', ['product_id' => $product->id]) }}" 
               class="inline-flex items-center justify-center px-3 py-2 text-xs font-bold text-white bg-sky-600 hover:bg-sky-500 rounded-xl shadow-xs transition-colors">
                Request Quote
            </a>
        </div>
    </div>
</div>
