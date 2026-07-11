@extends('layouts.app')

@section('content')

<!-- Hero -->
<div class="bg-success text-white rounded p-5 mb-4">
    <div class="container">
        <h1 class="display-5 fw-bold">
            Marketplace Preloved
        </h1>

        <p class="lead">
            Temukan barang bekas berkualitas dengan harga terbaik.
        </p>

        <a href="{{ route('products.index') }}" class="btn btn-warning">
            Belanja Sekarang
        </a>
    </div>
</div>

<!-- Kategori -->
<div class="mb-4">

    <h3 class="mb-3">
        Kategori
    </h3>

    <div class="d-flex flex-wrap gap-2">

        <a href="{{ route('products.index') }}"
            class="btn btn-outline-success">

            Semua

        </a>

        @foreach($categories as $category)

        <a href="{{ route('products.index',['category'=>$category]) }}"
            class="btn btn-outline-primary">

            {{ $category }}

        </a>

        @endforeach

    </div>

</div>

<!-- Produk -->

<h3 class="mb-4">

Produk Terbaru

</h3>

<div class="row">

@forelse($latestProducts as $product)

<div class="col-md-3 mb-4">

<div class="card h-100 shadow-sm">

@if($product->image)

<img src="{{ asset('storage/'.$product->image) }}"
class="card-img-top"
style="height:220px;object-fit:cover;">

@else

<img src="https://via.placeholder.com/300x220?text=No+Image"
class="card-img-top">

@endif

<div class="card-body">

<h5>

{{ $product->name }}

</h5>

<p class="text-success fw-bold">

Rp {{ number_format($product->price,0,',','.') }}

</p>

<p>

Kategori :
{{ $product->category }}

</p>

<p>

Kondisi :
{{ $product->condition }}

</p>

</div>

<div class="card-footer bg-white">

<a href="{{ route('products.show',$product->id) }}"
class="btn btn-success w-100">

Lihat Detail

</a>

</div>

</div>

</div>

@empty

<div class="col-12">

<div class="alert alert-warning">

Belum ada produk.

</div>

</div>

@endforelse

</div>

@endsection