@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            <h3 class="mb-0">

                Dashboard Verifikasi Pembayaran

            </h3>

        </div>

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <table class="table table-bordered table-striped align-middle">

                <thead class="table-success">

                    <tr>

                        <th>No</th>

                        <th>Pembeli</th>

                        <th>Produk</th>

                        <th>Nominal</th>

                        <th>Metode</th>

                        <th>Bukti</th>

                        <th>Status</th>

                        <th width="180">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($payments as $payment)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            {{ $payment->user->name }}

                        </td>

                        <td>

                            {{ $payment->product->name }}

                        </td>

                        <td>

                            {{ $payment->formatted_amount }}

                        </td>

                        <td>

                            {{ $payment->payment_method }}

                        </td>

                        <td>

                            @if($payment->proof)

                                <img
                                    src="{{ asset('storage/'.$payment->proof) }}"
                                    width="100"
                                    class="rounded border">

                            @else

                                -

                            @endif

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

                        <td>

                            @if($payment->status=='Pending')

                                <form
                                    action="{{ route('payment.verify',$payment->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('PUT')

                                    <button
                                        class="btn btn-success btn-sm">

                                        Approve

                                    </button>

                                </form>

                                <form
                                    action="{{ route('payment.reject',$payment->id) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf

                                    @method('PUT')

                                    <button
                                        class="btn btn-danger btn-sm">

                                        Reject

                                    </button>

                                </form>

                            @else

                                -

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            Belum ada pembayaran.

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