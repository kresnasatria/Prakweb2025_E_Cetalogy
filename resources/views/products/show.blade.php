<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">


        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Left Section - Product Images -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        <!-- Main Image -->
                        <div class="relative bg-gray-100 flex items-center justify-center" style="min-height: 500px;">
                            <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover">


                        </div>

                        <!-- Thumbnail Images -->
                        {{-- <div class="p-4 flex space-x-2 overflow-x-auto">
                            <div
                                class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-lg cursor-pointer border-2 border-black">
                                <img src="{{ $product->thumbnail }}" alt="Thumbnail"
                                    class="w-full h-full object-cover rounded-lg">
                            </div>
                            @for ($i = 1; $i <= 5; $i++)
                                <div
                                    class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-lg cursor-pointer hover:border-2 hover:border-gray-400">
                                    <img src="{{ $product->thumbnail }}" alt="Thumbnail {{ $i }}"
                                        class="w-full h-full object-cover rounded-lg opacity-70">
                                </div>
                            @endfor
                        </div> --}}
                    </div>
                </div>

                <!-- Right Section - Product Info -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-4">

                        <!-- Staff Pick Badge -->
                        <div class="flex items-center space-x-2 mb-3">
                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm text-blue-500 font-medium">{{ $product->category->name }}</span>
                        </div>

                        <!-- Product Title -->
                        <h1 class="text-2xl font-bold text-gray-900 mb-2 uppercase">
                            {{ $product->name }}
                        </h1>

                        <!-- Price -->
                        <div class="text-3xl font-bold text-gray-900 mb-6">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3 mb-6">
                            <button
                                class="w-full bg-black text-white font-bold py-4 rounded-lg hover:bg-gray-800 transition-colors">
                                Beli langsung
                            </button>
                            <button
                                class="w-full bg-white text-black font-bold py-4 rounded-lg border-2 border-black hover:bg-gray-50 transition-colors">
                                + Keranjang
                            </button>
                        </div>

                        <!-- Product Details -->
                        <div class="border-t pt-6">
                            <h3 class="font-bold text-gray-900 mb-3">Detail</h3>
                            <div class="space-y-2 text-sm">
                                <span id="short-description">{{ Str::limit($product->description, 200) }}</span>
                                <span id="full-description" style="display: none;">{{ $product->description }}</span>
                                <button id="toggle-description" class="text-blue-600 text-sm mt-2 hover:underline">
                                    Selengkapnya
                                </button>
                            </div>

                            {{-- <h3 class="font-bold text-gray-900 mt-3">Stok</h3> --}}
                            <div class="space-y-2 text-sm mt-3 font-semibold">
                                @if ($product->stock > 0)
                                    <span class="text-green-700">Stok tersedia</span>
                                @else
                                    <span class="text-red-500">Stok habis</span>
                                @endif
                            </div>

                            <!-- Tags -->
                            {{-- <div class="mt-4 flex flex-wrap gap-2">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-pink-50 text-pink-700 border border-pink-200">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Pink, Cream
                                </span>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-700 border border-gray-300">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Casual
                                </span>
                            </div> --}}


                        </div>

                        <!-- Buyer Protection -->
                        <div class="border-t mt-6 pt-6">
                            <div class="flex items-center justify-between p-3 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Perlindungan Pembeli</p>
                                        <p class="text-xs text-gray-500">Belanja di Preloved aman dengan garansi
                                            pengembalian dana.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Produk Serupa --}}
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Serupa</h2>
                <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($relatedProducts as $relatedProduct)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <a href="{{ route('products.show', $relatedProduct->slug) }}">
                                <img src="{{ $relatedProduct->thumbnail ?? 'https://placehold.co/300x200' }}"
                                    alt="{{ $relatedProduct->name }}" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-4">
                                <span
                                    class="text-xs text-blue-600 font-semibold">{{ $relatedProduct->category->name ?? 'Uncategorized' }}</span>
                                <h3 class="font-semibold text-gray-800 mt-1 truncate">
                                    <a href="{{ route('products.show', $relatedProduct->slug) }}"
                                        class="hover:text-blue-600">
                                        {{ $relatedProduct->name }}
                                    </a>
                                </h3>
                                <p class="text-lg font-bold text-green-600 mt-2">
                                    Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">Stok: {{ $relatedProduct->stock }}</p>

                                {{-- Add to Cart Button --}}
                                <div class="mt-4 flex gap-2">
                                    @if ($relatedProduct->stock > 0)
                                        @auth
                                            <form action="{{ route('cart.add', $relatedProduct) }}" method="POST"
                                                class="flex-1">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 text-sm font-semibold transition">
                                                    + Keranjang
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}"
                                                class="flex-1 bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 text-center text-sm font-semibold transition">
                                                Login untuk Beli
                                            </a>
                                        @endauth
                                        <a href="{{ route('products.show', $relatedProduct->slug) }}"
                                            class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-md hover:bg-gray-300 text-center text-sm font-semibold transition">
                                            Lihat
                                        </a>
                                    @else
                                        <button type="button" disabled
                                            class="w-full bg-gray-300 text-gray-500 py-2 rounded-md text-sm font-semibold cursor-not-allowed">
                                            Stok Habis
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500 text-lg">Produk serupa tidak ditemukan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggle-description').addEventListener('click', function() {
            var short = document.getElementById('short-description');
            var full = document.getElementById('full-description');
            var button = this;
            if (full.style.display === 'none') {
                short.style.display = 'none';
                full.style.display = 'inline';
                button.textContent = 'Sembunyikan';
            } else {
                short.style.display = 'inline';
                full.style.display = 'none';
                button.textContent = 'Selengkapnya';
            }
        });
    </script>

</x-app-layout>
