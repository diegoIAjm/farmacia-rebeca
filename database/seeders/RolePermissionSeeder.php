<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Mapeo: rol => array de permisos
        $asignaciones = [
            'superadmin' => [
                'ver_usuarios', 'crear_usuarios', 'editar_usuarios', 'eliminar_usuarios',
                'ver_sucursales', 'crear_sucursales', 'editar_sucursales',
                'ver_productos', 'crear_productos', 'editar_productos', 'eliminar_productos',
                'ver_inventario', 'editar_inventario', 'eliminar_inventario',
                'usar_pos', 'ver_ventas_propias', 'ver_ventas_todas', 'anular_ventas',
                'hacer_corte_caja', 'ver_cortes_caja',
                'crear_solicitudes', 'aprobar_solicitudes', 'rechazar_solicitudes', 'ejecutar_transferencias',
                'ver_reportes_sucursal', 'ver_reportes_globales', 'exportar_reportes',
                'ver_auditoria', 'gestionar_configuracion',
            ],
            'admin_sucursal' => [
                'ver_usuarios',
                'ver_productos', 'crear_productos', 'editar_productos',
                'ver_inventario', 'editar_inventario',
                'usar_pos', 'ver_ventas_propias', 'ver_ventas_todas', 'anular_ventas',
                'hacer_corte_caja', 'ver_cortes_caja',
                'crear_solicitudes', 'aprobar_solicitudes', 'rechazar_solicitudes', 'ejecutar_transferencias',
                'ver_reportes_sucursal', 'exportar_reportes',
            ],
            'cajero' => [
                'ver_productos',
                'ver_inventario',
                'usar_pos', 'ver_ventas_propias',
                'hacer_corte_caja',
            ],
        ];

        foreach ($asignaciones as $rolNombre => $permisos) {
            $rolId = DB::table('roles')->where('nombre', $rolNombre)->value('id');
            
            foreach ($permisos as $permisoNombre) {
                $permisoId = DB::table('permissions')->where('nombre', $permisoNombre)->value('id');
                
                if ($rolId && $permisoId) {
                    DB::table('role_permission')->insert([
                        'role_id' => $rolId,
                        'permission_id' => $permisoId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}