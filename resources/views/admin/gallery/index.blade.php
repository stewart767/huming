@extends('layouts.admin')

@section('title', 'Manage Gallery')
@section('header_title', 'Media Gallery Management')

@section('content')
    <div class="space-y-8" x-data="{ uploadOpen: false, catModalOpen: false }">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-slate-900">Media Gallery ({{ $items->total() }})</h2>
                <p class="text-xs text-slate-500">Upload and organize real manufacturing facility and product photos</p>
            </div>
            <div class="flex gap-2">
                <button type="button" @click="catModalOpen = true" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs shadow-xs transition-colors">
                    + New Gallery Album
                </button>
                <button type="button" @click="uploadOpen = !uploadOpen" class="px-4 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-sm transition-colors">
                    + Upload Photo
                </button>
            </div>
        </div>

        <!-- Upload Form Drawer -->
        <div x-show="uploadOpen" x-cloak class="bg-white rounded-3xl border border-sky-200 p-6 shadow-md space-y-5">
            <h3 class="font-bold text-slate-900 text-sm">Upload New Photo to Gallery</h3>
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="title" class="block text-xs font-bold text-slate-700 uppercase mb-1">Title <span class="text-rose-500">*</span></label>
                        <input type="text" id="title" name="title" required placeholder="e.g. Precision Extrusion Line #2" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label for="gallery_category_id" class="block text-xs font-bold text-slate-700 uppercase mb-1">Album / Category</label>
                        <select id="gallery_category_id" name="gallery_category_id" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none bg-white">
                            <option value="">-- Select Album --</option>
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="image" class="block text-xs font-bold text-slate-700 uppercase mb-1">Photo File <span class="text-rose-500">*</span></label>
                        <input type="file" id="image" name="image" required accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700">
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-xs font-bold text-slate-700 uppercase mb-1">Caption / Description</label>
                    <input type="text" id="description" name="description" placeholder="Brief explanation of the facility, equipment, or project..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                </div>

                <div class="flex items-center justify-between pt-2">
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                        <input type="checkbox" name="is_featured" value="1" class="rounded text-sky-600 focus:ring-sky-500">
                        <span>Feature on Manufacturing Page</span>
                    </label>
                    <div class="flex gap-2">
                        <button type="button" @click="uploadOpen = false" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Cancel</button>
                        <button type="submit" class="px-6 py-2 rounded-xl bg-sky-600 text-white font-bold text-xs shadow-xs">Save Photo</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Photos Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($items as $item)
                <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden flex flex-col justify-between group">
                    <div>
                        <div class="aspect-4/3 overflow-hidden bg-slate-100 relative">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                            @if($item->category)
                                <span class="absolute top-2 left-2 px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-900/80 text-white">
                                    {{ $item->category->name }}
                                </span>
                            @endif
                        </div>
                        <div class="p-4 space-y-1">
                            <h4 class="font-bold text-slate-900 text-xs">{{ $item->title }}</h4>
                            <p class="text-[11px] text-slate-500 line-clamp-2">{{ $item->description }}</p>
                        </div>
                    </div>

                    <div class="p-3 pt-0 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-[10px] text-slate-400 font-mono">#{{ $item->id }}</span>
                        <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-700 font-bold text-[11px]">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-3xl border border-slate-200 p-6 text-slate-400 text-sm">
                    No gallery images uploaded.
                </div>
            @endforelse
        </div>

        @if($items->hasPages())
            <div class="mt-6">
                {{ $items->links() }}
            </div>
        @endif

        <!-- Album Category Modal -->
        <div x-show="catModalOpen" x-cloak class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl p-6 max-w-sm w-full shadow-2xl space-y-4" @click.away="catModalOpen = false">
                <h3 class="font-black text-slate-900 text-base">New Gallery Album Category</h3>
                <form action="{{ route('admin.gallery.categories.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="cat_name" class="block text-xs font-bold text-slate-700 uppercase mb-1">Album Name</label>
                        <input type="text" id="cat_name" name="name" required placeholder="e.g. Automated Extrusion" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="catModalOpen = false" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Cancel</button>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-sky-600 text-white text-xs font-bold">Create Album</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
