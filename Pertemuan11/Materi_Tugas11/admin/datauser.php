<?php
session_start();
include('../config/koneksi.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Admin Panel - Data User</h1>
    </header>

    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="datauser.php" class="active">Data User</a></li>
                <li><a href="product.php">Kelola Produk</a></li>
                <li><a href="settings.php">Pengaturan</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <section class="content">
            <h2>Data Pengguna</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIM</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM tbl_users ORDER BY id DESC");
                    $no = 1;
                    while($user = mysqli_fetch_assoc($query)):
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['nama']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['nim']; ?></td>
                        <td>
                            <?php 
                            if($user['role'] == 'admin') {
                                echo '<span style="background: #3498db; color: white; padding: 3px 8px; border-radius: 3px; font-size: 12px;">Admin</span>';
                            } else {
                                echo '<span style="background: #95a5a6; color: white; padding: 3px 8px; border-radius: 3px; font-size: 12px;">User</span>';
                            }
                            ?>
                        </td>
                        <td><?php echo date('d/m/Y', strtotime($user['created_at'] ?? 'now')); ?></td>
                        <td>
                            <button class="btn-edit" onclick="editUser(<?php echo $user['id']; ?>)">Edit</button>
                            <?php if($user['id'] != $_SESSION['user_id']): ?>
                            <a href="admin.php?mod=hapus_user&id=<?php echo $user['id']; ?>" 
                               onclick="return confirm('Yakin ingin menghapus user ini?')">
                                <button class="btn-delete">Hapus</button>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $no++; endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>

    <footer>
        <p>© 2025 MK - Pemrograman Platform Web | By Zaenarif Putra 'Ainurdin</p>
    </footer>
</body>
</html>