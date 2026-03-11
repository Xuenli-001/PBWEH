<html>
<head>
    <title>TUGAS PRAKTIKUM 6</title>
    <style>
        body { font-family: sans-serif; margin: 20px; line-height: 1.6; }
        nav { background: #f4f4f4; padding: 10px; border-radius: 5px; }
        .hasil { margin-top: 20px; padding: 15px; border: 1px solid #ddd; background: #fafafa; }
    </style>
</head>
<body>
    <h2>Menu Soal</h2>
    <nav>
        <a href="?soal=1">Soal 1 (Kendaraan)</a> | 
        <a href="?soal=2">Soal 2 (Loop Genap)</a> | 
        <a href="?soal=3">Soal 3 (Daftar Hewan)</a> | 
        <a href="?soal=4">Soal 4 (Ternary Genap/Ganjil)</a>
    </nav>

    <div class="hasil">
    <?php
    include 'tugas6.php';
    $menu = $_GET['soal'] ?? '';

    switch ($menu) {
        case '1':
            echo "<h3>Soal 1: Cek Jenis Kendaraan</h3>";
            echo '<form method="POST">
                    Masukkan Jumlah Roda: <input type="number" name="roda" required>
                    <button type="submit">Cek</button>
                  </form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['roda'])) {
                echo "<p>Hasil: <b>" . soal1($_POST['roda']) . "</b></p>";
            }
            break;

        case '2':
            echo "<h3>Soal 2: Bilangan Genap (2-10)</h3>";
            echo "Mencetak menggunakan loop for: <br><b>" . soal2() . "</b>";
            break;

        case '3':
            echo "<h3>Soal 3: Daftar Nama Hewan</h3><ul>";
            soal3();
            echo "</ul>";
            break;

        case '4':
            echo "<h3>Soal 4: Ternary Genap atau Ganjil</h3>";
            echo '<form method="POST">
                    Masukkan Angka: <input type="number" name="angka" required>
                    <button type="submit">Cek</button>
                  </form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['angka'])) {
                echo "<p>Angka " . $_POST['angka'] . " adalah bilangan: <b>" . soal4($_POST['angka']) . "</b></p>";
            }
            break;

        default:
            echo "Pilih soal di navigasi untuk melihat jawaban dan menjalankan program.";
            break;
    }
    ?>
    </div>
</body>
</html>