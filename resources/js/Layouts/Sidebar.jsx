import { Link, usePage } from '@inertiajs/react';
import { useMemo, useState } from 'react';

/* ---------- Iconos SVG inline (sin dependencias) ---------- */
const Icon = ({ path }) => (
    <svg
        className="h-5 w-5 shrink-0"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        strokeWidth="1.8"
    >
        <path strokeLinecap="round" strokeLinejoin="round" d={path} />
    </svg>
);

const icons = {
    home: 'M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
    cart: 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.3 4.6A1 1 0 005.6 19H19M9 22a1 1 0 100-2 1 1 0 000 2zm9 0a1 1 0 100-2 1 1 0 000 2z',
    history: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
    cash: 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z',
    box: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
    swap: 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4',
    users: 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M12 7a4 4 0 11-8 0 4 4 0 018 0zm8 4a3 3 0 11-6 0 3 3 0 016 0z',
    store: 'M3 9l1.5-6h15L21 9m-18 0v10a2 2 0 002 2h14a2 2 0 002-2V9M3 9h18M9 13h6',
    chart: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
    shield: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.052-.382-3.016z',
    cog: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
    logout: 'M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1',
};

/* ---------- Definición del menú ---------- */
/* Cada item tiene: label, routeName, icon, permiso (o null si es libre) */
const menu = [
    { label: 'Inicio', routeName: 'dashboard', icon: 'home' },
    {
        label: 'Ventas',
        icon: 'cart',
        children: [
            { label: 'POS', routeName: 'ventas.pos', permiso: 'usar_pos' },
            { label: 'Historial', routeName: 'ventas.historial', permiso: 'ver_ventas_propias' },
        ],
    },
    {
        label: 'Caja',
        icon: 'cash',
        children: [
            { label: 'Corte de caja', routeName: 'caja.corte', permiso: 'hacer_corte_caja' },
        ],
    },
    {
        label: 'Inventario',
        icon: 'box',
        children: [
            { label: 'Productos', routeName: 'inventario.index', permiso: 'ver_inventario' },
            { label: 'Agregar producto', routeName: 'inventario.agregar', permiso: 'crear_productos' },
        ],
    },
    {
        label: 'Operaciones',
        icon: 'swap',
        children: [
            { label: 'Solicitudes', routeName: 'operaciones.solicitudes', permiso: 'crear_solicitudes' },
            { label: 'Transferencias', routeName: 'operaciones.transferencias', permiso: 'ejecutar_transferencias' },
        ],
    },
    {
        label: 'Administración',
        icon: 'shield',
        children: [
            { label: 'Usuarios', routeName: 'admin.usuarios', permiso: 'ver_usuarios' },
            { label: 'Sucursales', routeName: 'admin.sucursales', permiso: null, soloSuperadmin: true },
            { label: 'Configuración', routeName: 'admin.configuracion', permiso: null, soloSuperadmin: true },
        ],
    },
    {
        label: 'Reportes',
        icon: 'chart',
        children: [
            { label: 'Ventas por sucursal', routeName: 'reportes.ventas', permiso: 'ver_reportes_sucursal' },
            { label: 'Ranking vendedores', routeName: 'reportes.ranking', permiso: 'ver_reportes_sucursal' },
            { label: 'Auditoría', routeName: 'reportes.auditoria', permiso: null, soloSuperadmin: true },
        ],
    },
];

export default function Sidebar({ open, onClose }) {
    const { auth } = usePage().props;
    const permisos = auth?.permisos ?? [];
    const esSuperadmin = auth?.user?.es_superadmin ?? false;

    const puedeVer = (item) => {
        if (item.soloSuperadmin) return esSuperadmin;
        if (item.permiso === null) return true;
        if (!item.permiso) return true;
        return permisos.includes(item.permiso);
    };

    // Filtramos los grupos: solo mostramos los hijos permitidos
    const menuFiltrado = useMemo(() => {
        return menu
            .map((grupo) => {
                if (!grupo.children) {
                    return puedeVer(grupo) ? grupo : null;
                }
                const children = grupo.children.filter(puedeVer);
                return children.length > 0 ? { ...grupo, children } : null;
            })
            .filter(Boolean);
    }, [permisos, esSuperadmin]);

    // Grupos abiertos por defecto (los que ya tienen un child activo)
    const [abiertos, setAbiertos] = useState(() => {
        const inicial = {};
        menuFiltrado.forEach((g) => {
            if (g.children) inicial[g.label] = true;
        });
        return inicial;
    });

    const toggle = (label) =>
        setAbiertos((prev) => ({ ...prev, [label]: !prev[label] }));

    const currentUrl = typeof window !== 'undefined' ? window.location.pathname : '';
    const isActive = (routeName) => {
        try {
            return route(routeName) === currentUrl;
        } catch {
            return false;
        }
    };

    return (
        <>
            {/* Overlay mobile */}
            {open && (
                <div
                    className="fixed inset-0 z-30 bg-black/40 lg:hidden"
                    onClick={onClose}
                />
            )}

            <aside
                className={`fixed inset-y-0 left-0 z-40 flex w-64 flex-col bg-emerald-800 text-emerald-50 transition-transform duration-200 lg:static lg:translate-x-0 ${
                    open ? 'translate-x-0' : '-translate-x-full'
                }`}
            >
                {/* Branding */}
                <div className="flex h-16 items-center gap-3 border-b border-emerald-700 px-4">
                    <div className="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-500 font-bold text-white">
                        FR
                    </div>
                    <div className="leading-tight">
                        <div className="text-sm font-semibold">Farmacias Rebeca</div>
                        <div className="text-[11px] text-emerald-200">
                            Punto de venta
                        </div>
                    </div>
                </div>

                {/* Menú */}
                <nav className="flex-1 overflow-y-auto px-2 py-4 text-sm">
                    {menuFiltrado.map((grupo) => {
                        if (!grupo.children) {
                            const active = isActive(grupo.routeName);
                            return (
                                <Link
                                    key={grupo.label}
                                    href={route(grupo.routeName)}
                                    onClick={onClose}
                                    className={`mb-1 flex items-center gap-3 rounded-md px-3 py-2 transition ${
                                        active
                                            ? 'bg-emerald-600 text-white'
                                            : 'hover:bg-emerald-700/60'
                                    }`}
                                >
                                    <Icon path={icons[grupo.icon]} />
                                    <span>{grupo.label}</span>
                                </Link>
                            );
                        }

                        const abierto = abiertos[grupo.label];
                        return (
                            <div key={grupo.label} className="mb-1">
                                <button
                                    type="button"
                                    onClick={() => toggle(grupo.label)}
                                    className="flex w-full items-center justify-between rounded-md px-3 py-2 hover:bg-emerald-700/60"
                                >
                                    <span className="flex items-center gap-3">
                                        <Icon path={icons[grupo.icon]} />
                                        <span>{grupo.label}</span>
                                    </span>
                                    <svg
                                        className={`h-4 w-4 transition-transform ${
                                            abierto ? 'rotate-90' : ''
                                        }`}
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            strokeWidth="2"
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>
                                </button>

                                {abierto && (
                                    <div className="mt-1 space-y-0.5 pl-4">
                                        {grupo.children.map((item) => {
                                            const active = isActive(item.routeName);
                                            return (
                                                <Link
                                                    key={item.routeName}
                                                    href={route(item.routeName)}
                                                    onClick={onClose}
                                                    className={`block rounded-md px-3 py-2 text-[13px] transition ${
                                                        active
                                                            ? 'bg-emerald-600 text-white'
                                                            : 'text-emerald-100 hover:bg-emerald-700/60'
                                                    }`}
                                                >
                                                    {item.label}
                                                </Link>
                                            );
                                        })}
                                    </div>
                                )}
                            </div>
                        );
                    })}
                </nav>

                {/* Info usuario + logout */}
                <div className="border-t border-emerald-700 p-3 text-xs">
                    <div className="mb-2">
                        <div className="font-semibold text-emerald-50">
                            {auth?.user?.nombre}
                        </div>
                        <div className="text-emerald-200">
                            {auth?.user?.rol_etiqueta}
                            {auth?.user?.sucursal_nombre
                                ? ` · ${auth.user.sucursal_nombre}`
                                : ' · Global'}
                        </div>
                    </div>
                    <Link
                        href={route('logout')}
                        method="post"
                        as="button"
                        className="flex w-full items-center gap-2 rounded-md bg-emerald-900/60 px-3 py-2 text-emerald-100 hover:bg-emerald-900"
                    >
                        <Icon path={icons.logout} />
                        Cerrar sesión
                    </Link>
                </div>
            </aside>
        </>
    );
}