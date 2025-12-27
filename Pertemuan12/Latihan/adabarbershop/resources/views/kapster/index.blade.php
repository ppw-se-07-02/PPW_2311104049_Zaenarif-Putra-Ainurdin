<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Kapster</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #f0f0f0; }
        form { margin-bottom: 30px; padding: 20px; border: 1px solid #ddd; }
        input, button { margin-top: 8px; padding: 8px; width: 100%; }
        h2 { margin-top: 0; }
    </style>
</head>
<body>

<h1>Manajemen Kapster</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

{{-- FORM RAW SQL --}}
<form method="POST" action="/kapster/raw">
    @csrf
    <h2>Insert Data Kapster (Raw SQL)</h2>
    @include('kapster.form')
    <button type="submit">Simpan Raw SQL</button>
</form>

{{-- FORM QUERY BUILDER --}}
<form method="POST" action="/kapster/query">
    @csrf
    <h2>Insert Data Kapster (Query Builder)</h2>
    @include('kapster.form')
    <button type="submit">Simpan Query Builder</button>
</form>

{{-- FORM ELOQUENT ORM --}}
<form method="POST" action="/kapster/eloquent">
    @csrf
    <h2>Insert Data Kapster (Eloquent ORM)</h2>
    @include('kapster.form')
    <button type="submit">Simpan Eloquent ORM</button>
</form>

<h2>Data Kapster</h2>

<table>
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Umur</th>
        <th>Tanggal Masuk</th>
    </tr>
    @foreach($kapsters as $k)
    <tr>
        <td>{{ $k->nama }}</td>
        <td>{{ $k->email }}</td>
        <td>{{ $k->no_hp }}</td>
        <td>{{ $k->umur }}</td>
        <td>{{ $k->tanggal_masuk }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>
