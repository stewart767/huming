@extends('layouts.admin')

@section('title', 'Manufacturing CMS')
@section('header_title', 'Production Process Steps & Values CMS')

@section('content')
    <div class="space-y-12" x-data="{ procOpen: false, valOpen: false }">
        <!-- 1. Production Process Steps -->
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-black text-slate-900">1. Production &amp; Manufacturing Steps</h2>
                    <p class="text-xs text-slate-500">Edit the sequential production phases displayed on the Manufacturing page</p>
                </div>
                <button type="button" @click="procOpen = !procOpen" class="px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-xs transition-colors">
                    + Add Step
                </button>
            </div>

            <div x-show="procOpen" x-cloak class="bg-white rounded-3xl border border-sky-200 p-6 shadow-md space-y-4">
                <form action="{{ route('admin.manufacturing.processes.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Step # <span class="text-rose-500">*</span></label>
                            <input type="number" name="step_number" required value="{{ $processes->count() + 1 }}" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                        </div>
                        <div class="sm:col-span-3">
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Step Title <span class="text-rose-500">*</span></label>
                            <input type="text" name="title" required placeholder="e.g. Raw Material Selection & Lab QC" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Step Description <span class="text-rose-500">*</span></label>
                        <textarea name="description" rows="2" required placeholder="Describe technical operations in this phase..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none"></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="procOpen = false" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Cancel</button>
                        <button type="submit" class="px-6 py-2 rounded-xl bg-sky-600 text-white font-bold text-xs shadow-xs">Save Step</button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($processes as $p)
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 space-y-2 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-7 h-7 rounded-lg bg-sky-100 text-sky-700 font-mono font-bold text-xs flex items-center justify-center">
                                    0{{ $p->step_number }}
                                </span>
                                <h4 class="font-bold text-slate-900 text-sm">{{ $p->title }}</h4>
                            </div>
                            <p class="text-xs text-slate-600 leading-relaxed">{{ $p->description }}</p>
                        </div>
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-end">
                            <form action="{{ route('admin.manufacturing.processes.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Delete step?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold text-[11px]">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 2. Company Values Section -->
        <div class="space-y-6 pt-6 border-t border-slate-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-black text-slate-900">2. Core Company Values</h2>
                    <p class="text-xs text-slate-500">Manage foundational corporate pillars displayed on the About page</p>
                </div>
                <button type="button" @click="valOpen = !valOpen" class="px-4 py-2 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-xs transition-colors">
                    + Add Value
                </button>
            </div>

            <div x-show="valOpen" x-cloak class="bg-white rounded-3xl border border-sky-200 p-6 shadow-md space-y-4">
                <form action="{{ route('admin.manufacturing.values.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Value Title <span class="text-rose-500">*</span></label>
                            <input type="text" name="title" required placeholder="e.g. Sustainable Manufacturing" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Sort Order</label>
                            <input type="number" name="sort_order" value="0" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Description <span class="text-rose-500">*</span></label>
                        <textarea name="description" rows="2" required placeholder="Description..." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none"></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="valOpen = false" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Cancel</button>
                        <button type="submit" class="px-6 py-2 rounded-xl bg-sky-600 text-white font-bold text-xs shadow-xs">Save Value</button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($values as $v)
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 space-y-2 flex flex-col justify-between">
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">{{ $v->title }}</h4>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $v->description }}</p>
                        </div>
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-slate-400 font-mono">Order: {{ $v->sort_order }}</span>
                            <form action="{{ route('admin.manufacturing.values.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Delete value?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-bold text-[11px]">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
