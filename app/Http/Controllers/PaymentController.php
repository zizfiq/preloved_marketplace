<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Halaman Checkout
     */
    public function create(Product $product)
    {
        return view('payments.create', compact('product'));
    }

    /**
     * Simpan Pembayaran
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'       => 'required|exists:products,id',
            'payment_method'   => 'required|string|max:100',
            'proof'            => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->status != 'available' || $product->stock <= 0) {

            return redirect()
                    ->route('products.show', $product->id)
                    ->with('error', 'Maaf, produk ini sudah tidak tersedia / stok habis.');

        }

        $proof = null;

        if ($request->hasFile('proof')) {

            $proof = $request->file('proof')->store('payments', 'public');

        }

        Payment::create([

            'user_id'          => Auth::id(),

            'product_id'       => $product->id,

            'payment_method'   => $request->payment_method,

            'proof'            => $proof,

            'amount'           => $product->price,

            'status'           => 'Pending',

            'invoice'          => 'INV-' . now()->format('Ymd') . '-' . strtoupper(uniqid()),

        ]);

        return redirect()
                ->route('payment.history')
                ->with('success', 'Pembayaran berhasil dikirim.');
    }

    /**
     * Riwayat Pembayaran
     */
    public function history()
    {
        $payments = Payment::with('product')
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('payments.history', compact('payments'));
    }

    /**
     * Detail Pembayaran
     */
    public function show(Payment $payment)
    {
        if ($payment->user_id != Auth::id()) {

            abort(403);

        }

        return view('payments.show', compact('payment'));
    }

    /**
     * Dashboard Admin
     */
    public function admin()
    {
        $payments = Payment::with(['user','product'])
                    ->latest()
                    ->paginate(10);

        return view('payments.admin', compact('payments'));
    }

    /**
     * Verifikasi Pembayaran
     */
    public function verify($id)
    {
        $payment = Payment::with('product')->findOrFail($id);

        $payment->status = 'Paid';

        $payment->save();

        // Kurangi stok produk & tandai terjual jika stok habis
        $product = $payment->product;

        if ($product) {

            $newStock = max(0, $product->stock - 1);

            $product->stock = $newStock;

            if ($newStock <= 0) {
                $product->status = 'sold';
            }

            $product->save();

        }

        return redirect()
                ->back()
                ->with('success','Pembayaran berhasil diverifikasi, status produk diperbarui.');
    }

    /**
     * Tolak Pembayaran
     */
    public function reject($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->status = 'Rejected';

        $payment->save();

        return redirect()
                ->back()
                ->with('success','Pembayaran ditolak.');
    }
}