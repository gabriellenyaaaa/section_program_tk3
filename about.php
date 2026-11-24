<?php
require_once __DIR__ . '/connect.php';

// Ambil data grafik dari database
$sql = "SELECT element_name, percentage FROM style_elements ORDER BY sort_order ASC";
$result = $conn->query($sql);

$chartLabels = [];
$chartData = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $chartLabels[] = $row['element_name'];
        $chartData[] = (int)$row['percentage'];
    }
}

// JIKA DIPANGGIL OLEH JAVASCRIPT REALTIME (AJAX), KIRIM JSON LALU STOP
if (isset($_GET['ajax_chart'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'labels' => $chartLabels,
        'data'   => $chartData
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
?>

<!-- Tentang sutradara -->
<section class="about-section section-padding" id="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="portrait-wrap">
                    <img src="assets/img/ms.jpg" alt="Potret Makoto Shinkai">
                    <span class="portrait-label">THE CREATOR<br>BEHIND THE FRAMES</span>
                </div>
            </div>
            <div class="col-lg-7 about-copy">
                <p class="eyebrow">ABOUT THE DIRECTOR</p>
                <h2>Creating emotions<br>through <em>animation.</em></h2>
                <p class="about-lead"><strong>Makoto Shinkai</strong> adalah sutradara, penulis, dan animator
                    asal Jepang yang lahir pada 1973 di Prefektur Nagano.</p>
                <p>Ia memulai debut film panjangnya melalui <em>The Place Promised in Our Early Days</em>
                    (2004), setelah dikenal lewat film pendek <em>Voices of a Distant Star</em> (2002).
                    Karya-karyanya dikenal melalui visual yang detail dan cerita yang dekat dengan emosi
                    manusia.</p>
                <p>Langit, hujan, cahaya, lanskap kota, jarak, waktu, dan kenangan menjadi elemen penting dalam
                    dunia sinematiknya.</p>
                <div class="about-signature">A world painted with light.</div>
            </div>
        </div>
    </div>
</section>

<!-- Perjalanan karier -->
<section class="journey-section section-padding" id="journey">
    <div class="container">
        <div class="section-heading journey-heading">
            <p class="eyebrow">FROM THE BEGINNING</p>
            <h2>A creative <em>journey.</em></h2>
            <p class="section-lead">Beberapa tonggak perjalanan Makoto Shinkai dalam dunia animasi dan
                perfilman.</p>
        </div>

        <div class="timeline">
            <article class="timeline-item">
                <span class="timeline-year">1973</span>
                <div>
                    <h3>Early beginnings</h3>
                    <p>Lahir di Prefektur Nagano, Jepang.</p>
                </div>
            </article>
            <article class="timeline-item">
                <span class="timeline-year">2002</span>
                <div>
                    <h3>Voices of a Distant Star</h3>
                    <p>Merilis film pendek yang ia kerjakan secara independen.</p>
                </div>
            </article>
            <article class="timeline-item">
                <span class="timeline-year">2004</span>
                <div>
                    <h3>The Place Promised in Our Early Days</h3>
                    <p>Merilis film panjang pertamanya.</p>
                </div>
            </article>
            <article class="timeline-item">
                <span class="timeline-year">2007</span>
                <div>
                    <h3>5 Centimeters per Second</h3>
                    <p>Menghadirkan kisah episodik tentang jarak dan perubahan hubungan.</p>
                </div>
            </article>
            <article class="timeline-item">
                <span class="timeline-year">2013</span>
                <div>
                    <h3>The Garden of Words</h3>
                    <p>Memperkuat ciri visualnya melalui detail hujan dan suasana kota.</p>
                </div>
            </article>
            <article class="timeline-item">
                <span class="timeline-year">2016—2022</span>
                <div>
                    <h3>Global recognition</h3>
                    <p>Merilis Your Name., Weathering With You, dan Suzume untuk penonton dunia.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Elemen visual dan grafik -->
<section class="style-section section-padding">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-5 style-copy">
                <p class="eyebrow">VISUAL LANGUAGE</p>
                <h2>A signature<br><em>style.</em></h2>
                <p>
                    Karya Makoto Shinkai memiliki pendekatan visual
                    dan tema yang khas. Grafik berikut merupakan
                    interpretasi editorial, bukan penilaian resmi.
                </p>
            </div>

            <div class="col-lg-7">
                <div class="chart-card">
                    <h3>THE ELEMENTS OF HIS FILMS</h3>

                    <div class="chart-container">
                        <canvas id="styleChart"></canvas>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Library Chart.js -->
<script src="assets/js/chart.min.js"></script>

<!-- JavaScript Grafik -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const canvas = document.getElementById("styleChart");

    if (canvas && typeof Chart !== "undefined") {

        const ctx = canvas.getContext("2d");

        // Gradasi warna biru
        const gradient = ctx.createLinearGradient(0, 0, 0, 350);
        gradient.addColorStop(0, "#368bc0");
        gradient.addColorStop(1, "#9bd8f5");

        // Simpan instance chart ke variabel agar bisa di-update realtime
        const styleChart = new Chart(ctx, {
            type: "bar",

            data: {
                labels: <?= json_encode($chartLabels, JSON_UNESCAPED_UNICODE) ?>,

                datasets: [{
                    label: "Elemen Visual",
                    data: <?= json_encode($chartData) ?>,

                    backgroundColor: gradient,
                    borderRadius: 5,
                    borderSkipped: false,
                    barPercentage: 0.55,
                    categoryPercentage: 0.75
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
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
                            stepSize: 20,
                            color: "#b8c5d3",
                            callback: function(value) { return value + "%"; }
                        },
                        grid: { color: "rgba(255,255,255,0.12)" },
                        border: { display: false }
                    },
                    x: {
                        ticks: {
                            color: "#b8c5d3",
                            font: { size: 12 }
                        },
                        grid: { display: false },
                        border: { display: false }
                    }
                }
            }
        });

        // Update grafik secara realtime langsung dari about.php setiap 3 detik
        setInterval(function () {
            fetch("about.php?ajax_chart=1")
                .then(response => response.json())
                .then(result => {
                    styleChart.data.labels = result.labels;
                    styleChart.data.datasets[0].data = result.data;
                    styleChart.update();
                })
                .catch(err => console.error("Gagal memperbarui grafik:", err));
        }, 3000);
    }

});
</script>
