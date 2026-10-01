@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header_title', 'Manufacturing Control & Operations Overview')

@section('content')
    <div class="space-y-8">
        <!-- KPI Metrics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Products -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Catalog Products</span>
                    <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['total_products'] }}</p>
                    <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-sky-600 hover:underline mt-2 inline-block">
                        Manage Catalog &rarr;
                    </a>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center border border-sky-100">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>

            <!-- Categories -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Product Categories</span>
                    <p class="text-3xl font-black text-slate-900 mt-1">{{ $stats['total_categories'] }}</p>
                    <a href="{{ route('admin.categories.index') }}" class="text-xs font-semibold text-sky-600 hover:underline mt-2 inline-block">
                        Manage Categories &rarr;
                    </a>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </div>
            </div>

            <!-- New Quotations -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">New Quotations</span>
                    <p class="text-3xl font-black text-rose-600 mt-1">{{ $stats['new_quotes'] }}</p>
                    <span class="text-xs text-slate-500 mt-2 inline-block">Total {{ $stats['total_quotes'] }} submissions</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center border border-rose-100">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>

            <!-- Inquiries -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/90 shadow-xs flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Unread Messages</span>
                    <p class="text-3xl font-black text-amber-600 mt-1">{{ $stats['new_messages'] }}</p>
                    <a href="{{ route('admin.messages.index') }}" class="text-xs font-semibold text-sky-600 hover:underline mt-2 inline-block">
                        View Inbox &rarr;
                    </a>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Quick Action Shortcuts -->
        <div class="bg-gradient-to-r from-slate-900 to-slate-950 rounded-3xl p-6 text-white shadow-md flex flex-wrap items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-base">Quick Catalog &amp; Operations Shortcuts</h3>
                <p class="text-xs text-slate-400 mt-0.5">Quickly publish products, update company phone/WhatsApp, or process client quotations.</p>
            </div>
            <div class="flex flex-wrap gap-2.5">
                <a href="{{ route('admin.products.create') }}" class="px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-xs transition-colors">
                    + Add New Product
                </a>
                <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-semibold text-xs transition-colors">
                    + New Category
                </a>
                <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-semibold text-xs transition-colors">
                    Edit Settings
                </a>
            </div>
        </div>

        <!-- Recent Quotations & Inquiries Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Recent Quotes -->
            <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h3 class="font-black text-slate-900 text-lg">Recent Quotation Inquiries</h3>
                        <p class="text-xs text-slate-500">Live feed of product quote requests submitted from website</p>
                    </div>
                    <a href="{{ route('admin.quotes.index') }}" class="text-xs font-bold text-sky-600 hover:underline">
                        View All ({{ $stats['total_quotes'] }}) &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                <th class="py-3 px-2">Ref Code</th>
                                <th class="py-3 px-2">Client / Company</th>
                                <th class="py-3 px-2">Product</th>
                                <th class="py-3 px-2">Status</th>
                                <th class="py-3 px-2 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentQuotes as $quote)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="py-3 px-2 font-mono font-bold text-sky-700">
                                        <a href="{{ route('admin.quotes.show', $quote->id) }}" class="hover:underline">
                                            {{ $quote->quote_number }}
                                        </a>
                                    </td>
                                    <td class="py-3 px-2">
                                        <p class="font-bold text-slate-900">{{ $quote->full_name }}</p>
                                        <p class="text-[11px] text-slate-500">{{ $quote->company_name ?: 'Individual' }}</p>
                                    </td>
                                    <td class="py-3 px-2">
                                        <p class="font-medium text-slate-800">{{ $quote->product_name ?: 'Multiple Items' }}</p>
                                        @if($quote->quantity)
                                            <p class="text-[11px] text-slate-500">{{ $quote->quantity }} {{ $quote->preferred_unit }}</p>
                                        @endif
                                    </td>
                                    <td class="py-3 px-2">
                                        <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $quote->status_badge_class }}">
                                            {{ $quote->status }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-2 text-right">
                                        <a href="{{ route('admin.quotes.show', $quote->id) }}" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-sky-50 text-slate-700 hover:text-sky-700 font-semibold transition-colors">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-400">
                                        No quotation requests received yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Messages -->
            <div class="lg:col-span-4 bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div>
                        <h3 class="font-black text-slate-900 text-lg">Contact Inquiries</h3>
                        <p class="text-xs text-slate-500">Recent messages</p>
                    </div>
                    <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-sky-600 hover:underline">
                        View All &rarr;
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($recentMessages as $msg)
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 space-y-1.5 hover:border-sky-200 transition-colors">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-900 text-xs">{{ $msg->name }}</span>
                                <span class="text-[10px] font-semibold text-slate-400">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs font-medium text-slate-700 truncate">{{ $msg->subject ?: 'General inquiry' }}</p>
                            <p class="text-[11px] text-slate-500 line-clamp-2">{{ $msg->message }}</p>
                            <div class="pt-1 flex items-center justify-between">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $msg->status_badge_class }}">
                                    {{ $msg->status }}
                                </span>
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="text-xs font-semibold text-sky-600 hover:underline">
                                    Read &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="py-6 text-center text-slate-400 text-xs">No contact messages received.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
