@extends('layouts.admin')

@section('title', 'View Message #' . $message->id)
@section('header_title', 'Customer Inquiry: ' . ($message->subject ?: 'Message #' . $message->id))

@section('content')
    <div class="max-w-3xl space-y-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.messages.index') }}" class="text-xs font-semibold text-slate-500 hover:text-sky-600">
                &larr; Back to Inquiries List
            </a>
            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase {{ $message->status_badge_class }}">
                {{ $message->status }}
            </span>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-8 space-y-6">
            <!-- Sender Header -->
            <div class="border-b border-slate-100 pb-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="font-black text-slate-900 text-lg">{{ $message->name }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">
                        <a href="mailto:{{ $message->email }}" class="text-sky-600 hover:underline">{{ $message->email }}</a>
                        @if($message->phone)
                            &bull; <a href="tel:{{ $message->phone }}" class="text-slate-700 hover:underline">{{ $message->phone }}</a>
                        @endif
                    </p>
                </div>
                <span class="text-xs text-slate-400 font-medium">
                    Received {{ $message->created_at->format('M d, Y - h:i A') }}
                </span>
            </div>

            <!-- Subject & Body -->
            <div class="space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Subject</span>
                <p class="font-bold text-slate-900 text-base">{{ $message->subject ?: '(No Subject)' }}</p>

                <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block pt-2">Message Content</span>
                <div class="p-5 rounded-2xl bg-slate-50 text-slate-800 text-sm leading-relaxed border border-slate-100 whitespace-pre-wrap">
                    {{ $message->message }}
                </div>
            </div>

            <!-- Status & Internal Notes Form -->
            <form action="{{ route('admin.messages.update', $message->id) }}" method="POST" class="pt-6 border-t border-slate-100 space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="status" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Message Status
                        </label>
                        <select id="status" name="status" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none bg-white">
                            <option value="new" {{ $message->status == 'new' ? 'selected' : '' }}>New</option>
                            <option value="read" {{ $message->status == 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ $message->status == 'replied' ? 'selected' : '' }}>Replied</option>
                            <option value="archived" {{ $message->status == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div>
                        <label for="internal_notes" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Internal Response Notes
                        </label>
                        <input type="text" id="internal_notes" name="internal_notes" value="{{ old('internal_notes', $message->internal_notes) }}" placeholder="e.g., Called client on Oct 1, sent catalog" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="mailto:{{ $message->email }}?subject=Re:%20{{ $message->subject }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-sky-50 text-sky-700 hover:bg-sky-100 text-xs font-bold transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Reply via Email</span>
                    </a>

                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-xs transition-colors">
                        Save Status
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
