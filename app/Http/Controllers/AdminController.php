<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Payment;

class AdminController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function index()
    {
        // Jumlah produk
        $totalProducts = Product::count();

        // Jumlah user (tidak termasuk admin)
        $totalUsers = User::where('role', 'user')->count();

        // Jumlah pembayaran
        $totalPayments = Payment::count();

        // Total pendapatan (hanya pembayaran Paid)
        $totalIncome = Payment::where('status', 'Paid')->sum('amount');

        // 10 pembayaran terbaru
        $latestPayments = Payment::with(['user', 'product'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalUsers',
            'totalPayments',
            'totalIncome',
            'latestPayments'
        ));
    }
}