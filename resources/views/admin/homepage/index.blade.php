@extends('layouts.admin')

@section('title', 'Homepage CMS')
@section('header_title', 'Homepage Hero Sliders & Features CMS')

@section('content')
    <div class="space-y-12" x-data="{ slideFormOpen: false, featureFormOpen: false }">
        <!-- 1. Hero Sliders Section -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-black text-slate-900">1. Hero Slider Banners</h2>
                    <p class="text-xs text-slate-500">Manage headlines, badge texts, background images, and call-to-action buttons</p>
                </div>
                <button type="button" @click="slideFormOpen = !slideFormOpen" class="px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-xs transition-colors">
                    + Add New Slide
                </button>
            </div>

            <!-- Slide Add Form Drawer -->
            <div x-show="slideFormOpen" x-cloak class="bg-white rounded-3xl border border-sky-200 p-6 shadow-md space-y-4">
                <h3 class="font-bold text-slate-900 text-sm">Add New Hero Banner Slide</h3>
                <form action="{{ route('admin.homepage.slides.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Badge Tag</label>
                            <input type="text" name="badge_text" placeholder="e.g., PRECISION MANUFACTURING EXCELLENCE" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Slide Image</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Headline Title <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" required placeholder="e.g. Quality Manufacturing Solutions for Modern Construction" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Supporting Subtitle Text</label>
                        <textarea name="subtitle" rows="2" placeholder="Supporting text..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none"></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" name="button_text" placeholder="Button 1 Text" value="Explore Products" class="px-3.5 py-2 rounded-xl border border-slate-200 text-xs outline-none">
                            <input type="text" name="button_url" placeholder="Button 1 URL" value="/products" class="px-3.5 py-2 rounded-xl border border-slate-200 text-xs outline-none">
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" name="secondary_button_text" placeholder="Button 2 Text" value="Request a Quote" class="px-3.5 py-2 rounded-xl border border-slate-200 text-xs outline-none">
                            <input type="text" name="secondary_button_url" placeholder="Button 2 URL" value="/quote" class="px-3.5 py-2 rounded-xl border border-slate-200 text-xs outline-none">
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="slideFormOpen = false" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Cancel</button>
                        <button type="submit" class="px-6 py-2 rounded-xl bg-sky-600 text-white font-bold text-xs shadow-xs">Save Slide</button>
                    </div>
                </form>
            </div>

            <!-- Slides List -->
            <div class="space-y-4">
                @foreach($slides as $slide)
                    <div class="bg-white rounded-3xl border border-slate-200/90 p-5 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <img src="{{ $slide->image_url }}" alt="Slide" class="w-16 h-12 rounded-xl object-cover border border-slate-200">
                            <div>
                                <span class="text-[10px] font-bold text-sky-600 uppercase">{{ $slide->badge_text ?: 'Hero Banner' }}</span>
                                <h4 class="font-bold text-slate-900 text-sm">{{ $slide->title }}</h4>
                                <p class="text-xs text-slate-500 line-clamp-1 max-w-lg">{{ $slide->subtitle }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="text-xs font-semibold text-slate-400">Order: {{ $slide->sort_order }}</span>
                            <form action="{{ route('admin.homepage.slides.destroy', $slide->id) }}" method="POST" onsubmit="return confirm('Delete this hero slide?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 text-xs font-bold transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 2. Why Choose Us Features Section -->
        <div class="space-y-6 pt-6 border-t border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-black text-slate-900">2. "Why Choose Us" Highlights</h2>
                    <p class="text-xs text-slate-500">Manage strengths displayed on Homepage and About pages</p>
                </div>
                <button type="button" @click="featureFormOpen = !featureFormOpen" class="px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-xs transition-colors">
                    + Add Feature
                </button>
            </div>

            <!-- Add Feature Form -->
            <div x-show="featureFormOpen" x-cloak class="bg-white rounded-3xl border border-sky-200 p-6 shadow-md space-y-4">
                <form action="{{ route('admin.homepage.features.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Feature Title <span class="text-rose-500">*</span></label>
                            <input type="text" name="title" required placeholder="e.g. Competitive Solutions" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Sort Order</label>
                            <input type="number" name="sort_order" value="0" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Description <span class="text-rose-500">*</span></label>
                        <textarea name="description" rows="2" required placeholder="Details..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none"></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="featureFormOpen = false" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Cancel</button>
                        <button type="submit" class="px-6 py-2 rounded-xl bg-sky-600 text-white font-bold text-xs shadow-xs">Save Feature</button>
                    </div>
                </form>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($features as $feature)
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 space-y-2 flex flex-col justify-between">
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">{{ $feature->title }}</h4>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $feature->description }}</p>
                        </div>
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-slate-400 font-mono">Order: {{ $feature->sort_order }}</span>
                            <form action="{{ route('admin.homepage.features.destroy', $feature->id) }}" method="POST" onsubmit="return confirm('Delete this feature?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold text-[11px]">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
