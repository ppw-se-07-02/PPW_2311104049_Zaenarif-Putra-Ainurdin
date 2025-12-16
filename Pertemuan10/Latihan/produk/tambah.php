<?php
include "../config/koneksi.php";

if (isset($_POST['simpan'])) {
    $nama  = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    mysqli_query($koneksi, "INSERT INTO produk VALUES ('', '$nama', '$harga', '$stok')");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Tambah Produk</h2>

<form method="POST">
  <div class="mb-3">
    <label>Nama Produk</label>
    <input type="text" name="nama_produk" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Harga</label>
    <input type="number" name="harga" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Stok</label>
    <input type="number" name="stok" class="form-control" required>
  </div>

  <button class="btn btn-primary" name="simpan">Simpan</button>
</form>

</body>
</html>
