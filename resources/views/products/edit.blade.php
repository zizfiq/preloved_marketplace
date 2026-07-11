@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-warning text-dark">

                    <h4 class="mb-0">Edit Produk</h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('products.update', $product->id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $product->name) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Harga</label>

                            <input
                                type="number"
                                name="price"
                                class="form-control"
                                value="{{ old('price', $product->price) }}"
                                required>
                        </div>

                        <div class="mb-3">

                            <label class="form-label">Kategori</label>

                            <select
                                name="category"
                                class="form-select">

                                <option value="Fashion" {{ $product->category == 'Fashion' ? 'selected' : '' }}>Fashion</option>

                                <option value="Elektronik" {{ $product->category == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>

                                <option value="Tas" {{ $product->category == 'Tas' ? 'selected' : '' }}>Tas</option>

                                <option value="Sepatu" {{ $product->category == 'Sepatu' ? 'selected' : '' }}>Sepatu</option>

                                <option value="Aksesoris" {{ $product->category == 'Aksesoris' ? 'selected' : '' }}>Aksesoris</option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Kondisi</label>

                            <select
                                name="condition"
                                class="form-select">

                                <option value="Baru" {{ $product->condition == 'Baru' ? 'selected' : '' }}>Baru</option>

                                <option value="Bekas" {{ $product->condition == 'Bekas' ? 'selected' : '' }}>Bekas</option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Stok</label>

                            <input
                                type="number"
                                name="stock"
                                class="form-control"
                                value="{{ old('stock', $product->stock) }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Deskripsi</label>

                            <textarea
                                name="description"
                                rows="5"
                                class="form-control"
                                required>{{ old('description', $product->description) }}</textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Foto Saat Ini</label>

                            <br>

                            @if($product->image)

                                <img
                                    src="{{ $product->image_url }}"
                                    width="220"
                                    class="img-thumbnail rounded shadow">

                            @endif

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Ganti Foto</label>

                            <input
                                type="file"
                                name="image"
                                class="form-control"
                                accept="image/*">

                        </div>

                        <button
                            type="submit"
                            class="btn btn-warning">

                            Update Produk

                        </button>

                        <a
                            href="{{ route('dashboard') }}"
                            class="btn btn-secondary">

                            Kembali

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection