@extends('layouts.app')

@section('content')

<div class="container mt-5">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3">

            <div class="card shadow">

                <div class="card-body text-center">

                    <img src="{{ $user->photo_url }}"
                        class="rounded-circle border shadow mb-3"
                        style="width:150px;height:150px;object-fit:cover;">

                    <h4>{{ $user->name }}</h4>

                    <p class="text-muted">
                        {{ $user->email }}
                    </p>

                    <hr>

                    <div class="list-group">

                        <a href="{{ route('profile.edit') }}"
                            class="list-group-item list-group-item-action active">

                            👤 Profile Saya

                        </a>

                        <a href="{{ route('dashboard') }}"
                            class="list-group-item list-group-item-action">

                            📦 Produk Saya

                        </a>

                        <a href="{{ route('payment.history') }}"
                            class="list-group-item list-group-item-action">

                            💳 Riwayat Pembayaran

                        </a>

                        <a href="{{ route('home') }}"
                            class="list-group-item list-group-item-action">

                            🏠 Beranda

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!-- Konten -->
        <div class="col-md-9">

            <!-- Statistik -->

            <div class="row mb-4">

                <div class="col-md-3">

                    <div class="card bg-primary text-white shadow">

                        <div class="card-body text-center">

                            <h2>{{ $totalProducts }}</h2>

                            <small>Total Produk</small>

                        </div>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card bg-success text-white shadow">

                        <div class="card-body text-center">

                            <h2>{{ $availableProducts }}</h2>

                            <small>Produk Aktif</small>

                        </div>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card bg-danger text-white shadow">

                        <div class="card-body text-center">

                            <h2>{{ $soldProducts }}</h2>

                            <small>Terjual</small>

                        </div>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card bg-warning shadow">

                        <div class="card-body text-center">

                            <h2>{{ $totalPayments }}</h2>

                            <small>Pembayaran</small>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Form -->

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    <h4>Edit Profile</h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('profile.update') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')

                        <div class="mb-3">

                            <label>Foto Profil</label>

                            <input type="file"
                                name="photo"
                                class="form-control">

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label>Nama</label>

                                    <input type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name',$user->name) }}">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label>Email</label>

                                    <input type="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ old('email',$user->email) }}">

                                </div>

                            </div>

                        </div>

                        <div class="mb-3">

                            <label>Nomor HP</label>

                            <input type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone',$user->phone) }}">

                        </div>

                        <div class="mb-3">

                            <label>Alamat</label>

                            <textarea
                                class="form-control"
                                rows="3"
                                name="address">{{ old('address',$user->address) }}</textarea>

                        </div>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="mb-3">

                                    <label>Kota</label>

                                    <input type="text"
                                        name="city"
                                        class="form-control"
                                        value="{{ old('city',$user->city) }}">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="mb-3">

                                    <label>Provinsi</label>

                                    <input type="text"
                                        name="province"
                                        class="form-control"
                                        value="{{ old('province',$user->province) }}">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="mb-3">

                                    <label>Kode Pos</label>

                                    <input type="text"
                                        name="postal_code"
                                        class="form-control"
                                        value="{{ old('postal_code',$user->postal_code) }}">

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label>Jenis Kelamin</label>

                                    <select
                                        name="gender"
                                        class="form-select">

                                        <option value="">Pilih</option>

                                        <option value="Laki-laki"
                                            {{ old('gender',$user->gender)=='Laki-laki'?'selected':'' }}>

                                            Laki-laki

                                        </option>

                                        <option value="Perempuan"
                                            {{ old('gender',$user->gender)=='Perempuan'?'selected':'' }}>

                                            Perempuan

                                        </option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label>Tanggal Lahir</label>

                                    <input type="date"
                                        name="birth_date"
                                        class="form-control"
                                        value="{{ old('birth_date', optional($user->birth_date)->format('Y-m-d')) }}">

                                </div>

                            </div>

                        </div>

                        <button class="btn btn-success">

                            Simpan Perubahan

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection