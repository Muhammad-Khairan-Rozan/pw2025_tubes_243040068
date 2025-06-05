<?php
$host = "localhost";
$user = "root";
$pass = ""; // default password Laragon adalah kosong
$db   = "festival_kuliner";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
