<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Preloved Marketplace</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f5f5f5;
        }

        .navbar-brand{
            font-size:24px;
            font-weight:bold;
        }

        .card{
            transition:.3s;
        }

        .card:hover{
            transform:translateY(-5px);
            box-shadow:0 10px 25px rgba(0,0,0,.15);
        }

        footer{
            margin-top:80px;
            background:#212529;
            color:white;
            padding:25px 0;
        }

        .profile-img{
            width:38px;
            height:38px;
            object-fit:cover;
            border-radius:50%;
            border:2px solid white;
        }

    </style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow">

    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">

            🛒 Preloved Marketplace

        </a>

        <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">

                    <a class="nav-link" href="{{ route('home') }}">

                        Home

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ route('products.index') }}">

                        Produk

                    </a>

                </li>

                @auth

                <li class="nav-item">

                    <a class="nav-link" href="{{ route('dashboard') }}">

                        Dashboard

                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="{{ route('profile.edit') }}">

                        Profile

                    </a>

                </li>

                @endauth

            </ul>

            <ul class="navbar-nav align-items-center">

                @guest

                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('login') }}">

                            Login

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="btn btn-warning ms-2"
                            href="{{ route('register') }}">

                            Register

                        </a>

                    </li>

                @else

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">

                            <img
                                src="{{ Auth::user()->photo_url }}"
                                class="profile-img me-2">

                            {{ Auth::user()->name }}

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                <a class="dropdown-item"
                                    href="{{ route('profile.edit') }}">

                                    👤 Profile Saya

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item"
                                    href="{{ route('dashboard') }}">

                                    📦 Dashboard

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item"
                                    href="{{ route('products.create') }}">

                                    ➕ Tambah Produk

                                </a>

                            </li>

                            @if(Route::has('payment.history'))

                            <li>

                                <a class="dropdown-item"
                                    href="{{ route('payment.history') }}">

                                    💳 Riwayat Pembayaran

                                </a>

                            </li>

                            @endif

                            @if(Auth::user()->role === 'admin')

                            <li>

                                <a class="dropdown-item"
                                    href="{{ route('admin.dashboard') }}">

                                    🛠️ Dashboard Admin

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-item"
                                    href="{{ route('payment.admin') }}">

                                    ✅ Verifikasi Pembayaran

                                </a>

                            </li>

                            @endif

                            <li>

                                <hr class="dropdown-divider">

                            </li>

                            <li>

                                <form
                                    method="POST"
                                    action="{{ route('logout') }}">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item text-danger">

                                        🚪 Logout

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </li>

                @endguest

            </ul>

        </div>

    </div>

</nav>

<div class="container mt-4">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    @yield('content')

</div>

<footer>

    <div class="container text-center">

        <h5>

            🛒 Preloved Marketplace

        </h5>

        <p class="mb-0">

            © {{ date('Y') }} Preloved Marketplace. All Rights Reserved.

        </p>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>