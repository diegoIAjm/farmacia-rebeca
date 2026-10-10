<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'nombre' => 'superadmin',
                'etiqueta' => 'Superadministrador',
                'descripcion' => 'Acceso total al sistema, todas las sucursales.',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'admin_sucursal',
                'etiqueta' => 'Administrador de Sucursal',
                'descripcion' => 'Administra su propia sucursal.',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'cajero',
                'etiqueta' => 'Cajero / Vendedor',
                'descripcion' => 'Registra ventas y realiza su corte de caja.',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}