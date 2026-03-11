<html>
<head>
    <title>Penentuan Kelulusan Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; line-height: 1.6; }
        .container { width: 450px; border: 1px solid #000; padding: 20px; }
        .form-group { margin-bottom: 10px; }
        label { display: inline-block; width: 120px; }
        .result { margin-top: 20px; padding: 15px; border-top: 2px solid #333; background-color: #f9f9f9; }
        .lulus { color: green; font-weight: bold; }
        .gagal { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <div class="container">
        <h3>Input Data Nilai Mahasiswa</h3>
        <form method="POST">
            <div class="form-group">
                <label>NPM :</label>
                <input type="text" name="npm" required>
            </div>
            <div class="form-group">
                <label>Nama :</label>
                <input type="text" name="nama" required>
            </div>
            <div class="form-group">
                <label>Nilai UTS :</label>
                <input type="number" name="uts" min="0" max="100" required>
            </div>
            <div class="form-group">
                <label>Nilai UAS :</label>
                <input type="number" name="uas" min="0" max="100" required>
            </div>
            <button type="submit" name="proses">Proses Nilai</button>
        </form>

        <?php
        if (isset($_POST['proses'])) {
            // Mengambil data dari form
            $npm  = $_POST['npm'];
            $nama = strtoupper($_POST['nama']);
            $uts  = $_POST['uts'];
            $uas  = $_POST['uas'];

            // Menghitung Nilai Akhir (Rata-rata)
            $nilai_akhir = ($uts + $uas) / 2;

            // Logika Penentuan Kelulusan
            if ($nilai_akhir >= 60) {
                $status = "LULUS";
                $class  = "lulus";
            } else {
                $status = "TIDAK LULUS";
                $class  = "gagal";
            }

            // Menampilkan Luaran
            echo "<div class='result'>";
            echo "<strong>LUARAN YANG DIHARAPKAN</strong><br><br>";
            echo "NPM : $npm<br>";
            echo "NAMA : $nama<br>";
            echo "NILAI UTS : $uts<br>";
            echo "NILAI UAS : $uas<br>";
            echo "NILAI AKHIR : $nilai_akhir<br>";
            echo "STATUS : <span class='$class'>$status</span>";
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>
