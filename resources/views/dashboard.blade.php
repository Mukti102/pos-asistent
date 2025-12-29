@extends('layouts.main')
@section('content')
    <div class="space-y-6">

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-950">
                <div class="flex flex-row items-center justify-between pb-2">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</h3>
                </div>
                <div class="text-2xl font-bold text-gray-900 dark:text-gray-50">$45,231.89</div>
                <p class="text-xs text-gray-500 dark:text-gray-400">+20.1% from last month</p>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-950">
                <div class="flex flex-row items-center justify-between pb-2">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Subscriptions</h3>
                </div>
                <div class="text-2xl font-bold text-gray-900 dark:text-gray-50">+2350</div>
                <p class="text-xs text-gray-500 dark:text-gray-400">+180.1% from last month</p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-950">
            <div class="p-6">
                <h3 class="text-lg font-semibold leading-none tracking-tight">Recent Sales</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">You made 265 sales this month.</p>
            </div>

            <div class="relative w-full overflow-auto">
                <table class="w-full caption-bottom text-sm text-left">
                    <thead class="[&_tr]:border-b border-gray-200 dark:border-gray-800">
                        <tr
                            class="border-b transition-colors hover:bg-gray-100/50 dark:hover:bg-gray-800/50 data-[state=selected]:bg-gray-100">
                            <th class="h-12 px-4 align-middle font-medium text-gray-500 dark:text-gray-400">Invoice</th>
                            <th class="h-12 px-4 align-middle font-medium text-gray-500 dark:text-gray-400">Status</th>
                            <th class="h-12 px-4 align-middle font-medium text-gray-500 dark:text-gray-400">Method</th>
                            <th class="h-12 px-4 align-middle font-medium text-gray-500 dark:text-gray-400 text-right">
                                Amount</th>
                        </tr>
                    </thead>
                    <tbody class="[&_tr:last-child]:border-0">
                        <tr
                            class="border-b border-gray-100 dark:border-gray-800 transition-colors hover:bg-gray-50 dark:hover:bg-gray-900">
                            <td class="p-4 align-middle font-medium">INV001</td>
                            <td class="p-4 align-middle text-gray-500">Paid</td>
                            <td class="p-4 align-middle">Credit Card</td>
                            <td class="p-4 align-middle text-right">$250.00</td>
                        </tr>
                        <tr
                            class="border-b border-gray-100 dark:border-gray-800 transition-colors hover:bg-gray-50 dark:hover:bg-gray-900">
                            <td class="p-4 align-middle font-medium">INV002</td>
                            <td class="p-4 align-middle text-yellow-600">Pending</td>
                            <td class="p-4 align-middle">PayPal</td>
                            <td class="p-4 align-middle text-right">$150.00</td>
                        </tr>
                        <tr
                            class="border-b border-gray-100 dark:border-gray-800 transition-colors hover:bg-gray-50 dark:hover:bg-gray-900">
                            <td class="p-4 align-middle font-medium">INV003</td>
                            <td class="p-4 align-middle text-gray-500">Paid</td>
                            <td class="p-4 align-middle">Bank Transfer</td>
                            <td class="p-4 align-middle text-right">$350.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



@php
    $breadcrumbs = [['label' => 'Dashboard', 'url' => route('dashboard')]];
@endphp
