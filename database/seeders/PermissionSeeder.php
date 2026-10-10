<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [
            // Módulo Usuarios
            ['nombre' => 'ver_usuarios',        'etiqueta' => 'Ver usuarios',        'modulo' => 'usuarios'],
            ['nombre' => 'crear_usuarios',      'etiqueta' => 'Crear usuarios',      'modulo' => 'usuarios'],
            ['nombre' => 'editar_usuarios',     'etiqueta' => 'Editar usuarios',     'modulo' => 'usuarios'],
            ['nombre' => 'eliminar_usuarios',   'etiqueta' => 'Desactivar usuarios', 'modulo' => 'usuarios'],

            // Módulo Sucursales
            ['nombre' => 'ver_sucursales',      'etiqueta' => 'Ver sucursales',      'modulo' => 'sucursales'],
            ['nombre' => 'crear_sucursales',    'etiqueta' => 'Crear sucursales',    'modulo' => 'sucursales'],
            ['nombre' => 'editar_sucursales',   'etiqueta' => 'Editar sucursales',   'modulo' => 'sucursales'],

            // Módulo Productos
            ['nombre' => 'ver_productos',       'etiqueta' => 'Ver productos',       'modulo' => 'productos'],
            ['nombre' => 'crear_productos',     'etiqueta' => 'Crear productos',     'modulo' => 'productos'],
            ['nombre' => 'editar_productos',    'etiqueta' => 'Editar productos',    'modulo' => 'productos'],
            ['nombre' => 'eliminar_productos',  'etiqueta' => 'Desactivar productos','modulo' => 'productos'],

            // Módulo Inventario
            ['nombre' => 'ver_inventario',      'etiqueta' => 'Ver inventario',      'modulo' => 'inventario'],
            ['nombre' => 'editar_inventario',   'etiqueta' => 'Editar inventario',   'modulo' => 'inventario'],
            ['nombre' => 'eliminar_inventario', 'etiqueta' => 'Eliminar lotes',      'modulo' => 'inventario'],

            // Módulo Ventas
            ['nombre' => 'usar_pos',            'etiqueta' => 'Usar el POS',         'modulo' => 'ventas'],
            ['nombre' => 'ver_ventas_propias',  'etiqueta' => 'Ver sus propias ventas','modulo' => 'ventas'],
            ['nombre' => 'ver_ventas_todas',    'etiqueta' => 'Ver todas las ventas','modulo' => 'ventas'],
            ['nombre' => 'anular_ventas',       'etiqueta' => 'Anular ventas',       'modulo' => 'ventas'],

            // Módulo Caja
            ['nombre' => 'hacer_corte_caja',    'etiqueta' => 'Realizar corte de caja','modulo' => 'caja'],
            ['nombre' => 'ver_cortes_caja',     'etiqueta' => 'Ver cortes de caja',  'modulo' => 'caja'],

            // Módulo Solicitudes / Transferencias
            ['nombre' => 'crear_solicitudes',   'etiqueta' => 'Crear solicitudes',   'modulo' => 'solicitudes'],
            ['nombre' => 'aprobar_solicitudes', 'etiqueta' => 'Aprobar solicitudes', 'modulo' => 'solicitudes'],
            ['nombre' => 'rechazar_solicitudes','etiqueta' => 'Rechazar solicitudes','modulo' => 'solicitudes'],
            ['nombre' => 'ejecutar_transferencias', 'etiqueta' => 'Ejecutar transferencias', 'modulo' => 'solicitudes'],

            // Módulo Reportes
            ['nombre' => 'ver_reportes_sucursal',   'etiqueta' => 'Ver reportes de su sucursal', 'modulo' => 'reportes'],
            ['nombre' => 'ver_reportes_globales',   'etiqueta' => 'Ver reportes globales',       'modulo' => 'reportes'],
            ['nombre' => 'exportar_reportes',       'etiqueta' => 'Exportar reportes',           'modulo' => 'reportes'],

            // Módulo Auditoría
            ['nombre' => 'ver_auditoria',       'etiqueta' => 'Ver auditoría',       'modulo' => 'auditoria'],

            // Módulo Configuración
            ['nombre' => 'gestionar_configuracion', 'etiqueta' => 'Gestionar configuración', 'modulo' => 'configuracion'],
        ];

        foreach ($permisos as $permiso) {
            DB::table('permissions')->insert(array_merge($permiso, [
                'descripcion' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}