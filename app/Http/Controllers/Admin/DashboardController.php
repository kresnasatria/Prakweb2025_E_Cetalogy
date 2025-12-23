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
        $totalPemasukan = Order::where('status', 'completed')->sum('total_amount');
        $totalProduk = Product::count();
        $totalKategori = Category::count();
        $totalPesanan = Order::count();
        $totalUser = User::count();

        $pemasukanHariIni = Order::where('status', 'completed')
            ->whereDate('created_at', today())
            ->sum('total_amount');
        $pemasukanBulanIni = Order::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');
        $pemasukanTotal = $totalPemasukan;

        return view('admin.dashboard', [
            'totalPemasukan' => $totalPemasukan,
            'totalProduk' => $totalProduk,
            'totalKategori' => $totalKategori,
            'totalPesanan' => $totalPesanan,
            'totalUser' => $totalUser,
            'pemasukanHariIni' => $pemasukanHariIni,
            'pemasukanBulanIni' => $pemasukanBulanIni,
            'pemasukanTotal' => $pemasukanTotal,
        ]);
    }
}
