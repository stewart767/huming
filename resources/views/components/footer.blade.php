@php
    $categories = \App\Models\Category::active()->get();
    $companyName = \App\Models\Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED');
    $footerAbout = \App\Models\Setting::get('footer_about', 'HUMING INTERNATIONAL LIMITED is a premier manufacturing and supply company providing high-grade building materials, interior finishing panels, PVC systems, and plumbing products for modern construction.');
    $phone = \App\Models\Setting::get('company_phone', '+254 700 000 000');
    $whatsapp = \App\Models\Setting::get('company_whatsapp');
    $email = \App\Models\Setting::get('company_email', 'info@huminginternational.com');
    $address = \App\Models\Setting::get('company_address', 'Industrial Area, Commercial Street, Nairobi, Kenya');
    $facebook = \App\Models\Setting::get('facebook_url');
    $instagram = \App\Models\Setting::get('instagram_url');
    $linkedin = \App\Models\Setting::get('linkedin_url');
    $youtube = \App\Models\Setting::get('youtube_url');
@endphp

<footer class="bg-slate-950 text-slate-300 border-t border-slate-800 mt-auto">
    <!-- Top CTA Ribbon -->
    <div class="bg-gradient-to-r from-sky-900 via-slate-900 to-sky-950 border-b border-slate-800/80 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                    Partner With a Dependable Manufacturing Leader
                </h3>
                <p class="text-sky-200 mt-2 text-sm sm:text-base max-w-2xl">
                    Get in touch with our technical sales engineers for bulk pricing, customized product dimensions, and supply timelines.
                </p>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('quote.create') }}" class="px-6 py-3.5 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 font-bold text-sm tracking-wide shadow-lg shadow-sky-500/20 transition-all transform hover:-translate-y-0.5">
                    Request a Quotation
                </a>
                <a href="{{ route('contact.index') }}" class="px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm border border-white/15 transition-all">
                    Contact Sales Office
                </a>
            </div>
        </div>
    </div>

    <!-- Main Footer Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
            <!-- Col 1: Company Profile -->
            <div class="lg:col-span-2 space-y-5">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/branding/logo-white.svg') }}" alt="{{ $companyName }}" class="h-12 w-auto object-contain">
                </div>
                <p class="text-slate-400 text-sm leading-relaxed pr-6">
                    {{ $footerAbout }}
                </p>
                
                <!-- Social Media Icons -->
                <div class="flex items-center space-x-3 pt-2">
                    @if($facebook)
                        <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-sky-400 hover:border-sky-500/50 transition-all" title="Facebook">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    @endif
                    @if($instagram)
                        <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-rose-400 hover:border-rose-500/50 transition-all" title="Instagram">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                    @if($linkedin)
                        <a href="{{ $linkedin }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-sky-400 hover:border-sky-500/50 transition-all" title="LinkedIn">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    @endif
                    @if($youtube)
                        <a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-red-500 hover:border-red-500/50 transition-all" title="YouTube">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div>
                <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-5 border-l-2 border-sky-500 pl-3">
                    Quick Navigation
                </h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-sky-400 transition-colors">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-slate-400 hover:text-sky-400 transition-colors">About Company</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-slate-400 hover:text-sky-400 transition-colors">Products Catalog</a></li>
                    <li><a href="{{ route('manufacturing') }}" class="text-slate-400 hover:text-sky-400 transition-colors">Manufacturing &amp; QC</a></li>
                    <li><a href="{{ route('applications.index') }}" class="text-slate-400 hover:text-sky-400 transition-colors">Industry Applications</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="text-slate-400 hover:text-sky-400 transition-colors">Media Gallery</a></li>
                    <li><a href="{{ route('quote.create') }}" class="text-slate-400 hover:text-sky-400 transition-colors">Request a Quote</a></li>
                    <li><a href="{{ route('contact.index') }}" class="text-slate-400 hover:text-sky-400 transition-colors">Contact Support</a></li>
                </ul>
            </div>

            <!-- Col 3: Product Categories -->
            <div>
                <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-5 border-l-2 border-sky-500 pl-3">
                    Core Products
                </h4>
                <ul class="space-y-3 text-sm">
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="text-slate-400 hover:text-sky-400 transition-colors flex items-center justify-between group">
                                <span>{{ $cat->name }}</span>
                                <span class="text-xs text-slate-600 group-hover:text-sky-500">&rarr;</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Col 4: Contact Details -->
            <div>
                <h4 class="text-white font-bold text-sm tracking-wider uppercase mb-5 border-l-2 border-sky-500 pl-3">
                    Head Office &amp; Plant
                </h4>
                <ul class="space-y-3.5 text-sm text-slate-400">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-sky-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $address }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-sky-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="hover:text-sky-400 transition-colors">{{ $phone }}</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-sky-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ $email }}" class="hover:text-sky-400 transition-colors">{{ $email }}</a>
                    </li>
                    @if($whatsapp)
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                            </svg>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank" rel="noopener noreferrer" class="text-emerald-400 hover:text-emerald-300 transition-colors">
                                WhatsApp: {{ $whatsapp }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Bottom Copyright -->
        <div class="mt-14 pt-8 border-t border-slate-900 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
            <p>
                &copy; {{ date('Y') }} <span class="font-semibold text-slate-400">{{ $companyName }}</span>. All Rights Reserved.
            </p>
            <div class="flex items-center space-x-6">
                <a href="{{ route('sitemap') }}" class="hover:text-slate-400 transition-colors">Sitemap XML</a>
                <span>&bull;</span>
                <a href="{{ route('admin.login') }}" class="hover:text-sky-400 transition-colors">Employee / Admin Portal</a>
            </div>
        </div>
    </div>
</footer>
