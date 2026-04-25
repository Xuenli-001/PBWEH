<?php
// --- FITUR PENDETEKSI ERROR ---
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ------------------------------

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id      = $_POST['id'];
    $nama    = $_POST['nama'];
    $alamat  = $_POST['alamat'];
    $email   = $_POST['email'];
    $telepon = $_POST['telepon'];

    $stmt = $conn->prepare("UPDATE pelanggan SET Nama=?, Alamat=?, Email=?, Telepon=? WHERE ID=?");
    
    if ($stmt === false) {
        die("Error pada query SQL: " . $conn->error);
    }

    $stmt->bind_param("ssssi", $nama, $alamat, $email, $telepon, $id);

    if ($stmt->execute()) {
        header("Location: Pelanggan.php?pesan=edit");
        exit();
    } else {
        echo "Gagal mengupdate data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Halaman ini hanya bisa diakses lewat tombol submit form!";
}
?>