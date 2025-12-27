<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shifts')->updateOrInsert(
            ['nama_shift' => 'Pagi'],
            [
                'jam_masuk'  => '08:00:00',
                'jam_keluar' => '16:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
