<?php
session_start();
include('../config/koneksi.php');

if(isset($_SESSION['user_id'])) {
    if($_SESSION['role'] == 'admin') {
        header("Location: index.php");
    } else {
        header("Location: ../index.php");
    }
    exit();
}

$error = '';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM tbl_users WHERE (username = '$username' OR email = '$username') AND role = 'admin'";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nim'] = $user['nim'];

            if(isset($_POST['remember'])) {
                $token = bin2hex(random_bytes(32));
                setcookie('remember_token', $token, time() + (86400 * 30), "/");
            }
            
            header("Location: index.php");
            exit();
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Hanya admin yang dapat login di sini!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - MK PPW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ===== LOGIN STYLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
        }
        
        .login-header {
            background: linear-gradient(to right, #4776E6, #8E54E9);
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            animation: float 20s linear infinite;
        }
        
        @keyframes float {
            0% { transform: rotate(0deg) translate(0, 0); }
            100% { transform: rotate(360deg) translate(10px, 10px); }
        }
        
        .login-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .login-header p {
            font-size: 14px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .error-message {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            text-align: center;
            font-size: 14px;
            animation: shake 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(255, 65, 108, 0.3);
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
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
            padding: 16px 20px 16px 50px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
            color: #333;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #4776E6;
            background: white;
            box-shadow: 0 5px 20px rgba(71, 118, 230, 0.2);
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
            color: #4776E6;
        }
        
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #4776E6;
            cursor: pointer;
        }
        
        .remember-me label {
            color: #666;
            font-size: 14px;
            cursor: pointer;
        }
        
        .forgot-password {
            color: #4776E6;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .forgot-password:hover {
            color: #8E54E9;
            text-decoration: underline;
        }
        
        .btn-login {
            width: 100%;
            padding: 18px;
            background: linear-gradient(to right, #4776E6, #8E54E9);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(71, 118, 230, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(71, 118, 230, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(-1px);
        }
        
        .btn-login::after {
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
        
        .btn-login:hover::after {
            left: 100%;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 25px;
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .register-link {
            color: #4776E6;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: all 0.3s;
        }
        
        .register-link:hover {
            color: #8E54E9;
            text-decoration: underline;
        }
        
        .back-home {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-home a {
            color: #7f8c8d;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            padding: 10px 20px;
            border-radius: 25px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .back-home a:hover {
            color: white;
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* Floating animation */
        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 0;
        }
        
        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatElement 15s infinite linear;
        }
        
        .floating-element:nth-child(1) {
            width: 50px;
            height: 50px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .floating-element:nth-child(2) {
            width: 30px;
            height: 30px;
            top: 20%;
            right: 15%;
            animation-delay: 2s;
        }
        
        .floating-element:nth-child(3) {
            width: 40px;
            height: 40px;
            bottom: 15%;
            left: 15%;
            animation-delay: 4s;
        }
        
        @keyframes floatElement {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(10px, 10px) rotate(90deg); }
            50% { transform: translate(0, 20px) rotate(180deg); }
            75% { transform: translate(-10px, 10px) rotate(270deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                max-width: 100%;
            }
            
            .login-card {
                border-radius: 15px;
            }
            
            .login-header {
                padding: 30px 20px;
            }
            
            .login-body {
                padding: 30px 20px;
            }
            
            .login-header h1 {
                font-size: 28px;
            }
            
            .form-control {
                padding: 14px 20px 14px 45px;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>
    
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1><i class="fas fa-user-shield"></i> Admin Login</h1>
                <p>MK - Pemrograman Platform Web</p>
            </div>
            
            <div class="login-body">
                <?php if($error): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">
                            <i class="fas fa-user"></i> Username atau Email
                        </label>
                        <input type="text" id="username" name="username" 
                               class="form-control" 
                               placeholder="admin@example.com" 
                               required>
                        <i class="fas fa-user input-icon"></i>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input type="password" id="password" name="password" 
                               class="form-control" 
                               placeholder="Masukkan password" 
                               required>
                        <i class="fas fa-lock input-icon" id="password-icon" onclick="togglePassword()" style="cursor: pointer;"></i>
                    </div>
                    
                    <div class="remember-forgot">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Ingat Saya</label>
                        </div>
                        
                        <a href="#" class="forgot-password">Lupa Password?</a>
                    </div>
                    
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>
                        Login ke Dashboard
                    </button>
                </form>
                
                <div class="login-footer">
                    Hanya untuk administrator sistem.
                    <a href="register.php" class="register-link">Butuh akun admin?</a>
                </div>
                
                <div class="back-home">
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
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if(passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-lock');
                passwordIcon.classList.add('fa-unlock');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-unlock');
                passwordIcon.classList.add('fa-lock');
            }
        }
        
        // Add floating effect to card
        const card = document.querySelector('.login-card');
        
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateY = (x - centerX) / 25;
            const rotateX = (centerY - y) / 25;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
        
        // Auto-focus on username input
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('username').focus();
        });
    </script>
</body>
</html>