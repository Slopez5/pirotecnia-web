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

<body class="bg-primary-900 text-on-primary selection:bg-primary/30 min-h-screen">
    <!-- SideNavBar (JSON Derived) -->
    <aside
        class="bg-primary-100 dark:bg-primary-800 h-screen w-64 fixed left-0 top-0 overflow-y-auto no-border shadow-2xl shadow-primary-900/40 flex flex-col py-6 font-['Manrope'] tracking-tight z-50">
        <div class="px-6 mb-8 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary"
                    style="font-variation-settings: 'FILL' 1;">explosion</span>
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-tighter text-on-primary">Pirotecnia San Rafael</h1>
                <p class="text-[10px] uppercase tracking-[0.2em] text-secondary">Detonando emociones</p>
            </div>
        </div>
        <nav class="flex-1 space-y-1">
            <!-- Active Tab: Inicio -->
            <a class="flex items-center gap-3 py-3 px-4 bg-primary-700 text-secondary font-semibold rounded-lg mx-2 transition-transform scale-[0.98] active:scale-95"
                href="{{ route('dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Inicio</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 text-primary-200 hover:text-on-primary hover:bg-primary-700 transition-colors duration-200 mx-2"
                href="{{ route('employees.index') }}">
                <span class="material-symbols-outlined">badge</span>
                <span>Empleados</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 text-primary-200 hover:text-on-primary hover:bg-primary-700 transition-colors duration-200 mx-2"
                href="{{ route('events.index') }}">
                <span class="material-symbols-outlined">event_upcoming</span>
                <span>Eventos</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 text-primary-200 hover:text-on-primary hover:bg-primary-700 transition-colors duration-200 mx-2"
                href="{{ route('inventories.index') }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <span>Inventario</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 text-primary-200 hover:text-on-primary hover:bg-primary-700 transition-colors duration-200 mx-2"
                href="{{ route('purchases.index') }}">
                <span class="material-symbols-outlined">shopping_cart</span>
                <span>Compras</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 text-primary-200 hover:text-on-primary hover:bg-primary-700 transition-colors duration-200 mx-2"
                href="{{ route('sales.index') }}">
                <span class="material-symbols-outlined">payments</span>
                <span>Ventas</span>
            </a>
            <a class="flex items-center gap-3 py-3 px-4 text-primary-200 hover:text-on-primary hover:bg-primary-700 transition-colors duration-200 mx-2"
                href="#">
                <span class="material-symbols-outlined">settings</span>
                <span>Configuración</span>
            </a>
        </nav>
        <div class="mt-auto px-4">
            <div class="bg-primary-700 rounded-xl p-4 flex items-center gap-3">
                <img alt="Admin" class="w-10 h-10 rounded-full object-cover border border-on-primary/10"
                    data-alt="Professional headshot of a mature business administrator with silver hair in a sharp navy suit, clean studio background"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8Bl-k16pH2-oxzBS6OIqfTgCbeV3aCIzWFZrMOcObz-HwE1yfrd4xSgSmIyyFvfk50gWOjKKWbvXbw6C2qSu1MAD-05WvnY2cmSb64FkUxuhAWVUcmvFa0KHrlCPTBr6eo7NcnJOEdUIPAm3B04gPkpVZPVA7q1DZm4LvgUVi7IeAImHxR2O7efFMf3wrYZFAb-pg_PFUPWxx_Pll-VEVHMrVJkbvwJR11dYwkFbonobTHSCvkjoYdHa402GkwDn6WGFcLumR4uo" />
                <div class="overflow-hidden">
                    <p class="text-sm font-semibold text-on-primary truncate">Administrador</p>
                    <p class="text-xs text-primary-200 truncate">Sede Central</p>
                </div>
            </div>
        </div>
    </aside>
    <header
        class="fixed top-0 right-0 w-[calc(100%-16rem)] h-16 z-40 bg-primary-900/80 backdrop-blur-xl dark:bg-primary-800/80 flex justify-between items-center px-8 font-['Manrope'] font-medium shadow-sm border-b border-primary-600/20">
        <div
            class="flex items-center bg-primary-800 px-4 py-2 rounded-full w-96 group focus-within:ring-1 focus-within:ring-accent/30 transition-all">
            <span class="material-symbols-outlined text-primary-200 text-sm mr-2">search</span>
            <input
                class="bg-transparent border-none focus:ring-0 text-sm text-on-primary placeholder:text-primary-200 w-full"
                placeholder="Buscar eventos, productos o facturas..." type="text" />
        </div>
        <div class="flex items-center gap-4">
            <button class="p-2 hover:bg-primary-700/60 rounded-full transition-all text-on-primary relative">
                <span class="material-symbols-outlined">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full"></span>
            </button>
            <button class="p-2 hover:bg-primary-700/60 rounded-full transition-all text-on-primary">
                <span class="material-symbols-outlined">settings</span>
            </button>
            <div class="h-8 w-[1px] bg-primary-600/40 mx-2"></div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-on-primary">Pirotecnia San Rafael</span>
                <div
                    class="w-8 h-8 rounded-full bg-primary-700 flex items-center justify-center text-on-primary border border-primary-600/40">
                    <span class="material-symbols-outlined text-lg">shield_person</span>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content Wrapper -->
    <main class="ml-64 min-h-screen flex flex-col">
        <!-- TopNavBar (JSON Derived) -->

        <!-- Dashboard Canvas -->

        @yield('main-content')
    </main>

    @livewireScriptConfig
</body>

</html>
