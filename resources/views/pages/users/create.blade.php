@extends('layouts.main')
@section('title', 'Tambah User')
@section('content')

{{-- form add user --}}
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                Tambah User
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                Isi form di bawah untuk menambahkan user baru.
            </p>
        </div>

        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nama
                    </label>
                    <input type="text" name="name" id="name" required
                        class="mt-1 block w-full rounded-md
                               bg-white dark:bg-gray-900
                               border-gray-300 dark:border-gray-700
                               text-gray-900 dark:text-gray-100
                               shadow-sm
                               focus:border-blue-500 focus:ring-blue-500
                               sm:text-sm">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="email" name="email" id="email" required
                        class="mt-1 block w-full rounded-md
                               bg-white dark:bg-gray-900
                               border-gray-300 dark:border-gray-700
                               text-gray-900 dark:text-gray-100
                               shadow-sm
                               focus:border-blue-500 focus:ring-blue-500
                               sm:text-sm">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Password
                    </label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full rounded-md
                               bg-white dark:bg-gray-900
                               border-gray-300 dark:border-gray-700
                               text-gray-900 dark:text-gray-100
                               shadow-sm
                               focus:border-blue-500 focus:ring-blue-500
                               sm:text-sm">
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Hak Akses
                    </label>
                    <select name="role" id="role" required
                        class="mt-1 block w-full rounded-md
                               bg-white dark:bg-gray-900
                               border-gray-300 dark:border-gray-700
                               text-gray-900 dark:text-gray-100
                               shadow-sm
                               focus:border-blue-500 focus:ring-blue-500
                               sm:text-sm">
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2
                               border border-transparent rounded-md shadow-sm
                               text-sm font-medium text-white
                               bg-blue-600 hover:bg-blue-700
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                               dark:focus:ring-offset-gray-800">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@php
    $breadcrumbs = [
        ['label' => 'User Management', 'url' => route('users.index')],
        ['label' => 'Tambah User', 'url' => route('users.create')],
    ];
@endphp
