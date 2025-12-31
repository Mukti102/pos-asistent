@extends('layouts.main')
@section('title', 'Kategory')
@section('content')

    <div class="max-w-7xl mx-auto py-6">
        <div
            class="bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden sm:rounded-lg">

            {{-- Header --}}
            <div class="px-4 py-5 sm:px-6 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                        Kategori
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                        List of all category.
                    </p>
                </div>

                {{-- Button + Modal --}}
                <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false" class="relative z-50">
                    <button @click="modalOpen=true"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50">
                        Tambah Category
                    </button>

                    <template x-teleport="body">
                        <div x-show="modalOpen" x-cloak class="fixed inset-0 z-[99] flex items-center justify-center">

                            {{-- Backdrop --}}
                            <div @click="modalOpen=false" class="absolute inset-0 bg-black/40"></div>

                            {{-- Modal --}}
                            <div x-show="modalOpen" x-transition x-trap.inert.noscroll="modalOpen"
                                class="relative w-full sm:max-w-lg px-7 py-6
                                   bg-white dark:bg-gray-900
                                   rounded-lg shadow-lg">

                                <div class="flex justify-between items-center pb-3">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        Tambah Category
                                    </h3>
                                    <button @click="modalOpen=false"
                                        class="w-8 h-8 flex items-center justify-center rounded-full
                                           text-gray-500 hover:text-gray-700
                                           dark:text-gray-400 dark:hover:text-gray-200
                                           hover:bg-gray-100 dark:hover:bg-gray-800">
                                        ✕
                                    </button>
                                </div>

                                {{-- Form --}}
                                <form action="{{ route('category.store') }}" method="POST" class="space-y-6">
                                    @csrf

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Nama
                                        </label>
                                        <input type="text" name="name" required
                                            class="mt-1 block w-full rounded-md
                                               bg-white dark:bg-gray-800
                                               border-gray-300 dark:border-gray-700
                                               text-gray-900 dark:text-gray-100
                                               shadow-sm
                                               focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Deskripsi
                                        </label>
                                        <textarea name="description" rows="3"
                                            class="mt-1 block w-full rounded-md
                                               bg-white dark:bg-gray-800
                                               border-gray-300 dark:border-gray-700
                                               text-gray-900 dark:text-gray-100
                                               shadow-sm
                                               focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50">
                                            Simpan
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-5 py-3 text-xs text-left font-medium uppercase text-gray-500 dark:text-gray-400">
                                Name
                            </th>
                            <th class="px-5 py-3 text-xs text-left font-medium uppercase text-gray-500 dark:text-gray-400">
                                Description
                            </th>
                            <th class="px-5 py-3 text-xs text-right font-medium uppercase text-gray-500 dark:text-gray-400">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach ($categories as $category)
                            <tr class="text-gray-800 dark:text-gray-200">
                                <td class="px-5 py-4 text-sm font-medium">
                                    {{ $category->name }}
                                </td>
                                <td class="px-5 py-4 text-sm">
                                    {{ $category->description }}
                                </td>
                                <td class="px-5 py-4 text-sm text-right">
                                    <div x-data="{ editOpen: false }" class="inline-block">
                                        <button @click="editOpen = true" class="text-blue-600 hover:text-blue-700">
                                            Edit
                                        </button>

                                        {{-- Modal Edit --}}
                                        <template x-teleport="body">
                                            <div x-show="editOpen" x-cloak
                                                class="fixed inset-0 z-[99] flex items-center justify-center">

                                                {{-- Backdrop --}}
                                                <div @click="editOpen = false" class="absolute inset-0 bg-black/40"></div>

                                                {{-- Modal --}}
                                                <div x-show="editOpen" x-transition x-trap.inert.noscroll="editOpen"
                                                    class="relative w-full sm:max-w-lg px-7 py-6
                           bg-white dark:bg-gray-900
                           rounded-lg shadow-lg">

                                                    <div class="flex justify-between items-center pb-3">
                                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                            Edit Category
                                                        </h3>
                                                        <button @click="editOpen = false"
                                                            class="w-8 h-8 flex items-center justify-center rounded-full
                                   text-gray-500 hover:text-gray-700
                                   dark:text-gray-400 dark:hover:text-gray-200
                                   hover:bg-gray-100 dark:hover:bg-gray-800">
                                                            ✕
                                                        </button>
                                                    </div>

                                                    <form action="{{ route('category.update', $category->id) }}"
                                                        method="POST" class="space-y-6">
                                                        @csrf
                                                        @method('PUT')

                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                Nama
                                                            </label>
                                                            <input type="text" name="name"
                                                                value="{{ $category->name }}" required
                                                                class="mt-1 block w-full rounded-md
                                       bg-white dark:bg-gray-800
                                       border-gray-300 dark:border-gray-700
                                       text-gray-900 dark:text-gray-100
                                       shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                                        </div>

                                                        <div>
                                                            <label
                                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                                Deskripsi
                                                            </label>
                                                            <textarea name="description" rows="3"
                                                                class="mt-1 block w-full rounded-md
                                       bg-white dark:bg-gray-800
                                       border-gray-300 dark:border-gray-700
                                       text-gray-900 dark:text-gray-100
                                       shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ $category->description }}</textarea>
                                                        </div>

                                                        <div class="flex justify-end gap-2">
                                                            <button type="button" @click="editOpen = false"
                                                                class="px-4 py-2 text-sm rounded-md
                                       border border-gray-300 dark:border-gray-700
                                       text-gray-700 dark:text-gray-300
                                       hover:bg-gray-100 dark:hover:bg-gray-800">
                                                                Batal
                                                            </button>

                                                            <button type="submit"
                                                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50">
                                                                Simpan
                                                            </button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                        class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700"
                                            onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
