@extends('layouts.app')

@section('content')
    <!-- Header -->
    <section class="bg-slate-950 text-white py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 industrial-grid-dark opacity-30 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/10 border border-sky-400/30 text-sky-400 text-xs font-bold tracking-widest uppercase">
                Customer &amp; Technical Support
            </span>
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white mt-3">
                Contact Huming International Limited
            </h1>
            <p class="text-slate-300 text-base sm:text-lg max-w-3xl mt-4 leading-relaxed">
                Reach out to our commercial sales office, factory dispatch desk, or technical engineering department.
            </p>
        </div>
    </section>

    <!-- Main Contact & Form Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Info Panel -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white rounded-3xl p-8 border border-slate-200/90 shadow-xs space-y-6">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600">Headquarters</span>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">
                        {{ $companyName }}
                    </h2>
                    
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center flex-shrink-0 border border-sky-100">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase">Physical Address</p>
                                <p class="font-medium text-slate-800 mt-0.5">{{ $address }}</p>
                            </div>
                        </li>

                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center flex-shrink-0 border border-sky-100">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase">Direct Phone</p>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="font-semibold text-sky-600 hover:underline mt-0.5 block">
                                    {{ $phone }}
                                </a>
                            </div>
                        </li>

                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center flex-shrink-0 border border-sky-100">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase">Email Inquiries</p>
                                <a href="mailto:{{ $email }}" class="font-semibold text-sky-600 hover:underline mt-0.5 block">
                                    {{ $email }}
                                </a>
                            </div>
                        </li>

                        @if($whatsapp)
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 border border-emerald-100">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-400 uppercase">WhatsApp Desk</p>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank" rel="noopener noreferrer" class="font-semibold text-emerald-600 hover:underline mt-0.5 block">
                                        {{ $whatsapp }}
                                    </a>
                                </div>
                            </li>
                        @endif

                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center flex-shrink-0 border border-sky-100">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase">Operating Hours</p>
                                <p class="font-medium text-slate-800 mt-0.5">{{ $workingHours }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Google Maps Embed -->
                @if($mapsEmbed)
                    <div class="rounded-3xl overflow-hidden border border-slate-200 shadow-xs h-64 bg-slate-200">
                        <iframe src="{{ $mapsEmbed }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                @endif
            </div>

            <!-- Right Form Panel -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200/90 shadow-xl space-y-6">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600">Send an Inquiry</span>
                        <h2 class="text-2xl font-black text-slate-900 tracking-tight mt-1">
                            Contact Message Form
                        </h2>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Your Name <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" required value="{{ old('name') }}" placeholder="John Doe" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Email Address <span class="text-rose-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" required value="{{ old('email') }}" placeholder="name@domain.com" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Phone Number
                                </label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+254 700 000000" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                            </div>

                            <div>
                                <label for="subject" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Subject
                                </label>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="e.g. Distribution Dealership Inquiry" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                Message <span class="text-rose-500">*</span>
                            </label>
                            <textarea id="message" name="message" rows="5" required placeholder="Type your message here..." class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm shadow-md transition-all">
                            Send Message &rarr;
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
