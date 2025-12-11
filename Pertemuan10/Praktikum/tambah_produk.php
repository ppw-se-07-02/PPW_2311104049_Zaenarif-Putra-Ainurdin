<?php
session_start();
require_once 'config/database.php';

// Cek login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Proses tambah produk
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    
    $query = "INSERT INTO produk (nama_produk, kategori, harga, stok, deskripsi) 
              VALUES ('$nama_produk', '$kategori', '$harga', '$stok', '$deskripsi')";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Produk berhasil ditambahkan!";
        header('Location: kelola_produk.php');
        exit();
    } else {
        $error = "Gagal menambahkan produk: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Produk - Dashboard Administrator</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Poppins", Arial, sans-serif;
      display: grid;
      grid-template-areas:
        "header header"
        "sidebar konten"
        "footer footer";
      grid-template-columns: 260px 1fr;
      grid-template-rows: auto 1fr auto;
      min-height: 100vh;
      background: #f5f7fa;
      color: #333;
    }

    header {
      grid-area: header;
      background: linear-gradient(90deg, #00467f, #00a676);
      color: #fff;
      padding: 20px 30px;
      font-size: 1.6rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    header span {
      font-size: 0.9rem;
      font-weight: bold;
      opacity: 0.9;
    }

    nav {
      grid-area: sidebar;
      background: #ffffff;
      padding: 30px 20px;
      border-right: 1px solid #e0e0e0;
      box-shadow: 2px 0 10px rgba(0,0,0,0.05);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .menu {
      list-style: none;
    }

    .menu li {
      margin-bottom: 15px;
    }

    .menu a {
      text-decoration: none;
      color: #333;
      font-weight: 600;
      padding: 10px 15px;
      border-radius: 8px;
      display: block;
      transition: all 0.3s ease;
    }

    .menu a:hover {
      background: #0042a6;
      color: #fff;
      transform: translateX(5px);
      box-shadow: 0 2px 6px rgba(0, 166, 118, 0.3);
    }

    .logout {
      margin-top: auto;
      color: #d9534f;
      font-weight: bold;
    }

    main {
      grid-area: konten;
      padding: 30px;
    }

    .content-box {
      background: #fff;
      border-radius: 10px;
      padding: 25px 30px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
      animation: fadeIn 0.6s ease;
      max-width: 800px;
      margin: 0 auto;
    }

    main h2 {
      color: #1e98a8;
      margin-bottom: 25px;
    }

    p {
      line-height: 1.6;
      color: #555;
    }

    footer {
      grid-area: footer;
      background: linear-gradient(90deg, #00467f, #00a676);
      color: #fff;
      text-align: center;
      padding: 15px;
      font-size: 0.9rem;
      box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
      body {
        grid-template-areas:
          "header"
          "konten"
          "footer";
        grid-template-columns: 1fr;
      }

      nav {
        display: none;
      }

      main {
        padding: 15px;
      }
    }

    /* Form styles */
    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      color: #333;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
      font-family: "Poppins", Arial, sans-serif;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: #00467f;
      box-shadow: 0 0 0 2px rgba(0, 70, 127, 0.2);
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s ease;
    }

    .btn-primary {
      background: #00467f;
      color: white;
    }

    .btn-primary:hover {
      background: #003366;
      transform: translateY(-2px);
    }

    .btn-secondary {
      background: #6c757d;
      color: white;
    }

    .btn-secondary:hover {
      background: #5a6268;
    }

    .error-message {
      background: #f8d7da;
      color: #721c24;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .form-actions {
      display: flex;
      gap: 10px;
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <header>
    <div>Dashboard Administrator</div>
    <span>Selamat datang, <?php echo $_SESSION['admin_name'] ?? 'Admin'; ?>!</span>
  </header>

  <nav>
    <ul class="menu">
      <li><a href="index.php">🏠 Dashboard</a></li>
      <li><a href="kelola_produk.php">🛍️ Kelola Produk</a></li>
      <li><a href="#">📋 Data User</a></li>
      <li><a href="#">🔑 Edit Password</a></li>
      <li><a href="logout.php" class="logout">🚪 Logout</a></li>
    </ul>
  </nav>

  <main>
    <div class="content-box">
      <h2>Tambah Produk Baru</h2>
      
      <?php if (isset($error)): ?>
        <div class="error-message">
          <?php echo $error; ?>
        </div>
      <?php endif; ?>
      
      <form method="POST" action="">
        <div class="form-group">
          <label for="nama_produk">Nama Produk *</label>
          <input type="text" id="nama_produk" name="nama_produk" required>
        </div>
        
        <div class="form-group">
          <label for="kategori">Kategori *</label>
          <select id="kategori" name="kategori" required>
            <option value="">Pilih Kategori</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Furniture">Furniture</option>
            <option value="Buku">Buku</option>
            <option value="Aksesoris">Aksesoris</option>
            <option value="Pakaian">Pakaian</option>
            <option value="Makanan">Makanan</option>
            <option value="Lainnya">Lainnya</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="harga">Harga (Rp) *</label>
          <input type="number" id="harga" name="harga" min="0" required>
        </div>
        
        <div class="form-group">
          <label for="stok">Stok *</label>
          <input type="number" id="stok" name="stok" min="0" required>
        </div>
        
        <div class="form-group">
          <label for="deskripsi">Deskripsi Produk</label>
          <textarea id="deskripsi" name="deskripsi" rows="4"></textarea>
        </div>
        
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Simpan Produk</button>
          <a href="kelola_produk.php" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </main>

  <footer>
    © 2025 Dashboard Administrator | By Zaenarif Putra Ainurdin
  </footer>
</body>
</html>