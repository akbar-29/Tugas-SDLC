<?php
$servername = "localhost"; // biasanya localhost
$username = "root"; // username database
$password = "akbarnugraha"; // password database (kosong kalau pakai XAMPP)
$dbname = "ikj_db"; // nama database yang sudah kamu buat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
