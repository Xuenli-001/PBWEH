<?php
// --- FITUR PENDETEKSI ERROR ---
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ------------------------------

include 'koneksi.php';

// Cek apakah ada ID di URL
if (!isset($_GET['id'])) {
    die("Error: ID Pelanggan tidak ditemukan di URL.");
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM pelanggan WHERE ID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if(!$data) {
    die("Error: Data pelanggan dengan ID $id tidak ditemukan di database!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Data Pelanggan</h2>
    <div class="card p-4 mt-3 col-md-6">
        <form action="proses_edit_pelanggan.php" method="POST">
            <input type="hidden" name="id" value="<?= $data['ID'] ?>">
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['Nama']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required><?= htmlspecialchars($data['Alamat']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['Email']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control" value="<?= htmlspecialchars($data['Telepon']) ?>" required>
            </div>
            
            <button type="submit" class="btn btn-warning">Update Data</button>
            <a href="Pelanggan.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
</body>
</html>

<?php 
$stmt->close();
$conn->close(); 
?>
