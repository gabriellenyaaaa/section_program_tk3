@extends('layout')

@section('content')
    <!-- Hero: ganti vid.mp4 untuk memperbarui video utama -->
    <section class="hero" id="home">
        <video class="hero-video" autoplay muted loop playsinline aria-label="Video suasana film Makoto Shinkai">
            <source src="{{ asset('vid.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung pemutaran video.
        </video>
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <p class="eyebrow light">AN ANIMATED WORLD BY</p>
            <h1>MAKOTO<br><em>SHINKAI</em></h1>
            <p class="hero-kicker">ANIMATION FILM DIRECTOR</p>
            <p class="hero-copy">Creating worlds beyond imagination through breathtaking visuals, beautiful
                landscapes, and unforgettable stories.</p>
            <a class="btn hero-button" href="{{ route('services') }}">EXPLORE MY WORKS <i class="bi bi-arrow-right"></i></a>
        </div>
    </section>

    <!-- Kutipan pembuka -->
    <section class="intro-strip">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <p class="eyebrow mb-0">THE ART OF STORYTELLING</p>
            <p class="intro-quote mb-0">“Every frame can hold a feeling, and every story can become a memory.”</p>
        </div>
    </section>
@endsection
