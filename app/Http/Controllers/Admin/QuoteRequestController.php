<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuoteRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = QuoteRequest::with('product');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where(function ($q) use ($s) {
                $q->where('quote_number', 'like', "%{$s}%")
                  ->orWhere('full_name', 'like', "%{$s}%")
                  ->orWhere('company_name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%")
                  ->orWhere('product_name', 'like', "%{$s}%");
            });
        }

        $quotes = $query->latest()->paginate(15)->withQueryString();

        $counts = [
            'all' => QuoteRequest::count(),
            'new' => QuoteRequest::where('status', QuoteRequest::STATUS_NEW)->count(),
            'reviewing' => QuoteRequest::where('status', QuoteRequest::STATUS_REVIEWING)->count(),
            'contacted' => QuoteRequest::where('status', QuoteRequest::STATUS_CONTACTED)->count(),
            'quoted' => QuoteRequest::where('status', QuoteRequest::STATUS_QUOTED)->count(),
            'completed' => QuoteRequest::where('status', QuoteRequest::STATUS_COMPLETED)->count(),
            'cancelled' => QuoteRequest::where('status', QuoteRequest::STATUS_CANCELLED)->count(),
        ];

        return view('admin.quotes.index', compact('quotes', 'counts'));
    }

    public function show(QuoteRequest $quote)
    {
        // If it was newly opened, optionally advance or keep
        return view('admin.quotes.show', compact('quote'));
    }

    public function update(Request $request, QuoteRequest $quote)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:new,reviewing,contacted,quoted,completed,cancelled'],
            'internal_notes' => ['nullable', 'string'],
        ]);

        $quote->update($validated);

        return back()->with('success', "Quotation [{$quote->quote_number}] updated successfully.");
    }

    public function destroy(QuoteRequest $quote)
    {
        if ($quote->attachment && Storage::disk('public')->exists($quote->attachment)) {
            Storage::disk('public')->delete($quote->attachment);
        }

        $num = $quote->quote_number;
        $quote->delete();

        return redirect()->route('admin.quotes.index')->with('success', "Quotation [{$num}] deleted successfully.");
    }

    public function downloadAttachment(QuoteRequest $quote)
    {
        if (!$quote->attachment || !Storage::disk('public')->exists($quote->attachment)) {
            return back()->with('error', 'Attachment file not found.');
        }

        return Storage::disk('public')->download($quote->attachment);
    }
}
