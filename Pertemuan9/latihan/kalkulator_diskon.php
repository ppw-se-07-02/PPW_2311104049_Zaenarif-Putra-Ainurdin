<?php
echo "=== KALKULATOR DISKON ===\n\n";

echo "Masukkan total belanja (Rp): ";
$total_belanja = trim(fgets(STDIN));

$total_belanja = floatval(str_replace('.', '', $total_belanja));

if ($total_belanja <= 0) {
    echo "Total belanja harus lebih dari 0!\n";
    exit();
}

echo "\n" . str_repeat("-", 50) . "\n";
echo "RINCIAN PERHITUNGAN\n";
echo str_repeat("-", 50) . "\n";

echo "Total Belanja: Rp " . number_format($total_belanja, 0, ',', '.') . "\n";

if ($total_belanja >= 1000000) {
    $diskon_persen = 30;
    echo "Kategori: Belanja ≥ Rp 1.000.000\n";
} elseif ($total_belanja >= 500000) {
    $diskon_persen = 20;
    echo "Kategori: Belanja ≥ Rp 500.000\n";
} elseif ($total_belanja >= 100000) {
    $diskon_persen = 10;
    echo "Kategori: Belanja ≥ Rp 100.000\n";
} else {
    $diskon_persen = 0;
    echo "Kategori: Belanja < Rp 100.000\n";
}

$diskon = ($total_belanja * $diskon_persen) / 100;
$total_bayar = $total_belanja - $diskon;

echo "Diskon: " . $diskon_persen . "%\n";
echo "Potongan: Rp " . number_format($diskon, 0, ',', '.') . "\n";
echo str_repeat("-", 50) . "\n";
echo "TOTAL BAYAR: Rp " . number_format($total_bayar, 0, ',', '.') . "\n";
echo str_repeat("-", 50) . "\n";

echo "\nSimulasi untuk jumlah lain:\n";
$simulasi = [50000, 150000, 600000, 1200000];

foreach($simulasi as $jumlah) {
    if ($jumlah >= 1000000) $diskon = 30;
    elseif ($jumlah >= 500000) $diskon = 20;
    elseif ($jumlah >= 100000) $diskon = 10;
    else $diskon = 0;
    
    $bayar = $jumlah - ($jumlah * $diskon / 100);
    echo "Rp " . number_format($jumlah, 0, ',', '.') . " → diskon " . $diskon . "% → bayar Rp " . number_format($bayar, 0, ',', '.') . "\n";
}
?>