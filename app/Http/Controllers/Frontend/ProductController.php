<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::published()->with(['category', 'images']);

        // Search query
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('full_description', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($catQuery) use ($search) {
                      $catQuery->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('specifications', function ($specQuery) use ($search) {
                      $specQuery->where('specification_name', 'like', "%{$search}%")
                                ->orWhere('specification_value', 'like', "%{$search}%");
                  });
            });
        }

        // Category filter
        $selectedCategory = null;
        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            $selectedCategory = Category::where('slug', $categorySlug)->first();
            if ($selectedCategory) {
                $query->where('category_id', $selectedCategory->id);
            }
        }

        // Sorting
        $sort = $request->input('sort', 'featured');
        switch ($sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'featured':
            default:
                $query->orderByDesc('is_featured')->orderBy('sort_order')->orderBy('name');
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::active()->withCount('publishedProducts')->get();
        $featuredProducts = Product::featured()->take(4)->get();

        $pageTitle = $selectedCategory ? $selectedCategory->name . ' Products Catalog' : 'Industrial & Building Products Catalog';
        $pageDesc = $selectedCategory ? $selectedCategory->description : 'Browse Huming International Limited catalog of marble sheets, decorative wall panels, PVC sealing, hydraulic flash tanks, and high pressure PVC pipes.';

        $seo = [
            'title' => $pageTitle . ' — ' . Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED'),
            'description' => $pageDesc,
            'image' => $selectedCategory ? $selectedCategory->image_url : asset('images/branding/logo.svg'),
            'type' => 'website',
        ];

        return view('frontend.products.index', compact(
            'products',
            'categories',
            'selectedCategory',
            'featuredProducts',
            'seo'
        ));
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'images', 'specifications', 'applications'])
            ->firstOrFail();

        $relatedProducts = Product::published()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        $company = Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED');
        $whatsapp = Setting::get('company_whatsapp', '+254700000000');

        $seo = [
            'title' => ($product->seo_title ?: $product->name) . ' — ' . $company,
            'description' => $product->seo_description ?: $product->short_description,
            'image' => $product->image_url,
            'keywords' => $product->seo_keywords,
            'type' => 'product',
        ];

        return view('frontend.products.show', compact('product', 'relatedProducts', 'whatsapp', 'seo'));
    }
}
