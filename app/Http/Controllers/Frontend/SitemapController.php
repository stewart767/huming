<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $products = Product::published()->latest()->get();
        $categories = Category::active()->get();
        $applications = Application::active()->get();

        $content = view('frontend.sitemap', compact('products', 'categories', 'applications'))->render();

        return response($content, 200)->header('Content-Type', 'text/xml');
    }
}
