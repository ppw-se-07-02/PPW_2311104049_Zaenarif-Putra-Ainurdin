<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarberController;

Route::get('/', function () {
    return view('welcome');
});

// Tugas 1.1 - ROUTING
// 1. ROUTE TANPA PARAMETER (minimal 5)
Route::get('/home', function () {
    return "Halaman Home Ada Barbershop";
});

Route::get('/about', function () {
    return "Tentang Ada Barbershop";
});

Route::get('/services', function () {
    return "Layanan Pangkas Rambut";
});

Route::get('/contact', function () {
    return "Hubungi Kami";
});

Route::get('/login', function () {
    return "Halaman Login Admin";
});

// 2. ROUTE DENGAN PARAMETER (minimal 3)
Route::get('/barber/{id}', function ($id) {
    return "Detail Kapster ID: $id";
});

Route::get('/schedule/{date}', function ($date) {
    return "Jadwal Tanggal: $date";
});

Route::get('/report/{month}/{year}', function ($month, $year) {
    return "Laporan Bulan: $month Tahun: $year";
});

// 3. ROUTE DENGAN OPTIONAL PARAMETER (minimal 3)
Route::get('/attendance/{date?}', function ($date = null) {
    $date = $date ?? date('Y-m-d');
    return "Absensi Tanggal: $date";
});

Route::get('/rewards/{type?}/{period?}', function ($type = 'all', $period = 'monthly') {
    return "Reward Tipe: $type, Periode: $period";
});

Route::get('/admin/{section?}/{action?}', function ($section = 'dashboard', $action = 'view') {
    return "Admin Section: $section, Action: $action";
});


// Tugas 2.1 - VIEW
Route::get('/show-image', function () {
    return view('show_image');
});

Route::get('/with-assets', function () {
    return view('with_assets');
});

// Tugas 3.1 - BLADE TEMPLATE ENGINE

// Route untuk halaman perulangan
Route::get('/perulangan-for', function () {
    return view('for');
});

Route::get('/perulangan-while', function () {
    return view('while');
});

// Route untuk nilai mahasiswa (sesuai soal)
Route::get('/mahasiswa', function () {
    $nilai = [80, 64, 30, 76, 95];
    return view('mahasiswa', ['nilai' => $nilai]);
});

// Tugas 4.1 - Controller

Route::get('/barbershop', [BarberController::class, 'index']);