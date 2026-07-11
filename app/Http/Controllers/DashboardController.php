<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard penjual.
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('dashboard.index', compact('products'));
    }
}