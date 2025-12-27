<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->updateOrInsert(
            ['email' => 'admin2@adabarbershop.com'],
            [
                'nama' => 'Admin Utama',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
