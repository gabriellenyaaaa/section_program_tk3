<?php
require_once 'koneksi.php';

$status_pesan = "";

// Cek jika ada parameter ?status=sukses di URL setelah redirect
if (isset($_GET['status']) && $_GET['status'] == 'sukses') {
    $status_pesan = '<div class="alert alert-success text-center">Terima kasih! Pesan kamu berhasil dikirim.</div>';
}

// Mengecek apakah form dikirim menggunakan tombol Kirim Pesan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kirim_pesan'])) {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    $sql = "INSERT INTO contacts (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";

    if (mysqli_query($conn, $sql)) {
        // Redirect ulang ke halaman agar riwayat POST terhapus (mencegah Form Resubmission)
        echo "<script>window.location.href = 'index3.php?status=sukses#contact';</script>";
        exit;
    } else {
        $status_pesan = '<div class="alert alert-danger text-center">Gagal mengirim pesan: ' . mysqli_error($conn) . '</div>';
    }
}
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

            <!-- Menampilkan notifikasi setelah tombol diklik -->
            <?= $status_pesan; ?>

            <form method="POST" action="#contact">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputName4">Nama</label>
                        <input type="text" class="form-control" id="inputName4" name="nama" placeholder="Nama kamu" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputMessage">Pesan</label>
                    <textarea class="form-control" id="inputMessage" name="pesan" placeholder="Tuliskan pesan kamu..."
                        required></textarea>
                </div>

                <button type="submit" name="kirim_pesan" class="btn btn-primary">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</section>
