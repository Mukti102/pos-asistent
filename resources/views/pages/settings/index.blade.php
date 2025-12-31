@extends('layouts.main')

@section('content')
<div class="max-w-6xl mx-auto py-5 px-4">
    <div class="flex items-center gap-3 mb-6">
        <div class="p-3 bg-primary rounded-xl text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Pengaturan Aplikasi</h1>
    </div>

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/20">
                <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200 uppercase">Identitas Situs</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Aplikasi / Toko</label>
                    <input type="text" name="site_name" value="{{ \App\Models\Setting::get('site_name') }}" 
                           class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Slogan / Deskripsi</label>
                    <textarea name="site_description" rows="2" class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white outline-none focus:ring-2 focus:ring-blue-500">{{ \App\Models\Setting::get('site_description') }}</textarea>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-3">Logo Aplikasi</label>
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden border">
                        @if($logo = \App\Models\Setting::get('site_logo'))
                            <img src="{{ asset('storage/' . $logo) }}" class="object-contain w-full h-full">
                        @else
                            <span class="text-gray-400 text-xs text-center p-1">No Logo</span>
                        @endif
                    </div>
                    <input type="file" name="site_logo" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-3">Favicon (Icon Tab)</label>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden border">
                        @if($favicon = \App\Models\Setting::get('site_favicon'))
                            <img src="{{ asset('storage/' . $favicon) }}" class="object-contain w-full h-full">
                        @else
                            <span class="text-gray-400 text-[10px]">No Icon</span>
                        @endif
                    </div>
                    <input type="file" name="site_favicon" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl font-bold uppercase text-sm hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all active:scale-95">
                Simpan Semua Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection