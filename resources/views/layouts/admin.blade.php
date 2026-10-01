<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') — {{ \App\Models\Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-900" x-data="{ sidebarOpen: false }">
    <div class="min-h-full flex">
        <!-- Off-canvas sidebar for mobile -->
        <div x-show="sidebarOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-cloak>
            <div class="fixed inset-0 bg-slate-900/80 backdrop-blur-xs transition-opacity" @click="sidebarOpen = false"></div>

            <div class="fixed inset-0 flex">
                <div class="relative mr-16 flex w-full max-w-xs flex-1">
                    <div class="absolute top-0 left-full flex w-16 justify-center pt-5">
                        <button type="button" @click="sidebarOpen = false" class="-m-2.5 p-2.5 text-white">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Mobile Sidebar Content -->
                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-slate-900 px-6 pb-4">
                        <div class="flex h-16 shrink-0 items-center border-b border-slate-800">
                            <span class="text-white font-black tracking-wider text-base">HUMING CMS</span>
                        </div>
                        @include('admin.partials.sidebar-nav')
                    </div>
                </div>
            </div>
        </div>

        <!-- Static desktop sidebar -->
        <aside class="hidden lg:fixed lg:inset-y-0 lg:z-40 lg:flex lg:w-72 lg:flex-col border-r border-slate-800 bg-slate-950">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto px-6 pb-6">
                <!-- Brand -->
                <div class="flex h-20 shrink-0 items-center justify-between border-b border-slate-800">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white font-black shadow-md">
                            H
                        </div>
                        <div>
                            <span class="text-sm font-black tracking-wider text-white uppercase block">HUMING CMS</span>
                            <span class="text-[10px] font-semibold text-slate-400 tracking-wider uppercase block">Industrial Control</span>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                @include('admin.partials.sidebar-nav')
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="lg:pl-72 flex flex-col flex-1 min-w-0">
            <!-- Top Header Navbar -->
            <header class="sticky top-0 z-30 flex h-16 shrink-0 items-center justify-between gap-x-4 border-b border-slate-200 bg-white px-4 sm:px-6 lg:px-8 shadow-2xs">
                <button type="button" @click="sidebarOpen = true" class="-m-2.5 p-2.5 text-slate-700 lg:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <div class="flex items-center gap-3">
                    <h1 class="text-base font-bold text-slate-800 truncate">
                        @yield('header_title', 'Management Dashboard')
                    </h1>
                </div>

                <div class="flex items-center gap-x-4 lg:gap-x-6">
                    <!-- Live Public Site link -->
                    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-sky-700 bg-sky-50 hover:bg-sky-100 border border-sky-200 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span>View Website</span>
                    </a>

                    <!-- User Profile & Logout -->
                    <div class="flex items-center gap-3 border-l border-slate-200 pl-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold text-slate-900">{{ auth()->user()->name }}</p>
                            <span class="inline-block px-1.5 py-0.5 rounded text-[10px] font-bold uppercase bg-slate-100 text-slate-700">
                                {{ str_replace('_', ' ', auth()->user()->role) }}
                            </span>
                        </div>

                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="p-2 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Logout">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Alerts -->
            <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-3 rounded-2xl flex items-center justify-between shadow-xs mb-6">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-sm font-semibold">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-rose-50 border border-rose-300 text-rose-800 px-4 py-3 rounded-2xl flex items-center justify-between shadow-xs mb-6">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-rose-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            <span class="text-sm font-semibold">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Page Body -->
            <main class="flex-1 py-6 px-4 sm:px-6 lg:px-8 max-w-7xl w-full mx-auto">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
