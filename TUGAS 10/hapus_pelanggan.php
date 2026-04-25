<?php
// --- FITUR PENDETEKSI ERROR ---
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ------------------------------

include 'koneksi.php';

// Mengecek apakah ada parameter 'id' di URL dan apakah isinya angka
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Siapkan query hapus
    $stmt = $conn->prepare("DELETE FROM pelanggan WHERE ID = ?");
    
    if ($stmt === false) {
        die("Error pada query SQL: " . $conn->error);
    }

    // Bind parameter (i = integer)
    $stmt->bind_param("i", $id);

    // Eksekusi dan alihkan halaman
    if ($stmt->execute()) {
        header("Location: Pelanggan.php?pesan=hapus");
        exit(); // Wajib ada agar eksekusi berhenti setelah redirect
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Jika tidak ada ID yang valid, langsung kembalikan ke halaman utama
    header("Location: Pelanggan.php");
    exit();
}

$conn->close();
?>