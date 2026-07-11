@extends('layouts.app')

@section('content')

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">Dashboard Penjual</h2>
            <p class="text-muted mb-0">
                Selamat datang, {{ Auth::user()->name }}
            </p>
        </div>

        <a href="{{ route('products.create') }}" class="btn btn-success">
            + Tambah Produk
        </a>

    </div>

    <!-- Statistik -->
    <div class="row mb-4">

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h6>Total Produk</h6>

                    <h2 class="text-success">

                        {{ $products->count() }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h6>Produk Tersedia</h6>

                    <h2 class="text-primary">

                        {{ $products->where('status','available')->count() }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow border-0">

                <div class="card-body text-center">

                    <h6>Produk Habis</h6>

                    <h2 class="text-danger">

                        {{ $products->where('status','sold')->count() }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <!-- Pesan -->
    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <!-- Tabel Produk -->

    <div class="card shadow">

        <div class="card-header bg-success text-white">

            Daftar Produk Saya

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th width="60">No</th>

                        <th width="120">Foto</th>

                        <th>Nama Produk</th>

                        <th>Kategori</th>

                        <th>Harga</th>

                        <th>Stok</th>

                        <th>Status</th>

                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($products as $product)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            <img
                                src="{{ $product->image_url }}"
                                width="80"
                                class="rounded shadow-sm">

                        </td>

                        <td>

                            <strong>

                                {{ $product->name }}

                            </strong>

                        </td>

                        <td>

                            {{ $product->category }}

                        </td>

                        <td>

                            {{ $product->formatted_price }}

                        </td>

                        <td>

                            {{ $product->stock }}

                        </td>

                        <td>

                            @if($product->status == 'available')

                                <span class="badge bg-success">

                                    Tersedia

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Terjual

                                </span>

                            @endif

                        </td>

                        <td>

                            <a
                                href="{{ route('products.show',$product->id) }}"
                                class="btn btn-info btn-sm">

                                Detail

                            </a>

                            <a
                                href="{{ route('products.edit',$product->id) }}"
                                class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form
                                action="{{ route('products.destroy',$product->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                    class="btn btn-danger btn-sm">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            Belum ada produk.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $products->links() }}

            </div>

        </div>

    </div>

</div>

@endsection