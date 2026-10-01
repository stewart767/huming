<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $categories = GalleryCategory::orderBy('sort_order')->get();
        $query = Gallery::with('category')->orderBy('sort_order');

        if ($request->filled('category_id')) {
            $query->where('gallery_category_id', $request->input('category_id'));
        }

        $items = $query->paginate(15)->withQueryString();

        return view('admin.gallery.index', compact('categories', 'items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gallery_category_id' => ['nullable', 'exists:gallery_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['required', 'image', 'max:8192'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $validated['image'] = $path;
        }

        Gallery::create($validated);

        return back()->with('success', 'Gallery item uploaded successfully.');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'gallery_category_id' => ['nullable', 'exists:gallery_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'max:8192'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            $path = $request->file('image')->store('gallery', 'public');
            $validated['image'] = $path;
        }

        $gallery->update($validated);

        return back()->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();

        return back()->with('success', 'Gallery item removed.');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:gallery_categories,slug'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['slug'] = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['sort_order'] = $request->input('sort_order', 0);

        GalleryCategory::create($validated);

        return back()->with('success', 'Gallery category created.');
    }
}
