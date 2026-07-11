<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama Marketplace.
     */
    public function index()
    {
        // Ambil 8 produk terbaru
        $latestProducts = Product::with('user')
            ->where('status', 'available')
            ->latest()
            ->take(8)
            ->get();

        // Ambil daftar kategori unik
        $categories = Product::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('home', compact(
            'latestProducts',
            'categories'
        ));
    }
}