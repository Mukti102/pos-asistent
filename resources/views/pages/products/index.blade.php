@extends('layouts.main')
@section('title', 'Products Management')
@section('content')

<div class="max-w-7xl mx-auto py-6">
    <div
        class="bg-white dark:bg-gray-950
               border border-gray-200 dark:border-gray-800
               shadow-sm overflow-hidden sm:rounded-lg">

        {{-- Header --}}
        <div class="px-4 py-5 sm:px-6 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200">
                    Products
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                    List of all products.
                </p>
            </div>

            <a href="{{ route('products.create') }}"
                class="inline-flex items-center px-4 py-2
                       text-sm font-medium text-white
                       bg-blue-600 hover:bg-blue-700
                       rounded-md shadow
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                       dark:focus:ring-offset-gray-950">
                Tambah +
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            No
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Kode Produck
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Name
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Category
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Barcode
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Purchase Price
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Selling Price
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Stock
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-right uppercase text-gray-500 dark:text-gray-400">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach ($products as $product)
                        <tr class="text-gray-800 dark:text-gray-200">
                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                {{ $product->code }}
                            </td>
                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                {{ $product->name }}
                            </td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                {{ $product->category->name }}
                            </td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                {{ $product->barcode }}
                            </td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                {{ $product->purchase_price }}
                            </td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                {{ $product->selling_price }}
                            </td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                {{ $product->stock }}
                            </td>
                            <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="text-blue-600 hover:text-blue-700">
                                    Edit
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-700"
                                        onclick="return confirm('Are you sure you want to delete this product?')">
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

@php
    $breadcrumbs = [
        ['label' => 'Products Management', 'url' => route('products.index')],
    ];
@endphp
