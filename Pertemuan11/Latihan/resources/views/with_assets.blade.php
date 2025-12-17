<!DOCTYPE html>
<html>
<head>
    <title>Dengan CSS & JS</title>
    <!-- Load CSS dari folder css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="header" id="header">
        <h1>Ada Barbershop</h1>
        <p>Sistem Manajemen Kapster</p>
    </div>
    
    <div class="container">
        <h2>Selamat Datang</h2>
        <p>Halaman ini menggunakan CSS dan JavaScript eksternal</p>
        
        <button class="button" onclick="showWelcome()">Klik untuk Welcome</button>
        <button class="button" onclick="changeHeader()">Ubah Warna Header</button>
        <button class="button" onclick="showDateTime()">Tampilkan Waktu</button>
        
        <p id="datetime" style="margin-top: 20px; font-weight: bold;"></p>
        
        <h3>Asset yang digunakan:</h3>
        <ul>
            <li>CSS: {{ asset('css/style.css') }}</li>
            <li>JavaScript: {{ asset('js/script.js') }}</li>
        </ul>
    </div>
    
    <!-- Load JavaScript dari folder js -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>