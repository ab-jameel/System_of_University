<?php
session_start();
// Veritabanı bağlantısı oluştur
$host = "localhost";
$username = "root";
$password = "";
$database = "ubys";

$conn = new mysqli($host, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}
?>
