@extends('layouts.main')


@section('content')

    {{-- Main Content with Alpine.js --}}
    <div x-data="transactionHandler({{ $products->toJson() }})" class="w-full">

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 gap-6">
                
                {{-- Card: Item Transaksi (Kode Lama - Tidak Berubah) --}}
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Item Transaksi</h3>
                        <button type="button" @click="addItem()" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded shadow transition duration-150 ease-in-out flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Produk
                        </button>
                    </div>

                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="text-xs font-semibold tracking-wide text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3 w-5/12">Produk</th>
                                        <th class="px-4 py-3 w-2/12">Harga</th>
                                        <th class="px-4 py-3 w-2/12">Qty</th>
                                        <th class="px-4 py-3 w-2/12">Total</th>
                                        <th class="px-4 py-3 w-1/12 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <template x-for="(item, index) in items" :key="index">
                                        <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                            <td class="px-4 py-3">
                                                <select :name="`items[${index}][product_id]`" x-model="item.product_id" @change="updatePrice(index)" class="block w-full px-3 py-2 mt-1 text-sm text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 form-select" required>
                                                    <option value="" disabled>Pilih Produk</option>
                                                    <template x-for="product in products_db" :key="product.id">
                                                        <option :value="product.id" x-text="product.name"></option>
                                                    </template>
                                                </select>
                                            </td>
                                            <td class="px-4 py-3">
                                                <input type="number" :name="`items[${index}][price]`" x-model="item.price" class="w-full pl-2 py-2 text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded-md dark:bg-gray-600 dark:text-gray-300 dark:border-gray-600 cursor-not-allowed" readonly>
                                            </td>
                                            <td class="px-4 py-3">
                                                <input type="number" :name="`items[${index}][quantity]`" x-model="item.quantity" min="1" class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500" required>
                                            </td>
                                            <td class="px-4 py-3 font-semibold text-gray-900 dark:text-white">
                                                <span x-text="formatRupiah(item.price * item.quantity)"></span>
                                                <input type="hidden" :name="`items[${index}][total]`" :value="item.price * item.quantity">
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <button type="button" @click="removeItem(index)" class="text-red-500 hover:text-red-700 transition" :disabled="items.length === 1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- NEW SECTION: Kalkulasi Pajak, Diskon, dan Status Pembayaran --}}
                <div class="flex flex-col md:flex-row gap-6 justify-end">
                    
                    {{-- Kolom Kiri: Status Pembayaran --}}
                    <div class="w-full md:w-1/3">
                         <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border border-gray-200 dark:border-gray-700 h-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Pembayaran</label>
                            <select name="payment_status" x-model="payment_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="unpaid">Unpaid (Belum Lunas)</option>
                                <option value="partial">Partial (Sebagian)</option>
                                <option value="paid">Paid (Lunas)</option>
                            </select>
                            
                            <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                                Pastikan status pembayaran sesuai dengan bukti transfer atau uang tunai yang diterima.
                            </p>
                         </div>
                    </div>

                    {{-- Kolom Kanan: Kalkulasi Harga --}}
                    <div class="w-full md:w-1/3">
                        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 border border-gray-200 dark:border-gray-700">
                            
                            {{-- Subtotal --}}
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-600 dark:text-gray-400 font-medium">Subtotal</span>
                                <span class="text-gray-900 dark:text-white font-bold" x-text="formatRupiah(subTotal())"></span>
                            </div>

                            {{-- Tax Input --}}
                            <div class="mb-4">
                                <label class="block mb-1 text-xs font-medium text-gray-700 dark:text-gray-300">Pajak (Tax) Rp</label>
                                <input type="number" name="tax" x-model="tax" min="0" class="w-full px-3 py-2 text-sm text-right bg-gray-50 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            {{-- Discount Input --}}
                            <div class="mb-4">
                                <label class="block mb-1 text-xs font-medium text-gray-700 dark:text-gray-300">Diskon (Discount) Rp</label>
                                <input type="number" name="discount" x-model="discount" min="0" class="w-full px-3 py-2 text-sm text-right bg-gray-50 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <hr class="border-gray-200 dark:border-gray-700 my-4">

                            {{-- Grand Total --}}
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-800 dark:text-white">Total Bayar</span>
                                <span class="text-xl font-bold text-blue-600 dark:text-blue-400" x-text="formatRupiah(grandTotal())"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end gap-3 mt-4">
                    <a href="{{ route('products.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 shadow-lg">
                        Simpan Transaksi
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- Script Logic Alpine.js --}}
    <script>
        function transactionHandler(productsData) {
            return {
                products_db: productsData,
                items: [
                    { product_id: '', price: 0, quantity: 1, total: 0 }
                ],
                
                // DATA BARU: Inisialisasi variabel baru
                tax: 0,
                discount: 0,
                payment_status: 'unpaid',

                addItem() {
                    this.items.push({
                        product_id: '',
                        price: 0,
                        quantity: 1,
                        total: 0
                    });
                },

                removeItem(index) {
                    if (this.items.length > 1) {
                        this.items.splice(index, 1);
                    }
                },

                updatePrice(index) {
                    const selectedId = this.items[index].product_id;
                    const product = this.products_db.find(p => p.id == selectedId);
                    if (product) {
                        this.items[index].price = product.selling_price; // Pastikan field database Anda sesuai (e.g. price atau selling_price)
                    } else {
                        this.items[index].price = 0;
                    }
                },

                // Fungsi Subtotal Murni (Total Item)
                subTotal() {
                    return this.items.reduce((sum, item) => {
                        return sum + (item.price * item.quantity);
                    }, 0);
                },

                // LOGIKA BARU: Grand Total memperhitungkan Tax dan Diskon
                grandTotal() {
                    const subtotal = this.subTotal();
                    const taxValue = parseFloat(this.tax) || 0;
                    const discountValue = parseFloat(this.discount) || 0;

                    // Rumus: (Subtotal + Pajak) - Diskon
                    // Gunakan Math.max(0, ...) agar total tidak minus jika diskon terlalu besar
                    return Math.max(0, subtotal + taxValue - discountValue);
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(number);
                }
            }
        }
    </script>
@endsection