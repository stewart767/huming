<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageFeature;
use App\Models\HomepageSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function index()
    {
        $slides = HomepageSlide::orderBy('sort_order')->get();
        $features = HomepageFeature::orderBy('sort_order')->get();
        return view('admin.homepage.index', compact('slides', 'features'));
    }

    public function storeSlide(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'max:8192'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'secondary_button_text' => ['nullable', 'string', 'max:100'],
            'secondary_button_url' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['status'] = $request->boolean('status', true);
        $validated['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('slides', 'public');
            $validated['image'] = $path;
        }

        HomepageSlide::create($validated);

        return back()->with('success', 'Hero slide created successfully.');
    }

    public function updateSlide(Request $request, HomepageSlide $slide)
    {
        $validated = $request->validate([
            'badge_text' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'max:8192'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'secondary_button_text' => ['nullable', 'string', 'max:100'],
            'secondary_button_url' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $validated['status'] = $request->boolean('status', true);
        $validated['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            if ($slide->image && Storage::disk('public')->exists($slide->image)) {
                Storage::disk('public')->delete($slide->image);
            }
            $path = $request->file('image')->store('slides', 'public');
            $validated['image'] = $path;
        }

        $slide->update($validated);

        return back()->with('success', 'Hero slide updated successfully.');
    }

    public function destroySlide(HomepageSlide $slide)
    {
        if ($slide->image && Storage::disk('public')->exists($slide->image)) {
            Storage::disk('public')->delete($slide->image);
        }
        $slide->delete();

        return back()->with('success', 'Hero slide removed.');
    }

    public function storeFeature(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['status'] = $request->boolean('status', true);
        $validated['sort_order'] = $request->input('sort_order', 0);

        HomepageFeature::create($validated);

        return back()->with('success', 'Feature card added.');
    }

    public function updateFeature(Request $request, HomepageFeature $feature)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['status'] = $request->boolean('status', true);
        $validated['sort_order'] = $request->input('sort_order', 0);

        $feature->update($validated);

        return back()->with('success', 'Feature card updated.');
    }

    public function destroyFeature(HomepageFeature $feature)
    {
        $feature->delete();
        return back()->with('success', 'Feature card removed.');
    }
}
