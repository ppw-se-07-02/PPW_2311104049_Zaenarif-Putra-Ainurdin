<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .dashboard {
            max-width: 1000px;
            margin: 0 auto;
        }
        .card {
            background: #f8f9fa;
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        .kapster-list {
            list-style: none;
            padding: 0;
        }
        .kapster-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>🎯 {{ $title }}</h1>
        
        <div class="card">
            <h2>Statistik</h2>
            <p>Total Kapster: <strong>{{ $total_kapsters }}</strong></p>
            <p>Hadir Hari Ini: <strong>{{ $attendance_today }}</strong></p>
        </div>
        
        <div class="card">
            <h2>Daftar Kapster</h2>
            <ul class="kapster-list">
                @foreach($kapsters as $kapster)
                <li class="kapster-item">
                    ID: {{ $kapster['id'] }} - 
                    Nama: {{ $kapster['name'] }} - 
                    Posisi: {{ $kapster['position'] }}
                </li>
                @endforeach
            </ul>
        </div>
        
        <div class="card">
            <h2>Informasi Sistem</h2>
            <p>Halaman ini ditampilkan menggunakan Controller di Laravel</p>
            <p>Controller: <code>BarberController</code></p>
            <p>Method: <code>index()</code></p>
        </div>
    </div>
</body>
</html>