<?php
$servername = "localhost"; // Ganti sesuai dengan host Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_cuaca"; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}
?>
