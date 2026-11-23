<?php
require_once 'koneksi.php';

// Jika dipanggil dengan alamat "about.php?fetch_skills=1"
if (isset($_GET['fetch_skills'])) {
    header('Content-Type: application/json');
    
    $query = mysqli_query($conn, "SELECT nama_skill, nilai FROM skills");
    $labels = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $labels[] = $row['nama_skill'];
        $data[] = (int)$row['nilai'];
    }

    echo json_encode(['labels' => $labels, 'data' => $data]);
    exit; 
}
?>

<section id="About" class="section-padding">
    <div class="container">
        <div class="row mb-5">
            <div class="col text-center">
                <h2 class="display-5 underline mb-4">About Me</h2>
                <p class="text-muted mx-auto mb-0" style="max-width: 700px; line-height: 1.8;">
                    <strong>Min Yoongi</strong>, yang lebih dikenal sebagai <strong>SUGA dari BTS dan Agust D</strong>,
                    adalah seorang produser musik, penulis lagu, dan rapper global asal Korea Selatan. Memulai
                    perjalanannya dari musisi underground di Daegu, ia kini telah berkembang menjadi salah satu kreator
                    musik paling berpengaruh di industri musik internasional.
                </p>
            </div>
        </div>
        <div class="row g-5 mb-5 align-items-center">
            <div class="col-lg-5">
                <h3 class="fw-bold mb-4">Riwayat Pendidikan</h3>

                <div class="education-timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="timeline-content">
                            <h5 class="fw-bold mb-1">SD Daegu Taejeon</h5>
                            <p class="text-muted mb-1">2000 - 2006</p>
                            <a href="https://maps.app.goo.gl/RHWmwpBwYJ2kUzj5A" target="_blank"
                                class="btn btn-sm btn-maps-link">
                                <i class="bi bi-geo-alt me-1"></i>Lihat Lokasi
                            </a>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="timeline-content">
                            <h5 class="fw-bold mb-1">SMP Gwaneum</h5>
                            <p class="text-muted mb-1">2006 - 2009</p>
                            <a href="https://maps.app.goo.gl/pWyoWigHzTB3pLgC6" target="_blank"
                                class="btn btn-sm btn-maps-link">
                                <i class="bi bi-geo-alt me-1"></i>Lihat Lokasi
                            </a>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="timeline-content">
                            <h5 class="fw-bold mb-1">SMA Kangbuk</h5>
                            <p class="text-muted mb-1">2009 - 2010</p>
                            <a href="https://maps.app.goo.gl/ig9Evhr7M3iZ9M9WA" target="_blank"
                                class="btn btn-sm btn-maps-link">
                                <i class="bi bi-geo-alt me-1"></i>Lihat Lokasi
                            </a>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="timeline-content">
                            <h5 class="fw-bold mb-1">SMK Apgujeong</h5>
                            <p class="text-muted mb-1">2010 - 2013</p>
                            <a href="https://maps.app.goo.gl/eaTM2nkVKSVKEx747" target="_blank"
                                class="btn btn-sm btn-maps-link">
                                <i class="bi bi-geo-alt me-1"></i>Lihat Lokasi
                            </a>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker active"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="timeline-content">
                            <h5 class="fw-bold mb-1">Global Cyber University</h5>
                            <p class="text-muted mb-1">2013 - 2019</p>
                            <a href="https://maps.app.goo.gl/EqH16Cv9dZLqKEJH9" target="_blank"
                                class="btn btn-sm btn-maps-link">
                                <i class="bi bi-geo-alt me-1"></i>Lihat Lokasi
                            </a>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker"><i class="bi bi-mortarboard-fill"></i></div>
                        <div class="timeline-content">
                            <h5 class="fw-bold mb-1">Hanyang Cyber University</h5>
                            <p class="text-muted mb-1">2019 - now</p>
                            <p class="small text-muted">S2-Pascasarjana</p>
                            <span class="badge bg-dark mb-2">Currently Studying</span><br>
                            <a href="https://maps.app.goo.gl/aTmwFx6FHZKRFWBn6" target="_blank"
                                class="btn btn-sm btn-maps-link">
                                <i class="bi bi-geo-alt me-1"></i>Lihat Lokasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="dashboard-card p-4">
                    <h5 class="fw-bold mb-4 text-center">Grapik Skill</h5>
                    <div class="chart-container"
                        style="position: relative; height: 350px; width: 100%; max-width: 500px; margin: 0 auto;">
                        <canvas id="skillsChart" role="img" aria-label="Grafik tingkat kemampuan"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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

        // Simpan grafik ke variabel skillsChart agar bisa di-update
        const skillsChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: [],
                datasets: [{
                    label: "Tingkat Kemampuan",
                    data: [],
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
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: "#626A78"
                        }
                    }
                }
            }
        });

        // Fungsi mengambil data terbaru dari database setiap 3 detik
        function updateSkillsChart() {
            fetch("about.php?fetch_skills=1")
                .then(response => response.json())
                .then(result => {
                    skillsChart.data.labels = result.labels;
                    skillsChart.data.datasets[0].data = result.data;
                    skillsChart.update();
                })
                .catch(error => console.error("Gagal memuat data grafik:", error));
        }

        // Jalankan saat halaman dibuka, lalu ulangi tiap 3 detik
        updateSkillsChart();
        setInterval(updateSkillsChart, 3000);
    });
</script>
