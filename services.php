<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "suga_coba";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT judul, deskripsi, gambar FROM services";
$result = mysqli_query($conn, $sql);

$conn->close();
?>

<section id="container">
    <div class="judul-services">
        <h2>Services</h2>
    </div>

    <div class="container">
        <div class="row services-grid">

            <?php
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
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