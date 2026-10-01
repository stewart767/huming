@extends('layouts.admin')

@section('title', 'Industry Applications')
@section('header_title', 'Industry & Building Applications')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-slate-900">Building Applications ({{ $applications->count() }})</h2>
                <p class="text-xs text-slate-500">Manage application categories connected to manufactured products</p>
            </div>
            <a href="{{ route('admin.applications.create') }}" class="px-4 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-sm transition-colors">
                + Create Application
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs overflow-hidden">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider border-b border-slate-200 font-bold">
                    <tr>
                        <th class="py-3.5 px-4">Image</th>
                        <th class="py-3.5 px-4">Title</th>
                        <th class="py-3.5 px-4">Slug</th>
                        <th class="py-3.5 px-4">Linked Products</th>
                        <th class="py-3.5 px-4">Sort Order</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($applications as $app)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3 px-4">
                                <img src="{{ $app->image_url }}" alt="{{ $app->title }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200">
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.applications.edit', $app->id) }}" class="font-bold text-slate-900 hover:text-sky-600 block text-sm">
                                    {{ $app->title }}
                                </a>
                                <p class="text-[11px] text-slate-500 line-clamp-1">{{ $app->description }}</p>
                            </td>
                            <td class="py-3 px-4 font-mono text-slate-600">
                                /{{ $app->slug }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 rounded-md bg-sky-50 text-sky-700 font-bold font-mono">
                                    {{ $app->products_count }} Products
                                </span>
                            </td>
                            <td class="py-3 px-4 font-semibold text-slate-700">
                                {{ $app->sort_order }}
                            </td>
                            <td class="py-3 px-4 text-right space-x-2">
                                <a href="{{ route('admin.applications.edit', $app->id) }}" class="p-1.5 rounded-lg text-slate-600 hover:text-sky-600 hover:bg-sky-50 transition-colors inline-block" title="Edit">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.applications.destroy', $app->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this application category?');">
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
                            <td colspan="6" class="py-8 text-center text-slate-400">No applications created.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
