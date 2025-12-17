<?php
// Ambil parameter mod dengan default value 'beranda'
$mod = isset($_GET['mod']) ? $_GET['mod'] : 'beranda';

// Daftar halaman yang valid
$valid_pages = ['beranda', 'produk', 'member', 'login'];

// Validasi jika mod tidak ada dalam daftar valid
if (!in_array($mod, $valid_pages)) {
    $mod = 'beranda';
}

// Include file template berdasarkan mod
$template_file = "templates/{$mod}.php";

// Pastikan file template ada sebelum di-include
if (file_exists($template_file)) {
    include($template_file);
} else {
    echo "<h2>Error: Template tidak ditemukan</h2>";
    echo "<p>File template untuk <strong>{$mod}</strong> tidak ada.</p>";
}
?>