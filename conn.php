<?php

$conn = mysqli_connect('localhost', 'root', '', 'gaji_personil');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

?>