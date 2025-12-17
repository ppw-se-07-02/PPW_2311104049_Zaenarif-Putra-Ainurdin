<?php
session_start();
include('../config/koneksi.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
    exit();
}

if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $result = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id='$id'");
    
    if(mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        echo json_encode([
            'success' => true,
            'id' => $product['id'],
            'nama_produk' => $product['nama_produk'],
            'harga' => $product['harga'],
            'deskripsi' => $product['deskripsi'],
            'gambar' => $product['gambar']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Produk tidak ditemukan']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID tidak ditemukan']);
}
?>