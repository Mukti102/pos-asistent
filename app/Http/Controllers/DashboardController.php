<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Ringkasan
        $stats = [
            'total_sales' => Transaction::whereDate('created_at', today())->sum('total'),
            'total_transactions' => Transaction::count(),
            'total_products' => Product::count(),
            'low_stock' => Product::where('stock', '<=', 5)->count(),
        ];

        // Data untuk Chart (Penjualan 7 Hari Terakhir)
        $salesData = Transaction::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total')
        )
        ->where('created_at', '>=', now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

        // Produk Terlaris
        $topProducts = DB::table('transaction_items')
            ->join('products', 'transaction_items.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(transaction_items.quantity) as total_sold'))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'salesData', 'topProducts'));
    }
}