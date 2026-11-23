<?php
$host     = "localhost";
$user     = "root";      // User default XAMPP
$password = "";          // Password default XAMPP (kosong)
$database = "suga_coba"; // Sesuaikan dengan nama database di phpMyAdmin

$conn = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
