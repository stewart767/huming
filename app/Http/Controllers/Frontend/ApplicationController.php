<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Setting;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::active()->with(['products' => function ($q) {
            $q->published()->take(4);
        }])->get();

        $seo = [
            'title' => 'Building & Industry Applications — ' . Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED'),
            'description' => 'Discover diverse architectural, construction, plumbing, and commercial applications of Huming International products.',
            'image' => asset('images/branding/logo.svg'),
            'type' => 'website',
        ];

        return view('frontend.applications.index', compact('applications', 'seo'));
    }

    public function show(string $slug)
    {
        $application = Application::where('slug', $slug)
            ->where('status', true)
            ->with(['products' => function ($q) {
                $q->published()->with('category');
            }])
            ->firstOrFail();

        $otherApplications = Application::active()
            ->where('id', '!=', $application->id)
            ->take(5)
            ->get();

        $seo = [
            'title' => $application->title . ' — Applications — ' . Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED'),
            'description' => $application->description,
            'image' => $application->image_url,
            'type' => 'website',
        ];

        return view('frontend.applications.show', compact('application', 'otherApplications', 'seo'));
    }
}
