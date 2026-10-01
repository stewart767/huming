<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::withCount('products')->orderBy('sort_order')->get();
        return view('admin.applications.index', compact('applications'));
    }

    public function create()
    {
        return view('admin.applications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:applications,slug'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'icon' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['slug'] = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['status'] = $request->boolean('status', true);
        $validated['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('applications', 'public');
            $validated['image'] = $path;
        }

        Application::create($validated);

        return redirect()->route('admin.applications.index')->with('success', 'Application category created successfully.');
    }

    public function edit(Application $application)
    {
        return view('admin.applications.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:applications,slug,' . $application->id],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'icon' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if (!empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);
        }
        $validated['status'] = $request->boolean('status', true);
        $validated['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            if ($application->image && Storage::disk('public')->exists($application->image)) {
                Storage::disk('public')->delete($application->image);
            }
            $path = $request->file('image')->store('applications', 'public');
            $validated['image'] = $path;
        }

        $application->update($validated);

        return redirect()->route('admin.applications.index')->with('success', 'Application category updated successfully.');
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route('admin.applications.index')->with('success', 'Application deleted successfully.');
    }
}
