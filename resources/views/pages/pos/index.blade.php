@extends('layouts.pos')
@section('content')
    <div x-data="posSystem({{ $products->toJson() }})"
        class="flex flex-col h-screen md:h-[calc(100vh-100px)] overflow-hidden bg-gray-50 dark:bg-zinc-950">

        {{-- Header & Nav --}}
        <div class="p-4 flex justify-between items-center">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2 text-gray-600 dark:text-zinc-400 hover:text-primary transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="font-medium hidden sm:block">Dashboard</span>
            </a>

            {{-- Mobile Cart Trigger (Hanya muncul di HP) --}}
            <button @click="showMobileCart = true"
                class="md:hidden relative p-2 bg-white dark:bg-zinc-900 rounded-full shadow-md border border-gray-200 dark:border-zinc-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span x-show="cart.length > 0" x-text="cart.length"
                    class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full border-2 border-white"></span>
            </button>
        </div>

        <div class="flex flex-1 overflow-hidden gap-4 px-4 pb-4">
            {{-- SISI KIRI: PRODUK (Lebar penuh di HP, 2/3 di Desktop) --}}
            <div class="w-full md:w-2/3 flex flex-col h-full overflow-hidden">
                <div class="flex flex-col sm:flex-row gap-3 mb-4">
                    {{-- Search Bar --}}
                    <div class="relative flex-1">
                        <input type="text" x-model="search" placeholder="Cari produk..."
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 dark:bg-zinc-900 dark:border-zinc-800 dark:text-white focus:ring-2 focus:ring-primary shadow-sm outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3 text-gray-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    {{-- Filter Kategori --}}
                    <div class="w-full sm:w-48">
                        <select x-model="selectedCategory"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 dark:bg-zinc-900 dark:border-zinc-800 dark:text-white focus:ring-2 focus:ring-primary shadow-sm outline-none">
                            <option value="">Semua Kategori</option>
                            <template x-for="cat in categories" :key="cat">
                                <option :value="cat" x-text="cat"></option>
                            </template>
                        </select>
                    </div>
                </div>

                {{-- Grid Produk --}}
                <div
                    class="flex-1 overflow-y-auto grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 pr-2 scrollbar-hide">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <div @click="addToCart(product)"
                            class="bg-white dark:bg-zinc-900 p-2 sm:p-3 rounded-2xl shadow-sm cursor-pointer hover:ring-2 hover:ring-primary transition-all border border-gray-200 dark:border-zinc-800 group active:scale-95">
                            <div
                                class="aspect-square w-full bg-gray-100 dark:bg-zinc-800 rounded-xl mb-2 flex items-center justify-center overflow-hidden">
                                <template x-if="product.image">
                                    <img :src="product.image" class="h-full w-full object-cover">
                                </template>
                                <template x-if="!product.image">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </template>
                            </div>
                            <h4 class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-zinc-200 truncate"
                                x-text="product.name"></h4>
                            <p class="text-xs text-primary font-bold mt-1" x-text="formatRupiah(product.selling_price)"></p>
                        </div>
                    </template>
                </div>
            </div>

            {{-- SISI KANAN: KERANJANG (Sembunyi di HP, Tampil di Tablet/Desktop) --}}
            <div
                :class="showMobileCart ? 'fixed inset-0 z-50 flex flex-col bg-white dark:bg-zinc-950' :
                    'hidden md:flex md:w-1/3 flex-col bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-gray-200 dark:border-zinc-800'">

                {{-- Header Keranjang Mobile --}}
                <div
                    class="p-4 border-b dark:border-zinc-800 flex justify-between items-center bg-white dark:bg-zinc-900 md:rounded-t-2xl">
                    <div class="flex items-center gap-2">
                        <button @click="showMobileCart = false" class="md:hidden p-1">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <h3 class="font-bold text-gray-700 dark:text-zinc-200">Keranjang</h3>
                    </div>
                    <button @click="cart = []; showMobileCart = false"
                        class="text-xs text-red-500 font-medium">Reset</button>
                </div>

                {{-- List Items --}}
                <div class="flex-1 overflow-y-auto p-4 space-y-3">
                    <template x-for="(item, index) in cart" :key="index">
                        <div
                            class="flex items-center gap-3 bg-gray-50 dark:bg-zinc-800/50 p-3 rounded-xl border border-gray-100 dark:border-zinc-800">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white truncate" x-text="item.name">
                                </p>
                                <p class="text-xs text-gray-500" x-text="formatRupiah(item.price)"></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button @click="decreaseQty(index)"
                                    class="w-7 h-7 rounded-lg bg-white dark:bg-zinc-700 shadow-sm flex items-center justify-center font-bold text-gray-600 dark:text-zinc-200">-</button>
                                <span class="text-sm font-bold w-4 text-center dark:text-white"
                                    x-text="item.quantity"></span>
                                <button @click="increaseQty(index)"
                                    class="w-7 h-7 rounded-lg bg-white dark:bg-zinc-700 shadow-sm flex items-center justify-center font-bold text-gray-600 dark:text-zinc-200">+</button>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Checkout Area (Sticky di bawah) --}}
                <div class="p-4 bg-gray-50 dark:bg-zinc-900 border-t dark:border-zinc-800 md:rounded-b-2xl">
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        {{-- Total Display --}}
                        <div class="flex justify-between items-end mb-4">
                            <span class="text-sm text-gray-500">Total Tagihan</span>
                            <span class="text-xl font-black text-primary" x-text="formatRupiah(grandTotal())"></span>
                        </div>

                        {{-- Hidden Inputs --}}
                        <template x-for="(item, index) in cart" :key="index">
                            <div>
                                <input type="hidden" :name="`items[${index}][product_id]`" :value="item.id">
                                <input type="hidden" :name="`items[${index}][quantity]`" :value="item.quantity">
                            </div>
                        </template>

                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="col-span-2">
                                <label class="text-[10px] uppercase font-bold text-gray-400 px-1">Uang Bayar</label>
                                <input type="number" x-model.number="cashReceived" @input="calculateChange()"
                                    class="w-full p-3 rounded-xl border dark:bg-zinc-800 dark:border-zinc-700 dark:text-white font-bold text-lg outline-none focus:ring-2 focus:ring-primary"
                                    placeholder="0">
                            </div>

                            <div
                                class="flex justify-between items-center pt-2 border-t border-blue-200 dark:border-blue-800 mt-2">
                                <span class="text-xs font-bold text-gray-500 uppercase">Kembalian</span>
                                <span class="text-lg font-black"
                                    :class="change < 0 ? 'text-red-500' : 'text-green-600 dark:text-green-400'"
                                    x-text="formatRupiah(change)">
                                </span>
                            </div>
                        </div>

                        <button type="submit" :disabled="cart.length === 0 || change < 0"
                            class="w-full py-4 bg-primary hover:bg-primary/90 disabled:bg-gray-300 dark:disabled:bg-zinc-800 text-white font-black rounded-2xl shadow-lg transition transform active:scale-95">
                            <span x-show="change >= 0">BAYAR SEKARANG</span>
                            <span x-show="change < 0">UANG KURANG</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function posSystem(products) {
            return {
                search: '',
                selectedCategory: '',
                products_db: products,
                categories: [...new Set(products.map(p => p.category?.name).filter(Boolean))],
                cart: [],
                tax: 0,
                discount: 0,
                payment_status: 'paid',

                // State Baru
                cashReceived: 0,
                change: 0,

                showMobileCart: false, // Tambahkan ini
                cashReceived: 0,
                change: 0,

                // Pastikan saat menambah produk di HP, keranjang tidak langsung menutup produk
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
                    this.calculateChange();

                },

                get filteredProducts() {
                    return this.products_db.filter(p => {
                        const matchSearch = p.name.toLowerCase().includes(this.search.toLowerCase()) ||
                            (p.barcode && p.barcode.includes(this.search));
                        const matchCategory = this.selectedCategory === '' ||
                            (p.category && p.category.name === this.selectedCategory);
                        return matchSearch && matchCategory;
                    });
                },

                // Fungsi baru untuk hitung kembalian
                calculateChange() {
                    this.change = this.cashReceived - this.grandTotal();
                },

                // Update grandTotal agar juga mentrigger kembalian saat pajak/diskon diubah
                grandTotal() {
                    const total = Math.max(0, (this.subTotal() + parseFloat(this.tax || 0)) - parseFloat(this.discount ||
                        0));
                    // Trigger hitung kembalian setiap kali total berubah
                    this.change = this.cashReceived - total;
                    return total;
                },

                // Pastikan saat tambah/hapus item, kembalian terupdate
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
                    this.calculateChange(); // Update kembalian
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
