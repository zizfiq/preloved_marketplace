<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan semua produk.
     */
    public function index(Request $request)
    {
        $query = Product::with('user');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->paginate(9);

        return view('products.index', compact('products'));
    }

    /**
     * Form tambah produk.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Simpan produk.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|max:255',
            'description' => 'required',
            'price'       => 'required|numeric',
            'category'    => 'required',
            'condition'   => 'required',
            'stock'       => 'required|integer|min:1',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'user_id'     => Auth::id(),
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category'    => $request->category,
            'condition'   => $request->condition,
            'stock'       => $request->stock,
            'status'      => 'available',
            'image'       => $image,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Detail produk.
     */
    public function show(Product $product)
    {
        $product->load('user');

        return view('products.show', compact('product'));
    }

    /**
     * Form edit.
     */
    public function edit(Product $product)
    {
        if ($product->user_id != Auth::id()) {
            abort(403);
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Update produk.
     */
    public function update(Request $request, Product $product)
    {
        if ($product->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name'        => 'required|max:255',
            'description' => 'required',
            'price'       => 'required|numeric',
            'category'    => 'required',
            'condition'   => 'required',
            'stock'       => 'required|integer|min:1',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $image = $product->image;

        if ($request->hasFile('image')) {

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category'    => $request->category,
            'condition'   => $request->condition,
            'stock'       => $request->stock,
            'image'       => $image,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk.
     */
    public function destroy(Product $product)
    {
        if ($product->user_id != Auth::id()) {
            abort(403);
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Produk berhasil dihapus.');
    }
}