@extends('layouts.app')

@section('content')
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 min-h-[75vh] flex items-center justify-center">
        <div class="max-w-2xl w-full bg-white rounded-3xl border border-slate-200/90 shadow-2xl p-8 sm:p-12 text-center space-y-6">
            <!-- Icon -->
            <div class="w-20 h-20 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto shadow-inner">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <div class="space-y-2">
                <span class="text-xs font-extrabold uppercase tracking-widest text-emerald-600">Quotation Registered</span>
                <h1 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    Thank You for Contacting Us
                </h1>
                <p class="text-slate-600 text-sm sm:text-base">
                    Your quotation request has been received by Huming International Limited. Our commercial sales engineering team will review your specifications and prepare a formal quote.
                </p>
            </div>

            <!-- Quotation Reference Card -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 text-left space-y-3">
                <div class="flex items-center justify-between border-b border-slate-200/80 pb-3">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Inquiry Reference Number</span>
                    <span class="font-mono font-black text-sky-700 text-base bg-sky-50 px-3 py-1 rounded-lg border border-sky-200">
                        {{ $quote->quote_number }}
                    </span>
                </div>
                <div class="grid grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-slate-400 block">Client:</span>
                        <span class="font-semibold text-slate-800">{{ $quote->full_name }} ({{ $quote->company_name ?: 'Individual' }})</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block">Product:</span>
                        <span class="font-semibold text-slate-800">{{ $quote->product_name ?: 'Multiple Lines' }}</span>
                    </div>
                    @if($quote->quantity)
                        <div>
                            <span class="text-slate-400 block">Quantity:</span>
                            <span class="font-semibold text-slate-800">{{ $quote->quantity }} {{ $quote->preferred_unit }}</span>
                        </div>
                    @endif
                    <div>
                        <span class="text-slate-400 block">Submission Date:</span>
                        <span class="font-semibold text-slate-800">{{ $quote->created_at->format('M d, Y - h:i A') }}</span>
                    </div>
                </div>
            </div>

            <!-- Follow-up Options -->
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
                @if($whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}?text={{ urlencode('Hello Huming International Limited, I submitted quotation request [' . $quote->quote_number . ']. I would like to follow up.') }}" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm shadow-md flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        <span>Follow Up on WhatsApp</span>
                    </a>
                @endif
                <a href="{{ route('products.index') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm">
                    Return to Products
                </a>
            </div>
        </div>
    </section>
@endsection
