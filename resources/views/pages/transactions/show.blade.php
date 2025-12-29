@extends('layouts.main')

@section('title', 'Detail Transaksi #' . $transaction->invoice_number)

@section('content')
    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-3 lg:px-1">

        {{-- Header & Tombol Aksi --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Detail Transaksi</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Nomor Invoice: <span
                        class="font-mono font-bold text-blue-600 uppercase">{{ $transaction->invoice_number }}</span></p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('transactions.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600">
                    Kembali
                </a>
                {{-- Tombol Cetak (Opsional - Bisa dihubungkan ke fungsi window.print()) --}}
                {{-- <button onclick="window.print()"
                    class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Struk
                </button> --}}
                <a href="{{ route('transactions.print', $transaction->id) }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak Struk
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Card Kiri: Info Transaksi --}}
            <div class="md:col-span-2 space-y-6">
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                        <h3 class="font-semibold text-gray-700 dark:text-gray-200">Item Dibeli</h3>
                    </div>
                    <div class="p-0 overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr
                                    class="text-xs font-semibold text-gray-500 uppercase bg-gray-50 dark:bg-gray-700/50 dark:text-gray-400">
                                    <th class="px-6 py-3">Nama Produk</th>
                                    <th class="px-6 py-3 text-center">Harga</th>
                                    <th class="px-6 py-3 text-center">Qty</th>
                                    <th class="px-6 py-3 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($transaction->items as $item)
                                    <tr class="text-sm text-gray-700 dark:text-gray-300">
                                        <td class="px-6 py-4 font-medium">{{ $item->product->name }}</td>
                                        <td class="px-6 py-4 text-center">Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-center">{{ $item->quantity }}</td>
                                        <td class="px-6 py-4 text-right font-semibold">Rp
                                            {{ number_format($item->total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Card Kanan: Ringkasan Pembayaran --}}
            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="font-semibold text-gray-700 dark:text-gray-200 mb-4">Ringkasan Biaya</h3>

                    <div class="space-y-3">
                        <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
                            <span>Pajak (Tax)</span>
                            <span class="text-red-500">+ Rp {{ number_format($transaction->tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400">
                            <span>Diskon</span>
                            <span class="text-green-500">- Rp
                                {{ number_format($transaction->discount, 0, ',', '.') }}</span>
                        </div>
                        <div class="pt-3 border-t border-gray-200 dark:border-gray-700 flex justify-between">
                            <span class="font-bold text-gray-800 dark:text-white">Grand Total</span>
                            <span class="font-bold text-blue-600 dark:text-blue-400 text-lg">Rp
                                {{ number_format($transaction->total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block text-xs font-semibold text-gray-500 uppercase mb-2">Status Pembayaran</span>
                        @php
                            $statusColor = [
                                'paid' => 'bg-green-100 text-green-800 border-green-200',
                                'unpaid' => 'bg-red-100 text-red-800 border-red-200',
                                'partial' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            ][$transaction->payment_status];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusColor }}">
                            {{ strtoupper($transaction->payment_status) }}
                        </span>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 text-sm text-gray-600 dark:text-gray-400">
                    <p class="mb-2"><strong>Kasir:</strong> {{ $transaction->user->name ?? 'System' }}</p>
                    <p><strong>Waktu:</strong> {{ $transaction->transaction_date }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CSS khusus print agar tombol tidak ikut tercetak --}}
    <style>
        @media print {

            header,
            nav,
            .flex.gap-2,
            aside {
                display: none !important;
            }

            .max-w-4xl {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .dark {
                color-scheme: light;
            }
        }
    </style>
@endsection
