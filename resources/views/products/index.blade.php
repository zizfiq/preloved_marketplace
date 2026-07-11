@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="row mb-4">

        <div class="col-md-8">
            <h2 class="fw-bold">Belanja Produk Preloved</h2>
            <p class="text-muted">
                Temukan berbagai barang preloved berkualitas dengan harga terbaik.
            </p>
        </div>

    </div>

    <!-- Form Search -->
    <form action="{{ route('products.index') }}" method="GET">

        <div class="row mb-4">

            <div class="col-md-5">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari produk..."
                    value="{{ request('search') }}">

            </div>

            <div class="col-md-4">

                <select
                    name="category"
                    class="form-select">

                    <option value="">Semua Kategori</option>

                    <option value="Fashion"
                        {{ request('category') == 'Fashion' ? 'selected' : '' }}>
                        Fashion
                    </option>

                    <option value="Elektronik"
                        {{ request('category') == 'Elektronik' ? 'selected' : '' }}>
                        Elektronik
                    </option>

                    <option value="Sepatu"
                        {{ request('category') == 'Sepatu' ? 'selected' : '' }}>
                        Sepatu
                    </option>

                    <option value="Tas"
                        {{ request('category') == 'Tas' ? 'selected' : '' }}>
                        Tas
                    </option>

                    <option value="Aksesoris"
                        {{ request('category') == 'Aksesoris' ? 'selected' : '' }}>
                        Aksesoris
                    </option>

                </select>

            </div>

            <div class="col-md-3">

                <button class="btn btn-success w-100">

                    Cari Produk

                </button>

            </div>

        </div>

    </form>

    <div class="row">

        @forelse($products as $product)

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm h-100">

                <div class="position-relative">

                    <img
                        src="{{ $product->image_url }}"
                        class="card-img-top"
                        style="height:250px;object-fit:cover;">

                    @if($product->status != 'available' || $product->stock <= 0)

                        <span class="badge bg-danger position-absolute top-0 end-0 m-2">

                            Terjual

                        </span>

                    @endif

                </div>

                <div class="card-body">

                    <h5 class="fw-bold">

                        {{ $product->name }}

                    </h5>

                    <h4 class="text-success">

                        Rp {{ number_format($product->price,0,',','.') }}

                    </h4>

                    <p class="mb-1">

                        <strong>Kategori :</strong>

                        {{ $product->category }}

                    </p>

                    <p class="mb-1">

                        <strong>Kondisi :</strong>

                        {{ $product->condition }}

                    </p>

                    <p>

                        <strong>Stok :</strong>

                        {{ $product->stock }}

                    </p>

                </div>

                <div class="card-footer bg-white border-0">

                    <a
                        href="{{ route('products.show',$product->id) }}"
                        class="btn btn-success w-100">

                        Lihat Detail

                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-md-12">

            <div class="alert alert-warning text-center">

                Belum ada produk tersedia.

            </div>

        </div>

        @endforelse

    </div>

    <div class="mt-4 d-flex justify-content-center">

        {{ $products->links() }}

    </div>

</div>

@endsection