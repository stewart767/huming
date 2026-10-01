@extends('layouts.admin')

@section('title', 'Staff & User Management')
@section('header_title', 'Staff & Role-Based Access Control')

@section('content')
    <div class="space-y-6" x-data="{ userModal: false, editModal: false, editUser: {} }">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-black text-slate-900">Staff Accounts ({{ $users->total() }})</h2>
                <p class="text-xs text-slate-500">Manage employee accounts and system permissions</p>
            </div>
            <button type="button" @click="userModal = true" class="px-4 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-xs shadow-sm transition-colors">
                + Add Staff User
            </button>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs overflow-hidden">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider border-b border-slate-200 font-bold">
                    <tr>
                        <th class="py-3.5 px-4">Name</th>
                        <th class="py-3.5 px-4">Email</th>
                        <th class="py-3.5 px-4">Assigned Role</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4">Created</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($users as $u)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 px-4 font-bold text-slate-900 text-sm">
                                {{ $u->name }}
                            </td>
                            <td class="py-3.5 px-4 font-mono text-slate-700">
                                {{ $u->email }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase {{ $u->role === 'super_admin' ? 'bg-purple-100 text-purple-800' : ($u->role === 'content_manager' ? 'bg-sky-100 text-sky-800' : 'bg-amber-100 text-amber-800') }}">
                                    {{ str_replace('_', ' ', $u->role) }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $u->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                    {{ $u->is_active ? 'Active' : 'Disabled' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-400">
                                {{ $u->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-2">
                                @if($u->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete staff account?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-rose-500 hover:text-rose-700 hover:bg-rose-50 transition-colors" title="Delete">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add User Modal -->
        <div x-show="userModal" x-cloak class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl space-y-5" @click.away="userModal = false">
                <h3 class="font-black text-slate-900 text-lg">Create New Staff User</h3>
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Full Name</label>
                        <input type="text" name="name" required placeholder="Jane Smith" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Email Address</label>
                        <input type="email" name="email" required placeholder="jane@huming.com" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Password</label>
                        <input type="password" name="password" required placeholder="Minimum 8 characters" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Assigned Role</label>
                        <select name="role" required class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none bg-white">
                            <option value="super_admin">Super Administrator (Full System Access)</option>
                            <option value="content_manager">Content Manager (Products, Gallery, CMS)</option>
                            <option value="sales_manager">Sales &amp; Quotation Manager (Quotes &amp; Inquiries)</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="userModal = false" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Cancel</button>
                        <button type="submit" class="px-6 py-2 rounded-xl bg-sky-600 text-white font-bold text-xs shadow-xs">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
