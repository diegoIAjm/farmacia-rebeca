import { useState } from 'react';
import { Link, usePage } from '@inertiajs/react';
import Sidebar from './Sidebar';

export default function AuthenticatedLayout({ header, children }) {
    const { auth, flash } = usePage().props;
    const [sidebarOpen, setSidebarOpen] = useState(false);

    return (
        <div className="flex h-screen overflow-hidden bg-gray-100">
            <Sidebar open={sidebarOpen} onClose={() => setSidebarOpen(false)} />

            <div className="flex flex-1 flex-col overflow-hidden">
                {/* Topbar */}
                <header className="flex h-16 items-center justify-between border-b border-gray-200 bg-white px-4 lg:px-6">
                    <div className="flex items-center gap-3">
                        <button
                            type="button"
                            className="rounded-md p-2 text-gray-500 hover:bg-gray-100 lg:hidden"
                            onClick={() => setSidebarOpen(true)}
                        >
                            <svg
                                className="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                            </svg>
                        </button>

                        {header && (
                            <div className="text-lg font-semibold text-gray-800">
                                {header}
                            </div>
                        )}
                    </div>

                    <div className="flex items-center gap-3 text-sm">
                        <div className="hidden text-right sm:block">
                            <div className="font-medium text-gray-800">
                                {auth?.user?.nombre}
                            </div>
                            <div className="text-xs text-gray-500">
                                {auth?.user?.rol_etiqueta}
                            </div>
                        </div>
                        <div className="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 font-semibold text-emerald-700">
                            {auth?.user?.nombre?.[0]?.toUpperCase() ?? '?'}
                        </div>
                    </div>
                </header>

                {/* Flash messages */}
                {(flash?.success || flash?.error) && (
                    <div className="px-4 pt-4 lg:px-6">
                        {flash.success && (
                            <div className="rounded-md border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm text-emerald-800">
                                {flash.success}
                            </div>
                        )}
                        {flash.error && (
                            <div className="mt-2 rounded-md border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-800">
                                {flash.error}
                            </div>
                        )}
                    </div>
                )}

                {/* Contenido */}
                <main className="flex-1 overflow-y-auto p-4 lg:p-6">
                    {children}
                </main>
            </div>
        </div>
    );
}