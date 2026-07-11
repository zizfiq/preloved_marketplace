@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h3>

                        Detail Pembayaran

                    </h3>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <img
                                src="{{ $payment->product->image_url }}"
                                class="img-fluid rounded shadow">

                        </div>

                        <div class="col-md-8">

                            <table class="table">

                                <tr>

                                    <th>Produk</th>

                                    <td>

                                        {{ $payment->product->name }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>Harga</th>

                                    <td>

                                        {{ $payment->formatted_amount }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>Metode</th>

                                    <td>

                                        {{ $payment->payment_method }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>Status</th>

                                    <td>

                                        @if($payment->status=="Pending")

                                            <span class="badge bg-warning">

                                                Pending

                                            </span>

                                        @elseif($payment->status=="Paid")

                                            <span class="badge bg-success">

                                                Paid

                                            </span>

                                        @else

                                            <span class="badge bg-danger">

                                                Rejected

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            </table>

                        </div>

                    </div>

                    <hr>

                    <h5>

                        Bukti Transfer

                    </h5>

                    @if($payment->proof)

                        <img
                            src="{{ asset('storage/'.$payment->proof) }}"
                            class="img-fluid rounded border">

                    @else

                        <div class="alert alert-warning">

                            Bukti pembayaran belum tersedia.

                        </div>

                    @endif

                    <hr>

                    <a href="{{ route('payment.history') }}"
                        class="btn btn-secondary">

                        Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection