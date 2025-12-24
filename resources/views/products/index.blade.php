@extends('layouts.app')

@section('content')
    
    @auth
        <div class="w-screen relative left-[calc(-50vw+50%)] mb-8 -mt-6 py-8 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <form id="filterForm" method="GET" action="{{ route('products.index') }}">
                    
                    {{-- Search Bar --}}
                    <div class="max-w-3xl mx-auto text-center mb-8">
                        <label class="block text-3xl font-extrabold text-gray-800 mb-6">Apa yang ingin Anda cari?</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                                   placeholder="Ketik nama baju, celana, atau produk lainnya..."
                                   class="pl-14 block w-full bg-white border-0 rounded-full shadow-lg ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 py-4 text-gray-700 text-lg transition hover:shadow-xl">
                        </div>
                    </div>

                    {{-- Filter Lanjutan --}}
                    <div class="px-2">
                        <div class="flex items-center gap-2 mb-2 text-gray-400 uppercase tracking-wide text-[10px] font-bold pl-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                            Filter Lanjutan
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-5 gap-3 items-end">
                            {{-- Input Kategori --}}
                            <div>
                                <select name="category" id="categoryFilter" class="w-full bg-white border-0 rounded-md shadow-sm ring-1 ring-gray-200 focus:ring-blue-500 py-2 text-sm text-gray-600">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Input Harga Min --}}
                            <div>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><span class="text-gray-400 text-xs">Rp</span></div>
                                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" 
                                           class="pl-8 w-full bg-white border-0 rounded-md shadow-sm ring-1 ring-gray-200 focus:ring-blue-500 py-2 text-sm text-gray-600">
                                </div>
                            </div>
                            {{-- Input Harga Max --}}
                            <div>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><span class="text-gray-400 text-xs">Rp</span></div>
                                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" 
                                           class="pl-8 w-full bg-white border-0 rounded-md shadow-sm ring-1 ring-gray-200 focus:ring-blue-500 py-2 text-sm text-gray-600">
                                </div>
                            </div>
                            {{-- Input Sorting --}}
                            <div>
                                <select name="sort" id="sortFilter" class="w-full bg-white border-0 rounded-md shadow-sm ring-1 ring-gray-200 focus:ring-blue-500 py-2 text-sm text-gray-600">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Termurah</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Termahal</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>A-Z</option>
                                </select>
                            </div>
                            {{-- Tombol Reset & Cari --}}
                            <div class="flex gap-2">
                                <a href="{{ route('products.index') }}" class="flex-1 py-2 text-center text-gray-500 hover:text-gray-800 text-sm font-medium transition border border-gray-200 rounded-md hover:bg-gray-50 bg-white">
                                    Reset
                                </a>
                                <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 shadow-sm transition font-medium text-sm">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endauth


    @guest
        {{-- Carousel Container --}}
        <div class="w-screen relative left-[calc(-50vw+50%)] mb-10 -mt-6"
             x-data="{ 
                activeSlide: 0,
                slides: [
                    { title: 'Selamat Datang di Toko Laravel', text: 'Temukan produk fashion berkualitas dengan harga terbaik.', color: 'from-blue-600 to-indigo-700', btn: 'Daftar Sekarang', link: '{{ route('login') }}' },
                    { title: 'Koleksi Terbaru 2025', text: 'Tampil gaya dengan tren fashion terkini.', color: 'from-purple-600 to-pink-600', btn: 'Lihat Produk', link: '{{ route('login') }}' },
                    { title: 'Diskon Spesial Hari Ini', text: 'Nikmati gratis ongkir untuk pembelian pertama Anda.', color: 'from-green-600 to-teal-600', btn: 'Belanja Yuk', link: '{{ route('login') }}' }
                ],
                next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
                prev() { this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length },
                init() { setInterval(() => this.next(), 5000) }
             }"
             x-init="init()">
            
            {{-- Slide Track --}}
            <div class="relative h-[600px] overflow-hidden">
                <template x-for="(slide, index) in slides" :key="index">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r text-white flex items-center justify-center transition-opacity duration-1000 ease-in-out"
                         :class="slide.color"
                         x-show="activeSlide === index"
                         x-transition:enter="transition ease-out duration-1000"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-1000"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-105">
                        
                        <div class="text-center px-4 max-w-4xl">
                            <h1 class="text-6xl font-extrabold mb-6 leading-tight" x-text="slide.title"></h1>
                            <p class="text-2xl text-white/90 mb-10" x-text="slide.text"></p>
                            <a :href="slide.link" 
                               class="inline-block bg-white text-gray-900 px-10 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition shadow-xl transform hover:-translate-y-1"
                               x-text="slide.btn">
                            </a>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Navigasi Carousel --}}
            <button @click="prev()" class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-4 rounded-full text-white backdrop-blur-sm transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button @click="next()" class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-4 rounded-full text-white backdrop-blur-sm transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="activeSlide = index" 
                            class="w-3 h-3 rounded-full transition-all duration-300"
                            :class="activeSlide === index ? 'bg-white w-10' : 'bg-white/50 hover:bg-white/80'">
                    </button>
                </template>
            </div>
        </div>

        {{-- Info Promo --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-lg shadow p-6 text-center hover:-translate-y-1 transition transform duration-300">
                <div class="text-4xl mb-3">📦</div>
                <h3 class="font-bold text-gray-800 mb-2">Gratis Ongkir</h3>
                <p class="text-gray-500 text-sm">Pengiriman gratis untuk pembelian tertentu</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center hover:-translate-y-1 transition transform duration-300">
                <div class="text-4xl mb-3">✅</div>
                <h3 class="font-bold text-gray-800 mb-2">Produk Original</h3>
                <p class="text-gray-500 text-sm">100% produk asli berkualitas tinggi</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center hover:-translate-y-1 transition transform duration-300">
                <div class="text-4xl mb-3">💳</div>
                <h3 class="font-bold text-gray-800 mb-2">Pembayaran Aman</h3>
                <p class="text-gray-500 text-sm">Transaksi dijamin aman dan terpercaya</p>
            </div>
        </div>
    @endguest


    {{-- DAFTAR PRODUK --}}
    <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Daftar Produk</h2>
            <p class="text-gray-600 text-sm">
                Menampilkan <span class="font-semibold">{{ $products->total() }}</span> produk
                @if(request('search'))
                    untuk "<span class="font-semibold">{{ request('search') }}</span>"
                @endif
            </p>
        </div>

        {{-- Partial View Grid Produk --}}
        <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @include('products.partials.product-grid', ['products' => $products])
        </div>

        <div id="pagination" class="mt-8">
            {{ $products->links() }}
        </div>
    </div>

    {{-- LIVE SEARCH (AJAX) --}}
    @auth
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const sortFilter = document.getElementById('sortFilter');
            let debounceTimer;

            if(searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => { fetchProducts(); }, 500);
                });
            }

            if(categoryFilter) categoryFilter.addEventListener('change', fetchProducts);
            if(sortFilter) sortFilter.addEventListener('change', fetchProducts);

            function fetchProducts() {
                const form = document.getElementById('filterForm');
                if(!form) return;
                
                const formData = new FormData(form);
                const params = new URLSearchParams(formData);

                window.history.replaceState({}, '', `${window.location.pathname}?${params}`);

                fetch(`{{ route('products.index') }}?${params}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('productGrid').innerHTML = data.html;
                    document.getElementById('pagination').innerHTML = data.pagination;
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
    @endauth
@endsection