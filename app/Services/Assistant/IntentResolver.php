<?php

namespace App\Services\Assistant;

class IntentResolver
{
    public function resolve(string $message): array
    {
        $msg = strtolower(trim($message));

        // =====================
        // CEK STOK
        // =====================
        if (preg_match('/(stok|stock|sisa)\s+(produk\s+)?(.+)/', $msg, $m)) {
            return [
                'intent' => 'stock_product',
                'product_name' => trim($m[3])
            ];
        }

        // =====================
        // PENDAPATAN
        // =====================
        if ($this->contains($msg, ['income', 'pendapatan', 'omzet'])) {
            if ($this->contains($msg, ['bulan', 'monthly'])) {
                return ['intent' => 'income_monthly'];
            }

            return ['intent' => 'income_today'];
        }

        // =====================
        // PRODUK TERLARIS
        // =====================
        if ($this->contains($msg, ['terlaris', 'paling laku', 'best seller'])) {
            return ['intent' => 'top_product'];
        }

        // =====================
        // CEK TRANSAKSI
        // =====================
        if (preg_match('/(invoice|inv|transaksi)\s+([a-z0-9\-]+)/', $msg, $m)) {
            return [
                'intent' => 'check_transaction',
                'invoice' => strtoupper($m[2])
            ];
        }

        // =====================
        // RINGKASAN
        // =====================
        if ($this->contains($msg, ['ringkasan', 'summary', 'performa', 'laporan singkat'])) {
            return ['intent' => 'summary_report'];
        }

        // =====================
        // SAPAAN
        // =====================
        if ($this->contains($msg, ['halo', 'hai', 'hi', 'assisten','siapa kamu','asisten'])) {
            return ['intent' => 'greeting'];
        }

        return ['intent' => 'unknown'];
    }

    private function contains(string $text, array $keywords): bool
    {
        foreach ($keywords as $word) {
            if (str_contains($text, $word)) return true;
        }
        return false;
    }
}
