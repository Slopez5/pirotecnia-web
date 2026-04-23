<!DOCTYPE html>

<html class="dark" lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Manrope:wght@600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        .headline {
            font-family: 'Manrope', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen overflow-x-hidden bg-primary-900 text-on-primary selection:bg-primary/30">
    <div class="fixed inset-0 z-40 bg-primary-900/70 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden"
        id="sidebar-overlay"></div>

    <aside id="app-sidebar"
        class="fixed inset-y-0 left-0 z-50 flex h-[100dvh] w-72 max-w-[85vw] -translate-x-full flex-col overflow-y-auto bg-primary-100 py-6 font-['Manrope'] tracking-tight shadow-2xl shadow-primary-900/40 transition-transform duration-300 dark:bg-primary-800 lg:h-screen lg:w-64 lg:max-w-none lg:translate-x-0">
        <div class="mb-8 flex items-center justify-between gap-3 px-6">
            <div class="flex min-w-0 items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary">
                    <span class="material-symbols-outlined text-on-primary"
                        style="font-variation-settings: 'FILL' 1;">explosion</span>
                </div>
                <div class="min-w-0">
                    <h1 class="truncate text-xl font-bold tracking-tighter text-on-primary">Pirotecnia San Rafael</h1>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-secondary">Detonando emociones</p>
                </div>
            </div>
            <button
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-on-primary transition-colors hover:bg-primary-700/60 lg:hidden"
                id="sidebar-close" type="button">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <nav class="flex-1 space-y-1">
            <a class="mx-2 flex items-center gap-3 rounded-lg bg-primary-700 px-4 py-3 font-semibold text-secondary transition-transform scale-[0.98] active:scale-95"
                href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Inicio</span>
            </a>
            <a class="mx-2 flex items-center gap-3 px-4 py-3 text-primary-200 transition-colors duration-200 hover:bg-primary-700 hover:text-on-primary"
                href="{{ route('employees.index') }}">
                <span class="material-symbols-outlined">badge</span>
                <span>Empleados</span>
            </a>
            <a class="mx-2 flex items-center gap-3 px-4 py-3 text-primary-200 transition-colors duration-200 hover:bg-primary-700 hover:text-on-primary"
                href="{{ route('events.index') }}">
                <span class="material-symbols-outlined">event_upcoming</span>
                <span>Eventos</span>
            </a>
            <a class="mx-2 flex items-center gap-3 px-4 py-3 text-primary-200 transition-colors duration-200 hover:bg-primary-700 hover:text-on-primary"
                href="{{ route('inventories.index') }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <span>Inventario</span>
            </a>
            <a class="mx-2 flex items-center gap-3 px-4 py-3 text-primary-200 transition-colors duration-200 hover:bg-primary-700 hover:text-on-primary"
                href="{{ route('purchases.index') }}">
                <span class="material-symbols-outlined">shopping_cart</span>
                <span>Compras</span>
            </a>
            <a class="mx-2 flex items-center gap-3 px-4 py-3 text-primary-200 transition-colors duration-200 hover:bg-primary-700 hover:text-on-primary"
                href="{{ route('sales.index') }}">
                <span class="material-symbols-outlined">payments</span>
                <span>Ventas</span>
            </a>
            <a class="mx-2 flex items-center gap-3 px-4 py-3 text-primary-200 transition-colors duration-200 hover:bg-primary-700 hover:text-on-primary"
                href="{{ route('settings.index') }}">
                <span class="material-symbols-outlined">settings</span>
                <span>Configuración</span>
            </a>
        </nav>

        <div class="mt-auto px-4">
            <div class="flex items-center gap-3 rounded-xl bg-primary-700 p-4">
                <img alt="Admin" class="h-10 w-10 rounded-full border border-on-primary/10 object-cover"
                    data-alt="Professional headshot of a mature business administrator with silver hair in a sharp navy suit, clean studio background"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8Bl-k16pH2-oxzBS6OIqfTgCbeV3aCIzWFZrMOcObz-HwE1yfrd4xSgSmIyyFvfk50gWOjKKWbvXbw6C2qSu1MAD-05WvnY2cmSb64FkUxuhAWVUcmvFa0KHrlCPTBr6eo7NcnJOEdUIPAm3B04gPkpVZPVA7q1DZm4LvgUVi7IeAImHxR2O7efFMf3wrYZFAb-pg_PFUPWxx_Pll-VEVHMrVJkbvwJR11dYwkFbonobTHSCvkjoYdHa402GkwDn6WGFcLumR4uo" />
                <div class="overflow-hidden">
                    <p class="truncate text-sm font-semibold text-on-primary">Administrador</p>
                    <p class="truncate text-xs text-primary-200">Sede Central</p>
                </div>
            </div>
        </div>
    </aside>

    <header
        class="fixed inset-x-0 top-0 z-30 flex h-16 items-center border-b border-primary-600/20 bg-primary-900/80 px-4 font-['Manrope'] font-medium shadow-sm backdrop-blur-xl dark:bg-primary-800/80 sm:px-6 lg:left-64 lg:px-8">
        <div class="flex w-full items-center gap-3">
            <button
                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-on-primary transition-colors hover:bg-primary-700/60 lg:hidden"
                id="sidebar-open" type="button">
                <span class="material-symbols-outlined">menu</span>
            </button>

            <form action="{{ route('search.global') }}"
                class="flex min-w-0 flex-1 items-center rounded-full bg-primary-800 px-3 py-2 transition-all focus-within:ring-1 focus-within:ring-accent/30 lg:max-w-xl lg:px-4"
                method="GET">
                <span class="material-symbols-outlined mr-2 text-sm text-primary-200">search</span>
                <input
                    class="w-full border-none bg-transparent text-sm text-on-primary placeholder:text-primary-200 focus:ring-0"
                    name="q" placeholder="Buscar eventos, empleados, productos o ventas..." type="text"
                    value="{{ request('q') }}" />
                <button
                    class="hidden rounded-full bg-primary-700 px-3 py-1 text-xs font-semibold text-on-primary transition hover:bg-primary-600 sm:inline-flex"
                    type="submit">
                    Buscar
                </button>
                <button
                    class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-primary-700 text-on-primary transition hover:bg-primary-600 sm:hidden"
                    type="submit">
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </form>

            <div class="ml-auto flex items-center gap-2 sm:gap-4">
                <button class="relative rounded-full p-2 text-on-primary transition-all hover:bg-primary-700/60">
                    <span class="material-symbols-outlined">notifications</span>
                    <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-primary"></span>
                </button>
                <button class="hidden rounded-full p-2 text-on-primary transition-all hover:bg-primary-700/60 sm:inline-flex">
                    <span class="material-symbols-outlined">settings</span>
                </button>
                <div class="mx-1 hidden h-8 w-px bg-primary-600/40 sm:block"></div>
                <div class="flex items-center gap-3">
                    <span class="hidden text-sm text-on-primary lg:inline">Pirotecnia San Rafael</span>
                    <div
                        class="flex h-8 w-8 items-center justify-center rounded-full border border-primary-600/40 bg-primary-700 text-on-primary">
                        <span class="material-symbols-outlined text-lg">shield_person</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="min-h-screen lg:pl-64">
        @yield('main-content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const syncResponsiveTables = (root = document) => {
                root.querySelectorAll('table').forEach((table) => {
                    if (table.dataset.mobileCards === 'off') {
                        return;
                    }

                    if (!table.classList.contains('responsive-stack-table')) {
                        table.classList.add('responsive-stack-table');
                    }

                    if (
                        !table.classList.contains('responsive-stack-table-dark') &&
                        !table.classList.contains('responsive-stack-table-light')
                    ) {
                        table.classList.add('responsive-stack-table-light');
                    }

                    const headers = Array.from(table.querySelectorAll('thead th')).map((header) =>
                        header.textContent.replace(/\s+/g, ' ').trim()
                    );

                    if (headers.length === 0) {
                        return;
                    }

                    table.querySelectorAll('tbody tr').forEach((row) => {
                        Array.from(row.children).forEach((cell, index) => {
                            if (!(cell instanceof HTMLTableCellElement) || cell.tagName !== 'TD') {
                                return;
                            }

                            if (cell.dataset.label && cell.dataset.label.trim() !== '') {
                                return;
                            }

                            const label = headers[index] ?? '';

                            if (label !== '') {
                                cell.dataset.label = label;
                            }
                        });
                    });
                });
            };

            const sidebar = document.getElementById('app-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const openButton = document.getElementById('sidebar-open');
            const closeButton = document.getElementById('sidebar-close');
            const desktopMedia = window.matchMedia('(min-width: 1024px)');

            syncResponsiveTables();

            const openSidebar = () => {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-100');
                document.body.classList.add('overflow-hidden');
            };

            const closeSidebar = () => {
                if (desktopMedia.matches) {
                    overlay.classList.add('opacity-0', 'pointer-events-none');
                    overlay.classList.remove('opacity-100');
                    document.body.classList.remove('overflow-hidden');

                    return;
                }

                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                overlay.classList.remove('opacity-100');
                document.body.classList.remove('overflow-hidden');
            };

            if (sidebar && overlay) {
                openButton?.addEventListener('click', openSidebar);
                closeButton?.addEventListener('click', closeSidebar);
                overlay.addEventListener('click', closeSidebar);

                document.querySelectorAll('#app-sidebar a').forEach((link) => {
                    link.addEventListener('click', () => {
                        if (!desktopMedia.matches) {
                            closeSidebar();
                        }
                    });
                });

                desktopMedia.addEventListener('change', (event) => {
                    if (event.matches) {
                        sidebar.classList.remove('-translate-x-full');
                        sidebar.classList.add('translate-x-0');
                        closeSidebar();
                    } else {
                        sidebar.classList.add('-translate-x-full');
                        sidebar.classList.remove('translate-x-0');
                    }
                });
            }

            document.addEventListener('livewire:navigated', () => {
                syncResponsiveTables();
            });

            document.addEventListener('livewire:initialized', () => {
                if (window.Livewire?.hook) {
                    window.Livewire.hook('morphed', ({ el }) => {
                        syncResponsiveTables(el);
                    });
                }
            });
        });
    </script>

    @livewireScriptConfig
</body>

</html>
