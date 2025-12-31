@extends('layouts.main')
@section('title', 'Tambah Product')
@section('content')

    {{-- form add user --}}
    <div class="max-w-7xl mx-auto py-6">
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 dark:bg-slate-600 bg-slate-100 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                    Tambah Product
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                    Isi form di bawah untuk menambahkan Product baru.
                </p>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST" class="space-y-6">
                    @csrf
                    {{-- grid --}}
                    <div class="grid gap-3 grid-cols-2">
                        <x-form.input label="Nama" name="name" required />
                        {{-- category id --}}
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kategori
                            </label>
                            <select name="category_id" id="category_id" required
                                class="mt-1 block w-full rounded-md
                                       bg-white dark:bg-gray-900
                                       border-gray-300 dark:border-gray-700
                                       text-gray-900 dark:text-gray-100
                                       shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500
                                       sm:text-sm">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <x-form.input type="number" label="Harga Beli" name="purchase_price" required />
                        <x-form.input type="number" label="Harga Jual" name="selling_price" required />
                        <x-form.input type="number" label="Stock" name="stock" required />
                        {{-- is active --}}
                        <div>
                            <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status
                            </label>
                            <select name="is_active" id="is_active" required
                            class="mt-1 block w-full rounded-md
                                       bg-white dark:bg-gray-900
                                       border-gray-300 dark:border-gray-700
                                       text-gray-900 dark:text-gray-100
                                       shadow-sm
                                       focus:border-blue-500 focus:ring-blue-500
                                       sm:text-sm">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        <x-form.input type="file" label="Gambar" name="image" required />
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
    </div>


@endsection
@php
    $breadcrumbs = [
        ['label' => 'Products Management', 'url' => route('products.index')],
        ['label' => 'Tambah Product', 'url' => route('products.create')],
    ];
@endphp
