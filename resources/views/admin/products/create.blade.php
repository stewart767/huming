@extends('layouts.admin')

@section('title', 'Create Product')
@section('header_title', 'Create New Manufacturing Product')

@section('content')
    <div class="max-w-4xl space-y-6" x-data="{ 
        specs: [{ name: '', value: '' }] 
    }">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-slate-500 hover:text-sky-600">
                &larr; Back to Products List
            </a>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Basic Details Card -->
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-8 space-y-5">
                <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3">
                    1. Basic Product Information
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Product Name <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="e.g., High-Pressure Schedule 80 PVC Pipe" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>

                    <div>
                        <label for="category_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Category <span class="text-rose-500">*</span>
                        </label>
                        <select id="category_id" name="category_id" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none bg-white">
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="slug" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Custom Slug (Optional)
                        </label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="leave empty to generate automatically" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none font-mono text-xs">
                    </div>

                    <div>
                        <label for="main_image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Main Product Photo
                        </label>
                        <input type="file" id="main_image" name="main_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700">
                    </div>
                </div>

                <div>
                    <label for="short_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Short Summary Description
                    </label>
                    <textarea id="short_description" name="short_description" rows="2" placeholder="Brief 1-2 sentence overview shown in product cards..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">{{ old('short_description') }}</textarea>
                </div>

                <div>
                    <label for="full_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Detailed Engineering &amp; Application Description
                    </label>
                    <textarea id="full_description" name="full_description" rows="5" placeholder="Complete technical product details, material advantages, and structural characteristics..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">{{ old('full_description') }}</textarea>
                </div>
            </div>

            <!-- Dynamic Specifications Card -->
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-8 space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div>
                        <h3 class="font-black text-slate-900 text-base">2. Dynamic Product Specifications</h3>
                        <p class="text-xs text-slate-500">Add customizable attributes specific to this product (e.g. Diameter, Thickness, Pressure, Color)</p>
                    </div>
                    <button type="button" @click="specs.push({ name: '', value: '' })" class="px-3 py-1.5 rounded-xl bg-sky-50 text-sky-700 hover:bg-sky-100 text-xs font-bold transition-colors">
                        + Add Spec Row
                    </button>
                </div>

                <div class="space-y-3">
                    <template x-for="(spec, index) in specs" :key="index">
                        <div class="flex items-center gap-3">
                            <input type="text" name="spec_names[]" x-model="spec.name" placeholder="Specification Name (e.g., Diameter, Thickness)" class="w-1/2 px-4 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                            <input type="text" name="spec_values[]" x-model="spec.value" placeholder="Value (e.g., 110mm, Class E, 3.0mm)" class="w-1/2 px-4 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                            <button type="button" @click="specs.splice(index, 1)" x-show="specs.length > 1" class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Target Applications Card -->
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-8 space-y-4">
                <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3">
                    3. Target Industry Applications
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach($applications as $app)
                        <label class="flex items-center gap-2.5 p-3 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer text-xs font-semibold text-slate-700">
                            <input type="checkbox" name="applications[]" value="{{ $app->id }}" class="rounded text-sky-600 focus:ring-sky-500">
                            <span>{{ $app->title }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Gallery Images -->
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-8 space-y-4">
                <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3">
                    4. Additional Gallery Images
                </h3>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Upload Multiple Detail / Technical Images
                    </label>
                    <input type="file" name="gallery_images[]" multiple accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700">
                </div>
            </div>

            <!-- Visibility, Status & SEO Card -->
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-8 space-y-5">
                <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3">
                    5. Publishing &amp; Search Engine Optimization (SEO)
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Publish Status
                        </label>
                        <select id="status" name="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none bg-white">
                            <option value="published" selected>Published (Live on Website)</option>
                            <option value="draft">Draft (Hidden)</option>
                        </select>
                    </div>

                    <div>
                        <label for="sort_order" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Catalog Sort Order
                        </label>
                        <input type="number" id="sort_order" name="sort_order" value="0" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>

                    <div class="flex items-center pt-6">
                        <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-800">
                            <input type="checkbox" name="is_featured" value="1" class="rounded text-sky-600 focus:ring-sky-500">
                            <span>Feature on Homepage</span>
                        </label>
                    </div>
                </div>

                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <div>
                        <label for="seo_title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            SEO Meta Title
                        </label>
                        <input type="text" id="seo_title" name="seo_title" value="{{ old('seo_title') }}" placeholder="e.g., UV Marble Sheets Manufacturer | Huming" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>

                    <div>
                        <label for="seo_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            SEO Meta Description
                        </label>
                        <textarea id="seo_description" name="seo_description" rows="2" placeholder="Search engine snippet description..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">{{ old('seo_description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-3 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-100 text-xs font-bold">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-md transition-colors">
                    Save &amp; Publish Product
                </button>
            </div>
        </form>
    </div>
@endsection
