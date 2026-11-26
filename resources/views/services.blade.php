@extends('layout')

@section('content')

<section class="section-padding films-section" id="films" style="padding-top: 120px;">
    <div class="container">
        <div class="section-heading d-flex flex-column flex-md-row justify-content-between align-items-md-end">
            <div>
                <p class="eyebrow">SELECTED FILMOGRAPHY</p>
                <h2>Stories that<br><em>stay with us.</em></h2>
            </div>
        </div>

        <div class="row film-grid">
            @foreach ($films as $film)
                <div class="col-md-6 col-lg-4 mb-4">
                    <article class="film-card">
                        <div class="film-poster">
                            <img src="{{ asset($film['poster_path']) }}" 
                                 alt="Poster film {{ $film['title'] }}">
                            <span class="film-number">{{ $film['film_number'] }}</span>
                        </div>
                        <div class="film-info">
                            <div class="film-meta">
                                <span>{{ $film['release_year'] }}</span>
                                <span>{{ $film['genre'] }}</span>
                            </div>
                            <h3>{{ $film['title'] }}</h3>
                            <p>{{ $film['description'] }}</p>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
