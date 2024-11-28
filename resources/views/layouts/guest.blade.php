<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
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
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    <!--menu user-->
                @if(Auth::check() && Auth::user()->isUser())
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="btn btn-primary mx-1">User</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('buku.index') }}" class="btn btn-primary mx-1">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kategori.index') }}" class="btn btn-primary mx-1">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('peminjaman.index')}}" class="btn btn-primary mx-1">Pinjam</a>
                    </li>
                @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                    </ul>
                </div>
            </div>
        </nav>        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
