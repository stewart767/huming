@extends('layouts.admin')

@section('title', 'Contact Inquiries')
@section('header_title', 'Customer & Business Contact Messages')

@section('content')
    <div class="space-y-6">
        <!-- Status Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-2 flex-wrap">
            <a href="{{ route('admin.messages.index') }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ !request('status') ? 'bg-slate-900 text-white shadow-sm' : 'bg-white text-slate-700 hover:bg-slate-50 border border-slate-200' }}">
                All ({{ $counts['all'] }})
            </a>
            <a href="{{ route('admin.messages.index', ['status' => 'new']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ request('status') == 'new' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-blue-700 hover:bg-blue-50 border border-slate-200' }}">
                New ({{ $counts['new'] }})
            </a>
            <a href="{{ route('admin.messages.index', ['status' => 'read']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ request('status') == 'read' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white text-emerald-700 hover:bg-emerald-50 border border-slate-200' }}">
                Read ({{ $counts['read'] }})
            </a>
            <a href="{{ route('admin.messages.index', ['status' => 'replied']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ request('status') == 'replied' ? 'bg-purple-600 text-white shadow-sm' : 'bg-white text-purple-700 hover:bg-purple-50 border border-slate-200' }}">
                Replied ({{ $counts['replied'] }})
            </a>
            <a href="{{ route('admin.messages.index', ['status' => 'archived']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors {{ request('status') == 'archived' ? 'bg-gray-600 text-white shadow-sm' : 'bg-white text-gray-700 hover:bg-gray-50 border border-slate-200' }}">
                Archived ({{ $counts['archived'] }})
            </a>
        </div>

        <!-- Search Bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/90 shadow-xs">
            <form action="{{ route('admin.messages.index') }}" method="GET" class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, phone, subject, or message text..." class="flex-1 px-4 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                <button type="submit" class="px-6 py-2 bg-sky-600 hover:bg-sky-500 text-white rounded-xl text-xs font-bold transition-colors">
                    Search
                </button>
            </form>
        </div>

        <!-- Messages Table -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider border-b border-slate-200 font-bold">
                        <tr>
                            <th class="py-3.5 px-4">Sender</th>
                            <th class="py-3.5 px-4">Subject &amp; Message Snippet</th>
                            <th class="py-3.5 px-4">Date</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($messages as $msg)
                            <tr class="hover:bg-slate-50 transition-colors {{ $msg->status === 'new' ? 'bg-sky-50/40 font-semibold' : '' }}">
                                <td class="py-3.5 px-4">
                                    <p class="font-bold text-slate-900 text-sm">{{ $msg->name }}</p>
                                    <p class="text-[11px] text-slate-500">{{ $msg->email }} &bull; {{ $msg->phone ?: 'No phone' }}</p>
                                </td>
                                <td class="py-3.5 px-4 max-w-md">
                                    <p class="font-bold text-slate-900">{{ $msg->subject ?: 'No subject' }}</p>
                                    <p class="text-[11px] text-slate-500 line-clamp-1 mt-0.5">{{ $msg->message }}</p>
                                </td>
                                <td class="py-3.5 px-4 text-slate-500">
                                    {{ $msg->created_at->format('M d, Y') }}
                                    <span class="block text-[10px] text-slate-400">{{ $msg->created_at->format('h:i A') }}</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $msg->status_badge_class }}">
                                        {{ $msg->status }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-right space-x-2">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="px-2.5 py-1 rounded-lg bg-sky-50 text-sky-700 hover:bg-sky-100 font-bold transition-colors inline-block">
                                        Read
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this message?');">
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
                                <td colspan="5" class="py-12 text-center text-slate-400">
                                    No contact messages found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($messages->hasPages())
                <div class="p-4 border-t border-slate-100">
                    {{ $messages->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
