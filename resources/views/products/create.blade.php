@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h4 class="mb-0">
                        Tambah Produk
                    </h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('products.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Nama Produk
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Harga
                            </label>

                            <input
                                type="number"
                                name="price"
                                class="form-control"
                                value="{{ old('price') }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Kategori
                            </label>

                            <select
                                name="category"
                                class="form-select"
                                required>

                                <option value="">Pilih Kategori</option>

                                <option value="Fashion">Fashion</option>

                                <option value="Elektronik">Elektronik</option>

                                <option value="Sepatu">Sepatu</option>

                                <option value="Tas">Tas</option>

                                <option value="Aksesoris">Aksesoris</option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Kondisi
                            </label>

                            <select
                                name="condition"
                                class="form-select"
                                required>

                                <option value="">Pilih Kondisi</option>

                                <option value="Baru">Baru</option>

                                <option value="Bekas">Bekas</option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Stok
                            </label>

                            <input
                                type="number"
                                name="stock"
                                class="form-control"
                                value="1"
                                min="1"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Deskripsi Produk
                            </label>

                            <textarea
                                name="description"
                                rows="5"
                                class="form-control"
                                required>{{ old('description') }}</textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Upload Foto
                            </label>

                            <input
                                type="file"
                                name="image"
                                class="form-control"
                                accept="image/*"
                                required>

                        </div>

                        <button
                            class="btn btn-success">

                            Simpan Produk

                        </button>

                        <a href="{{ route('dashboard') }}"
                            class="btn btn-secondary">

                            Batal

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection