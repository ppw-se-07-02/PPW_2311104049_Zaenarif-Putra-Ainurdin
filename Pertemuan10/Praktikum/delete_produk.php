<?php
session_start();
require_once 'config/database.php';

// Cek login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Cek ID produk
if (!isset($_GET['id'])) {
    header('Location: kelola_produk.php');
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Hapus produk
$query = "DELETE FROM produk WHERE id = '$id'";
if (mysqli_query($conn, $query)) {
    $_SESSION['message'] = "Produk berhasil dihapus!";
} else {
    $_SESSION['message'] = "Gagal menghapus produk: " . mysqli_error($conn);
}

header('Location: kelola_produk.php');
exit();
?>