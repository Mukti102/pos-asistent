<?php
namespace App\Services\Assistant;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;

class AssistantService
{
    public function handle(array $intent)
    {
        return match ($intent['intent'] ?? null) {

            'income_today'   => $this->incomeToday(),
            'income_monthly' => $this->incomeMonthly(),
            'stock_product'  => $this->stockProduct($intent),
            'top_product'    => $this->topSellingProduct(),
            'check_transaction' => $this->checkTransaction($intent),
            'summary_report' => $this->summaryReport(),
            'greeting'       => $this->greeting(),

            default => $this->helpMessage()
        };
    }

    private function greeting()
    {
        return "👋 Halo! Saya *Asisten POS*.\n\nSaya bisa bantu:\n• Cek pendapatan\n• Cek stok barang\n• Cari transaksi\n• Ringkasan penjualan\n\nSilakan tanya ya 😊";
    }

    private function incomeToday()
    {
        $total = Transaction::whereDate('created_at', today())->sum('total');
        $count = Transaction::whereDate('created_at', today())->count();

        return "💰 *Laporan Hari Ini*\n• Total Transaksi: {$count}\n• Pendapatan: *Rp " .
            number_format($total, 0, ',', '.') . "*";
    }

    private function incomeMonthly()
    {
        $total = Transaction::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        return "📅 *Pendapatan Bulan " . now()->translatedFormat('F') . "*\n• Total: *Rp " .
            number_format($total, 0, ',', '.') . "*";
    }

    private function stockProduct($intent)
    {
        $product = Product::where('name', 'LIKE', "%{$intent['product_name']}%")->first();

        if (!$product) {
            return "❌ Saya tidak menemukan produk *{$intent['product_name']}*.";
        }

        if ($product->stock <= 5) {
            return "⚠️ *{$product->name}* tersisa {$product->stock} unit.\nDisarankan segera restock.";
        }

        return "📦 Stok *{$product->name}* tersedia {$product->stock} unit.";
    }

    private function topSellingProduct()
    {
        $best = TransactionItem::select('product_id', DB::raw('SUM(quantity) as qty'))
            ->groupBy('product_id')
            ->orderByDesc('qty')
            ->with('product')
            ->first();

        if (!$best) return "Belum ada data penjualan.";

        return "🔥 Produk terlaris saat ini adalah *{$best->product->name}* ({$best->qty} unit terjual).";
    }

    private function checkTransaction($intent)
    {
        $trx = Transaction::where('invoice_number', $intent['invoice'])->first();

        if (!$trx) {
            return "🔍 Transaksi dengan invoice *{$intent['invoice']}* tidak ditemukan.";
        }

        return "📄 *Detail Transaksi*\n• Invoice: {$trx->invoice_number}\n• Status: " .
            strtoupper($trx->payment_status) .
            "\n• Total: Rp " . number_format($trx->total) .
            "\n• Tanggal: " . $trx->created_at->format('d M Y H:i');
    }

    private function summaryReport()
    {
        $trxToday = Transaction::whereDate('created_at', today())->count();
        $lowStock = Product::where('stock', '<=', 5)->count();

        return "📊 *Ringkasan Cepat*\n• Transaksi Hari Ini: {$trxToday}\n• Produk Stok Menipis: {$lowStock}\n\nGunakan menu laporan untuk detail lengkap.";
    }

    private function helpMessage()
    {
        return "🤖 Saya belum memahami pertanyaan itu.\n\nCoba contoh:\n• Pendapatan hari ini\n• Stok kopi\n• Produk terlaris\n• Cek invoice INV-001";
    }
}
