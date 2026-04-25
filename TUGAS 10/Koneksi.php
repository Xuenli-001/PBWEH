<?php
$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'pemrograman_web_contoh'; 

// Variabel ini HARUS bernama $conn
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi Database Gagal: " . $conn->connect_error);
}
?>