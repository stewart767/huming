<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seo['title'] ?? config('app.name', 'HUMING INTERNATIONAL LIMITED') }}</title>
    <meta name="description" content="{{ $seo['description'] ?? \App\Models\Setting::get('site_description') }}">
    @if(!empty($seo['keywords']))
        <meta name="keywords" content="{{ $seo['keywords'] }}">
    @endif
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $seo['type'] ?? 'website' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seo['title'] ?? config('app.name') }}">
    <meta property="og:description" content="{{ $seo['description'] ?? \App\Models\Setting::get('site_description') }}">
    <meta property="og:image" content="{{ $seo['image'] ?? asset('images/branding/logo.svg') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $seo['title'] ?? config('app.name') }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? \App\Models\Setting::get('site_description') }}">
    <meta name="twitter:image" content="{{ $seo['image'] ?? asset('images/branding/logo.svg') }}">

    <!-- Favicon -->
    @php
        $favicon = \App\Models\Setting::get('favicon');
    @endphp
    @if($favicon && file_exists(public_path('storage/' . $favicon)))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $favicon) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/branding/logo.svg') }}">
    @endif

    <!-- Google Fonts: Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Schema.org Organization JSON-LD -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Organization",
      "name": "{{ \App\Models\Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED') }}",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('images/branding/logo.svg') }}",
      "description": "{{ \App\Models\Setting::get('site_description') }}",
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "{{ \App\Models\Setting::get('company_phone', '+254 700 000 000') }}",
        "contactType": "Customer Service",
        "email": "{{ \App\Models\Setting::get('company_email', 'info@huminginternational.com') }}",
        "availableLanguage": ["English", "Swahili"]
      },
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "{{ \App\Models\Setting::get('company_address', 'Industrial Area') }}"
      }
    }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased selection:bg-sky-600 selection:text-white flex flex-col min-h-screen">

    <!-- Top Utility Bar -->
    <div class="bg-slate-900 text-slate-300 text-xs py-2 px-4 sm:px-6 lg:px-8 border-b border-slate-800 hidden sm:block">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center space-x-6">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', \App\Models\Setting::get('company_phone', '+254700000000')) }}" class="flex items-center gap-1.5 hover:text-sky-400 transition-colors">
                    <svg class="w-3.5 h-3.5 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>{{ \App\Models\Setting::get('company_phone', '+254 700 000 000') }}</span>
                </a>
                <a href="mailto:{{ \App\Models\Setting::get('company_email', 'info@huminginternational.com') }}" class="flex items-center gap-1.5 hover:text-sky-400 transition-colors">
                    <svg class="w-3.5 h-3.5 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ \App\Models\Setting::get('company_email', 'info@huminginternational.com') }}</span>
                </a>
                <span class="text-slate-500 hidden md:inline">|</span>
                <span class="text-slate-400 hidden md:inline">{{ \App\Models\Setting::get('working_hours', 'Mon - Fri: 8:00 AM - 5:00 PM') }}</span>
            </div>
            
            <div class="flex items-center space-x-4">
                @php $wa = \App\Models\Setting::get('company_whatsapp'); @endphp
                @if($wa)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wa) }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-1 text-emerald-400 hover:text-emerald-300 transition-colors font-medium">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        <span>WhatsApp Support</span>
                    </a>
                @endif
                <span class="text-slate-600">|</span>
                <span class="text-amber-400 font-semibold uppercase tracking-wider text-[10px]">ISO Standard Compliant</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <x-navbar />

    <!-- Flash Alerts -->
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-4">
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm" role="alert" x-data="{ show: true }" x-show="show">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                    <span class="sr-only">Close</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 border border-rose-300 text-rose-800 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm" role="alert" x-data="{ show: true }" x-show="show">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-rose-500 hover:text-rose-700">
                    <span class="sr-only">Close</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- WhatsApp Direct Floating Button -->
    @php
        $waNum = \App\Models\Setting::get('company_whatsapp');
        $coName = \App\Models\Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED');
    @endphp
    @if($waNum)
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $waNum) }}?text={{ urlencode('Hello ' . $coName . ', I am inquiring about your manufacturing products.') }}" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="fixed bottom-6 right-6 z-40 bg-emerald-500 hover:bg-emerald-600 text-white p-3.5 rounded-full shadow-2xl flex items-center gap-2 group transition-all duration-300 hover:scale-105"
           title="Chat with sales on WhatsApp">
            <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
            </svg>
            <span class="max-w-0 overflow-hidden whitespace-nowrap group-hover:max-w-xs transition-all duration-300 font-semibold text-sm pr-1">
                Chat on WhatsApp
            </span>
        </a>
    @endif

    <!-- Footer Component -->
    <x-footer />

    @stack('scripts')
</body>
</html>
