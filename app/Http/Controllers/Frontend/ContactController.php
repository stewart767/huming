<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        $companyName = Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED');
        $phone = Setting::get('company_phone', '+254 700 000 000');
        $whatsapp = Setting::get('company_whatsapp', '+254700000000');
        $email = Setting::get('company_email', 'info@huminginternational.com');
        $address = Setting::get('company_address', 'Industrial Area, Commercial Street, Nairobi, Kenya');
        $workingHours = Setting::get('working_hours', 'Mon - Fri: 8:00 AM - 5:00 PM');
        $mapsEmbed = Setting::get('google_maps_embed');

        $seo = [
            'title' => 'Contact Us — ' . $companyName,
            'description' => 'Get in touch with Huming International Limited sales and manufacturing support team for product inquiries, distribution opportunities, and factory orders.',
            'image' => asset('images/branding/logo.svg'),
            'type' => 'website',
        ];

        return view('frontend.contact', compact(
            'companyName',
            'phone',
            'whatsapp',
            'email',
            'address',
            'workingHours',
            'mapsEmbed',
            'seo'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        $msg = ContactMessage::create($validated);

        Log::info("New Contact Message received from {$msg->name} ({$msg->email}): {$msg->subject}");

        return back()->with('success', 'Thank you for reaching out to Huming International Limited. Your message has been received and our team will get back to you promptly.');
    }
}
