<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settingsGrouped = Setting::getAllGrouped();
        return view('admin.settings.index', compact('settingsGrouped'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'logo', 'favicon']);

        foreach ($data as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
            Setting::forget($key);
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('branding', 'public');
            Setting::set('logo', $path, 'branding', 'image', 'Company Logo');
        }

        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('branding', 'public');
            Setting::set('favicon', $path, 'branding', 'image', 'Favicon');
        }

        return back()->with('success', 'Company settings updated successfully.');
    }
}
