@extends('layouts.admin')

@section('title', 'Edit ' . $application->title)
@section('header_title', 'Edit Application: ' . $application->title)

@section('content')
    <div class="max-w-2xl space-y-6">
        <a href="{{ route('admin.applications.index') }}" class="text-xs font-semibold text-slate-500 hover:text-sky-600">
            &larr; Back to Applications
        </a>

        <form action="{{ route('admin.applications.update', $application->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-8 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Application Title <span class="text-rose-500">*</span>
                </label>
                <input type="text" id="title" name="title" required value="{{ old('title', $application->title) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
            </div>

            <div>
                <label for="slug" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    URL Slug
                </label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $application->slug) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none font-mono text-xs">
            </div>

            <div>
                <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Description
                </label>
                <textarea id="description" name="description" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">{{ old('description', $application->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Replace Cover Image
                    </label>
                    <div class="flex items-center gap-3">
                        <img src="{{ $application->image_url }}" alt="Cover" class="w-10 h-10 rounded-lg object-cover border border-slate-200">
                        <input type="file" id="image" name="image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700">
                    </div>
                </div>

                <div>
                    <label for="sort_order" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Sort Order
                    </label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $application->sort_order) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.applications.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-xs font-bold">Cancel</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-md transition-colors">
                    Update Application
                </button>
            </div>
        </form>
    </div>
@endsection
