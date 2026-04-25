<?php 
// --- FITUR PENDETEKSI ERROR (JANGAN DIHAPUS DULU) ---
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ----------------------------------------------------

include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Daftar Pelanggan</h2>
    
    <?php
    // Pesan Notifikasi
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "tambah") echo '<div class="alert alert-success">Data berhasil ditambahkan!</div>';
        if($_GET['pesan'] == "edit") echo '<div class="alert alert-success">Data berhasil diubah!</div>';
        if($_GET['pesan'] == "hapus") echo '<div class="alert alert-warning">Data berhasil dihapus!</div>';
    }
    ?>

    <a href="tambah_pelanggan.php" class="btn btn-primary mb-3">+ Tambah Pelanggan</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM pelanggan ORDER BY ID DESC";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row['ID']."</td>
                        <td>".htmlspecialchars($row['Nama'])."</td>
                        <td>".htmlspecialchars($row['Alamat'])."</td>
                        <td>".htmlspecialchars($row['Email'])."</td>
                        <td>".htmlspecialchars($row['Telepon'])."</td>
                        <td>
                            <a href='edit_pelanggan.php?id=".$row['ID']."' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='hapus_pelanggan.php?id=".$row['ID']."' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin hapus pelanggan ini?\")'>Hapus</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Belum ada data pelanggan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
<?php $conn->close(); ?>
