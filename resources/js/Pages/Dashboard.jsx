import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';

export default function Dashboard() {
    const { auth } = usePage().props;
    const user = auth?.user;

    return (
        <AuthenticatedLayout header="Inicio">
            <Head title="Inicio" />

            <div className="mx-auto max-w-5xl space-y-6">
                {/* Bienvenida */}
                <div className="rounded-xl bg-white p-6 shadow-sm">
                    <h1 className="text-2xl font-bold text-gray-800">
                        ¡Hola, {user?.nombre}!
                    </h1>
                    <p className="mt-1 text-gray-500">
                        Rol: <span className="font-medium">{user?.rol_etiqueta}</span>
                        {user?.sucursal_nombre && (
                            <>
                                {' · '}
                                Sucursal:{' '}
                                <span className="font-medium">
                                    {user.sucursal_nombre}
                                </span>
                            </>
                        )}
                        {user?.es_superadmin && (
                            <>
                                {' · '}
                                <span className="font-medium text-emerald-700">
                                    Acceso global
                                </span>
                            </>
                        )}
                    </p>
                </div>

                {/* Tarjetas placeholder */}
                <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    {[
                        { label: 'Ventas de hoy', value: '—' },
                        { label: 'Productos con stock bajo', value: '—' },
                        { label: 'Productos por vencer', value: '—' },
                        { label: 'Ventas del mes', value: '—' },
                    ].map((c) => (
                        <div
                            key={c.label}
                            className="rounded-xl bg-white p-5 shadow-sm"
                        >
                            <div className="text-xs uppercase tracking-wide text-gray-500">
                                {c.label}
                            </div>
                            <div className="mt-2 text-2xl font-semibold text-gray-800">
                                {c.value}
                            </div>
                        </div>
                    ))}
                </div>

                <div className="rounded-xl bg-white p-6 text-sm text-gray-500 shadow-sm">
                    Panel en construcción. Acá van a aparecer las métricas
                    reales del día (ventas, ranking, alertas de stock y
                    vencimientos).
                </div>
            </div>
        </AuthenticatedLayout>
    );
}