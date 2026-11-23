<?php
// Menggunakan koneksi dari file koneksi.php
require_once 'koneksi.php';

$sql = "SELECT judul, deskripsi, gambar FROM services";
$result = mysqli_query($conn, $sql);
?>

<section id="container">
    <div class="judul-services">
        <h2>Services</h2>
    </div>

    <div class="container">
        <div class="row services-grid">

            <?php
            if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                echo '
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img src="' . htmlspecialchars($row["gambar"]) . '" class="card-img-top" alt="' . htmlspecialchars($row["judul"]) . '">
                        <div class="card-body">
                            <h3 class="head">' . htmlspecialchars($row["judul"]) . '</h3>
                            <p class="card-text">
                                ' . htmlspecialchars($row["deskripsi"]) . '
                            </p>
                        </div>
                    </div>
                </div>';
              }
            } else {
              echo "<p>0 results</p>";
            }
            ?>

        </div>
    </div>
</section>
