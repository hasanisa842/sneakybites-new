<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('judul')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="logo" width="150">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Beranda</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('forum.index') }}">Forum</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Tersimpan
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('login') }}">Reviews</a>
                                <a class="dropdown-item" href="{{ route('login') }}">Restoran Favorit</a>
                            </div>
                        </li>
                    @else
                        @if (Auth::user()->is_admin == 0)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('forum.index') }}">Forum</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Tersimpan
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/histories">Reviews</a>
                                    <a class="dropdown-item" href="">Restoran Favorit</a>
                                </div>
                            </li>
                        @else
                            <a href="#" class="btn btn-secondary w-100" style="display: none;">Review restoran ini</a>
                            <a href="#" class="btn btn-secondary w-100" style="display: none;">Tambahkan favorit</a>
                        @endif
                    @endguest


                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                            </li>
                        @endif
                    @else
                        @if (Auth::user()->is_admin == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="/resto-list">Kelola Forum</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/resto-list">Kelola Restoran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/users">Kelola User</a>
                            </li>
                        @else
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('show_profile') }}">
                                    Edit Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                    Logout
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

    @yield('content')

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="footer-title text-info">About</h2>
                    <p class="footer-desc">Selamat datang di SneakyBites, platform yang didedikasikan untuk
                        menghubungkan Anda dengan restoran-restoran hidden gems yang menyajikan pengalaman kuliner tak
                        terlupakan. Kami percaya bahwa di balik setiap sudut kota, terdapat restoran-restoran unik yang
                        menawarkan cita rasa yang istimewa dan pengalaman makan yang luar biasa.</p>
                </div>
                <div class="col-md-3">
                    <h2 class="footer-title text-info">Contact Us</h2>
                    <ul class="footer-menu">
                        <li><a>Jakarta Barat</a></li>
                        <li><a>Indonesia</a></li>
                        <li><a>081212147513</a></li>
                        <li><a>sneakybites@gmail.com</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h2 class="footer-title text-info">Sosial Media</h2>
                    <ul class="footer-menu">
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">TikTok</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>