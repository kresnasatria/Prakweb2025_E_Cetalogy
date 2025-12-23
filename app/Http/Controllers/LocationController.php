<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    public function getLocation(Request $request)
    {
        // Dapatkan IP user
        $ip = $request->ip();

        // Panggil API ip-api.com
        $response = Http::get("http://ip-api.com/json/{$ip}");

        // Ambil data lokasi
        $location = $response->json();

        // Kirim ke view
        return view('location.show', compact('location'));
    }
}