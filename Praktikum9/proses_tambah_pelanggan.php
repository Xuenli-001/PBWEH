<?php
// --- FITUR PENDETEKSI ERROR ---
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ------------------------------

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama    = $_POST['nama'];
    $alamat  = $_POST['alamat'];
    $email   = $_POST['email'];
    $telepon = $_POST['telepon'];

    $stmt = $conn->prepare("INSERT INTO pelanggan (Nama, Alamat, Email, Telepon) VALUES (?, ?, ?, ?)");
    
    // Mengecek apakah prepare statement berhasil
    if ($stmt === false) {
        die("Error pada query SQL: " . $conn->error);
    }

    $stmt->bind_param("ssss", $nama, $alamat, $email, $telepon);

    if ($stmt->execute()) {
        // Jika sukses, kembali ke halaman Pelanggan.php (Perhatikan huruf kapital P-nya)
        header("Location: Pelanggan.php?pesan=tambah");
        exit(); // Wajib ditambahkan setelah header location
    } else {
        echo "Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Halaman ini hanya bisa diakses lewat tombol submit form!";
}
?>
