<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Category;
use App\Models\HomepageFeature;
use App\Models\HomepageSlide;
use App\Models\Product;
use App\Models\ProductionProcess;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HomepageSlide::where('status', true)->orderBy('sort_order')->get();
        $categories = Category::active()->withCount(['publishedProducts'])->get();
        $featuredProducts = Product::featured()->with(['category', 'images'])->orderBy('sort_order')->take(8)->get();
        $features = HomepageFeature::where('status', true)->orderBy('sort_order')->get();
        $applications = Application::active()->take(6)->get();
        $processes = ProductionProcess::where('status', true)->orderBy('step_number')->take(4)->get();
        
        // Dynamic SEO meta
        $seo = [
            'title' => Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED') . ' — Quality Manufacturing Solutions for Modern Construction',
            'description' => Setting::get('site_description', 'Huming International Limited is a premier manufacturing and supply company specializing in marble sheets, wall panels, PVC sealing, flash tanks, and PVC pipes.'),
            'image' => asset('images/branding/logo.svg'),
            'type' => 'website',
        ];

        return view('frontend.home', compact(
            'slides',
            'categories',
            'featuredProducts',
            'features',
            'applications',
            'processes',
            'seo'
        ));
    }
}
