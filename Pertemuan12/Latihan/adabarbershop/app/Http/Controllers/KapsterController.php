<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kapster;

class KapsterController extends Controller
{
    public function index()
    {
        $kapsters = Kapster::latest()->get();
        return view('kapster.index', compact('kapsters'));
    }

    public function storeRaw(Request $r)
    {
        DB::insert(
            "INSERT INTO kapsters
            (nama,email,no_hp,umur,tanggal_masuk,admin_id,outlet_id,shift_id,created_at,updated_at)
            VALUES (?,?,?,?,?,?,?,?,NOW(),NOW())",
            [
                $r->nama,
                $r->email,
                $r->no_hp,
                $r->umur,
                $r->tanggal_masuk,
                1,
                $r->outlet_id,
                $r->shift_id
            ]
        );

        return back()->with('success','RAW SQL berhasil');
    }

    public function storeQuery(Request $r)
    {
        DB::table('kapsters')->insert([
            'nama' => $r->nama,
            'email' => $r->email,
            'no_hp' => $r->no_hp,
            'umur' => $r->umur,
            'tanggal_masuk' => $r->tanggal_masuk,
            'admin_id' => 1,
            'outlet_id' => $r->outlet_id,
            'shift_id' => $r->shift_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success','Query Builder berhasil');
    }

    public function storeEloquent(Request $r)
    {
        Kapster::create([
            'nama' => $r->nama,
            'email' => $r->email,
            'no_hp' => $r->no_hp,
            'umur' => $r->umur,
            'tanggal_masuk' => $r->tanggal_masuk,
            'admin_id' => 1,
            'outlet_id' => $r->outlet_id,
            'shift_id' => $r->shift_id
        ]);

        return back()->with('success','Eloquent ORM berhasil');
    }
}
