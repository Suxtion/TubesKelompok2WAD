<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Aplikasi Kampus')</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Jika menggunakan Vite --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    {{-- Atau link CSS manual (contoh Bootstrap dari CDN) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}} {{-- Untuk CSS kustom kamu --}}

    @stack('styles') {{-- Untuk menambahkan CSS spesifik per halaman --}}

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth {{-- Tampilkan hanya jika user sudah login --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('barang.index') }}">Peminjaman Barang</a>
                            </li>
                            {{-- Tambahkan link navigasi lain di sini --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('reservasi.ruangan.index') }}">Reservasi Ruangan</a>
                            </li> --}}
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content') {{-- Di sinilah konten spesifik halaman akan ditampilkan --}}
        </main>

        <footer class="bg-light text-center text-lg-start mt-auto">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
                © {{ date('Y') }} Hak Cipta:
                <a class="text-dark" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            </div>
        </footer>
    </div>

    {{-- Jika menggunakan Vite, app.js sudah termasuk di atas --}}

    {{-- Atau link JS manual (contoh Bootstrap Bundle dari CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="{{ asset('js/script.js') }}"></script> --}} {{-- Untuk JS kustom kamu --}}

    @stack('scripts') {{-- Untuk menambahkan JavaScript spesifik per halaman --}}
</body>
</html>