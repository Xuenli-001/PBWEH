<?php
// --- No 1: Switch Case Kendaraan ---
function soal1($roda) {
    switch ($roda) {
        case 2: return "Sepeda Motor";
        case 3: return "Bajaj / Becak";
        case 4: return "Mobil";
        default: return "Jenis Kendaraan Tidak Diketahui";
    }
}

// --- No 2: For Loop Bilangan Genap ---
function soal2() {
    $hasil = [];
    for ($i = 2; $i <= 10; $i += 2) {
        $hasil[] = $i;
    }
    return implode(", ", $hasil);
}

// --- No 3: Array & Foreach Hewan ---
function soal3() {
    $hewan = ["Kucing", "Gajah", "Jerapah", "Singa"];
    foreach ($hewan as $h) {
        echo "<li>$h</li>";
    }
}

// --- No 4: Ternary Operator Genap/Ganjil ---
function soal4($angka) {
    return ($angka % 2 == 0) ? "Genap" : "Ganjil";
}
?>
