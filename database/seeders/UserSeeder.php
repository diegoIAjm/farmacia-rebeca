<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superadminId = DB::table('roles')->where('nombre', 'superadmin')->value('id');
        $adminId      = DB::table('roles')->where('nombre', 'admin_sucursal')->value('id');
        $cajeroId     = DB::table('roles')->where('nombre', 'cajero')->value('id');

        DB::table('users')->insert([
            [
                'nombre' => 'Superadmin',
                'username' => 'superadmin',
                'email' => 'sistema@rebeca.com', // opcional, puede ser null
                'password' => Hash::make('admin123'),
                'role_id' => $superadminId,
                'sucursal_id' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Administradora Tacagua',
                'username' => 'admin.tacagua',
                'email' => null,
                'password' => Hash::make('admin123'),
                'role_id' => $adminId,
                'sucursal_id' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Dra. Laura',
                'username' => 'laura',
                'email' => null,
                'password' => Hash::make('laura123'),
                'role_id' => $adminId,
                'sucursal_id' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Dra. Paola',
                'username' => 'paola',
                'email' => null,
                'password' => Hash::make('paola123'),
                'role_id' => $adminId,
                'sucursal_id' => 2,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cajero Tacagua',
                'username' => 'cajero.tacagua',
                'email' => null,
                'password' => Hash::make('cajero123'),
                'role_id' => $cajeroId,
                'sucursal_id' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}