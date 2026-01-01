@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Buku</h5>
        <div class="d-flex gap-2">
            <a href="{{ route('bukus.edit', $buku) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('bukus.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <th width="200">ID</th>
                <td>{{ $buku->id }}</td>
            </tr>
            <tr>
                <th>Judul</th>
                <td>{{ $buku->judul }}</td>
            </tr>
            <tr>
                <th>Penulis</th>
                <td>{{ $buku->penulis }}</td>
            </tr>
            <tr>
                <th>Tahun Terbit</th>
                <td>{{ $buku->tahun_terbit }}</td>
            </tr>
            <tr>
                <th>Penerbit</th>
                <td>{{ $buku->penerbit }}</td>
            </tr>
            <tr>
                <th>Dibuat</th>
                <td>{{ $buku->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            <tr>
                <th>Diperbarui</th>
                <td>{{ $buku->updated_at->format('d-m-Y H:i') }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection