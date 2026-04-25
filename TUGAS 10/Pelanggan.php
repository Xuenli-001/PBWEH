<?php 
// --- FITUR PENDETEKSI ERROR ---
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ------------------------------

include 'koneksi.php'; 

// --- LOGIKA PENCARIAN & PAGINATION ---
$limit = 5; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$search = isset($_GET['cari']) ? $_GET['cari'] : '';

// 1. Hitung total data untuk Pagination
if ($search != '') {
    $search_param = "%$search%";
    $stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM pelanggan WHERE Nama LIKE ? OR Email LIKE ?");
    $stmt_total->bind_param("ss", $search_param, $search_param);
} else {
    $stmt_total = $conn->prepare("SELECT COUNT(*) as total FROM pelanggan");
}
$stmt_total->execute();
$total_result = $stmt_total->get_result()->fetch_assoc();
$total_rows = $total_result['total'];
$total_pages = ceil($total_rows / $limit);
$stmt_total->close();
// -------------------------------------
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

    <div class="d-flex justify-content-between mb-3">
        <a href="tambah_pelanggan.php" class="btn btn-primary">+ Tambah Pelanggan</a>
        
        <form action="Pelanggan.php" method="GET" class="d-flex">
            <input type="text" name="cari" class="form-control me-2" placeholder="Cari Nama / Email..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-outline-success">Cari</button>
            <?php if($search != ''): ?>
                <a href="Pelanggan.php" class="btn btn-outline-secondary ms-2">Reset</a>
            <?php endif; ?>
        </form>
    </div>

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
            // 2. Ambil data sesuai pencarian dan halaman (Prepared Statements)
            if ($search != '') {
                $stmt = $conn->prepare("SELECT * FROM pelanggan WHERE Nama LIKE ? OR Email LIKE ? ORDER BY ID DESC LIMIT ? OFFSET ?");
                $stmt->bind_param("ssii", $search_param, $search_param, $limit, $offset);
            } else {
                $stmt = $conn->prepare("SELECT * FROM pelanggan ORDER BY ID DESC LIMIT ? OFFSET ?");
                $stmt->bind_param("ii", $limit, $offset);
            }
            
            $stmt->execute();
            $result = $stmt->get_result();
            
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
                echo "<tr><td colspan='6' class='text-center'>Data tidak ditemukan.</td></tr>";
            }
            $stmt->close();
            ?>
        </tbody>
    </table>

    <?php if ($total_pages > 1): ?>
    <nav>
        <ul class="pagination justify-content-center">
            <?php for($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="Pelanggan.php?page=<?= $i ?>&cari=<?= urlencode($search) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <?php endif; ?>

</div>
</body>
</html>
<?php $conn->close(); ?>