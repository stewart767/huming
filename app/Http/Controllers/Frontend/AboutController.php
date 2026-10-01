<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CompanyValue;
use App\Models\HomepageFeature;
use App\Models\Setting;

class AboutController extends Controller
{
    public function index()
    {
        $values = CompanyValue::where('status', true)->orderBy('sort_order')->get();
        $features = HomepageFeature::where('status', true)->orderBy('sort_order')->get();

        $seo = [
            'title' => 'About Us — ' . Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED'),
            'description' => Setting::get('about_short', 'Learn about Huming International Limited, our manufacturing facilities, vision, mission, and building product supply capabilities.'),
            'image' => asset('images/branding/logo.svg'),
            'type' => 'website',
        ];

        return view('frontend.about', compact('values', 'features', 'seo'));
    }
}
