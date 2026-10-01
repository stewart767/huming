<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\QuoteRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_quotes' => QuoteRequest::count(),
            'new_quotes' => QuoteRequest::where('status', QuoteRequest::STATUS_NEW)->count(),
            'reviewing_quotes' => QuoteRequest::where('status', QuoteRequest::STATUS_REVIEWING)->count(),
            'quoted_quotes' => QuoteRequest::where('status', QuoteRequest::STATUS_QUOTED)->count(),
            'completed_quotes' => QuoteRequest::where('status', QuoteRequest::STATUS_COMPLETED)->count(),
            'total_messages' => ContactMessage::count(),
            'new_messages' => ContactMessage::where('status', ContactMessage::STATUS_NEW)->count(),
            'total_gallery' => Gallery::count(),
            'total_applications' => Application::count(),
        ];

        $recentQuotes = QuoteRequest::with('product')->latest()->take(6)->get();
        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentProducts = Product::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentQuotes', 'recentMessages', 'recentProducts'));
    }
}
