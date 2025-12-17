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
    <title>Kelola Produk - Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Admin Panel - Kelola Produk</h1>
    </header>

    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="datauser.php">Data User</a></li>
                <li><a href="product.php" class="active">Kelola Produk</a></li>
                <li><a href="settings.php">Pengaturan</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <section class="content">
            <h2>Kelola Produk</h2>
            
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

            <form class="form" method="post" action="admin.php?mod=tambah_produk" enctype="multipart/form-data">
                <h3 style="margin-bottom: 20px;">Tambah Produk Baru</h3>
                
                <label>Nama Produk:</label>
                <input type="text" name="nama_produk" placeholder="Masukkan nama produk" required>

                <label>Harga (Rp):</label>
                <input type="number" name="harga" placeholder="Masukkan harga" min="0" required>
                
                <label>Gambar Produk:</label>
                <input type="file" name="gambar" accept="image/*" required>
                <small style="color: #666;">Format: JPG, PNG, GIF | Maks: 2MB</small>

                <label>Deskripsi:</label>
                <textarea rows="4" name="deskripsi" placeholder="Masukkan deskripsi produk" required></textarea>

                <button type="submit">Tambah Produk</button>
            </form>

            <h3 style="margin-top: 30px;">Daftar Produk</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 1; 
                    $data = mysqli_query($koneksi, "SELECT * FROM tbl_produk ORDER BY tanggal DESC");
                    while($r = mysqli_fetch_array($data)):
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                            <?php if(!empty($r['gambar'])): ?>
                            <img src="../assets/image/<?php echo $r['gambar']; ?>" 
                                 alt="<?php echo $r['nama_produk']; ?>" 
                                 style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                            <?php else: ?>
                            <span style="color: #999;">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $r['nama_produk']; ?></td>
                        <td>Rp <?php echo number_format($r['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo substr($r['deskripsi'], 0, 50) . '...'; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($r['tanggal'])); ?></td>
                        <td>
                            <button class="btn-edit" onclick="editProduct(<?php echo $r['id']; ?>)">Edit</button>
                            <a href="admin.php?mod=hapus_produk&id=<?php echo $r['id']; ?>" 
                               onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                <button class="btn-delete">Hapus</button>
                            </a>
                        </td>
                    </tr>
                <?php $no++; endwhile; ?>
                </tbody>
            </table>
            
            <?php if(mysqli_num_rows($data) == 0): ?>
                <p style="text-align: center; color: #666; padding: 20px;">Belum ada produk.</p>
            <?php endif; ?>
        </section>
    </div>

    <footer>
        <p>© 2025 MK - Pemrograman Platform Web | By Zaenarif Putra 'Ainurdin</p>
    </footer>

    <!-- Modal Edit (Sederhana) -->
    <div id="editModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
        <div style="background: white; margin: 50px auto; padding: 30px; border-radius: 8px; width: 80%; max-width: 600px;">
            <h3 style="margin-bottom: 20px;">Edit Produk</h3>
            <form id="editForm" method="post" action="admin.php?mod=edit_produk" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_id">
                
                <label>Nama Produk:</label>
                <input type="text" name="nama_produk" id="edit_nama" required>
                
                <label>Harga (Rp):</label>
                <input type="number" name="harga" id="edit_harga" min="0" required>
                
                <label>Gambar Produk:</label>
                <input type="file" name="gambar" id="edit_gambar">
                <small style="color: #666;">Kosongkan jika tidak ingin mengubah gambar</small>
                <div id="current-image" style="margin: 10px 0;"></div>
                
                <label>Deskripsi:</label>
                <textarea rows="4" name="deskripsi" id="edit_deskripsi" required></textarea>
                
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn-edit">Update Produk</button>
                    <button type="button" onclick="closeEditModal()" style="background: #95a5a6; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; margin-left: 10px;">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editProduct(id) {
            fetch(`get_product.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        document.getElementById('edit_id').value = data.id;
                        document.getElementById('edit_nama').value = data.nama_produk;
                        document.getElementById('edit_harga').value = data.harga;
                        document.getElementById('edit_deskripsi').value = data.deskripsi;
                        
                        const imageContainer = document.getElementById('current-image');
                        if(data.gambar) {
                            imageContainer.innerHTML = `
                                <p>Gambar saat ini:</p>
                                <img src="../assets/image/${data.gambar}" 
                                     alt="${data.nama_produk}" 
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px; margin-top: 5px;">
                            `;
                        } else {
                            imageContainer.innerHTML = '<p>Tidak ada gambar</p>';
                        }
                        
                        document.getElementById('editModal').style.display = 'block';
                    } else {
                        alert('Gagal memuat data produk');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat data');
                });
        }
        
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
            document.getElementById('editForm').reset();
            document.getElementById('current-image').innerHTML = '';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('editModal');
            if(event.target == modal) {
                closeEditModal();
            }
        }
    </script>
</body>
</html>