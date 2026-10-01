<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\ProductionProcess;
use App\Models\Setting;

class ManufacturingController extends Controller
{
    public function index()
    {
        $processes = ProductionProcess::where('status', true)->orderBy('step_number')->get();
        $gallery = Gallery::whereHas('category', function ($q) {
            $q->whereIn('slug', ['factory', 'manufacturing']);
        })->orWhere('is_featured', true)->take(6)->get();

        $seo = [
            'title' => 'Manufacturing Capabilities & Quality Control — ' . Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED'),
            'description' => Setting::get('manufacturing_overview', 'Explore Huming International Limited advanced manufacturing facilities, production process, and rigorous quality inspection protocols.'),
            'image' => asset('images/hero/hero-factory.jpg'),
            'type' => 'website',
        ];

        return view('frontend.manufacturing', compact('processes', 'gallery', 'seo'));
    }
}
