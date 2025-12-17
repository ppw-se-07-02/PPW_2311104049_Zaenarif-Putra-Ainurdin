<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if($_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

include('../config/koneksi.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - MK PPW</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Admin Panel - MK PPW</h1>
    </header>

    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="index.php" class="active">Dashboard</a></li>
                <li><a href="datauser.php">Data User</a></li>
                <li><a href="product.php">Kelola Produk</a></li>
                <li><a href="settings.php">Pengaturan</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <section class="content">
            <h2>Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h2>
            <p>Anda login sebagai Administrator. Terakhir login: <?php echo date('d F Y H:i:s'); ?></p>
            
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert-success" style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0;">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert-error" style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0;">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <div class="stats" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin: 30px 0;">
                <?php
                // Hitung total produk
                $query1 = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_produk");
                $produk = mysqli_fetch_assoc($query1);
                
                // Hitung total user
                $query2 = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_users");
                $user = mysqli_fetch_assoc($query2);
                
                // Hitung produk hari ini
                $today = date('Y-m-d');
                $query3 = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_produk WHERE DATE(tanggal) = '$today'");
                $produk_hari_ini = mysqli_fetch_assoc($query3);
                ?>
                
                <div class="stat-box" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center;">
                    <h3 style="color: #666; margin-bottom: 10px;">Total Produk</h3>
                    <div style="font-size: 36px; font-weight: bold; color: #2c3e50;"><?php echo $produk['total']; ?></div>
                </div>
                
                <div class="stat-box" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center;">
                    <h3 style="color: #666; margin-bottom: 10px;">Total User</h3>
                    <div style="font-size: 36px; font-weight: bold; color: #2c3e50;"><?php echo $user['total']; ?></div>
                </div>
                
                <div class="stat-box" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center;">
                    <h3 style="color: #666; margin-bottom: 10px;">Produk Hari Ini</h3>
                    <div style="font-size: 36px; font-weight: bold; color: #2c3e50;"><?php echo $produk_hari_ini['total']; ?></div>
                </div>
            </div>

            <div class="recent-activity" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <h3 style="margin-bottom: 20px;">Aktivitas Terbaru</h3>
                <?php
                $query4 = mysqli_query($koneksi, "SELECT * FROM tbl_produk ORDER BY tanggal DESC LIMIT 5");
                if(mysqli_num_rows($query4) > 0):
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($query4)): ?>
                            <tr>
                                <td><?php echo $row['nama_produk']; ?></td>
                                <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($row['tanggal'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Tidak ada aktivitas terbaru.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>
    
    <footer>
        <p>© 2025 MK - Pemrograman Platform Web | By Zaenarif Putra 'Ainurdin</p>
    </footer>
</body>
</html>