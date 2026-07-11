<nav x-data="{ open: false }" class="bg-success border-b border-success shadow">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center py-3">

            <!-- Logo -->
            <div class="d-flex align-items-center">

                <a href="{{ route('home') }}" class="navbar-brand text-white fw-bold fs-4 text-decoration-none">

                    🛒 Preloved Marketplace

                </a>

            </div>

            <!-- Menu -->
            <div class="d-none d-md-flex align-items-center gap-4">

                <a href="{{ route('home') }}" class="text-white text-decoration-none">

                    Home

                </a>

                <a href="{{ route('products.index') }}" class="text-white text-decoration-none">

                    Produk

                </a>

                @auth

                    <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">

                        Dashboard

                    </a>

                    <a href="{{ route('profile.edit') }}" class="text-white text-decoration-none">

                        Profile

                    </a>

                @endauth

            </div>

            <!-- User -->
            <div class="d-flex align-items-center">

                @guest

                    <a href="{{ route('login') }}" class="btn btn-light me-2">

                        Login

                    </a>

                    <a href="{{ route('register') }}" class="btn btn-warning">

                        Register

                    </a>

                @else

                    <div class="dropdown">

                        <button class="btn btn-success dropdown-toggle d-flex align-items-center"
                            data-bs-toggle="dropdown">

                            <img
                                src="{{ Auth::user()->photo_url }}"
                                width="40"
                                height="40"
                                class="rounded-circle me-2"
                                style="object-fit:cover;">

                            {{ Auth::user()->name }}

                        </button>

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

                                <form method="POST" action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit"
                                        class="dropdown-item text-danger">

                                        🚪 Logout

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                @endguest

            </div>

        </div>

    </div>

</nav>