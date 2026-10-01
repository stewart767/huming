@extends('layouts.app')

@section('content')
    <!-- Header -->
    <section class="bg-slate-950 text-white py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 industrial-grid-dark opacity-30 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/10 border border-sky-400/30 text-sky-400 text-xs font-bold tracking-widest uppercase">
                B2B &amp; Direct Supply
            </span>
            <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white mt-3">
                Request a Product Quotation
            </h1>
            <p class="text-slate-300 text-base sm:text-lg max-w-3xl mt-4 leading-relaxed">
                Provide your product specifications, volume requirements, or upload architectural drawings for formal pricing and lead time schedules.
            </p>
        </div>
    </section>

    <!-- Quotation Form Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xl p-6 sm:p-12">
                @if ($errors->any())
                    <div class="mb-8 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
                        <p class="font-bold mb-1">Please correct the following errors:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('quote.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Client Identification -->
                    <div>
                        <h2 class="text-lg font-black text-slate-900 border-b border-slate-100 pb-3 mb-5 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-md bg-sky-100 text-sky-700 text-xs flex items-center justify-center font-mono">1</span>
                            Contact &amp; Organization Details
                        </h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="full_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Full Name <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       id="full_name" 
                                       name="full_name" 
                                       required 
                                       value="{{ old('full_name') }}" 
                                       placeholder="e.g., John Doe" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                            </div>

                            <div>
                                <label for="company_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Company / Organization Name
                                </label>
                                <input type="text" 
                                       id="company_name" 
                                       name="company_name" 
                                       value="{{ old('company_name') }}" 
                                       placeholder="e.g., Apex Construction Co." 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Email Address <span class="text-rose-500">*</span>
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       required 
                                       value="{{ old('email') }}" 
                                       placeholder="name@company.com" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Phone Number (with country code) <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       id="phone" 
                                       name="phone" 
                                       required 
                                       value="{{ old('phone') }}" 
                                       placeholder="+254 700 000000" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                            </div>

                            <div>
                                <label for="country" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Country
                                </label>
                                <input type="text" 
                                       id="country" 
                                       name="country" 
                                       value="{{ old('country', 'Kenya') }}" 
                                       placeholder="e.g., Kenya, Uganda, Tanzania" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                            </div>

                            <div>
                                <label for="location" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Delivery City / Site Location
                                </label>
                                <input type="text" 
                                       id="location" 
                                       name="location" 
                                       value="{{ old('location') }}" 
                                       placeholder="e.g., Nairobi Industrial Area / Mombasa" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Product & Quantity Requirements -->
                    <div>
                        <h2 class="text-lg font-black text-slate-900 border-b border-slate-100 pb-3 mb-5 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-md bg-sky-100 text-sky-700 text-xs flex items-center justify-center font-mono">2</span>
                            Product &amp; Specification Requirements
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="sm:col-span-2">
                                <label for="product_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Select Product
                                </label>
                                <select id="product_id" 
                                        name="product_id" 
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none bg-white">
                                    <option value="">-- General / Multiple Product Inquiry --</option>
                                    @foreach($products as $p)
                                        <option value="{{ $p->id }}" {{ (old('product_id', $selectedProduct?->id) == $p->id) ? 'selected' : '' }}>
                                            {{ $p->name }} ({{ $p->category->name ?? 'Industrial' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="quantity" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Estimated Quantity
                                </label>
                                <input type="number" 
                                       step="any" 
                                       id="quantity" 
                                       name="quantity" 
                                       value="{{ old('quantity') }}" 
                                       placeholder="e.g., 500" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                            </div>

                            <div>
                                <label for="preferred_unit" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Unit of Measure
                                </label>
                                <select id="preferred_unit" 
                                        name="preferred_unit" 
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none bg-white">
                                    <option value="Pieces / Units" {{ old('preferred_unit') == 'Pieces / Units' ? 'selected' : '' }}>Pieces / Units</option>
                                    <option value="Meters (Lengths)" {{ old('preferred_unit') == 'Meters (Lengths)' ? 'selected' : '' }}>Meters (Lengths)</option>
                                    <option value="Square Meters (m²)" {{ old('preferred_unit') == 'Square Meters (m²)' ? 'selected' : '' }}>Square Meters (m²)</option>
                                    <option value="Rolls / Bundles" {{ old('preferred_unit') == 'Rolls / Bundles' ? 'selected' : '' }}>Rolls / Bundles</option>
                                    <option value="Cartons / Boxes" {{ old('preferred_unit') == 'Cartons / Boxes' ? 'selected' : '' }}>Cartons / Boxes</option>
                                    <option value="Containers / Pallets" {{ old('preferred_unit') == 'Containers / Pallets' ? 'selected' : '' }}>Containers / Pallets</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Message & Technical Attachment -->
                    <div>
                        <h2 class="text-lg font-black text-slate-900 border-b border-slate-100 pb-3 mb-5 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-md bg-sky-100 text-sky-700 text-xs flex items-center justify-center font-mono">3</span>
                            Technical Message &amp; Documents
                        </h2>

                        <div class="space-y-5">
                            <div>
                                <label for="message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    Project Notes / Specifications / Schedule
                                </label>
                                <textarea id="message" 
                                          name="message" 
                                          rows="4" 
                                          placeholder="Detail any custom thickness, pressure classes, wall types, project delivery deadlines, or specific requirements..." 
                                          class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">{{ old('message') }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="attachment" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                        Upload Spec Sheet / Bill of Quantities (PDF, DOCX, XLSX, Images - Max 10MB)
                                    </label>
                                    <input type="file" 
                                           id="attachment" 
                                           name="attachment" 
                                           class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                        Preferred Contact Method <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="grid grid-cols-3 gap-2">
                                        <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 cursor-pointer text-xs font-semibold hover:bg-slate-50">
                                            <input type="radio" name="preferred_contact_method" value="Email" {{ old('preferred_contact_method', 'Email') == 'Email' ? 'checked' : '' }} class="text-sky-600 focus:ring-sky-500">
                                            <span>Email</span>
                                        </label>
                                        <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 cursor-pointer text-xs font-semibold hover:bg-slate-50">
                                            <input type="radio" name="preferred_contact_method" value="WhatsApp" {{ old('preferred_contact_method') == 'WhatsApp' ? 'checked' : '' }} class="text-sky-600 focus:ring-sky-500">
                                            <span>WhatsApp</span>
                                        </label>
                                        <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 cursor-pointer text-xs font-semibold hover:bg-slate-50">
                                            <input type="radio" name="preferred_contact_method" value="Phone" {{ old('preferred_contact_method') == 'Phone' ? 'checked' : '' }} class="text-sky-600 focus:ring-sky-500">
                                            <span>Phone</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <p class="text-xs text-slate-500">
                            Your inquiry is encrypted and delivered directly to the sales division.
                        </p>
                        <button type="submit" 
                                class="px-8 py-4 rounded-xl bg-gradient-to-r from-sky-600 to-blue-700 hover:from-sky-500 hover:to-blue-600 text-white font-bold text-sm shadow-lg shadow-sky-600/30 transition-all transform hover:-translate-y-0.5">
                            Submit Quotation Request &rarr;
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
