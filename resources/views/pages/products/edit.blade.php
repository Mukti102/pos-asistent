@extends('layouts.main')
@section('title', 'Edit Product')
@section('content')

    <div class="max-w-7xl mx-auto py-6">
        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                    Edit Product
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                    Ubah informasi product pada form di bawah.
                </p>
            </div>

            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- grid --}}
                    <div class="grid gap-3 grid-cols-2">
                        <x-form.input label="Nama" name="name" :value="$product->name" required />

                        {{-- Category --}}
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
                                   sm:text-sm
                                   @error('category_id')
                                       border-red-500 focus:border-red-500 focus:ring-red-500
                                   @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <x-form.input type="number" label="Harga Beli" name="purchase_price" :value="$product->purchase_price" required />

                        <x-form.input type="number" label="Harga Jual" name="selling_price" :value="$product->selling_price" required />

                        <x-form.input type="number" label="Stock" name="stock" :value="$product->stock" required />

                        {{-- Status --}}
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
                                   sm:text-sm
                                   @error('is_active')
                                       border-red-500 focus:border-red-500 focus:ring-red-500
                                   @enderror">
                                <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>
                                    Tidak Aktif
                                </option>
                            </select>

                            @error('is_active')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <x-form.input type="file" label="Gambar" name="image" required />

                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center px-4 py-2
                               text-sm font-medium
                               border border-gray-300 dark:border-gray-700
                               text-gray-700 dark:text-gray-300
                               rounded-md
                               hover:bg-gray-100 dark:hover:bg-gray-700">
                            Batal
                        </a>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50">
                            Simpan Perubahan
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
        ['label' => 'Edit Product', 'url' => route('products.edit', $product->id)],
    ];
@endphp
