<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductSpecification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images']);

        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('slug', 'like', "%{$s}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $products = $query->orderBy('sort_order')->latest()->paginate(15)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        $applications = Application::active()->get();
        return view('admin.products.create', compact('categories', 'applications'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'full_description' => ['nullable', 'string'],
            'main_image' => ['nullable', 'image', 'max:5120'], // 5MB max
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['required', 'string', 'in:published,draft'],
            'sort_order' => ['nullable', 'integer'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'applications' => ['nullable', 'array'],
            'applications.*' => ['exists:applications,id'],
            'spec_names' => ['nullable', 'array'],
            'spec_values' => ['nullable', 'array'],
        ]);

        $slug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        // Ensure slug is unique
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('products', 'public');
            $validated['main_image'] = $path;
        }

        $product = Product::create($validated);

        // Attach applications
        if (!empty($validated['applications'])) {
            $product->applications()->sync($validated['applications']);
        }

        // Attach dynamic specifications
        $specNames = $request->input('spec_names', []);
        $specValues = $request->input('spec_values', []);
        $order = 1;
        foreach ($specNames as $index => $specName) {
            $val = $specValues[$index] ?? '';
            if (!empty(trim($specName)) && !empty(trim($val))) {
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'specification_name' => trim($specName),
                    'specification_value' => trim($val),
                    'sort_order' => $order++,
                ]);
            }
        }

        // Handle gallery images if uploaded
        if ($request->hasFile('gallery_images')) {
            $gOrder = 1;
            foreach ($request->file('gallery_images') as $imgFile) {
                $imgPath = $imgFile->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imgPath,
                    'sort_order' => $gOrder++,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', "Product '{$product->name}' created successfully.");
    }

    public function edit(Product $product)
    {
        $product->load(['category', 'images', 'specifications', 'applications']);
        $categories = Category::orderBy('name')->get();
        $applications = Application::active()->get();
        return view('admin.products.edit', compact('product', 'categories', 'applications'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug,' . $product->id],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'full_description' => ['nullable', 'string'],
            'main_image' => ['nullable', 'image', 'max:5120'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['required', 'string', 'in:published,draft'],
            'sort_order' => ['nullable', 'integer'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'seo_keywords' => ['nullable', 'string', 'max:500'],
            'applications' => ['nullable', 'array'],
            'applications.*' => ['exists:applications,id'],
            'spec_names' => ['nullable', 'array'],
            'spec_values' => ['nullable', 'array'],
        ]);

        if (!empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);
        }
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('main_image')) {
            if ($product->main_image && Storage::disk('public')->exists($product->main_image)) {
                Storage::disk('public')->delete($product->main_image);
            }
            $path = $request->file('main_image')->store('products', 'public');
            $validated['main_image'] = $path;
        }

        $product->update($validated);

        // Update applications
        $product->applications()->sync($request->input('applications', []));

        // Update dynamic specifications
        ProductSpecification::where('product_id', $product->id)->delete();
        $specNames = $request->input('spec_names', []);
        $specValues = $request->input('spec_values', []);
        $order = 1;
        foreach ($specNames as $index => $specName) {
            $val = $specValues[$index] ?? '';
            if (!empty(trim($specName)) && !empty(trim($val))) {
                ProductSpecification::create([
                    'product_id' => $product->id,
                    'specification_name' => trim($specName),
                    'specification_value' => trim($val),
                    'sort_order' => $order++,
                ]);
            }
        }

        // Additional gallery images
        if ($request->hasFile('gallery_images')) {
            $lastOrder = $product->images()->max('sort_order') ?? 0;
            foreach ($request->file('gallery_images') as $imgFile) {
                $imgPath = $imgFile->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imgPath,
                    'sort_order' => ++$lastOrder,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', "Product '{$product->name}' updated successfully.");
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', "Product '{$name}' deleted successfully.");
    }

    public function toggleFeatured(Product $product)
    {
        $product->is_featured = !$product->is_featured;
        $product->save();

        return response()->json([
            'success' => true,
            'is_featured' => $product->is_featured,
            'message' => $product->is_featured ? 'Product marked as featured.' : 'Product removed from featured.',
        ]);
    }
}
