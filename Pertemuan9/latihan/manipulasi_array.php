<?php
echo "=== MANIPULASI ARRAY NILAI MAHASISWA ===\n\n";

echo "Pilih sumber data:\n";
echo "1. Gunakan data default\n";
echo "2. Input data manual\n";
echo "Pilihan (1-2): ";
$pilihan = trim(fgets(STDIN));

$nilai_mahasiswa = [];

if ($pilihan == '2') {
    echo "\nMasukkan jumlah mahasiswa: ";
    $jumlah = intval(trim(fgets(STDIN)));
    
    for ($i = 0; $i < $jumlah; $i++) {
        echo "Nilai mahasiswa ke-" . ($i + 1) . ": ";
        $nilai = intval(trim(fgets(STDIN)));
        $nilai_mahasiswa[] = $nilai;
    }
} else {
    $nilai_mahasiswa = [75, 89, 65, 90, 85, 70, 98, 65, 69, 70, 12];
}

echo "\n" . str_repeat("=", 60) . "\n";
echo "ANALISIS DATA NILAI MAHASISWA\n";
echo str_repeat("=", 60) . "\n\n";

echo "1. Data Nilai Mahasiswa:\n";
echo "   " . implode(", ", $nilai_mahasiswa) . "\n";
echo "   Jumlah data: " . count($nilai_mahasiswa) . "\n\n";

$nilai_tertinggi = max($nilai_mahasiswa);
echo "2. Nilai Tertinggi: " . $nilai_tertinggi . "\n";

$nilai_terendah = min($nilai_mahasiswa);
echo "3. Nilai Terendah: " . $nilai_terendah . "\n";

$rata_rata = array_sum($nilai_mahasiswa) / count($nilai_mahasiswa);
echo "4. Rata-rata Nilai: " . number_format($rata_rata, 2) . "\n";

$lulus = array_filter($nilai_mahasiswa, function($nilai) {
    return $nilai >= 70;
});
$jumlah_lulus = count($lulus);
$persentase_lulus = ($jumlah_lulus / count($nilai_mahasiswa)) * 100;
echo "5. Statistik Kelulusan:\n";
echo "   Lulus (≥70): " . $jumlah_lulus . " mahasiswa\n";
echo "   Tidak lulus: " . (count($nilai_mahasiswa) - $jumlah_lulus) . " mahasiswa\n";
echo "   Persentase lulus: " . number_format($persentase_lulus, 1) . "%\n";

echo "   Nilai lulus: " . implode(", ", array_values($lulus)) . "\n";

$nilai_terurut = $nilai_mahasiswa;
rsort($nilai_terurut);
echo "\n6. Ranking Nilai (Tertinggi ke Terendah):\n";
foreach ($nilai_terurut as $index => $nilai) {
    $status = $nilai >= 70 ? "✓ LULUS" : "✗ TIDAK LULUS";
    echo "   " . ($index + 1) . ". " . $nilai . " ($status)\n";
}

// 7. Grafik sederhana
echo "\n7. Distribusi Nilai:\n";
$kategori = [
    "A (90-100)" => 0,
    "B (80-89)" => 0,
    "C (70-79)" => 0,
    "D (60-69)" => 0,
    "E (<60)" => 0
];

foreach ($nilai_mahasiswa as $nilai) {
    if ($nilai >= 90) $kategori["A (90-100)"]++;
    elseif ($nilai >= 80) $kategori["B (80-89)"]++;
    elseif ($nilai >= 70) $kategori["C (70-79)"]++;
    elseif ($nilai >= 60) $kategori["D (60-69)"]++;
    else $kategori["E (<60)"]++;
}

foreach ($kategori as $kat => $jumlah) {
    $bar = str_repeat("█", $jumlah);
    echo "   $kat: $bar ($jumlah)\n";
}

echo "\n" . str_repeat("=", 60) . "\n";
echo "ANALISIS SELESAI\n";
echo str_repeat("=", 60) . "\n";
?>