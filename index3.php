<?php
require_once "koneksi.php";
?>

<!DOCTYPE html>
<html  lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Personal Portfolio</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script src="assets/js/asset.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar">
            <img class="logo-brand"
                src="assets/img/suga3.png"
                alt="Foto profil">

            <a class="navbar-brand" href="#">Agust D</a>

            <button class="navbar-toggler" type="button"
                    data-toggle="collapse"
                    data-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Buka navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#container">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#About">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <section class="hero-video-section">
        <div class="hero-video-wrap">
            <video class="hero-video" autoplay muted loop preload="auto" playsinline aria-label="Video Sugavid">
                <source src="assets/sugavid.mp4" type="video/mp4">
                Browser Anda tidak mendukung pemutaran video.
            </video>
            <h1 class="hero-video-title">Agust D</h1>
        </div>
    </section>

    <?php
    include'services.php';
    ?>

    <?php
    include'about.php';
    ?>

    <section id="contact">
        <div class="container">
            <div class="contact-card reveal">
                <div class="text-center mb-4">
                    <h2>Hubungi Saya</h2>
                    <p class="text-muted">
                        Punya pertanyaan atau ide? Kirim pesan kepada saya.
                    </p>
                </div>

                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName4">Nama</label>
                            <input type="text"
                                class="form-control"
                                id="inputName4"
                                placeholder="Nama kamu"
                                required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email"
                                class="form-control"
                                id="inputEmail4"
                                placeholder="nama@email.com"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputMessage">Pesan</label>
                        <textarea class="form-control"
                                id="inputMessage"
                                placeholder="Tuliskan pesan kamu..."
                                required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </section>


    
   <footer class="footer-section py-5">
        <div class="container text-center">
            <div class="mb-4">
                <a href="#Home" class="text-decoration-none">
                    <h3 class="fw-bold text-white mb-0">Agust D<span style="color: var(--silver-sand);">.</span></h3>
                </a>
            </div>
            <div class="social-links mb-4">
                <a href="https://www.instagram.com/gabriellenya" class="social-icon" title="Instagram"><i
                        class="bi bi-instagram"></i></a>
                <a href="#" class="social-icon" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                <a href="https://github.com/gabriellenya" class="social-icon" title="GitHub"><i
                        class="bi bi-github"></i></a>
                <a href="https://wa.me/085702009655" class="social-icon" title="WhatsApp"><i
                        class="bi bi-whatsapp"></i></a>
            </div>
            <p class="text-muted-light mb-0 small">
                &copy; Dwcita
            </p>
        </div>
    </footer>


    <script>
       document.addEventListener("DOMContentLoaded", function () {
            const canvas = document.getElementById("skillsChart");

            if (!canvas || typeof Chart === "undefined") return;

            const ctx = canvas.getContext("2d");

            // Gradasi abu-abu
            const gradient = ctx.createLinearGradient(0, 0, 0, 320);
            gradient.addColorStop(0, "#292C36");
            gradient.addColorStop(0.5, "#848A98");
            gradient.addColorStop(1, "#BDC2C7");

            new Chart(ctx, {
                type: "bar",
                data: {
                labels: [
                    "SongWriter",
                    "Dance",
                    "Code",
                    "Music",
                    "Basket",
                    "Marry You"
                ],
                datasets: [{
                    label: "Tingkat Kemampuan",
                    data: [80, 90, 90, 80, 88, 100],
                    backgroundColor: gradient,
                    borderRadius: 9,
                    borderSkipped: false,
                    barPercentage: 0.58,
                    categoryPercentage: 0.75
                }]
                },
                options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                    display: false
                    },
                    tooltip: {
                    backgroundColor: "#292C36",
                    titleColor: "#ffffff",
                    bodyColor: "#ffffff",
                    callbacks: {
                        label: function (context) {
                        return context.parsed.y + "%";
                        }
                    }
                    }
                },
                scales: {
                    y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        stepSize: 10,
                        callback: function (value) {
                        return value + "%";
                        },
                        color: "#626A78"
                    },
                    grid: {
                        color: "#E0E3E8"
                    },
                    border: {
                        display: false
                    }
                    },
                    x: {
                    ticks: {
                        color: "#626A78",
                        maxRotation: 15,
                        minRotation: 0
                    },
                    grid: {
                        display: false
                    },
                    border: {
                        color: "#BDC2C7"
                    }
                    }
                }
                }
            });
        });

    </script>

</body>

</html>