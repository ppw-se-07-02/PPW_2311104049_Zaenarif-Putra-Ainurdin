<?php
session_start();
include('../config/koneksi.php');

// Cek apakah user adalah admin
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../templates/login.php");
    exit();
}

if($_GET['mod']=='tambah_produk') {
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    
    // Validasi input
    if(empty($nama_produk) || empty($harga) || empty($deskripsi)) {
        $_SESSION['error'] = "Semua field harus diisi!";
        header("Location: product.php");
        exit();
    }
    
    // Handle file upload
    $target_dir = "../assets/image/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Validasi gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if($check === false) {
        $_SESSION['error'] = "File bukan gambar.";
        header("Location: product.php");
        exit();
    }
    
    // Check file size (max 2MB)
    if ($_FILES["gambar"]["size"] > 2000000) {
        $_SESSION['error'] = "Ukuran file terlalu besar (maks 2MB).";
        header("Location: product.php");
        exit();
    }
    
    // Allow certain file formats
    $allowed_types = array("jpg", "jpeg", "png", "gif");
    if(!in_array($imageFileType, $allowed_types)) {
        $_SESSION['error'] = "Hanya format JPG, JPEG, PNG & GIF yang diizinkan.";
        header("Location: product.php");
        exit();
    }
    
    // Generate unique filename
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;
    
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $query = "INSERT INTO tbl_produk (nama_produk, harga, deskripsi, gambar, tanggal) 
                  VALUES ('$nama_produk', '$harga', '$deskripsi', '$new_filename', NOW())";
        
        if(mysqli_query($koneksi, $query)) {
            $_SESSION['success'] = "Produk berhasil ditambahkan!";
        } else {
            $_SESSION['error'] = "Gagal menambahkan produk: " . mysqli_error($koneksi);
        }
    } else {
        $_SESSION['error'] = "Gagal mengupload gambar.";
    }
    
    header("Location: product.php");
    exit();
} 

else if($_GET['mod']=='hapus_produk') {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Get product info for image deletion
    $result = mysqli_query($koneksi, "SELECT gambar FROM tbl_produk WHERE id='$id'");
    
    if(mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        
        // Delete image file
        $image_path = "../assets/image/" . $product['gambar'];
        if(file_exists($image_path)) {
            unlink($image_path);
        }
        
        // Delete from database
        mysqli_query($koneksi, "DELETE FROM tbl_produk WHERE id='$id'");
        $_SESSION['success'] = "Produk berhasil dihapus!";
    } else {
        $_SESSION['error'] = "Produk tidak ditemukan!";
    }
    
    header("Location: product.php");
    exit();
}

else if($_GET['mod']=='edit_produk') {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    
    // Validasi input
    if(empty($nama_produk) || empty($harga) || empty($deskripsi)) {
        $_SESSION['error'] = "Semua field harus diisi!";
        header("Location: product.php");
        exit();
    }
    
    $update_query = "UPDATE tbl_produk SET 
                    nama_produk='$nama_produk', 
                    harga='$harga', 
                    deskripsi='$deskripsi' 
                    WHERE id='$id'";
    
    // Jika ada gambar baru
    if(!empty($_FILES["gambar"]["name"])) {
        // Validasi gambar baru
        $target_dir = "../assets/image/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Validasi gambar
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if($check === false) {
            $_SESSION['error'] = "File bukan gambar.";
            header("Location: product.php");
            exit();
        }
        
        // Check file size (max 2MB)
        if ($_FILES["gambar"]["size"] > 2000000) {
            $_SESSION['error'] = "Ukuran file terlalu besar (maks 2MB).";
            header("Location: product.php");
            exit();
        }
        
        // Allow certain file formats
        $allowed_types = array("jpg", "jpeg", "png", "gif");
        if(!in_array($imageFileType, $allowed_types)) {
            $_SESSION['error'] = "Hanya format JPG, JPEG, PNG & GIF yang diizinkan.";
            header("Location: product.php");
            exit();
        }
        
        // Delete old image
        $result = mysqli_query($koneksi, "SELECT gambar FROM tbl_produk WHERE id='$id'");
        if(mysqli_num_rows($result) > 0) {
            $old_product = mysqli_fetch_assoc($result);
            $old_image_path = "../assets/image/" . $old_product['gambar'];
            if(file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        }
        
        // Generate unique filename for new image
        $new_filename = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $new_filename;
        
        if(move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $update_query = "UPDATE tbl_produk SET 
                            nama_produk='$nama_produk', 
                            harga='$harga', 
                            deskripsi='$deskripsi',
                            gambar='$new_filename' 
                            WHERE id='$id'";
        }
    }
    
    if(mysqli_query($koneksi, $update_query)) {
        $_SESSION['success'] = "Produk berhasil diperbarui!";
    } else {
        $_SESSION['error'] = "Gagal memperbarui produk: " . mysqli_error($koneksi);
    }
    
    header("Location: product.php");
    exit();
}

// Redirect jika tidak ada mod yang valid
header("Location: index.php");
exit();
?>