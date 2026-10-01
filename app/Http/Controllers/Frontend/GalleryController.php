<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\Setting;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $categories = GalleryCategory::orderBy('sort_order')->get();
        
        $query = Gallery::with('category')->orderBy('sort_order');
        
        if ($request->filled('category')) {
            $catSlug = $request->input('category');
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        $items = $query->paginate(12)->withQueryString();

        $seo = [
            'title' => 'Project & Facility Image Gallery — ' . Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED'),
            'description' => 'View high-definition photos of Huming products, manufacturing equipment, industrial facilities, and installed architectural projects.',
            'image' => asset('images/branding/logo.svg'),
            'type' => 'website',
        ];

        return view('frontend.gallery.index', compact('categories', 'items', 'seo'));
    }
}
