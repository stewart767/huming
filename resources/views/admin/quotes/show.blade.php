@extends('layouts.admin')

@section('title', 'Quotation ' . $quote->quote_number)
@section('header_title', 'Quotation Detail: ' . $quote->quote_number)

@section('content')
    <div class="max-w-4xl space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.quotes.index') }}" class="text-xs font-semibold text-slate-500 hover:text-sky-600">
                &larr; Back to Quotes List
            </a>
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase {{ $quote->status_badge_class }}">
                Status: {{ $quote->status }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Info Panel -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Client Details -->
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 space-y-4">
                    <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3">
                        Client Information
                    </h3>
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-slate-400 block font-bold uppercase">Full Name</span>
                            <span class="font-semibold text-slate-900 text-sm mt-0.5 block">{{ $quote->full_name }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-bold uppercase">Company</span>
                            <span class="font-semibold text-slate-900 text-sm mt-0.5 block">{{ $quote->company_name ?: 'Individual / Contractor' }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-bold uppercase">Email Address</span>
                            <a href="mailto:{{ $quote->email }}" class="font-semibold text-sky-600 hover:underline mt-0.5 block">{{ $quote->email }}</a>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-bold uppercase">Phone Number</span>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $quote->phone) }}" class="font-semibold text-sky-600 hover:underline mt-0.5 block">{{ $quote->phone }}</a>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-bold uppercase">Location / Site</span>
                            <span class="font-medium text-slate-800 mt-0.5 block">{{ $quote->location ?: 'Not specified' }} ({{ $quote->country }})</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-bold uppercase">Preferred Contact</span>
                            <span class="font-medium text-slate-800 mt-0.5 block">{{ $quote->preferred_contact_method }}</span>
                        </div>
                    </div>
                </div>

                <!-- Product Requirements -->
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 space-y-4">
                    <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3">
                        Requested Product &amp; Quantities
                    </h3>
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-slate-400 block font-bold uppercase">Product Line</span>
                            <span class="font-bold text-slate-900 text-sm mt-0.5 block">{{ $quote->product_name ?: 'General Line' }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-bold uppercase">Quantity Required</span>
                            <span class="font-bold text-slate-900 text-sm mt-0.5 block">
                                {{ $quote->quantity ? $quote->quantity . ' ' . $quote->preferred_unit : 'Custom batch' }}
                            </span>
                        </div>
                    </div>

                    @if($quote->message)
                        <div class="pt-3 border-t border-slate-100">
                            <span class="text-slate-400 block font-bold uppercase text-xs mb-1">Client Project Notes</span>
                            <div class="p-3.5 rounded-xl bg-slate-50 text-slate-700 text-xs leading-relaxed">
                                {{ $quote->message }}
                            </div>
                        </div>
                    @endif

                    @if($quote->attachment)
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                <svg class="w-4 h-4 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                <span>Attached Spec Sheet Document</span>
                            </div>
                            <a href="{{ route('admin.quotes.download', $quote->id) }}" class="px-3 py-1.5 rounded-lg bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-xs">
                                Download File &darr;
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Action Panel -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Status Update Form -->
                <form action="{{ route('admin.quotes.update', $quote->id) }}" method="POST" class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3">
                        Update Status &amp; Notes
                    </h3>

                    <div>
                        <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Quotation Progress Status
                        </label>
                        <select id="status" name="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none bg-white">
                            <option value="new" {{ $quote->status == 'new' ? 'selected' : '' }}>New Inquiry</option>
                            <option value="reviewing" {{ $quote->status == 'reviewing' ? 'selected' : '' }}>Under Review</option>
                            <option value="contacted" {{ $quote->status == 'contacted' ? 'selected' : '' }}>Client Contacted</option>
                            <option value="quoted" {{ $quote->status == 'quoted' ? 'selected' : '' }}>Quotation Sent</option>
                            <option value="completed" {{ $quote->status == 'completed' ? 'selected' : '' }}>Order Completed / Closed</option>
                            <option value="cancelled" {{ $quote->status == 'cancelled' ? 'selected' : '' }}>Cancelled / Inactive</option>
                        </select>
                    </div>

                    <div>
                        <label for="internal_notes" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Internal Staff Notes
                        </label>
                        <textarea id="internal_notes" name="internal_notes" rows="4" placeholder="Add pricing calculations, contact history, or logistics details..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">{{ old('internal_notes', $quote->internal_notes) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-sky-600 hover:bg-sky-500 text-white rounded-xl text-xs font-bold shadow-xs transition-colors">
                        Save Status &amp; Notes
                    </button>
                </form>

                <!-- Quick Direct Actions -->
                <div class="bg-slate-50 rounded-3xl border border-slate-200 p-6 space-y-3">
                    <h4 class="font-bold text-slate-900 text-xs uppercase tracking-wider">Quick Actions</h4>
                    <div class="space-y-2">
                        <a href="mailto:{{ $quote->email }}?subject=Quotation%20{{ $quote->quote_number }}%20-%20Huming%20International%20Limited" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-100 text-slate-800 text-xs font-bold transition-colors">
                            <svg class="w-4 h-4 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>Send Email to {{ $quote->email }}</span>
                        </a>

                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $quote->phone) }}?text={{ urlencode('Hello ' . $quote->full_name . ', this is Huming International Limited regarding your quotation request [' . $quote->quote_number . '].') }}" target="_blank" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition-colors shadow-xs">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                            <span>Chat on WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
