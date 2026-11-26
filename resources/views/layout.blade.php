<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfolio fan-made tentang film dan perjalanan kreatif Makoto Shinkai.">
    <title>Makoto Shinkai</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!-- Navigasi utama -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top site-navbar">
        <div class="container">
            <a class="navbar-brand brand" href="{{ route('home') }}">
                <img class="brand-avatar" src="{{ asset('assets/img/ms.jpg') }}" alt="">
                <span>
                    <h3>MAKOTO SHINKAI</h3><small>CINEMATIC PORTFOLIO</small>
                </span>
            </a>

            <button class="navbar-toggler" type="button" aria-controls="mainNav" aria-expanded="false"
                aria-label="Buka navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ml-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Filmography</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
                <a class="nav-cta ml-lg-4" href="{{ route('services') }}">EXPLORE FILMS <i class="bi bi-arrow-up-right"></i></a>
            </div>
        </div>
    </nav>

    <main style="{{ request()->routeIs('home') ? '' : 'padding-top: 100px;' }}">
        @yield('content')
    </main>


    <footer class="site-footer">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <a class="brand" href="{{ route('home') }}">
                <img class="brand-avatar" src="{{ asset('assets/img/ms.jpg') }}" alt="">
                <span>MAKOTO SHINKAI<small>CINEMATIC PORTFOLIO</small></span>
            </a>
            <p class="mb-0">Fan-made portfolio for educational purposes · © 2026</p>
            <a class="back-top" href="#">BACK TO TOP ↑</a>
        </div>
    </footer>

    <script src="{{ asset('assets/js/asset.js') }}"></script>
</body>

</html>
