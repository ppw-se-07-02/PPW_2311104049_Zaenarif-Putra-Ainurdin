<?php
session_start();
require_once 'config/database.php';

// Cek login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Handle search
$search = '';
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

// Query produk
if (!empty($search)) {
    $query = "SELECT * FROM produk WHERE 
              nama_produk LIKE '%$search%' OR 
              kategori LIKE '%$search%' OR 
              deskripsi LIKE '%$search%'
              ORDER BY tanggal_ditambahkan DESC";
} else {
    $query = "SELECT * FROM produk ORDER BY tanggal_ditambahkan DESC";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Produk - Dashboard Administrator</title>
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

    .active {
      background: #0042a6;
      color: #fff !important;
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
    }

    main h2 {
      color: #1e98a8;
      margin-bottom: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
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

    /* Styles untuk tabel produk */
    .btn {
      padding: 8px 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s ease;
    }

    .btn-success {
      background: #00a676;
      color: white;
    }

    .btn-success:hover {
      background: #008c63;
      transform: translateY(-2px);
    }

    .search-box {
      margin-bottom: 20px;
      display: flex;
      gap: 10px;
    }

    .search-box input {
      flex: 1;
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
    }

    .search-box button {
      padding: 10px 20px;
      background: #00467f;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .search-box button:hover {
      background: #003366;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #e0e0e0;
    }

    th {
      background-color: #f8f9fa;
      font-weight: 600;
      color: #333;
    }

    tr:hover {
      background-color: #f5f5f5;
    }

    .btn-sm {
      padding: 5px 10px;
      font-size: 14px;
      margin-right: 5px;
    }

    .btn-warning {
      background: #ffc107;
      color: #333;
    }

    .btn-warning:hover {
      background: #e0a800;
    }

    .btn-danger {
      background: #d9534f;
      color: white;
    }

    .btn-danger:hover {
      background: #c9302c;
    }

    .badge {
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 600;
    }

    .badge-success {
      background: #d4edda;
      color: #155724;
    }

    .badge-warning {
      background: #fff3cd;
      color: #856404;
    }

    .badge-danger {
      background: #f8d7da;
      color: #721c24;
    }

    .no-data {
      text-align: center;
      padding: 40px;
      color: #666;
    }

    .no-data i {
      font-size: 48px;
      margin-bottom: 10px;
      color: #ccc;
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
      <li><a href="kelola_produk.php" class="active">🛍️ Kelola Produk</a></li>
      <li><a href="#">📋 Data User</a></li>
      <li><a href="#">🔑 Edit Password</a></li>
      <li><a href="logout.php" class="logout">🚪 Logout</a></li>
    </ul>
  </nav>

  <main>
    <div class="content-box">
      <h2>
        Kelola Produk
        <a href="tambah_produk.php" class="btn btn-success">+ Tambah Produk</a>
      </h2>
      
      <div class="search-box">
        <form method="GET" action="">
          <input type="text" name="search" placeholder="Cari produk..." value="<?php echo htmlspecialchars($search); ?>">
          <button type="submit">Cari</button>
          <?php if(!empty($search)): ?>
            <a href="kelola_produk.php" class="btn">Reset</a>
          <?php endif; ?>
        </form>
      </div>
      
      <div class="table-container">
        <?php if(mysqli_num_rows($result) > 0): ?>
          <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              while($row = mysqli_fetch_assoc($result)): 
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                  <td>
                    <span class="badge badge-success"><?php echo htmlspecialchars($row['kategori']); ?></span>
                  </td>
                  <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                  <td>
                    <?php 
                    $badge_class = 'badge-success';
                    if ($row['stok'] < 5) {
                      $badge_class = 'badge-danger';
                    } elseif ($row['stok'] < 10) {
                      $badge_class = 'badge-warning';
                    }
                    ?>
                    <span class="badge <?php echo $badge_class; ?>">
                      <?php echo $row['stok']; ?> pcs
                    </span>
                  </td>
                  <td><?php echo substr(htmlspecialchars($row['deskripsi']), 0, 50) . '...'; ?></td>
                  <td>
                    <a href="edit_produk.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_produk.php?id=<?php echo $row['id']; ?>" 
                       class="btn btn-danger btn-sm" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                      Hapus
                    </a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        <?php else: ?>
          <div class="no-data">
            <p>📦</p>
            <h3>Tidak ada produk ditemukan</h3>
            <p><?php echo !empty($search) ? "Coba dengan kata kunci lain atau " : ""; ?>
               <a href="tambah_produk.php" class="btn btn-success">Tambah Produk Baru</a></p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </main>

  <footer>
    © 2025 Dashboard Administrator | By Zaenarif Putra Ainurdin
  </footer>
</body>
</html>