<?php
// 1. Pajak dijadikan konstanta (10%)
define("PAJAK", 0.1);

// 2. Informasi harga barang disimpan dalam array
// Kita simpan Nama dan Harga dalam array asosiatif
$barang = [
    "nama" => "Keyboard",
    "harga" => 150000
];

// 3. Jumlah yang dibeli (dibuat variable)
$jumlahBeli = 2;

// 4. Perhitungan menggunakan operator aritmatika
$totalHargaSebelumPajak = $barang['harga'] * $jumlahBeli;
$nominalPajak = $totalHargaSebelumPajak * PAJAK;
$totalBayar = $totalHargaSebelumPajak + $nominalPajak;

// Menampilkan hasil
echo "<h2>Perhitungan Total Pembelian (Dengan Array)</h2>";
echo "<hr>";
echo "Nama Barang: " . $barang['nama'] . "<br>";
echo "Harga Satuan: Rp " . number_format($barang['harga'], 0, ',', '.') . "<br>";
echo "Jumlah Beli: " . $jumlahBeli . "<br>";
echo "Total Harga (Sebelum Pajak): Rp " . number_format($totalHargaSebelumPajak, 0, ',', '.') . "<br>";
echo "Pajak (10%): Rp " . number_format($nominalPajak, 0, ',', '.') . "<br>";
echo "<strong>Total Bayar: Rp " . number_format($totalBayar, 0, ',', '.') . "</strong>";
?>