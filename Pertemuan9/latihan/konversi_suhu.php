<?php
echo "=== PROGRAM KONVERSI SUHU ===\n\n";

echo "Masukkan suhu: ";
$suhu = trim(fgets(STDIN));

echo "\nPilih jenis konversi:\n";
echo "1. Celcius ke Fahrenheit\n";
echo "2. Fahrenheit ke Celcius\n";
echo "3. Celcius ke Kelvin\n";
echo "Pilihan (1-3): ";
$pilihan = trim(fgets(STDIN));

$suhu = floatval($suhu);
$hasil = 0;
$keterangan = "";

switch($pilihan) {
    case '1':
        $hasil = ($suhu * 9/5) + 32;
        $keterangan = "Fahrenheit";
        $dari = "Celcius";
        break;
    case '2':
        $hasil = ($suhu - 32) * 5/9;
        $keterangan = "Celcius";
        $dari = "Fahrenheit";
        break;
    case '3':
        $hasil = $suhu + 273.15;
        $keterangan = "Kelvin";
        $dari = "Celcius";
        break;
    default:
        echo "Pilihan tidak valid!\n";
        exit();
}

echo "\n" . str_repeat("=", 40) . "\n";
echo "HASIL KONVERSI\n";
echo str_repeat("=", 40) . "\n";
echo "Input: " . number_format($suhu, 2) . "° $dari\n";
echo "Konversi: $dari → $keterangan\n";
echo "Hasil: " . number_format($hasil, 2) . "° $keterangan\n";
echo str_repeat("=", 40) . "\n";
?>