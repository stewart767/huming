<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\QuoteRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    public function create(Request $request)
    {
        $selectedProductId = $request->input('product_id');
        $selectedProduct = null;

        if ($selectedProductId) {
            $selectedProduct = Product::find($selectedProductId);
        } elseif ($request->filled('product')) {
            $selectedProduct = Product::where('slug', $request->input('product'))->first();
        }

        $products = Product::published()->orderBy('name')->get();

        $seo = [
            'title' => 'Request a Quotation — ' . Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED'),
            'description' => 'Submit your project specifications or product inquiries for custom manufacturing pricing, volume discounts, and lead times.',
            'image' => asset('images/branding/logo.svg'),
            'type' => 'website',
        ];

        return view('frontend.quote.create', compact('products', 'selectedProduct', 'seo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'country' => ['nullable', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
            'product_id' => ['nullable', 'exists:products,id'],
            'product_name' => ['nullable', 'string', 'max:255'],
            'quantity' => ['nullable', 'numeric', 'min:0.01'],
            'preferred_unit' => ['nullable', 'string', 'max:50'],
            'message' => ['nullable', 'string', 'max:3000'],
            'preferred_contact_method' => ['required', 'string', 'in:Email,Phone,WhatsApp'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,webp', 'max:10240'], // 10MB max
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('quotes/attachments', 'public');
            $validated['attachment'] = $path;
        }

        if (!empty($validated['product_id'])) {
            $product = Product::find($validated['product_id']);
            if ($product) {
                $validated['product_name'] = $product->name;
            }
        }

        $quote = QuoteRequest::create($validated);

        // Send email notifications if mail server configured
        try {
            $adminEmail = Setting::get('quote_notification_email', Setting::get('company_email', 'info@huminginternational.com'));
            // Log notification for local/dev
            Log::info("New Quote Request Generated: [{$quote->quote_number}] from {$quote->full_name} ({$quote->email}) for {$quote->product_name}");
        } catch (\Throwable $e) {
            Log::error("Failed sending quote notification email: " . $e->getMessage());
        }

        return redirect()->route('quote.success', ['quote_number' => $quote->quote_number])
            ->with('success', 'Thank you for contacting Huming International Limited. Your quotation request has been received.');
    }

    public function success(string $quote_number)
    {
        $quote = QuoteRequest::where('quote_number', $quote_number)->firstOrFail();
        $company = Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED');
        $whatsapp = Setting::get('company_whatsapp', '+254700000000');

        $seo = [
            'title' => 'Quotation Request Received — ' . $company,
            'description' => 'Your quotation request has been successfully registered with reference code ' . $quote_number,
            'image' => asset('images/branding/logo.svg'),
            'type' => 'website',
        ];

        return view('frontend.quote.success', compact('quote', 'whatsapp', 'seo'));
    }
}
