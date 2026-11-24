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

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Navigasi utama -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top site-navbar">
        <div class="container">
            <a class="navbar-brand brand" href="#home">
                <img class="brand-avatar" src="assets/img/ms.jpg" alt="">
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
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#films">Filmography</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#journey">Journey</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <a class="nav-cta ml-lg-4" href="#films">EXPLORE FILMS <i class="bi bi-arrow-up-right"></i></a>
            </div>
        </div>
    </nav>

    <main>
        <!-- Hero: ganti vid.mp4 untuk memperbarui video utama -->
        <section class="hero" id="home">
            <video class="hero-video" autoplay muted loop playsinline aria-label="Video suasana film Makoto Shinkai">
                <source src="vid.mp4" type="video/mp4">
                Browser Anda tidak mendukung pemutaran video.
            </video>
            <div class="hero-overlay"></div>
            <div class="container hero-content">
                <p class="eyebrow light">AN ANIMATED WORLD BY</p>
                <h1>MAKOTO<br><em>SHINKAI</em></h1>
                <p class="hero-kicker">ANIMATION FILM DIRECTOR</p>
                <p class="hero-copy">Creating worlds beyond imagination through breathtaking visuals, beautiful
                    landscapes, and unforgettable stories.</p>
                <a class="btn hero-button" href="#films">EXPLORE MY WORKS <i class="bi bi-arrow-right"></i></a>
            </div>
            <!-- <div class="hero-caption">A JOURNEY THROUGH LIGHT, SKY &amp; EMOTION <span>01 — 06</span></div>
            <a class="scroll-indicator" href="#films"><span></span> SCROLL TO EXPLORE</a> -->
        </section>

        <!-- Kutipan pembuka -->
        <section class="intro-strip">
            <div class="container d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <p class="eyebrow mb-0">THE ART OF STORYTELLING</p>
                <p class="intro-quote mb-0">“Every frame can hold a feeling, and every story can become a memory.”</p>
            </div>
        </section>

        <?php include 'film.php'; ?>

        <?php include 'about.php'; ?>

        <?php include 'contact.php'; ?>

    </main>

    <footer class="site-footer">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <a class="brand" href="#home">
                <img class="brand-avatar" src="assets/img/ms.jpg" alt="">
                <span>MAKOTO SHINKAI<small>CINEMATIC PORTFOLIO</small></span>
            </a>
            <p class="mb-0">Fan-made portfolio for educational purposes · © 2026</p>
            <a class="back-top" href="#home">BACK TO TOP ↑</a>
        </div>
    </footer>

</body>
</html>

    </script>

    <script src="assets/js/asset.js"></script>

</body>

</html>