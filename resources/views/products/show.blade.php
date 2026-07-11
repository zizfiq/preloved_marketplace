@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="row">

        <div class="col-md-5">

            <div class="card shadow">

                <img src="{{ $product->image_url }}"
                     class="card-img-top"
                     style="height:450px; object-fit:cover;">

            </div>

        </div>

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="mb-3">

                        {{ $product->name }}

                    </h2>

                    <h3 class="text-success">

                        {{ $product->formatted_price }}

                    </h3>

                    <hr>

                    <table class="table">

                        <tr>

                            <th width="180">

                                Kategori

                            </th>

                            <td>

                                {{ $product->category }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Kondisi

                            </th>

                            <td>

                                {{ $product->condition }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Stok

                            </th>

                            <td>

                                {{ $product->stock }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Penjual

                            </th>

                            <td>

                                {{ $product->user->name }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Status

                            </th>

                            <td>

                                @if($product->status=='available')

                                    <span class="badge bg-success">

                                        Tersedia

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Sold Out

                                    </span>

                                @endif

                            </td>

                        </tr>

                    </table>

                    <hr>

                    <h5>

                        Deskripsi Produk

                    </h5>

                    <p>

                        {{ $product->description }}

                    </p>

                    <hr>

                    @auth

                        @if($product->status == 'available' && $product->stock > 0)

                            <a href="{{ route('payment.create',$product->id) }}"
                               class="btn btn-success">

                                💳 Beli Sekarang

                            </a>

                        @else

                            <button class="btn btn-secondary" disabled>

                                Stok Habis / Sudah Terjual

                            </button>

                        @endif

                    @else

                        <a href="{{ route('login') }}"
                           class="btn btn-warning">

                            Login Untuk Membeli

                        </a>

                    @endauth

                    <a href="{{ route('products.index') }}"
                       class="btn btn-secondary">

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection