@extends('layouts.admin')

@section('title', 'Quotation Requests')
@section('header_title', 'Client Quotation Requests')

@section('content')
    <div class="space-y-6">
        <!-- Status Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 flex-wrap">
            <a href="{{ route('admin.quotes.index') }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ !request('status') ? 'bg-slate-900 text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-50 border border-slate-200' }}">
                All ({{ $counts['all'] }})
            </a>
            <a href="{{ route('admin.quotes.index', ['status' => 'new']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ request('status') == 'new' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-blue-700 hover:bg-blue-50 border border-slate-200' }}">
                New ({{ $counts['new'] }})
            </a>
            <a href="{{ route('admin.quotes.index', ['status' => 'reviewing']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ request('status') == 'reviewing' ? 'bg-amber-600 text-white shadow-sm' : 'bg-white text-amber-700 hover:bg-amber-50 border border-slate-200' }}">
                Reviewing ({{ $counts['reviewing'] }})
            </a>
            <a href="{{ route('admin.quotes.index', ['status' => 'contacted']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ request('status') == 'contacted' ? 'bg-purple-600 text-white shadow-sm' : 'bg-white text-purple-700 hover:bg-purple-50 border border-slate-200' }}">
                Contacted ({{ $counts['contacted'] }})
            </a>
            <a href="{{ route('admin.quotes.index', ['status' => 'quoted']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ request('status') == 'quoted' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-white text-indigo-700 hover:bg-indigo-50 border border-slate-200' }}">
                Quoted ({{ $counts['quoted'] }})
            </a>
            <a href="{{ route('admin.quotes.index', ['status' => 'completed']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ request('status') == 'completed' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white text-emerald-700 hover:bg-emerald-50 border border-slate-200' }}">
                Completed ({{ $counts['completed'] }})
            </a>
        </div>

        <!-- Search Bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <form action="{{ route('admin.quotes.index') }}" method="GET" class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by quote number, name, company, email, or product..." class="flex-1 px-4 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                <button type="submit" class="px-6 py-2 bg-sky-600 hover:bg-sky-500 text-white rounded-xl text-xs font-bold transition-colors">
                    Search
                </button>
            </form>
        </div>

        <!-- Quotes Table -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider border-b border-slate-200 font-bold">
                        <tr>
                            <th class="py-3.5 px-4">Ref Number</th>
                            <th class="py-3.5 px-4">Customer / Company</th>
                            <th class="py-3.5 px-4">Product Details</th>
                            <th class="py-3.5 px-4">Contact Method</th>
                            <th class="py-3.5 px-4">Date</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($quotes as $quote)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="py-3.5 px-4 font-mono font-bold text-sky-700">
                                    <a href="{{ route('admin.quotes.show', $quote->id) }}" class="hover:underline">
                                        {{ $quote->quote_number }}
                                    </a>
                                </td>
                                <td class="py-3.5 px-4">
                                    <p class="font-bold text-slate-900 text-sm">{{ $quote->full_name }}</p>
                                    <p class="text-[11px] text-slate-500">{{ $quote->company_name ?: 'Individual' }} &bull; {{ $quote->email }}</p>
                                </td>
                                <td class="py-3.5 px-4">
                                    <p class="font-semibold text-slate-800">{{ $quote->product_name ?: 'Multiple Items' }}</p>
                                    @if($quote->quantity)
                                        <p class="text-[11px] text-slate-500">{{ $quote->quantity }} {{ $quote->preferred_unit }}</p>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center gap-1 font-semibold text-slate-700">
                                        {{ $quote->preferred_contact_method }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-slate-500">
                                    {{ $quote->created_at->format('M d, Y') }}
                                    <span class="block text-[10px] text-slate-400">{{ $quote->created_at->format('h:i A') }}</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $quote->status_badge_class }}">
                                        {{ $quote->status }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-right space-x-2">
                                    @if($quote->attachment)
                                        <a href="{{ route('admin.quotes.download', $quote->id) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-sky-600 hover:bg-sky-50 transition-colors inline-block" title="Download Attached Spec Doc">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.quotes.show', $quote->id) }}" class="px-2.5 py-1 rounded-lg bg-sky-50 text-sky-700 hover:bg-sky-100 font-bold transition-colors inline-block">
                                        Manage
                                    </a>
                                    <form action="{{ route('admin.quotes.destroy', $quote->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this quote request?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 transition-colors" title="Delete">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    No quotation requests found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($quotes->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $quotes->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
