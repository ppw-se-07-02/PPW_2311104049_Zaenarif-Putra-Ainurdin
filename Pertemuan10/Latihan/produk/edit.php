<?php
include "../config/koneksi.php";

$id = $_GET['id'];
$produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id'");
$data = mysqli_fetch_assoc($produk);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    mysqli_query($koneksi, "UPDATE produk SET 
        nama_produk='$nama', harga='$harga', stok='$stok' 
        WHERE id_produk='$id'");

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Produk</title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Edit Produk</h2>

<form method="POST">
  <div class="mb-3">
    <label>Nama Produk</label>
    <input type="text" name="nama_produk" value="<?= $data['nama_produk'] ?>" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Harga</label>
    <input type="number" name="harga" value="<?= $data['harga'] ?>" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Stok</label>
    <input type="number" name="stok" value="<?= $data['stok'] ?>" class="form-control" required>
  </div>

  <button class="btn btn-primary" name="update">Update</button>
</form>

</body>
</html>
