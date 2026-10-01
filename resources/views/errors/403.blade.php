@extends('layouts.app')

@section('content')
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-slate-50 min-h-[70vh] flex items-center justify-center">
        <div class="max-w-md w-full text-center space-y-6 bg-white p-8 sm:p-10 rounded-3xl border border-slate-200/90 shadow-xl">
            <span class="inline-block px-3 py-1 rounded-full text-xs font-mono font-bold bg-amber-50 text-amber-600 border border-amber-200">
                ERROR 403
            </span>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">
                Access Restricted
            </h1>
            <p class="text-sm text-slate-500 leading-relaxed">
                You do not have administrative privileges to view or perform operations on this section.
            </p>
            <div class="pt-4">
                <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs">
                    Return to Home
                </a>
            </div>
        </div>
    </section>
@endsection
