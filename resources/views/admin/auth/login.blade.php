<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Employee &amp; Staff Login — {{ \App\Models\Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-100 flex items-center justify-center p-4">
    <!-- Industrial grid pattern background -->
    <div class="fixed inset-0 industrial-grid-dark opacity-30 pointer-events-none"></div>

    <div class="relative w-full max-w-md bg-slate-900/90 backdrop-blur-xl border border-slate-800 rounded-3xl p-8 sm:p-10 shadow-2xl space-y-8 z-10">
        <!-- Brand Header -->
        <div class="text-center space-y-3">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-600 text-white font-black text-2xl shadow-lg shadow-sky-500/25">
                H
            </div>
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight">
                    HUMING INTERNATIONAL
                </h1>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-widest mt-0.5">
                    Staff CMS &amp; Administration
                </p>
            </div>
        </div>

        @if ($errors->any())
            <div class="p-4 rounded-2xl bg-rose-950/80 border border-rose-800 text-rose-300 text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('info'))
            <div class="p-4 rounded-2xl bg-sky-950/80 border border-sky-800 text-sky-300 text-xs">
                {{ session('info') }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                    Staff Email Address
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       required 
                       autofocus 
                       value="{{ old('email', 'admin@huming.com') }}" 
                       class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all placeholder-slate-600"
                       placeholder="admin@huming.com">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                    Password
                </label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required 
                       value="password"
                       class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition-all placeholder-slate-600"
                       placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 cursor-pointer text-slate-400 hover:text-slate-300">
                    <input type="checkbox" name="remember" class="rounded bg-slate-950 border-slate-800 text-sky-600 focus:ring-sky-500">
                    <span>Remember this workstation</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-bold text-sm shadow-lg shadow-sky-500/25 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                Sign In to CMS &rarr;
            </button>
        </form>

        <div class="pt-4 border-t border-slate-800/80 text-center text-xs text-slate-500">
            <p>Seeded accounts: <code class="text-sky-400 font-mono">admin@huming.com</code> / <code class="text-slate-400 font-mono">password</code></p>
            <a href="{{ route('home') }}" class="inline-block mt-3 text-slate-400 hover:text-white transition-colors">
                &larr; Back to Public Website
            </a>
        </div>
    </div>
</body>
</html>
