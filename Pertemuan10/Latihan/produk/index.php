<?php
include "../config/koneksi.php";

// Fungsi pencarian
$cari = "";
if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
    $query = "SELECT * FROM produk WHERE nama_produk LIKE '%$cari%'";
} else {
    $query = "SELECT * FROM produk";
}

$data = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Kelola Produk</title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body class="p-4">

<h2>Kelola Produk</h2>

<a href="tambah.php" class="btn btn-primary mb-3">Tambah Produk</a>

<form method="GET" class="mb-3">
  <input type="text" name="cari" class="form-control w-25 d-inline" placeholder="Cari produk..." value="<?= $cari ?>">
  <button class="btn btn-success">Cari</button>
</form>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama Produk</th>
      <th>Harga</th>
      <th>Stok</th>
      <th>Aksi</th>
    </tr>
  </thead>

  <tbody>
    <?php while ($p = mysqli_fetch_assoc($data)) { ?>
      <tr>
        <td><?= $p['id_produk'] ?></td>
        <td><?= $p['nama_produk'] ?></td>
        <td><?= $p['harga'] ?></td>
        <td><?= $p['stok'] ?></td>
        <td>
          <a href="edit.php?id=<?= $p['id_produk'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="delete.php?id=<?= $p['id_produk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

</body>
</html>
