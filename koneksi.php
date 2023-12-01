<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "uas_diani";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
