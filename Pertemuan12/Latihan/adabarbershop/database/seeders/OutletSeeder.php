<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutletSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('outlets')->updateOrInsert(
            ['nama_outlet' => 'Outlet Pusat'],
            [
                'alamat' => 'Jl. Utama No. 1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
