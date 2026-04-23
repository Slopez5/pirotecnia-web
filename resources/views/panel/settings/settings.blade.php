@extends('templates.adminlte')

@section('main-content')
    <!-- Header Section -->
    <div class="mx-auto mt-16 w-full max-w-[1680px] space-y-8 px-4 py-6 sm:p-8">
        <section class="mb-12">
            <h2 class="font-manrope tracking-tight text-4xl font-extrabold text-on-primary mb-2">Configuración</h2>
            <p class="text-primary-200 font-body text-lg">Administra los catálogos, parámetros y módulos base del sistema
            </p>
        </section>
        <!-- KPI Row -->
        <section class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-primary-800 p-8 rounded-xl relative overflow-hidden group shadow-2xl shadow-primary-900/20">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-primary/10 rounded-full blur-2xl group-hover:bg-primary/20 transition-all duration-500">
                </div>
                <p class="text-primary-200 text-xs font-label uppercase tracking-widest mb-4">Total Modules</p>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-manrope font-extrabold text-on-primary">6</span>
                    <span class="material-symbols-outlined text-primary" data-icon="grid_view">grid_view</span>
                </div>
            </div>
            <div class="bg-primary-800 p-8 rounded-xl relative overflow-hidden group shadow-2xl shadow-primary-900/20">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-secondary/10 rounded-full blur-2xl group-hover:bg-secondary/20 transition-all duration-500">
                </div>
                <p class="text-primary-200 text-xs font-label uppercase tracking-widest mb-4">Active Packages</p>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-manrope font-extrabold text-on-primary">12</span>
                    <span class="material-symbols-outlined text-secondary" data-icon="inventory">inventory</span>
                </div>
            </div>
            <div class="bg-primary-800 p-8 rounded-xl relative overflow-hidden group shadow-2xl shadow-primary-900/20">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-accent/10 rounded-full blur-2xl group-hover:bg-accent/20 transition-all duration-500">
                </div>
                <p class="text-primary-200 text-xs font-label uppercase tracking-widest mb-4">Products</p>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-manrope font-extrabold text-on-primary">48</span>
                    <span class="material-symbols-outlined text-accent" data-icon="rocket_launch">rocket_launch</span>
                </div>
            </div>
            <div class="bg-primary-800 p-8 rounded-xl relative overflow-hidden group shadow-2xl shadow-primary-900/20">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-warning/10 rounded-full blur-2xl group-hover:bg-warning/20 transition-all duration-500">
                </div>
                <p class="text-primary-200 text-xs font-label uppercase tracking-widest mb-4">Event Types</p>
                <div class="flex items-end justify-between">
                    <span class="text-4xl font-manrope font-extrabold text-on-primary">9</span>
                    <span class="material-symbols-outlined text-warning" data-icon="festival">festival</span>
                </div>
            </div>
        </section>
        <!-- Filter Bar -->
        <section class="mb-8">
            <div class="relative max-w-md">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-primary-200"
                    data-icon="search">search</span>
                <input
                    class="w-full rounded-xl border border-primary-700/60 bg-primary-800 py-4 pl-12 pr-4 text-on-primary focus:ring-2 focus:ring-accent/30 transition-all placeholder:text-primary-200/70"
                    placeholder="Buscar módulo de configuración..." type="text" />
            </div>
        </section>
        <!-- Modules Grid -->
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Paquetes -->
            <div
                class="bg-primary-800 p-8 rounded-2xl flex flex-col h-full border border-primary-700/60 hover:border-primary-200/40 transition-all duration-500 group shadow-2xl shadow-primary-900/20">
                <div class="mb-8 flex items-center justify-between">
                    <div
                        class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-3xl" data-icon="inventory_2">inventory_2</span>
                    </div>
                    <span class="text-sm font-label text-primary-100 bg-primary-700 px-3 py-1 rounded-full">12
                        registros</span>
                </div>
                <h3 class="text-xl font-manrope font-bold text-on-primary mb-3">Paquetes</h3>
                <p class="text-primary-200 font-body text-sm mb-8 flex-1 leading-relaxed">Configura los paquetes
                    comerciales disponibles para los distintos tipos de eventos.</p>
                <a href="{{ route('settings.packages.index') }}"
                    class="w-full bg-primary-700 py-3 rounded-lg text-on-primary font-semibold hover:bg-primary hover:text-on-primary transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                    Administrar
                    <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform"
                        data-icon="arrow_forward">arrow_forward</span>
                </a>
            </div>
            <!-- Productos -->
            <div
                class="bg-primary-800 p-8 rounded-2xl flex flex-col h-full border border-primary-700/60 hover:border-secondary/40 transition-all duration-500 group shadow-2xl shadow-primary-900/20">
                <div class="mb-8 flex items-center justify-between">
                    <div
                        class="w-14 h-14 rounded-xl bg-secondary/10 flex items-center justify-center text-secondary group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-3xl" data-icon="explosion">explosion</span>
                    </div>
                    <span class="text-sm font-label text-primary-100 bg-primary-700 px-3 py-1 rounded-full">48
                        registros</span>
                </div>
                <h3 class="text-xl font-manrope font-bold text-on-primary mb-3">Productos</h3>
                <p class="text-primary-200 font-body text-sm mb-8 flex-1 leading-relaxed">Administra el catálogo de
                    productos de pirotecnia disponibles para venta y uso interno.</p>
                <a href="{{ route('settings.products.index') }}"
                    class="w-full bg-primary-700 py-3 rounded-lg text-on-primary font-semibold hover:bg-secondary hover:text-on-secondary transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                    Administrar
                    <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform"
                        data-icon="arrow_forward">arrow_forward</span>
                </a>
            </div>
            <!-- Equipamiento -->
            <div
                class="bg-primary-800 p-8 rounded-2xl flex flex-col h-full border border-primary-700/60 hover:border-accent/40 transition-all duration-500 group shadow-2xl shadow-primary-900/20">
                <div class="mb-8 flex items-center justify-between">
                    <div
                        class="w-14 h-14 rounded-xl bg-accent/10 flex items-center justify-center text-accent group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-3xl" data-icon="construction">construction</span>
                    </div>
                    <span class="text-sm font-label text-primary-100 bg-primary-700 px-3 py-1 rounded-full">27
                        registros</span>
                </div>
                <h3 class="text-xl font-manrope font-bold text-on-primary mb-3">Equipamiento</h3>
                <p class="text-primary-200 font-body text-sm mb-8 flex-1 leading-relaxed">Gestiona el equipo técnico,
                    logístico y de seguridad utilizado en los eventos.</p>
                <a href="{{ route('settings.equipments.index') }}"
                    class="w-full bg-primary-700 py-3 rounded-lg text-on-primary font-semibold hover:bg-accent hover:text-on-accent transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                    Administrar
                    <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform"
                        data-icon="arrow_forward">arrow_forward</span>
                </a>
            </div>
            <!-- Tipos de cliente -->
            <div
                class="bg-primary-800 p-8 rounded-2xl flex flex-col h-full border border-primary-700/60 hover:border-warning/40 transition-all duration-500 group shadow-2xl shadow-primary-900/20">
                <div class="mb-8 flex items-center justify-between">
                    <div
                        class="w-14 h-14 rounded-xl bg-warning/10 flex items-center justify-center text-warning group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-3xl" data-icon="groups">groups</span>
                    </div>
                    <span class="text-sm font-label text-primary-100 bg-primary-700 px-3 py-1 rounded-full">6
                        registros</span>
                </div>
                <h3 class="text-xl font-manrope font-bold text-on-primary mb-3">Tipos de cliente</h3>
                <p class="text-primary-200 font-body text-sm mb-8 flex-1 leading-relaxed">Define las categorías de
                    clientes que pueden contratar productos o eventos.</p>
                <a href="{{ route('settings.client-types.index') }}"
                    class="w-full bg-primary-700 py-3 rounded-lg text-on-primary font-semibold hover:bg-warning hover:text-on-warning transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                    Administrar
                    <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform"
                        data-icon="arrow_forward">arrow_forward</span>
                </a>
            </div>
            <!-- Tipos de evento -->
            <div
                class="bg-primary-800 p-8 rounded-2xl flex flex-col h-full border border-primary-700/60 hover:border-secondary/40 transition-all duration-500 group shadow-2xl shadow-primary-900/20">
                <div class="mb-8 flex items-center justify-between">
                    <div
                        class="w-14 h-14 rounded-xl bg-secondary/10 flex items-center justify-center text-secondary group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-3xl" data-icon="auto_awesome">auto_awesome</span>
                    </div>
                    <span class="text-sm font-label text-primary-100 bg-primary-700 px-3 py-1 rounded-full">9
                        registros</span>
                </div>
                <h3 class="text-xl font-manrope font-bold text-on-primary mb-3">Tipos de evento</h3>
                <p class="text-primary-200 font-body text-sm mb-8 flex-1 leading-relaxed">Administra los tipos de evento
                    disponibles para clasificar y organizar las ventas.</p>
                <a href="{{ route('settings.event_types.index') }}"
                    class="w-full bg-primary-700 py-3 rounded-lg text-on-primary font-semibold hover:bg-secondary hover:text-on-secondary transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                    Administrar
                    <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform"
                        data-icon="arrow_forward">arrow_forward</span>
                </a>
            </div>
            <!-- Niveles de experiencia -->
            <div
                class="bg-primary-800 p-8 rounded-2xl flex flex-col h-full border border-primary-700/60 hover:border-accent/40 transition-all duration-500 group shadow-2xl shadow-primary-900/20">
                <div class="mb-8 flex items-center justify-between">
                    <div
                        class="w-14 h-14 rounded-xl bg-accent/10 flex items-center justify-center text-accent group-hover:scale-110 transition-transform duration-500">
                        <span class="material-symbols-outlined text-3xl" data-icon="military_tech">military_tech</span>
                    </div>
                    <span class="text-sm font-label text-primary-100 bg-primary-700 px-3 py-1 rounded-full">4
                        registros</span>
                </div>
                <h3 class="text-xl font-manrope font-bold text-on-primary mb-3">Niveles de experiencia</h3>
                <p class="text-primary-200 font-body text-sm mb-8 flex-1 leading-relaxed">Configura los niveles de
                    experiencia requeridos para el personal y la operación.</p>
                <a href="{{ route('settings.experience-levels.index') }}"
                    class="w-full bg-primary-700 py-3 rounded-lg text-on-primary font-semibold hover:bg-accent hover:text-on-accent transition-all duration-300 flex items-center justify-center gap-2 group/btn">
                    Administrar
                    <span class="material-symbols-outlined text-sm group-hover/btn:translate-x-1 transition-transform"
                        data-icon="arrow_forward">arrow_forward</span>
                </a>
            </div>
        </section>
        <!-- Decorative Background Elements -->
        <div
            class="fixed bottom-0 right-0 w-[600px] h-[600px] bg-accent/10 rounded-full blur-[120px] -z-10 pointer-events-none">
        </div>
        <div
            class="fixed top-0 left-[300px] w-[400px] h-[400px] bg-secondary/10 rounded-full blur-[100px] -z-10 pointer-events-none">
        </div>
    </div>
@endsection
