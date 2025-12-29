@extends('layouts.pos')
@section('content')


<div x-data="posSystem({{ $products->toJson() }})" class="flex flex-col h-[calc(100vh-100px)] overflow-hidden">
    <a href="{{ route('dashboard') }}" class="mb-4 flex gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 dark:text-gray-300" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="text-gray-600 dark:text-gray-300 font-medium">Kembali ke Dashboard</span>
    </a>
        <div class="flex flex-1 overflow-hidden gap-4">

            {{-- SISI KIRI: DAFTAR PRODUK --}}
            <div class="w-full md:w-2/3 flex flex-col h-full bg-gray-100 dark:bg-gray-900 rounded-lg p-4">
                {{-- Search Bar --}}
                <div class="mb-4 relative">
                    <input type="text" x-model="search" placeholder="Cari nama produk atau barcode..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-2.5 text-gray-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                {{-- Grid Produk --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 overflow-y-auto pr-2 pb-4 p-5">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <div @click="addToCart(product)"
                            class="bg-white dark:bg-gray-800 p-3 rounded-xl shadow-sm cursor-pointer hover:shadow-md hover:ring-2 hover:ring-blue-500 transition-all group border border-gray-200 dark:border-gray-700">
                            <div
                                class="h-24 w-full bg-gray-200 dark:bg-gray-700 rounded-lg mb-2 flex items-center justify-center text-gray-400">
                                <template x-if="product.image" class="overflow-hidden rounded-sm">
                                    <img :src="product.image" :alt="product.name"
                                        class="h-full w-full object-cover group-hover:scale-110 transition duration-300">
                                </template>

                                <template x-if="!product.image">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-10 w-10 group-hover:scale-110 transition" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </template>
                               
                            </div>
                            <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 truncate"
                                x-text="product.name"></h4>
                            <p class="text-xs text-blue-600 dark:text-blue-400 font-bold mt-1"
                                x-text="formatRupiah(product.selling_price)"></p>
                            <p class="text-[10px] text-gray-400 mt-1">Stok: <span x-text="product.stock"></span></p>
                        </div>
                    </template>
                </div>
            </div>

            {{-- SISI KANAN: KERANJANG --}}
            <div
                class="w-full md:w-1/3 flex flex-col h-full bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="font-bold text-gray-700 dark:text-gray-200">Keranjang Belanja</h3>
                    <button @click="cart = []" class="text-xs text-red-500 hover:underline">Reset</button>
                </div>

                {{-- Daftar Item di Keranjang --}}
                <div class="flex-1 overflow-y-auto p-4 space-y-4">
                    <template x-for="(item, index) in cart" :key="index">
                        <div
                            class="flex items-center gap-3 bg-gray-50 dark:bg-gray-900/50 p-2 rounded-lg border border-gray-100 dark:border-gray-800">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800 dark:text-white" x-text="item.name"></p>
                                <p class="text-xs text-gray-500" x-text="formatRupiah(item.price)"></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button @click="decreaseQty(index)"
                                    class="w-6 h-6 rounded bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-sm font-bold">-</button>
                                <span class="text-sm font-bold w-4 text-center" x-text="item.quantity"></span>
                                <button @click="increaseQty(index)"
                                    class="w-6 h-6 rounded bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-sm font-bold">+</button>
                            </div>
                            <div class="text-right min-w-[80px]">
                                <p class="text-xs font-bold text-gray-800 dark:text-white"
                                    x-text="formatRupiah(item.price * item.quantity)"></p>
                            </div>
                            <button @click="removeItem(index)" class="text-gray-400 hover:text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </template>
                    <template x-if="cart.length === 0">
                        <div class="h-full flex flex-col items-center justify-center text-gray-400 italic py-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 opacity-20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Keranjang Kosong
                        </div>
                    </template>
                </div>

                {{-- Checkout Area --}}
                <form action="{{ route('transactions.store') }}" method="POST"
                    class="p-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                    @csrf
                    <div class="space-y-2 mb-4 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-bold text-gray-800 dark:text-white" x-text="formatRupiah(subTotal())"></span>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-gray-500">Tax</span>
                            <input type="number" name="tax" x-model="tax"
                                class="w-24 p-1 text-right text-xs rounded border border-gray-300 dark:bg-gray-800 dark:text-white">
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-gray-500">Discount</span>
                            <input type="number" name="discount" x-model="discount"
                                class="w-24 p-1 text-right text-xs rounded border border-gray-300 dark:bg-gray-800 dark:text-white">
                        </div>
                        <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-200">
                            <span class="text-gray-800 dark:text-white">Total</span>
                            <span class="text-blue-600 dark:text-blue-400" x-text="formatRupiah(grandTotal())"></span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <select name="payment_status" x-model="payment_status"
                            class="w-full text-xs p-2 rounded-lg border dark:bg-gray-800 dark:text-white">
                            <option value="paid">PAID (Lunas)</option>
                            <option value="unpaid">UNPAID (Hutang)</option>
                        </select>
                    </div>

                    {{-- Hidden Inputs for Laravel --}}
                    <template x-for="(item, index) in cart" :key="index">
                        <div>
                            <input type="hidden" :name="`items[${index}][product_id]`" :value="item.id">
                            <input type="hidden" :name="`items[${index}][quantity]`" :value="item.quantity">
                        </div>
                    </template>

                    <button type="submit" :disabled="cart.length === 0"
                        class="w-full py-3 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-bold rounded-xl shadow-lg transition">
                        BAYAR SEKARANG
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function posSystem(products) {
            return {
                search: '',
                products_db: products,
                cart: [],
                tax: 0,
                discount: 0,
                payment_status: 'paid',

                get filteredProducts() {
                    if (this.search === '') return this.products_db;
                    return this.products_db.filter(p =>
                        p.name.toLowerCase().includes(this.search.toLowerCase())
                    );
                },

                addToCart(product) {
                    const existing = this.cart.find(i => i.id === product.id);
                    if (existing) {
                        if (existing.quantity < product.stock) {
                            existing.quantity++;
                        } else {
                            alert('Stok habis!');
                        }
                    } else {
                        this.cart.push({
                            id: product.id,
                            name: product.name,
                            price: product.selling_price,
                            quantity: 1
                        });
                    }
                },

                increaseQty(index) {
                    const productDB = this.products_db.find(p => p.id === this.cart[index].id);
                    if (this.cart[index].quantity < productDB.stock) {
                        this.cart[index].quantity++;
                    }
                },

                decreaseQty(index) {
                    if (this.cart[index].quantity > 1) {
                        this.cart[index].quantity--;
                    } else {
                        this.removeItem(index);
                    }
                },

                removeItem(index) {
                    this.cart.splice(index, 1);
                },

                subTotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },

                grandTotal() {
                    return Math.max(0, (this.subTotal() + parseFloat(this.tax || 0)) - parseFloat(this.discount || 0));
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