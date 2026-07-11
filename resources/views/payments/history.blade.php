@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <h2 class="mb-4">
        Riwayat Pembayaran
    </h2>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-success">

                    <tr>

                        <th>No</th>

                        <th>Produk</th>

                        <th>Total</th>

                        <th>Metode</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($payments as $payment)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $payment->product->name }}</td>

                        <td>{{ $payment->formatted_amount }}</td>

                        <td>{{ $payment->payment_method }}</td>

                        <td>

                            @if($payment->status == 'Pending')

                                <span class="badge bg-warning">

                                    Pending

                                </span>

                            @elseif($payment->status == 'Paid')

                                <span class="badge bg-success">

                                    Paid

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Rejected

                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('payment.show',$payment->id) }}"
                               class="btn btn-primary btn-sm">

                                Detail

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Belum ada riwayat pembayaran.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $payments->links() }}

            </div>

        </div>

    </div>

</div>

@endsection