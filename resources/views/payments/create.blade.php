@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h3 class="mb-0">
                        Checkout Pembayaran
                    </h3>

                </div>

                <div class="card-body">

                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <div class="row">

                        <div class="col-md-5">

                            <img src="{{ $product->image_url }}"
                                 class="img-fluid rounded shadow">

                        </div>

                        <div class="col-md-7">

                            <h3>{{ $product->name }}</h3>

                            <hr>

                            <h4 class="text-success">

                                Rp {{ number_format($product->price,0,',','.') }}

                            </h4>

                            <p>

                                <strong>Kategori :</strong>

                                {{ $product->category }}

                            </p>

                            <p>

                                <strong>Kondisi :</strong>

                                {{ $product->condition }}

                            </p>

                            <p>

                                {{ $product->description }}

                            </p>

                        </div>

                    </div>

                    <hr>

                    <form action="{{ route('payment.store') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        <input
                            type="hidden"
                            name="product_id"
                            value="{{ $product->id }}">

                        <div class="mb-3">

                            <label class="form-label">

                                Metode Pembayaran

                            </label>

                            <select
                                class="form-select"
                                name="payment_method"
                                required>

                                <option value="BCA">

                                    Transfer BCA

                                </option>

                                <option value="BNI">

                                    Transfer BNI

                                </option>

                                <option value="BRI">

                                    Transfer BRI

                                </option>

                                <option value="Mandiri">

                                    Transfer Mandiri

                                </option>

                                <option value="QRIS">

                                    QRIS

                                </option>

                            </select>

                        </div>

                        <div class="alert alert-warning">

                            <h5>

                                Informasi Pembayaran

                            </h5>

                            <hr>

                            <p>

                                <strong>BCA</strong>

                                <br>

                                1234567890

                                <br>

                                a.n Marketplace Preloved

                            </p>

                            <p>

                                <strong>BNI</strong>

                                <br>

                                9876543210

                                <br>

                                a.n Marketplace Preloved

                            </p>

                            <p>

                                <strong>Mandiri</strong>

                                <br>

                                5555555555

                                <br>

                                a.n Marketplace Preloved

                            </p>

                            <p>

                                <strong>BRI</strong>

                                <br>

                                4444444444

                                <br>

                                a.n Marketplace Preloved

                            </p>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Upload Bukti Transfer

                            </label>

                            <input
                                type="file"
                                class="form-control"
                                name="proof"
                                required>

                        </div>

                        <button
                            class="btn btn-success">

                            Bayar Sekarang

                        </button>

                        <a href="{{ route('products.show',$product->id) }}"
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