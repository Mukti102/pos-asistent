@extends('layouts.main')
@section('title', 'Transactions Management')
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
                    Transactions
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                    List of all transactions.
                </p>
            </div>

            <a href="{{ route('transactions.create') }}"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50">
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
                            Invoice Number
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Subtotal
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Tax
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Discount
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Total
                        </th>
                        <th class="px-5 py-3 text-xs font-medium text-left uppercase text-gray-500 dark:text-gray-400">
                            Status
                        </th>
                       
                        <th class="px-5 py-3 text-xs font-medium text-right uppercase text-gray-500 dark:text-gray-400">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach ($transactions as $transaction)
                        <tr class="text-gray-800 dark:text-gray-200">
                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                {{ $transaction->invoice_number }}
                            </td>
                            <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">
                                {{ $transaction->subtotal }}
                            </td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                {{ $transaction->tax }}
                            </td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                {{ $transaction->discount }}
                            </td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                {{ $transaction->total }}
                            </td>
                            <td class="px-5 py-4 text-sm whitespace-nowrap">
                                @if ($transaction->payment_status == 'paid')
                                    <span class="bg-green-600 p-1 px-2 capitalize rounded-md text-gray-100 text-sm">
                                        {{ $transaction->payment_status }}
                                    </span>
                                @else 
                                    <span class="bg-yellow-500 p-1 px-2 capitalize rounded-md text-gray-100 text-sm">
                                        {{ $transaction->payment_status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <a href="{{ route('transactions.show', $transaction->id) }}">
                                    <span class="text-green-600 hover:text-blue-700">
                                        View
                                    </span>
                                </a>
                                <a href="{{ route('transactions.edit', $transaction->id) }}"
                                    class="text-blue-600 ml-2 hover:text-blue-700">
                                    Edit
                                </a>
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
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
        ['label' => 'Transaction Management', 'url' => route('transactions.index')],
    ];
@endphp
