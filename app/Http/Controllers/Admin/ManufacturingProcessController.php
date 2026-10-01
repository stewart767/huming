<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyValue;
use App\Models\ProductionProcess;
use Illuminate\Http\Request;

class ManufacturingProcessController extends Controller
{
    public function index()
    {
        $processes = ProductionProcess::orderBy('step_number')->get();
        $values = CompanyValue::orderBy('sort_order')->get();

        return view('admin.manufacturing.index', compact('processes', 'values'));
    }

    public function storeProcess(Request $request)
    {
        $validated = $request->validate([
            'step_number' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'icon' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['status'] = $request->boolean('status', true);

        ProductionProcess::create($validated);

        return back()->with('success', 'Production step created successfully.');
    }

    public function updateProcess(Request $request, ProductionProcess $process)
    {
        $validated = $request->validate([
            'step_number' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'icon' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['status'] = $request->boolean('status', true);

        $process->update($validated);

        return back()->with('success', 'Production step updated.');
    }

    public function destroyProcess(ProductionProcess $process)
    {
        $process->delete();
        return back()->with('success', 'Production step removed.');
    }

    public function storeValue(Request $request)
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

        CompanyValue::create($validated);

        return back()->with('success', 'Company value added.');
    }

    public function updateValue(Request $request, CompanyValue $value)
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

        $value->update($validated);

        return back()->with('success', 'Company value updated.');
    }

    public function destroyValue(CompanyValue $value)
    {
        $value->delete();
        return back()->with('success', 'Company value removed.');
    }
}
