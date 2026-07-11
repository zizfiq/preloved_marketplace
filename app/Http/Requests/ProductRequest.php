<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Semua user yang login boleh mengakses.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validasi input produk.
     */
    public function rules(): array
    {
        return [

            'name' => 'required|max:255',

            'description' => 'required',

            'price' => 'required|numeric|min:1000',

            'category' => 'required',

            'condition' => 'required',

            'stock' => 'required|integer|min:1',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        ];
    }

    /**
     * Pesan error.
     */
    public function messages(): array
    {
        return [

            'name.required' => 'Nama produk wajib diisi.',

            'price.required' => 'Harga wajib diisi.',

            'price.numeric' => 'Harga harus berupa angka.',

            'description.required' => 'Deskripsi wajib diisi.',

            'category.required' => 'Kategori wajib dipilih.',

            'condition.required' => 'Kondisi wajib dipilih.',

            'stock.required' => 'Stok wajib diisi.',

            'image.image' => 'File harus berupa gambar.',

        ];
    }
}