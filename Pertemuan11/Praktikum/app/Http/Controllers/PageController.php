<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function tampil()
    {
        $arrMahasiswa = [
            "Kholifahdina",
            "Rahmat Taufik",
            "Nita Fitrotunimah",
            "Defrin Anggun Saputri"
        ];

        return view('mahasiswa')->with('mahasiswa', $arrMahasiswa);
    }
}
