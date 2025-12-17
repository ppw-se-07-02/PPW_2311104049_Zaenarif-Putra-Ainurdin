<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Ada Barbershop - Dashboard',
            'kapsters' => [
                ['id' => 1, 'name' => 'Andi', 'position' => 'Senior Barber'],
                ['id' => 2, 'name' => 'Budi', 'position' => 'Junior Barber'],
                ['id' => 3, 'name' => 'Citra', 'position' => 'Stylist'],
            ],
            'total_kapsters' => 15,
            'attendance_today' => 12
        ];
        
        return view('barbershop.dashboard', $data);
    }
}
