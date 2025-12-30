<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Total pemasukan dari pesanan yang selesai
        $totalPemasukan = Order::where('status', 'completed')
            ->sum('total_amount');

        // Data ringkasan
        $totalProduk = Product::count();
        $totalKategori = Category::count();
        $totalPesanan = Order::count();
        $totalUser = User::count();

        // Pemasukan hari ini
        $pemasukanHariIni = Order::where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('total_amount');

        // Pemasukan bulan ini
        $pemasukanBulanIni = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');

        return view('admin.dashboard', [
            'totalPemasukan' => $totalPemasukan,
            'totalProduk' => $totalProduk,
            'totalKategori' => $totalKategori,
            'totalPesanan' => $totalPesanan,
            'totalUser' => $totalUser,
            'pemasukanHariIni' => $pemasukanHariIni,
            'pemasukanBulanIni' => $pemasukanBulanIni,
        ]);
    }
}
