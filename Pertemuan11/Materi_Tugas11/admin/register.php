<?php
session_start();
include('../config/koneksi.php');

// Jika sudah login sebagai admin, redirect ke dashboard
if(isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin') {
    header("Location: index.php");
    exit();
}

$error = "";
$success = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    
    // Validasi
    if(empty($username) || empty($password) || empty($nama) || empty($email)) {
        $error = "Semua field wajib diisi!";
    } elseif($password !== $confirm_password) {
        $error = "Password tidak sama!";
    } elseif(strlen($password) < 8) {
        $error = "Password minimal 8 karakter!";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email tidak valid!";
    } else {
        // Cek username/email sudah ada
        $check = mysqli_query($koneksi, "SELECT id FROM tbl_users WHERE username='$username' OR email='$email'");
        if(mysqli_num_rows($check) > 0) {
            $error = "Username atau email sudah terdaftar!";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert ke database
            $insert = mysqli_query($koneksi, 
                "INSERT INTO tbl_users (username, password, nama, email, nim, role, created_at) 
                 VALUES ('$username', '$hashed_password', '$nama', '$email', '$nim', 'admin', NOW())");
            
            if($insert) {
                $success = "Registrasi admin berhasil! Silakan login.";
                // Reset form
                $_POST = array();
            } else {
                $error = "Gagal mendaftarkan admin: " . mysqli_error($koneksi);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin - MK PPW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ===== REGISTER STYLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .register-container {
            width: 100%;
            max-width: 550px;
            animation: slideUp 0.6s ease-out;
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease;
        }
        
        .register-card:hover {
            transform: translateY(-5px);
        }
        
        .register-header {
            background: linear-gradient(to right, #FF416C, #FF4B2B);
            padding: 35px 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .register-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: shimmer 3s infinite linear;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .admin-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.3);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .register-header h1 {
            font-size: 30px;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .register-header p {
            font-size: 14px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        
        .register-body {
            padding: 35px 30px;
        }
        
        .message {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            text-align: center;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            animation: fadeIn 0.5s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .error {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            color: white;
        }
        
        .success {
            background: linear-gradient(to right, #00b09b, #96c93d);
            color: white;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-group.full-width {
            grid-column: 1 / -1;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-control {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
            color: #333;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #FF416C;
            background: white;
            box-shadow: 0 5px 20px rgba(255, 65, 108, 0.2);
        }
        
        .input-icon {
            position: absolute;
            left: 20px;
            top: 42px;
            color: #7f8c8d;
            font-size: 18px;
            transition: color 0.3s;
        }
        
        .form-control:focus + .input-icon {
            color: #FF416C;
        }
        
        .password-strength {
            height: 4px;
            background: #eee;
            margin-top: 5px;
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }
        
        .strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            position: absolute;
            top: 0;
            left: 0;
        }
        
        .weak { 
            background: linear-gradient(to right, #ff416c, #ff4b2b); 
            width: 33%; 
        }
        
        .medium { 
            background: linear-gradient(to right, #ff9a00, #ffcc00); 
            width: 66%; 
        }
        
        .strong { 
            background: linear-gradient(to right, #00b09b, #96c93d); 
            width: 100%; 
        }
        
        .password-hint {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(to right, #FF416C, #FF4B2B);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(255, 65, 108, 0.3);
        }
        
        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(255, 65, 108, 0.4);
        }
        
        .btn-register:active {
            transform: translateY(-1px);
        }
        
        .btn-register::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.3), transparent);
            transform: rotate(30deg);
            transition: all 0.5s;
        }
        
        .btn-register:hover::after {
            left: 100%;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
        
        .login-link a {
            color: #FF416C;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: all 0.3s;
        }
        
        .login-link a:hover {
            color: #ff4b2b;
            text-decoration: underline;
        }
        
        .back-link {
            text-align: center;
            margin-top: 15px;
        }
        
        .back-link a {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 25px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s;
        }
        
        .back-link a:hover {
            color: white;
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* Animated Background */
        .animated-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 0;
        }
        
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 4s infinite ease-in-out;
        }
        
        .bg-circle:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }
        
        .bg-circle:nth-child(2) {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
            animation-delay: 2s;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.1); opacity: 0.5; }
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .register-container {
                max-width: 100%;
            }
            
            .register-card {
                border-radius: 15px;
            }
            
            .register-header {
                padding: 25px 20px;
            }
            
            .register-body {
                padding: 25px 20px;
            }
            
            .form-control {
                padding: 14px 20px 14px 45px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="bg-circle"></div>
        <div class="bg-circle"></div>
    </div>
    
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="admin-badge">
                    <i class="fas fa-user-shield"></i> ADMIN REGISTRATION
                </div>
                <h1><i class="fas fa-user-plus"></i> Registrasi Admin</h1>
                <p>MK - Pemrograman Platform Web</p>
            </div>
            
            <div class="register-body">
                <?php if($error): ?>
                    <div class="message error">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <?php if($success): ?>
                    <div class="message success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo $success; ?>
                        <script>
                            setTimeout(function() {
                                window.location.href = 'login.php';
                            }, 3000);
                        </script>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="" onsubmit="return validateForm()">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nama"><i class="fas fa-user"></i> Nama Lengkap *</label>
                            <input type="text" id="nama" name="nama" 
                                   class="form-control" 
                                   value="<?php echo $_POST['nama'] ?? ''; ?>" 
                                   placeholder="John Doe" 
                                   required>
                            <i class="fas fa-user input-icon"></i>
                        </div>
                        
                        <div class="form-group">
                            <label for="nim"><i class="fas fa-id-card"></i> NIM</label>
                            <input type="text" id="nim" name="nim" 
                                   class="form-control" 
                                   value="<?php echo $_POST['nim'] ?? ''; ?>" 
                                   placeholder="12345678">
                            <i class="fas fa-id-card input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="email"><i class="fas fa-envelope"></i> Email *</label>
                        <input type="email" id="email" name="email" 
                               class="form-control" 
                               value="<?php echo $_POST['email'] ?? ''; ?>" 
                               placeholder="admin@example.com" 
                               required>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="username"><i class="fas fa-at"></i> Username *</label>
                        <input type="text" id="username" name="username" 
                               class="form-control" 
                               value="<?php echo $_POST['username'] ?? ''; ?>" 
                               placeholder="admin123" 
                               required>
                        <i class="fas fa-at input-icon"></i>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="password"><i class="fas fa-key"></i> Password *</label>
                            <input type="password" id="password" name="password" 
                                   class="form-control" 
                                   placeholder="Minimal 8 karakter" 
                                   required
                                   onkeyup="checkPasswordStrength()">
                            <i class="fas fa-key input-icon" id="password-icon" onclick="togglePassword('password', 'password-icon')" style="cursor: pointer;"></i>
                            <div class="password-strength">
                                <div class="strength-bar" id="strengthBar"></div>
                            </div>
                            <div class="password-hint">
                                <i class="fas fa-info-circle"></i>
                                <span id="passwordHint">Masukkan password</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password"><i class="fas fa-key"></i> Konfirmasi Password *</label>
                            <input type="password" id="confirm_password" name="confirm_password" 
                                   class="form-control" 
                                   placeholder="Ulangi password" 
                                   required
                                   onkeyup="checkPasswordMatch()">
                            <i class="fas fa-key input-icon" id="confirm-icon" onclick="togglePassword('confirm_password', 'confirm-icon')" style="cursor: pointer;"></i>
                            <div id="passwordMatch" style="font-size:12px; margin-top:5px; display: flex; align-items: center; gap: 5px;"></div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-register">
                        <i class="fas fa-user-plus"></i> Daftarkan Admin
                    </button>
                </form>
                
                <div class="login-link">
                    Sudah punya akun? 
                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                        <a href="index.php">Kembali ke Dashboard</a>
                    <?php else: ?>
                        <a href="login.php">Login di sini</a>
                    <?php endif; ?>
                </div>
                
                <div class="back-link">
                    <a href="../index.php">
                        <i class="fas fa-home"></i>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);
            
            if(passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-key');
                passwordIcon.classList.add('fa-unlock');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-unlock');
                passwordIcon.classList.add('fa-key');
            }
        }
        
        // Check password strength
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('strengthBar');
            const passwordHint = document.getElementById('passwordHint');
            
            let strength = 0;
            let hint = '';
            let colorClass = '';
            
            // Length check
            if(password.length >= 8) strength++;
            // Contains uppercase
            if(/[A-Z]/.test(password)) strength++;
            // Contains numbers
            if(/[0-9]/.test(password)) strength++;
            // Contains special characters
            if(/[^A-Za-z0-9]/.test(password)) strength++;
            
            switch(strength) {
                case 0:
                    hint = 'Masukkan password';
                    colorClass = '';
                    break;
                case 1:
                    hint = 'Password lemah';
                    colorClass = 'weak';
                    break;
                case 2:
                case 3:
                    hint = 'Password cukup';
                    colorClass = 'medium';
                    break;
                case 4:
                    hint = 'Password kuat';
                    colorClass = 'strong';
                    break;
            }
            
            strengthBar.className = 'strength-bar ' + colorClass;
            passwordHint.textContent = hint;
            
            // Check password match
            checkPasswordMatch();
        }
        
        // Check password match
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const matchDiv = document.getElementById('passwordMatch');
            
            if(confirmPassword) {
                if(password === confirmPassword) {
                    matchDiv.innerHTML = '<i class="fas fa-check" style="color:#00b09b"></i> <span style="color:#00b09b">Password cocok</span>';
                } else {
                    matchDiv.innerHTML = '<i class="fas fa-times" style="color:#ff416c"></i> <span style="color:#ff416c">Password tidak cocok</span>';
                }
            } else {
                matchDiv.innerHTML = '';
            }
        }
        
        // Form validation
        function validateForm() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const email = document.getElementById('email').value;
            
            if(password.length < 8) {
                alert('Password minimal 8 karakter!');
                return false;
            }
            
            if(password !== confirmPassword) {
                alert('Password dan konfirmasi password tidak sama!');
                return false;
            }
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(!emailRegex.test(email)) {
                alert('Email tidak valid!');
                return false;
            }
            
            return true;
        }
        
        // Add floating effect to card
        const card = document.querySelector('.register-card');
        
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateY = (x - centerX) / 20;
            const rotateX = (centerY - y) / 20;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
        
        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('nama').focus();
        });
    </script>
</body>
</html>