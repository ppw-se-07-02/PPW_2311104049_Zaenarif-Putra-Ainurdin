<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perulangan For</title>
</head>
<body>
    <h1>Perulangan For</h1>
    
    @for ($i = 1; $i <= 10; $i++)
        <p>Ini adalah perulangan ke-{{ $i }}</p>
    @endfor
</body>
</html>