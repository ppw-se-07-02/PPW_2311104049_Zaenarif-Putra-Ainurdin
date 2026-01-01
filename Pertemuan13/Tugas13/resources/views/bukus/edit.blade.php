@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Buku</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('bukus.update', $buku) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku *</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                       id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis *</label>
                <input type="text" class="form-control @error('penulis') is-invalid @enderror" 
                       id="penulis" name="penulis" value="{{ old('penulis', $buku->penulis) }}" required>
                @error('penulis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit *</label>
                <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" 
                       id="tahun_terbit" name="tahun_terbit" 
                       value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" 
                       min="1900" max="{{ date('Y') }}" required>
                @error('tahun_terbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit *</label>
                <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                       id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required>
                @error('penerbit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('bukus.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection