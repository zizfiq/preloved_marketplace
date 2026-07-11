@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">

        Dashboard Admin

    </h2>

    <div class="row">

        <div class="col-md-3">

            <div class="card bg-primary text-white shadow">

                <div class="card-body text-center">

                    <h5>Total Produk</h5>

                    <h2>{{ $totalProducts }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-success text-white shadow">

                <div class="card-body text-center">

                    <h5>Total User</h5>

                    <h2>{{ $totalUsers }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-warning text-dark shadow">

                <div class="card-body text-center">

                    <h5>Total Pembayaran</h5>

                    <h2>{{ $totalPayments }}</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-danger text-white shadow">

                <div class="card-body text-center">

                    <h5>Total Pendapatan</h5>

                    <h4>

                        Rp {{ number_format($totalIncome,0,',','.') }}

                    </h4>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow mt-4">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

            <span>Pembayaran Terbaru</span>

            <a href="{{ route('payment.admin') }}" class="btn btn-sm btn-success">

                ✅ Verifikasi Pembayaran

            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead class="table-success">

                    <tr>

                        <th>No</th>

                        <th>Pembeli</th>

                        <th>Produk</th>

                        <th>Nominal</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($latestPayments as $payment)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $payment->user->name }}</td>

                        <td>{{ $payment->product->name }}</td>

                        <td>

                            Rp {{ number_format($payment->amount,0,',','.') }}

                        </td>

                        <td>

                            @if($payment->status=='Pending')

                                <span class="badge bg-warning">

                                    Pending

                                </span>

                            @elseif($payment->status=='Paid')

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

                    @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            Belum ada pembayaran.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection