@php
    $newQuotesCount = \App\Models\QuoteRequest::where('status', \App\Models\QuoteRequest::STATUS_NEW)->count();
    $newMessagesCount = \App\Models\ContactMessage::where('status', \App\Models\ContactMessage::STATUS_NEW)->count();
    $user = auth()->user();
@endphp

<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <ul role="list" class="-mx-2 space-y-1">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="group flex gap-x-3 rounded-xl p-2.5 text-xs font-bold leading-6 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Quotation Requests -->
                <li>
                    <a href="{{ route('admin.quotes.index') }}" 
                       class="group flex items-center justify-between rounded-xl p-2.5 text-xs font-bold leading-6 transition-colors {{ request()->routeIs('admin.quotes.*') ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                        <div class="flex items-center gap-x-3">
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Quotations</span>
                        </div>
                        @if($newQuotesCount > 0)
                            <span class="inline-flex items-center rounded-full bg-rose-500 px-2 py-0.5 text-[10px] font-bold text-white">
                                {{ $newQuotesCount }}
                            </span>
                        @endif
                    </a>
                </li>

                <!-- Messages -->
                <li>
                    <a href="{{ route('admin.messages.index') }}" 
                       class="group flex items-center justify-between rounded-xl p-2.5 text-xs font-bold leading-6 transition-colors {{ request()->routeIs('admin.messages.*') ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                        <div class="flex items-center gap-x-3">
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <span>Inquiries</span>
                        </div>
                        @if($newMessagesCount > 0)
                            <span class="inline-flex items-center rounded-full bg-amber-500 px-2 py-0.5 text-[10px] font-bold text-slate-950">
                                {{ $newMessagesCount }}
                            </span>
                        @endif
                    </a>
                </li>
            </ul>
        </li>

        <!-- Product Catalog Section -->
        <li>
            <div class="text-[10px] font-extrabold uppercase tracking-widest text-slate-500 px-2 mb-2">
                Product Catalog
            </div>
            <ul role="list" class="-mx-2 space-y-1">
                <li>
                    <a href="{{ route('admin.products.index') }}" 
                       class="group flex gap-x-3 rounded-xl p-2.5 text-xs font-bold leading-6 transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span>All Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" 
                       class="group flex gap-x-3 rounded-xl p-2.5 text-xs font-bold leading-6 transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.applications.index') }}" 
                       class="group flex gap-x-3 rounded-xl p-2.5 text-xs font-bold leading-6 transition-colors {{ request()->routeIs('admin.applications.*') ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span>Applications</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.gallery.index') }}" 
                       class="group flex gap-x-3 rounded-xl p-2.5 text-xs font-bold leading-6 transition-colors {{ request()->routeIs('admin.gallery.*') ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Media Gallery</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- CMS Content Management -->
        <li>
            <div class="text-[10px] font-extrabold uppercase tracking-widest text-slate-500 px-2 mb-2">
                Website Content CMS
            </div>
            <ul role="list" class="-mx-2 space-y-1">
                <li>
                    <a href="{{ route('admin.homepage.index') }}" 
                       class="group flex gap-x-3 rounded-xl p-2.5 text-xs font-bold leading-6 transition-colors {{ request()->routeIs('admin.homepage.*') ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Homepage Slides &amp; Features</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.manufacturing.index') }}" 
                       class="group flex gap-x-3 rounded-xl p-2.5 text-xs font-bold leading-6 transition-colors {{ request()->routeIs('admin.manufacturing.*') ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                        <span>Production Flow &amp; Values</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- System Administration -->
        <li class="mt-auto">
            <div class="text-[10px] font-extrabold uppercase tracking-widest text-slate-500 px-2 mb-2">
                Administration
            </div>
            <ul role="list" class="-mx-2 space-y-1">
                @if($user->canManageSettings())
                    <li>
                        <a href="{{ route('admin.settings.index') }}" 
                           class="group flex gap-x-3 rounded-xl p-2.5 text-xs font-bold leading-6 transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Company Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" 
                           class="group flex gap-x-3 rounded-xl p-2.5 text-xs font-bold leading-6 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-sky-600 text-white shadow-sm' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>Staff Accounts</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>
</nav>
