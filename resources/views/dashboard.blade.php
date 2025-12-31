@extends('layouts.main')

@section('content')
<div class="p-6 space-y-6">
    <nav class="text-sm font-medium text-gray-500 mb-4">
        Dashboard / <span class="text-gray-900 dark:text-white font-bold">Ringkasan Utama</span>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Penjualan Hari Ini</p>
                    <h3 class="text-2xl font-bold text-primary">Rp {{ number_format($stats['total_sales'], 0, ',', '.') }}</h3>
                </div>
                <div class="p-3 bg-primary/20 dark:bg-primary-900/20 rounded-lg text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Transaksi</p>
                    <h3 class="text-2xl font-bold dark:text-white">{{ $stats['total_transactions'] }}</h3>
                </div>
                <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Varian Produk</p>
                    <h3 class="text-2xl font-bold dark:text-white">{{ $stats['total_products'] }}</h3>
                </div>
                <div class="p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Stok Menipis (<=5)</p>
                    <h3 class="text-2xl font-bold text-red-600">{{ $stats['low_stock'] }}</h3>
                </div>
                <div class="p-3 bg-red-50 dark:bg-red-900/20 rounded-lg text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="font-bold text-gray-800 dark:text-white mb-4">Tren Penjualan (7 Hari)</h3>
            <canvas id="salesChart" height="200"></canvas>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
            <h3 class="font-bold text-gray-800 dark:text-white mb-4 text-center">Produk Terlaris</h3>
            <div class="space-y-4">
                @foreach($topProducts as $item)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                    <span class="text-sm font-medium dark:text-gray-300">{{ $item->name }}</span>
                    <span class="px-3 py-1 bg-primary/20 text-primary text-xs font-bold rounded-full">
                        {{ $item->total_sold }} terjual
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($salesData->pluck('date')) !!},
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: {!! json_encode($salesData->pluck('total')) !!},
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection