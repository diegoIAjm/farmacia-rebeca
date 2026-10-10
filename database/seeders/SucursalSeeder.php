<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SucursalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sucursales')->insert([
            ['nombre' => 'Farmacia Rebeca Tacagua', 'activa' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Farmacia Rebeca Las Lomas', 'activa' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}