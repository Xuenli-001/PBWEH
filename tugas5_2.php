<html>
<head>
    <title>Menu Diskon Pembayaran Mahasiswa</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .form-box { border: 1px solid #000; padding: 20px; width: 400px; margin-bottom: 20px; }
        .result-box { border: 1px solid #000; padding: 20px; width: 450px; background-color: #fff; }
        .input-group { margin-bottom: 10px; }
        label { display: inline-block; width: 100px; }
    </style>
</head>
<body>

    <div class="form-box">
        <h3>Input Data Mahasiswa</h3>
        <form method="POST">
            <div class="input-group">
                <label>NPM:</label>
                <input type="text" name="npm" required>
            </div>
            <div class="input-group">
                <label>Nama:</label>
                <input type="text" name="nama" required>
            </div>
            <div class="input-group">
                <label>Prodi:</label>
                <input type="text" name="prodi" required>
            </div>
            <div class="input-group">
                <label>Semester:</label>
                <input type="number" name="semester" required>
            </div>
            <div class="input-group">
                <label>Biaya UKT:</label>
                <input type="number" name="biayaUkt" required>
            </div>
            <button type="submit" name="hitung">Hitung Diskon</button>
        </form>
    </div>

    <?php
    if (isset($_POST['hitung'])) {
        // a. Mengambil data dari inputan form
        $npm      = $_POST['npm'];
        $nama     = strtoupper($_POST['nama']); 
        $prodi    = strtoupper($_POST['prodi']);
        $semester = $_POST['semester'];
        $biayaUkt = $_POST['biayaUkt'];

        // Logika penentuan diskon
        $persenDiskon = 0;

        if ($biayaUkt >= 5000000) {
            // Poin b & c
            if ($semester > 8) {
                $persenDiskon = 15;
            } else {
                $persenDiskon = 10;
            }
        }

        $nominalDiskon = ($persenDiskon / 100) * $biayaUkt;
        $totalBayar    = $biayaUkt - $nominalDiskon;

        // Tampilan luaran 
        echo '<div class="result-box">';
        echo "<strong>Luaran yang diharuskan</strong><hr>";
        echo "NPM : " . htmlspecialchars($npm) . "<br>";
        echo "NAMA : " . htmlspecialchars($nama) . "<br>";
        echo "PRODI : " . htmlspecialchars($prodi) . "<br>";
        echo "SEMESTER : " . $semester . "<br>";
        echo "BIAYA UKT : Rp. " . number_format($biayaUkt, 0, ',', '.') . ",-<br>";
        echo "DISKON : " . $persenDiskon . "% <br>";
        echo "<strong>YANG HARUS DIBAYAR : Rp. " . number_format($totalBayar, 0, ',', '.') . ",- n </strong>";
        echo '</div>';
    }
    ?>

</body>
</html>