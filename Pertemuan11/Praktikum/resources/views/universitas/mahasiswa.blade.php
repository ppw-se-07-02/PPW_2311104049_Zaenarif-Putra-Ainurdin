<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Laravel</title>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <ol>
        <?php foreach ($mahasiswa as $nama) {
            echo "<li> $nama </li>";
        } ?>
    </ol>
</body>
</html>