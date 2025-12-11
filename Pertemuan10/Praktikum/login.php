<?php
session_start();
require_once 'config/database.php';

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit();
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Untuk demo, menggunakan username dan password default
    // Dalam produksi, gunakan hash password dan database users
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = 'Administrator';
        header('Location: index.php');
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Dashboard Administrator</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Poppins", Arial, sans-serif;
      min-height: 100vh;
      background: linear-gradient(135deg, #00467f, #00a676);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      animation: fadeIn 0.6s ease;
    }

    .login-container h1 {
      color: #00467f;
      text-align: center;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      color: #333;
      font-weight: 600;
    }

    .form-group input {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }

    .form-group input:focus {
      outline: none;
      border-color: #00467f;
      box-shadow: 0 0 0 2px rgba(0, 70, 127, 0.2);
    }

    .btn-login {
      width: 100%;
      padding: 12px;
      background: linear-gradient(90deg, #00467f, #00a676);
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .btn-login:hover {
      transform: translateY(-2px);
    }

    .error-message {
      background: #f8d7da;
      color: #721c24;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 20px;
      text-align: center;
    }

    .demo-info {
      margin-top: 20px;
      padding: 10px;
      background: #e3f2fd;
      border-radius: 5px;
      text-align: center;
      color: #00467f;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h1>Login Administrator</h1>
    
    <?php if (isset($error)): ?>
      <div class="error-message">
        <?php echo $error; ?>
      </div>
    <?php endif; ?>
    
    <form method="POST" action="">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      
      <button type="submit" class="btn-login">Masuk</button>
    </form>
    
    <div class="demo-info">
      <strong>Demo Credentials:</strong><br>
      Username: admin<br>
      Password: admin123
    </div>
  </div>
</body>
</html>