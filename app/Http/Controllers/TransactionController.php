<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('user')->get();
        return view('pages.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('is_active', true)->get();
        return view('pages.transactions.addItems', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            // Kita validasi tax & discount agar numeric & tidak minus
            'tax' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'payment_status' => 'required|in:paid,unpaid,partial',
        ]);

        try {
            // Gunakan DB Transaction agar jika satu gagal, semua batal (Data Integrity)
            DB::transaction(function () use ($validated) {

                // 2. Siapkan variabel hitungan
                $subtotal = 0;
                $itemsToSave = [];

                // 3. Loop items untuk hitung ulang total berdasarkan harga DB (Security)
                foreach ($validated['items'] as $item) {
                    $product = Product::findOrFail($item['product_id']);

                    // Cek Stok (Opsional, tapi disarankan)
                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("Stok barang {$product->name} tidak mencukupi.");
                    }

                    // Hitung total per item
                    $lineTotal = $product->selling_price * $item['quantity'];
                    $subtotal += $lineTotal;

                    // Siapkan data item untuk disimpan nanti
                    $itemsToSave[] = [
                        'product_id' => $product->id,
                        'price'      => $product->selling_price, // Ambil harga asli DB
                        'quantity'   => $item['quantity'],
                        'total'      => $lineTotal,
                    ];
                }

                // 4. Hitung Grand Total
                $tax = $validated['tax'] ?? 0;
                $discount = $validated['discount'] ?? 0;

                // Pastikan total tidak minus
                $grandTotal = max(0, ($subtotal + $tax) - $discount);
                // 5. Buat Header Transaksi
                $transaction = Transaction::create([
                    // Jika ada user login
                    'user_id' => Auth::id() ?? 1,
                    'transaction_date' => now(),
                    'invoice_number' => 'INV-' . time(), // Contoh generate kode invoice
                    'subtotal' => $subtotal, // (Opsional jika kolom ada)
                    'tax' => $tax,
                    'discount' => $discount,
                    'total' => $grandTotal, // Ini yang disimpan sebagai final
                    'payment_status' => $validated['payment_status'],
                ]);

                // 6. Simpan Detail Item & Kurangi Stok
                foreach ($itemsToSave as $dataItem) {
                    try {
                        // Simpan
                        $transaction->items()->create($dataItem);

                        // Kurangi Stok
                        Product::where('id', $dataItem['product_id'])
                            ->decrement('stock', $dataItem['quantity']);
                    } catch (\Exception $e) {
                        // Ini akan memunculkan pesan error asli kenapa gagal simpan
                        dd($e->getMessage());
                    }
                }
            });

            FacadesAlert::success('Sukses', 'Transaksi berhasil disimpan!');
            // Redirect Sukses
            return redirect()->back()->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            // Redirect Gagal
            return back()->withErrors(['msg' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }


    public function printPDF(Transaction $transaction)
    {
        // Load relasi agar data produk muncul di PDF
        $transaction->load(['items.product', 'user']);

        // Data yang akan dikirim ke view
        $data = [
            'transaction' => $transaction,
            'title' => 'Struk Transaksi ' . $transaction->invoice_number
        ];

        // Load view khusus struk dan set ukuran kertas (opsional: potrait/landscape)
        // Ukuran 'roll' biasanya 80mm atau gunakan 'A4'
        $pdf = Pdf::loadView('pages.transactions.printPDF', $data)
            ->setPaper('a4', 'portrait');

        // Pilih salah satu:
        // stream() = buka di browser (bisa dicek dulu)
        // download() = langsung download file
        return $pdf->stream('Struk-' . $transaction->invoice_number . '.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        // Load relasi agar data produk dan user pembuat muncul
        $transaction->load(['items.product', 'user']);

        return view('pages.transactions.show', compact('transaction'));
    }

    public function pos()
    {   
        $categories = Category::all();
        $products = Product::with('category')->where('is_active', true)->where('stock', '>', 0)->get();
        return view('pages.pos.index', compact('products','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        // Load relasi items dan produk agar bisa diedit
        $transaction->load('items.product');
        $products = Product::where('stock', '>', 0)->orWhereIn('id', $transaction->items->pluck('product_id'))->get();

        return view('pages.transactions.editItems', compact('transaction', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'tax' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'payment_status' => 'required|in:paid,unpaid,partial',
        ]);

        try {
            DB::transaction(function () use ($validated, $transaction) {
                // 1. Kembalikan stok lama sebelum transaksi diupdate
                foreach ($transaction->items as $oldItem) {
                    $oldItem->product->increment('stock', $oldItem->quantity);
                }

                // 2. Hapus detail transaksi lama
                $transaction->items()->delete();

                // 3. Kalkulasi ulang (mirip seperti store)
                $subtotal = 0;
                $itemsToSave = [];

                foreach ($validated['items'] as $item) {
                    $product = Product::findOrFail($item['product_id']);

                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("Stok barang {$product->name} tidak mencukupi.");
                    }

                    $lineTotal = $product->selling_price * $item['quantity'];
                    $subtotal += $lineTotal;

                    $itemsToSave[] = [
                        'product_id' => $product->id,
                        'price'      => $product->selling_price,
                        'quantity'   => $item['quantity'],
                        'total'      => $lineTotal,
                    ];
                }

                $tax = $validated['tax'] ?? 0;
                $discount = $validated['discount'] ?? 0;
                $grandTotal = max(0, ($subtotal + $tax) - $discount);

                // 4. Update Header Transaksi
                $transaction->update([
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'discount' => $discount,
                    'total' => $grandTotal,
                    'payment_status' => $validated['payment_status'],
                ]);

                // 5. Simpan detail baru & kurangi stok baru
                foreach ($itemsToSave as $dataItem) {
                    $transaction->items()->create($dataItem);
                    Product::where('id', $dataItem['product_id'])->decrement('stock', $dataItem['quantity']);
                }
            });

            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => $e->getMessage()])->withInput();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
            DB::transaction(function () use ($transaction) {
                // Kembalikan semua stok barang dalam transaksi ini
                foreach ($transaction->items as $item) {
                    $item->product->increment('stock', $item->quantity);
                }

                // Hapus transaksi (cascade akan menghapus items jika diset di migration)
                $transaction->delete();
            });

            return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus dan stok dikembalikan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }
}
