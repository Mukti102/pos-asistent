@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Pengaturan Profil</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 text-center">
                    <div class="relative inline-block">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D8ABC&color=fff"
                            alt="Avatar"
                            class="w-24 h-24 rounded-full border-4 border-blue-50 dark:border-blue-900/30 mb-4">
                        <span
                            class="absolute bottom-1 right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>
                    <h3 class="font-bold text-gray-800 dark:text-white uppercase">{{ auth()->user()->name }}</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 italic mb-4">{{ auth()->user()->role ?? 'Staff' }}
                    </p>
                    <div class="text-xs text-left py-3 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-gray-500">Email:</p>
                        <p class="dark:text-gray-300 font-medium">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 space-y-6">

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                        <h3 class="font-bold text-gray-700 dark:text-gray-200 uppercase text-sm">Update Informasi Dasar</h3>
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        @method('patch')

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}"
                                class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Alamat Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}"
                                class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow-md transition text-sm font-bold uppercase">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 bg-red-50/50 dark:bg-red-900/10">
                        <h3 class="font-bold text-red-600 dark:text-red-400 uppercase text-sm italic">Keamanan & Password
                        </h3>
                    </div>
                    <form action="{{ route('password.update') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Password Saat
                                Ini</label>
                            <input type="password" name="current_password"
                                class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-red-500 outline-none">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Password
                                    Baru</label>
                                <input type="password" name="password"
                                    class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-red-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Konfirmasi Password
                                    Baru</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full px-4 py-2 rounded-xl border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-red-500 outline-none">
                            </div>
                        </div>
                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                class="px-6 py-2 bg-gray-800 dark:bg-gray-600 text-white rounded-xl hover:bg-black shadow-md transition text-sm font-bold uppercase">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
