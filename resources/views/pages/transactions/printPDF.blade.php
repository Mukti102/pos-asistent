<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk #{{ $transaction->invoice_number }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .mt-20 { margin-top: 20px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f2f2f2; padding: 8px; border-bottom: 2px solid #ddd; }
        td { padding: 8px; border-bottom: 1px solid #eee; }
        
        .invoice-header { margin-bottom: 30px; }
        .invoice-header h1 { margin-bottom: 5px; color: #2563eb; }
        
        .summary-box { float: right; width: 250px; margin-top: 20px; }
        .summary-row { display: flex; justify-content: space-between; padding: 5px 0; }
        .clear { clear: both; }
        
        .footer { margin-top: 50px; text-align: center; font-style: italic; color: #777; }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>INVOICE</h1>
        <p>Nomor: <strong>{{ $transaction->invoice_number }}</strong></p>
        <p>Tanggal: {{ $transaction->transaction_date }}</p>
        <p>Kasir: {{ $transaction->user->name ?? 'System' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td class="text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-box">
        <table>
            <tr>
                <td>Subtotal</td>
                <td class="text-right">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Pajak</td>
                <td class="text-right">Rp {{ number_format($transaction->tax, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Diskon</td>
                <td class="text-right">- Rp {{ number_format($transaction->discount, 0, ',', '.') }}</td>
            </tr>
            <tr class="font-bold" style="font-size: 14px;">
                <td>Grand Total</td>
                <td class="text-right" style="color: #2563eb;">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
            </tr>
        </table>
        <p class="text-right mt-20">Status: <strong>{{ strtoupper($transaction->payment_status) }}</strong></p>
    </div>

    <div class="clear"></div>

    <div class="footer">
        <p>Terima kasih telah berbelanja di tempat kami!</p>
    </div>
</body>
</html>