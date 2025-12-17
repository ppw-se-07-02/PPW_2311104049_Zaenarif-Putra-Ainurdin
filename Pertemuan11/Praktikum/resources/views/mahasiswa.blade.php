<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>

    <ol>
        @forelse ($mahasiswa as $val)
            <li>{{ $val }}</li>
        @empty
            <div>Tidak ada data...</div>
        @endforelse
    </ol>

</body>
</html>
