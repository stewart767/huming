@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-slate-100 border-b border-slate-200 py-3.5 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex items-center space-x-2 text-xs text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-sky-600">Home</a>
            <span>/</span>
            <a href="{{ route('applications.index') }}" class="hover:text-sky-600">Applications</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold">{{ $application->title }}</span>
        </div>
    </div>

    <!-- Application Banner -->
    <section class="py-12 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-4">
                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-sky-100 text-sky-800">
                    Application Profile
                </span>
                <h1 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight">
                    {{ $application->title }}
                </h1>
                <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                    {{ $application->description }}
                </p>
                <div class="pt-4">
                    <a href="{{ route('quote.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm shadow-md transition-all">
                        Request Material Quotation for This Sector
                    </a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200 bg-slate-100">
                    <img src="{{ $application->image_url }}" alt="{{ $application->title }}" class="w-full h-80 object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Linked Products Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto">
            <div class="mb-10">
                <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600">Material Selection</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1">
                    Recommended Products for {{ $application->title }}
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($application->products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-slate-200 p-6 text-slate-500">
                        <p class="text-sm">All Huming International manufactured lines are customizable for this application.</p>
                        <a href="{{ route('products.index') }}" class="inline-block mt-3 px-4 py-2 bg-sky-600 text-white rounded-xl text-xs font-bold">
                            View All Products
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
