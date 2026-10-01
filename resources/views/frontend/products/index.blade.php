@extends('layouts.app')

@section('content')
    <!-- Header Banner -->
    <section class="bg-slate-950 text-white py-14 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 industrial-grid-dark opacity-30 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <nav class="flex items-center space-x-2 text-xs text-slate-400 mb-2">
                        <a href="{{ route('home') }}" class="hover:text-sky-400">Home</a>
                        <span>/</span>
                        <span class="text-sky-400 font-medium">Products Catalog</span>
                        @if($selectedCategory)
                            <span>/</span>
                            <span class="text-white font-semibold">{{ $selectedCategory->name }}</span>
                        @endif
                    </nav>
                    <h1 class="text-2xl sm:text-4xl font-black tracking-tight text-white">
                        {{ $selectedCategory ? $selectedCategory->name : 'Manufacturing & Building Products Catalog' }}
                    </h1>
                    <p class="text-slate-300 text-sm sm:text-base max-w-2xl mt-2">
                        {{ $selectedCategory ? $selectedCategory->description : 'Explore certified marble sheets, fluted wall panels, PVC sealing strips, flash evacuation tanks, and high-pressure PVC pipes.' }}
                    </p>
                </div>

                <a href="{{ route('quote.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 font-bold text-sm tracking-wide shadow-md transition-all self-start md:self-auto">
                    Request Custom Quote
                </a>
            </div>
        </div>
    </section>

    <!-- Main Catalog Filter & Products Grid -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Filter & Search Bar -->
            <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs mb-8">
                <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                    <!-- Search Input -->
                    <div class="sm:col-span-5 relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Search product name, category, or specs..." 
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                    </div>

                    <!-- Category Filter Dropdown -->
                    <div class="sm:col-span-4">
                        <select name="category" onchange="this.form.submit()" class="w-full py-2.5 px-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none bg-white">
                            <option value="">All Categories ({{ $categories->sum('published_products_count') }})</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }} ({{ $cat->published_products_count ?? $cat->products()->published()->count() }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sorting Dropdown -->
                    <div class="sm:col-span-2">
                        <select name="sort" onchange="this.form.submit()" class="w-full py-2.5 px-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none bg-white">
                            <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured First</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                        </select>
                    </div>

                    <!-- Submit / Reset -->
                    <div class="sm:col-span-1 flex gap-1">
                        <button type="submit" class="w-full py-2.5 bg-sky-600 hover:bg-sky-500 text-white rounded-xl text-sm font-bold flex items-center justify-center transition-colors">
                            Filter
                        </button>
                    </div>
                </form>

                <!-- Active Filter Tags -->
                @if(request('search') || request('category') || request('sort'))
                    <div class="mt-3 pt-3 border-t border-slate-100 flex items-center gap-2 text-xs flex-wrap">
                        <span class="text-slate-500 font-medium">Active Filters:</span>
                        @if(request('search'))
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-sky-50 text-sky-700 rounded-lg border border-sky-200">
                                Search: "{{ request('search') }}"
                            </span>
                        @endif
                        @if($selectedCategory)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-sky-50 text-sky-700 rounded-lg border border-sky-200">
                                Category: {{ $selectedCategory->name }}
                            </span>
                        @endif
                        <a href="{{ route('products.index') }}" class="text-rose-600 hover:underline font-semibold ml-2">
                            Reset All Filters
                        </a>
                    </div>
                @endif
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border border-slate-200 p-8">
                        <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">No products found matching your search.</h3>
                        <p class="text-sm text-slate-500 max-w-md mx-auto mt-1">
                            Try adjusting your search criteria or clearing active filters to see all available manufactured products.
                        </p>
                        <a href="{{ route('products.index') }}" class="inline-block mt-4 px-5 py-2.5 rounded-xl bg-sky-600 text-white text-xs font-bold">
                            View All Products
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
