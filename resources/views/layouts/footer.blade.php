<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            {{-- Kolom 1: Brand & Deskripsi --}}
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('GetReloved.png') }}" 
                    class="h-4 w-auto">    
                </div>
                <p class="text-gray-500 text-sm leading-relaxed max-w-xs">
                GetReloved percaya fashion bukan hanya soal tampilan, tapi tentang pilihan sadar. Dengan memperpanjang usia pakai pakaian, kami ikut mengurangi limbah dan dampak berlebih industri fashion.                </p>
            </div>

            {{-- Kolom 2: Navigasi Cepat --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">Navigasi</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-blue-600 text-sm transition">
                            Katalog Produk
                        </a>
                    </li>
                    @auth
                        <li>
                            <a href="{{ route('cart.view') }}" class="text-gray-500 hover:text-blue-600 text-sm transition">
                                Keranjang Belanja
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('orders.index') }}" class="text-gray-500 hover:text-blue-600 text-sm transition">
                                Riwayat Pesanan
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="text-gray-500 hover:text-blue-600 text-sm transition">
                                Login
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="text-gray-500 hover:text-blue-600 text-sm transition">
                                Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            {{-- Kolom 3: Kontak / Info Kampus --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">Hubungi Kami</h3>
                <ul class="space-y-3 text-gray-500 text-sm">
                    <li class="flex items-start gap-2">
                        <span>📍</span>
                        <span>
                            GetReloved<br>
                            Setiabudi, Sukajadi<br>
                            Bandung, Indonesia
                        </span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span>📧</span>
                        <a href="mailto:admin@unpas.ac.id" class="hover:text-blue-600">contact@GetReloved.co.id</a>
                    </li>
                </ul>
            </div>
        </div>

       
        {{-- Copyright Bawah --}}
        <div class="border-t border-gray-100 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-400">
                &copy; {{ date('Y') }} GetReloved. All rights reserved.
            </p>
        </div>
    </div>
</footer>