<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-grad">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" height="36" class="me-2 bg-white rounded-circle">
    {{ config('app.name') }}
    </a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
        @auth
            <li class="nav-item"><a class="btn btn-light btn-sm" href="{{ route('dashboard') }}">Ke Beranda</a></li>
        @else
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="btn btn-light btn-sm" href="{{ route('register') }}">Register</a></li>
        @endauth
        </ul>
    </div>
  </div>
</nav>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>