@extends('layouts.admin')

@section('title', 'Company Settings')
@section('header_title', 'Company Profile & Website Settings CMS')

@section('content')
    <div class="max-w-4xl space-y-6">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- 1. General & Branding -->
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-8 space-y-5">
                <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-md bg-sky-100 text-sky-700 text-xs flex items-center justify-center font-mono">1</span>
                    Corporate Identity &amp; Branding
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="company_name" class="block text-xs font-bold text-slate-700 uppercase mb-2">Company Name</label>
                        <input type="text" id="company_name" name="company_name" value="{{ \App\Models\Setting::get('company_name', 'HUMING INTERNATIONAL LIMITED') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label for="company_tagline" class="block text-xs font-bold text-slate-700 uppercase mb-2">Tagline / Slogan</label>
                        <input type="text" id="company_tagline" name="company_tagline" value="{{ \App\Models\Setting::get('company_tagline', 'Manufacturing Quality. Building the Future.') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                </div>

                <div>
                    <label for="site_description" class="block text-xs font-bold text-slate-700 uppercase mb-2">Global Meta Description</label>
                    <textarea id="site_description" name="site_description" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">{{ \App\Models\Setting::get('site_description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2 border-t border-slate-100">
                    <div>
                        <label for="logo" class="block text-xs font-bold text-slate-700 uppercase mb-2">Upload Custom Logo</label>
                        <input type="file" id="logo" name="logo" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700">
                    </div>
                    <div>
                        <label for="favicon" class="block text-xs font-bold text-slate-700 uppercase mb-2">Upload Favicon</label>
                        <input type="file" id="favicon" name="favicon" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700">
                    </div>
                </div>
            </div>

            <!-- 2. Contact Details & Social -->
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-8 space-y-5">
                <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-md bg-sky-100 text-sky-700 text-xs flex items-center justify-center font-mono">2</span>
                    Contact Coordinates &amp; Quotation Notifications
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="company_email" class="block text-xs font-bold text-slate-700 uppercase mb-2">Public Email</label>
                        <input type="email" id="company_email" name="company_email" value="{{ \App\Models\Setting::get('company_email') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label for="quote_notification_email" class="block text-xs font-bold text-slate-700 uppercase mb-2">Quotation Alert Email</label>
                        <input type="email" id="quote_notification_email" name="quote_notification_email" value="{{ \App\Models\Setting::get('quote_notification_email') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label for="company_phone" class="block text-xs font-bold text-slate-700 uppercase mb-2">Primary Phone</label>
                        <input type="text" id="company_phone" name="company_phone" value="{{ \App\Models\Setting::get('company_phone') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label for="company_whatsapp" class="block text-xs font-bold text-slate-700 uppercase mb-2">WhatsApp Number (e.g. +254700000000)</label>
                        <input type="text" id="company_whatsapp" name="company_whatsapp" value="{{ \App\Models\Setting::get('company_whatsapp') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="company_address" class="block text-xs font-bold text-slate-700 uppercase mb-2">Physical Plant / Office Address</label>
                        <input type="text" id="company_address" name="company_address" value="{{ \App\Models\Setting::get('company_address') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label for="working_hours" class="block text-xs font-bold text-slate-700 uppercase mb-2">Working Hours</label>
                        <input type="text" id="working_hours" name="working_hours" value="{{ \App\Models\Setting::get('working_hours') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                </div>

                <div>
                    <label for="google_maps_embed" class="block text-xs font-bold text-slate-700 uppercase mb-2">Google Maps Embed URL</label>
                    <input type="text" id="google_maps_embed" name="google_maps_embed" value="{{ \App\Models\Setting::get('google_maps_embed') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                </div>

                <!-- Social Links -->
                <div class="pt-4 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="facebook_url" class="block text-xs font-bold text-slate-700 uppercase mb-2">Facebook URL</label>
                        <input type="text" id="facebook_url" name="facebook_url" value="{{ \App\Models\Setting::get('facebook_url') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label for="instagram_url" class="block text-xs font-bold text-slate-700 uppercase mb-2">Instagram URL</label>
                        <input type="text" id="instagram_url" name="instagram_url" value="{{ \App\Models\Setting::get('instagram_url') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label for="linkedin_url" class="block text-xs font-bold text-slate-700 uppercase mb-2">LinkedIn URL</label>
                        <input type="text" id="linkedin_url" name="linkedin_url" value="{{ \App\Models\Setting::get('linkedin_url') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label for="youtube_url" class="block text-xs font-bold text-slate-700 uppercase mb-2">YouTube URL</label>
                        <input type="text" id="youtube_url" name="youtube_url" value="{{ \App\Models\Setting::get('youtube_url') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                </div>
            </div>

            <!-- 3. Company Vision, Mission & Narrative -->
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-8 space-y-5">
                <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-md bg-sky-100 text-sky-700 text-xs flex items-center justify-center font-mono">3</span>
                    Company Overview, Vision &amp; Quality Text
                </h3>

                <div>
                    <label for="company_overview" class="block text-xs font-bold text-slate-700 uppercase mb-2">Full Company Overview</label>
                    <textarea id="company_overview" name="company_overview" rows="4" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">{{ \App\Models\Setting::get('company_overview') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="company_vision" class="block text-xs font-bold text-slate-700 uppercase mb-2">Company Vision</label>
                        <textarea id="company_vision" name="company_vision" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">{{ \App\Models\Setting::get('company_vision') }}</textarea>
                    </div>
                    <div>
                        <label for="company_mission" class="block text-xs font-bold text-slate-700 uppercase mb-2">Company Mission</label>
                        <textarea id="company_mission" name="company_mission" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">{{ \App\Models\Setting::get('company_mission') }}</textarea>
                    </div>
                </div>

                <div>
                    <label for="footer_about" class="block text-xs font-bold text-slate-700 uppercase mb-2">Footer Summary</label>
                    <textarea id="footer_about" name="footer_about" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">{{ \App\Models\Setting::get('footer_about') }}</textarea>
                </div>

                <div>
                    <label for="quality_control_text" class="block text-xs font-bold text-slate-700 uppercase mb-2">Quality Control &amp; Testing Policy Statement</label>
                    <textarea id="quality_control_text" name="quality_control_text" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:ring-2 focus:ring-sky-500 outline-none">{{ \App\Models\Setting::get('quality_control_text') }}</textarea>
                </div>
            </div>

            <!-- 4. Statistics Management -->
            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-xs p-6 sm:p-8 space-y-5">
                <h3 class="font-black text-slate-900 text-base border-b border-slate-100 pb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-md bg-sky-100 text-sky-700 text-xs flex items-center justify-center font-mono">4</span>
                    Statistics Ribbon (Only Display Real/Configured Claims)
                </h3>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div>
                        <label for="stat_experience" class="block text-xs font-bold text-slate-700 uppercase mb-1">Experience</label>
                        <input type="text" id="stat_experience" name="stat_experience" value="{{ \App\Models\Setting::get('stat_experience', '10+') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-mono font-bold outline-none">
                    </div>
                    <div>
                        <label for="stat_products" class="block text-xs font-bold text-slate-700 uppercase mb-1">Product Lines</label>
                        <input type="text" id="stat_products" name="stat_products" value="{{ \App\Models\Setting::get('stat_products', '50+') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-mono font-bold outline-none">
                    </div>
                    <div>
                        <label for="stat_projects" class="block text-xs font-bold text-slate-700 uppercase mb-1">Projects Supplied</label>
                        <input type="text" id="stat_projects" name="stat_projects" value="{{ \App\Models\Setting::get('stat_projects', '500+') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-mono font-bold outline-none">
                    </div>
                    <div>
                        <label for="stat_capacity" class="block text-xs font-bold text-slate-700 uppercase mb-1">QC Tested Rate</label>
                        <input type="text" id="stat_capacity" name="stat_capacity" value="{{ \App\Models\Setting::get('stat_capacity', '100%') }}" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-mono font-bold outline-none">
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-8 py-4 rounded-xl bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm shadow-md transition-colors">
                    Save All Company Settings
                </button>
            </div>
        </form>
    </div>
@endsection
