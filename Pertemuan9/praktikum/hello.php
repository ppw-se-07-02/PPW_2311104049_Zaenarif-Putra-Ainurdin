<?php
echo "Hello, World!";
echo "<br>";
echo "This is my first PHP script.";
echo "<br>";

// Variable 
$nim = "2311104049";
$nama = "Zaenarif Putra";
echo "NIM:" . $nim;
echo "<br>";
echo "Nama: " . $nama;

// Constanta
define("Nama" , "Zaenarif Putra");
define("NIM" , "2311104049");
define("Asal", "Karawang");
echo "Nama: " . Nama . "<br>";
echo "NIM: " . NIM . "<br>";
echo "Asal: " . Asal;

// Struktur Kondisi
$nilai = 80;
if ($nilai > 50) {
    echo "Nilai anda adalah " . $nilai . " Selamat, Anda Lulus!";
} else {
    echo "Nilai anda adalah " . $nilai . " Maaf, Anda Tidak Lulus!";
}

// Sturktur Kondisi Switch
$nilai = 80;
switch ($nilai) {
 case ($nilai > 50 && $nilai <= 60):
 echo "Nilai Anda adalah $nilai. Indeks nilai anda C";
 break;
 case ($nilai > 60 && $nilai <= 70):
 echo "Nilai Anda adalah $nilai. Indeks nilai anda BC";
 break;
 case ($nilai > 70 && $nilai <= 75):
 echo "Nilai Anda adalah $nilai. Indeks nilai anda B";
 break;
 case ($nilai > 75 && $nilai <= 80):
 echo "Nilai Anda adalah $nilai. Indeks nilai anda AB";
 break;
 case ($nilai > 80 && $nilai <= 100):
 echo "Nilai Anda adalah $nilai. Indeks nilai anda A";
 break;
 default:
 echo "Nilai Anda adalah $nilai. Maaf, Anda tidak lulus";
 break;
}

// Perulangan (Looping)
// Ini adalah contoh perulangan for
echo "Ini adalah contoh perulangan for<br>";
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "<br><br>";
// Ini adalah contoh perulangan while
echo "Ini adalah contoh perulangan while<br>";
$i = 1;
while ($i <= 20) {
    echo $i . " ";
    $i += 2;
}
echo "<br><br>";
// Ini adalah contoh perulangan do-while
echo "Ini adalah contoh perulangan do-while<br>";
$i = 1;
do {
    echo $i . " ";
    $i += 3;
} while ($i < 30);

// Function
// Function Menggunakan Parameter
function cetakGenap()
{
    for ($i = 1; $i <= 100; $i++) {
        if ($i % 2 == 0) {
        echo "$i ";
        }
    }
}
//pemanggilan fungsi
cetakGenap();

// Function Menggunakan Return Value
// function cetakGenap($awal, $akhir)
// {
//     for ($i = $awal; $i <= $akhir; $i++) {
//         if ($i % 2 == 0) {
//             echo "$i ";
//         }
//     }
// }
// // Pemanggilan fungsi
// $a = 10;
// $b = 50;
// // Perbaikan: Mengubah teks "ganjil" menjadi "genap" agar sesuai dengan fungsi
// echo "Bilangan genap dari $a sampai $b adalah: <br>"; 
// cetakGenap($a, $b);

// Function Menghitung Luas Segitiga
// function luasSegitiga($alas, $tinggi)
// {
//     $luas = 0.5 * $alas * $tinggi;
//     return $luas;
// }
// $alas = 10;
// $tinggi = 20;
// $hasilLuas = luasSegitiga($alas, $tinggi);
// echo "Luas segitiga dengan alas $alas dan tinggi $tinggi adalah: "
// . $hasilLuas . "<br>";

// Array
echo "Array Numerik<br>";
$arrKendaraan = ["Mobil", "Pesawat", "Kereta Api", "Kapal Laut"];
echo $arrKendaraan[0] . "<br>"; //Mobil
echo $arrKendaraan[2] . "<br>"; //Kereta Api
$arrKota = [];
$arrKota[] = "Jakarta";
$arrKota[] = "Medan";
$arrKota[] = "Bandung";
$arrKota[] = "Malang";
$arrKota[] = "Sulawesi";
echo $arrKota[1] . "<br>"; //Medan
echo $arrKota[2] . "<br>"; //Bandung
echo $arrKota[4] . "<br>"; //Sulawesi
echo "<br>";

//Array Asosiatif
echo "Array Asosiatif<br>";
$arrAlamat = [
"Rona" => "Banjarmasin",
"Dhiva" => "Bandung",
"Ilham" => "Medan",
"Oku" => "Hongkong",
];
echo $arrAlamat["Dhiva"] . "<br>"; //Bandung
echo $arrAlamat['Oku'] . "<br>"; //Hongkong
$arrNim = [];
$arrNim["Rona"] = "11011112";
$arrNim["Dhiva"] = "11011101";
$arrNim["Ilham"] = "11011309";
$arrNim["Oku"] = "11014765";
$arrNim["Fadhlan"] = "11011113";
echo $arrNim["Ilham"] . "<br>"; //11011309
echo $arrNim['Fadhlan'] . "<br>"; //11011113
?>