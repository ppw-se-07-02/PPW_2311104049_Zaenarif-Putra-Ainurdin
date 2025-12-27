<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index()
    {
        return "Index untuk mahasiswa";
    }
    
    public function insertData()
    {
        // Menggunakan Eloquent ORM
        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = '20231001';
        $mahasiswa->nama_lengkap = 'Ahmad Fauzi';
        $mahasiswa->tempat_lahir = 'Surabaya';
        $mahasiswa->tanggal_lahir = '2001-05-15';
        $mahasiswa->alamat = 'Jl. Sudirman No. 45';
        $mahasiswa->fakultas = 'Fakultas Ilmu Komputer';
        $mahasiswa->jurusan = 'Sistem Informasi';
        
        $mahasiswa->save();
        
        // Tampilkan hasil
        dump($mahasiswa);
        return "Data mahasiswa berhasil disimpan!";
    }
}
?>