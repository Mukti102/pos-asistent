@extends('layouts.main')
@section('title', 'User Management')
@section('content')
    <div class="">
        <div class="max-w-7xl mx-auto py-6">
            <div class="bg-white border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-950 shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg leading-6 font-medium dark:text-gray-100 text-gray-900">
                            Users
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm dark:text-gray-200 text-gray-500">
                            List of all registered users.
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('users.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Tambah +
                        </a>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-neutral-200">
                                    <thead>
                                        <tr class="text-neutral-500">
                                            <th class="px-5 py-3 text-xs font-medium text-left uppercase">Name</th>
                                            <th class="px-5 py-3 text-xs font-medium text-left uppercase">Email</th>
                                            <th class="px-5 py-3 text-xs font-medium text-left uppercase">Hak Akses</th>
                                            <th class="px-5 py-3 text-xs font-medium text-right uppercase">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-neutral-200">
                                        @foreach ($users as $user)
                                            <tr class="text-neutral-800 border-b border-gray-100 dark:border-gray-800 transition-colors hover:bg-gray-50 dark:hover:bg-gray-900">
                                                <td class="px-5 dark:text-gray-400 py-4 text-sm font-medium whitespace-nowrap">
                                                    {{ $user->name }}
                                                </td>
                                                <td class="px-5 py-4 dark:text-gray-400 text-sm whitespace-nowrap">{{ $user->email }}</td>
                                                <td class="px-5 py-4 text-sm whitespace-nowrap">
                                                    @if ($user->role == 'admin')
                                                        <span
                                                            class="bg-blue-600 p-1 px-2 capitalize rounded-md text-gray-100 text-sm">
                                                            {{ $user->role }}
                                                        </span>
                                                    @else
                                                        <span
                                                            class="bg-yellow-500 p-1 px-2 capitalize rounded-md text-gray-100 text-sm">
                                                            {{ $user->role }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                    <a class="text-blue-600 hover:text-blue-700"
                                                        href="{{ route('users.edit', $user->id) }}">Edit</a>
                                                    {{-- destroy --}}
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-700 ml-4"
                                                            onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@php
    $breadcrumbs = [['label' => 'Dashboard', 'url' => route('dashboard')], ['label' => 'Users']];
@endphp
