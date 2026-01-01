@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Buku</h5>
        <a href="{{ route('bukus.create') }}" class="btn btn-primary">
            + Tambah Buku
        </a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Penerbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bukus as $buku)
                <tr>
                    <td>{{ $buku->id }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->tahun_terbit }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td>
                        <a href="{{ route('bukus.show', $buku) }}" class="btn btn-sm btn-info">Lihat</a>
                        <a href="{{ route('bukus.edit', $buku) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('bukus.destroy', $buku) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Hapus buku ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $bukus->links() }}
    </div>
</div>
@endsection