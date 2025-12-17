<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perulangan While</title>
</head>
<body>
    <h1>Perulangan While</h1>

    @php $i = 1; @endphp
    @while ($i <= 10)
        <p>Ini adalah perulangan ke-{{ $i }}</p>
        @php $i++; @endphp
    @endwhile
</body>
</html>