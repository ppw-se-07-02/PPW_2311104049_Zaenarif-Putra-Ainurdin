<?php
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session cookie
if(ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Clear remember token cookie
if(isset($_COOKIE['remember_token'])) {
    setcookie('remember_token', '', time() - 3600, '/');
}

// Destroy the session
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - MK PPW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .logout-container {
            text-align: center;
            color: white;
            max-width: 500px;
            animation: fadeIn 1s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .logout-icon {
            font-size: 80px;
            margin-bottom: 20px;
            color: rgba(255, 255, 255, 0.9);
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .logout-message h1 {
            font-size: 36px;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .logout-message p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.9;
        }
        
        .loading-dots {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }
        
        .dot {
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            animation: pulse 1.5s infinite ease-in-out;
        }
        
        .dot:nth-child(1) { animation-delay: 0s; }
        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes pulse {
            0%, 100% { transform: scale(0.8); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 1; }
        }
        
        .redirect-link {
            margin-top: 20px;
        }
        
        .redirect-link a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 25px;
            border-radius: 25px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s;
        }
        
        .redirect-link a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        
        <div class="logout-message">
            <h1>Anda telah logout</h1>
            <p>Sesi Anda telah berakhir dengan aman.</p>
            
            <div class="loading-dots">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
            
            <p>Mengarahkan ke halaman login...</p>
        </div>
        
        <div class="redirect-link">
            <a href="login.php">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login Kembali</span>
            </a>
        </div>
    </div>

    <script>
        // Redirect to login page after 3 seconds
        setTimeout(function() {
            window.location.href = 'login.php';
        }, 3000);
        
        // Option for immediate redirect
        document.querySelector('.redirect-link a').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'login.php';
        });
    </script>
</body>
</html>