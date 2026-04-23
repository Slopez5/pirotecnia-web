@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Productos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Configuración</a></li>
                        <li class="breadcrumb-item active">Productos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    @php
        $formatCurrency = fn($amount) => '$' . number_format((float) $amount, 2);
        $formatQuantity = function ($amount) {
            $amount = (float) $amount;

            return fmod($amount, 1.0) === 0.0 ? number_format($amount, 0) : number_format($amount, 2);
        };

        $toneClasses = [
            'secondary' => 'border-secondary/30 bg-secondary/10 text-secondary',
            'accent' => 'border-accent/30 bg-accent/10 text-accent',
            'warning' => 'border-warning/30 bg-warning/10 text-warning',
            'error' => 'border-error/30 bg-error/10 text-error',
        ];
    @endphp

    <div class="mx-auto mt-16 w-full max-w-[1680px] space-y-8 px-4 py-6 sm:p-8">
        <section class="grid gap-6 xl:grid-cols-[minmax(0,1.55fr)_minmax(320px,0.82fr)]">
            <div class="relative overflow-hidden rounded-3xl bg-primary-800 p-8 shadow-2xl shadow-primary-900/20">
                <div class="absolute -left-12 top-10 h-44 w-44 rounded-full bg-accent/15 blur-3xl"></div>
                <div class="absolute -right-10 bottom-0 h-52 w-52 rounded-full bg-secondary/15 blur-3xl"></div>

                <div class="relative flex h-full flex-col justify-between gap-8">
                    <div class="flex flex-wrap items-center gap-3">
                        <span
                            class="inline-flex rounded-full border border-primary-600/60 bg-primary-700/70 px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] text-primary-100">
                            Catálogo operativo
                        </span>
                        <span
                            class="inline-flex rounded-full border border-secondary/30 bg-secondary/10 px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] text-secondary">
                            {{ number_format($productStats['productCount']) }} registros activos
                        </span>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-secondary">Productos y materiales</p>
                        <h2 class="mt-4 font-heading text-4xl font-bold tracking-tight text-on-primary xl:text-5xl">
                            Catálogo central para ventas, eventos y configuración de paquetes.
                        </h2>
                        <p class="mt-3 max-w-3xl text-sm leading-7 text-primary-200">
                            Consulta existencias, valor de inventario, productos ligados a paquetes y piezas que requieren
                            seguimiento antes de comprometer nuevos eventos.
                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <div
                                class="inline-flex items-center gap-2 rounded-xl border border-primary-600/50 bg-primary-700/60 px-4 py-3 text-sm text-primary-100">
                                <span class="material-symbols-outlined text-secondary">inventory_2</span>
                                {{ number_format($productStats['trackedCount']) }} con inventario vinculado
                            </div>
                            <div
                                class="inline-flex items-center gap-2 rounded-xl border border-primary-600/50 bg-primary-700/60 px-4 py-3 text-sm text-primary-100">
                                <span class="material-symbols-outlined text-accent">deployed_code</span>
                                {{ $formatQuantity($productStats['availableUnits']) }} unidades disponibles
                            </div>
                            <div
                                class="inline-flex items-center gap-2 rounded-xl border border-primary-600/50 bg-primary-700/60 px-4 py-3 text-sm text-primary-100">
                                <span class="material-symbols-outlined text-warning">sell</span>
                                {{ number_format($productStats['linkedPackageCount']) }} ligados a paquetes
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <article class="rounded-2xl border border-primary-600/40 bg-primary-700/60 p-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Valor catalogado
                            </p>
                            <p class="mt-3 text-3xl font-bold text-on-primary">
                                {{ $formatCurrency($productStats['inventoryValue']) }}
                            </p>
                        </article>
                        <article class="rounded-2xl border border-primary-600/40 bg-primary-700/60 p-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Apartado</p>
                            <p class="mt-3 text-3xl font-bold text-on-primary">
                                {{ $formatQuantity($productStats['reservedUnits']) }}
                            </p>
                        </article>
                        <article class="rounded-2xl border border-primary-600/40 bg-primary-700/60 p-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Bajo seguimiento
                            </p>
                            <p class="mt-3 text-3xl font-bold text-secondary">
                                {{ number_format($productStats['lowStockCount']) }}
                            </p>
                        </article>
                    </div>
                </div>
            </div>

            <aside class="rounded-3xl bg-gradient-to-br from-primary to-primary-700 p-8 shadow-2xl shadow-primary-900/30">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Centro de acciones</p>
                <h3 class="mt-3 text-3xl font-bold text-on-primary">Gestión del catálogo</h3>
                <p class="mt-2 text-sm text-primary-100">
                    Accesos rápidos para alta, importación y navegación al resto de configuración.
                </p>

                <div class="mt-8 grid gap-3">
                    <a href="{{ route('products.create') }}"
                        class="inline-flex items-center justify-between rounded-2xl bg-secondary px-5 py-4 text-sm font-bold text-on-secondary shadow-lg shadow-secondary/20 transition-all hover:bg-secondary-600 active:scale-[0.99]">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined">add_circle</span>
                            Nuevo producto
                        </span>
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>

                    <a href="{{ route('products.import') }}"
                        class="inline-flex items-center justify-between rounded-2xl bg-on-primary/10 px-5 py-4 text-sm font-semibold text-on-primary transition-colors hover:bg-on-primary/20">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-accent">file_upload</span>
                            Importar catálogo
                        </span>
                        <span class="material-symbols-outlined text-primary-200">arrow_outward</span>
                    </a>

                    <a href="{{ route('settings.index') }}"
                        class="inline-flex items-center justify-between rounded-2xl bg-on-primary/10 px-5 py-4 text-sm font-semibold text-on-primary transition-colors hover:bg-on-primary/20">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-warning">settings</span>
                            Volver a configuración
                        </span>
                        <span class="material-symbols-outlined text-primary-200">arrow_outward</span>
                    </a>
                </div>

                <div class="mt-8 rounded-2xl bg-on-primary/10 p-5">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Lectura rápida</p>

                    <div class="mt-4 space-y-3">
                        <div class="rounded-2xl bg-primary-800/40 p-4">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm font-semibold text-on-primary">Materiales registrados</span>
                                <span
                                    class="inline-flex rounded-full border border-accent/30 bg-accent/10 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] text-accent">
                                    {{ number_format($productStats['materialCount']) }}
                                </span>
                            </div>
                            <p class="mt-2 text-xs text-primary-200">
                                Piezas que normalmente abastecen paquetes y eventos personalizados.
                            </p>
                        </div>
                        <div class="rounded-2xl bg-primary-800/40 p-4">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm font-semibold text-on-primary">Sin inventario</span>
                                <span
                                    class="inline-flex rounded-full border border-warning/30 bg-warning/10 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] text-warning">
                                    {{ number_format($productStats['productCount'] - $productStats['trackedCount']) }}
                                </span>
                            </div>
                            <p class="mt-2 text-xs text-primary-200">
                                Productos creados en catálogo pero todavía no ligados al almacén principal.
                            </p>
                        </div>
                    </div>
                </div>
            </aside>
        </section>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-3xl bg-primary-800 p-6 shadow-2xl shadow-primary-900/20">
                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Total de productos</p>
                <p class="mt-4 text-4xl font-bold text-on-primary">{{ number_format($productStats['productCount']) }}</p>
                <p class="mt-4 text-sm text-primary-200">Catálogo disponible para ventas, paquetes y eventos.</p>
            </article>
            <article class="rounded-3xl bg-primary-800 p-6 shadow-2xl shadow-primary-900/20">
                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Con inventario</p>
                <p class="mt-4 text-4xl font-bold text-on-primary">{{ number_format($productStats['trackedCount']) }}</p>
                <p class="mt-4 text-sm text-primary-200">Productos ya enlazados al polvorín principal.</p>
            </article>
            <article class="rounded-3xl bg-primary-800 p-6 shadow-2xl shadow-primary-900/20">
                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Ligados a paquetes</p>
                <p class="mt-4 text-4xl font-bold text-on-primary">
                    {{ number_format($productStats['linkedPackageCount']) }}
                </p>
                <p class="mt-4 text-sm text-primary-200">Catálogo reutilizado en configuraciones comerciales.</p>
            </article>
            <article class="rounded-3xl bg-primary-800 p-6 shadow-2xl shadow-primary-900/20">
                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Valor del inventario</p>
                <p class="mt-4 text-4xl font-bold text-secondary">
                    {{ $formatCurrency($productStats['inventoryValue']) }}
                </p>
                <p class="mt-4 text-sm text-primary-200">Monto estimado con stock actual y precio base.</p>
            </article>
        </div>

        <div class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1fr)_24rem]">
            <div class="min-w-0">
                <section class="overflow-hidden rounded-3xl bg-primary-800 shadow-2xl shadow-primary-900/10">
                    <div
                        class="flex flex-col gap-4 border-b border-primary-700/60 px-6 py-6 lg:flex-row lg:items-end lg:justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-secondary">Listado de productos
                            </p>
                            <h3 class="mt-3 text-2xl font-bold text-on-primary">Catálogo registrado</h3>
                            <p class="mt-2 text-sm text-primary-200">
                                Vista unificada con stock, reservas, precio base, nivel de disponibilidad y uso en paquetes.
                            </p>
                        </div>
                        <div
                            class="inline-flex items-center gap-2 rounded-full bg-primary-700/60 px-4 py-2 text-sm text-primary-100">
                            <span class="material-symbols-outlined text-accent">table_view</span>
                            {{ number_format($productStats['productCount']) }} filas visibles
                        </div>
                    </div>

                    @if ($productRows->isEmpty())
                        <div class="p-10">
                            <div class="rounded-3xl border border-primary-700/60 bg-primary-700/50 p-8 text-center">
                                <span class="material-symbols-outlined text-5xl text-primary-200">inventory_2</span>
                                <p class="mt-4 text-lg font-bold text-on-primary">Sin productos registrados</p>
                                <p class="mt-2 text-sm text-primary-200">
                                    Crea el primer producto o importa un archivo para comenzar a trabajar el catálogo.
                                </p>
                                <div class="mt-6 flex flex-wrap justify-center gap-3">
                                    <a href="{{ route('products.create') }}"
                                        class="inline-flex items-center gap-2 rounded-2xl bg-secondary px-5 py-3 text-sm font-bold text-on-secondary transition-colors hover:bg-secondary-600">
                                        <span class="material-symbols-outlined">add_circle</span>
                                        Nuevo producto
                                    </a>
                                    <a href="{{ route('products.import') }}"
                                        class="inline-flex items-center gap-2 rounded-2xl bg-primary-700 px-5 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600">
                                        <span class="material-symbols-outlined">file_upload</span>
                                        Importar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="responsive-stack-table responsive-stack-table-dark min-w-full text-left">
                                <thead class="bg-primary-700/70">
                                    <tr>
                                        <th class="px-6 py-4 text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                            Producto</th>
                                        <th class="px-6 py-4 text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                            Clave</th>
                                        <th class="px-6 py-4 text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                            Tipo</th>
                                        <th
                                            class="px-6 py-4 text-center text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                            Stock</th>
                                        <th
                                            class="px-6 py-4 text-center text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                            Apartado</th>
                                        <th
                                            class="px-6 py-4 text-right text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                            Precio base</th>
                                        <th
                                            class="px-6 py-4 text-center text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                            Paquetes</th>
                                        <th
                                            class="px-6 py-4 text-center text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                            Estado</th>
                                        <th
                                            class="px-6 py-4 text-center text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-primary-700/50">
                                    @foreach ($productRows as $product)
                                        <tr class="transition-colors hover:bg-primary-700/35">
                                            <td class="px-6 py-5" data-label="Producto">
                                                <div class="flex flex-col">
                                                    <span class="font-semibold text-on-primary">{{ $product['name'] }}</span>
                                                    <span class="mt-1 text-xs text-primary-200">{{ $product['detail'] }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 text-sm font-bold text-secondary" data-label="Clave">
                                                {{ $product['sku'] }}
                                            </td>
                                            <td class="px-6 py-5" data-label="Tipo">
                                                <span
                                                    class="inline-flex rounded-full border px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] {{ $toneClasses[$product['category_tone']] }}">
                                                    {{ $product['category_label'] }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 text-center" data-label="Stock">
                                                <p class="text-lg font-bold text-on-primary">
                                                    {{ $formatQuantity($product['quantity']) }}
                                                </p>
                                                <p class="text-xs text-primary-200">{{ $product['unit'] }}</p>
                                            </td>
                                            <td class="px-6 py-5 text-center" data-label="Apartado">
                                                <p class="text-lg font-bold text-warning">
                                                    {{ $formatQuantity($product['reserved']) }}
                                                </p>
                                                <p class="text-xs text-primary-200">
                                                    {{ $formatQuantity($product['available']) }} disponible
                                                </p>
                                            </td>
                                            <td class="px-6 py-5 text-right" data-label="Precio base">
                                                <p class="font-semibold text-on-primary">
                                                    {{ $product['price'] > 0 ? $formatCurrency($product['price']) : 'Sin capturar' }}
                                                </p>
                                                <p class="mt-1 text-xs text-primary-200">
                                                    Valor: {{ $formatCurrency($product['inventory_value']) }}
                                                </p>
                                            </td>
                                            <td class="px-6 py-5 text-center" data-label="Paquetes">
                                                <span
                                                    class="inline-flex rounded-full border border-secondary/30 bg-secondary/10 px-3 py-1 text-xs font-semibold text-secondary">
                                                    {{ number_format($product['package_count']) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 text-center" data-label="Estado">
                                                <span
                                                    class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] {{ $toneClasses[$product['status_tone']] }}">
                                                    <span class="material-symbols-outlined text-[16px]">
                                                        {{ $product['status_icon'] }}
                                                    </span>
                                                    {{ $product['status_label'] }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5" data-label="Acciones">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="{{ route('products.show', $product['id']) }}"
                                                        class="inline-flex rounded-lg p-2 text-primary-200 transition-colors hover:bg-primary-700/70 hover:text-accent"
                                                        title="Ver producto">
                                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                                    </a>
                                                    <a href="{{ route('products.edit', $product['id']) }}"
                                                        class="inline-flex rounded-lg p-2 text-primary-200 transition-colors hover:bg-primary-700/70 hover:text-secondary"
                                                        title="Editar producto">
                                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                                    </a>
                                                    <button
                                                        class="inline-flex rounded-lg p-2 text-primary-200 transition-colors hover:bg-error/10 hover:text-error"
                                                        onclick="confirmDelete({{ $product['id'] }})" title="Eliminar producto"
                                                        type="button">
                                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                                    </button>
                                                    <form action="{{ route('products.destroy', $product['id']) }}"
                                                        class="hidden" id="deleteForm-{{ $product['id'] }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </section>
            </div>

            <aside class="space-y-6 self-start xl:sticky xl:top-24">
                <section class="overflow-hidden rounded-3xl bg-primary-800 shadow-2xl shadow-primary-900/20">
                    <div
                        class="relative overflow-hidden border-b border-primary-700/60 bg-gradient-to-br from-primary to-primary-700 px-6 py-6">
                        <div class="absolute -right-10 -top-12 h-36 w-36 rounded-full bg-secondary/15 blur-3xl"></div>
                        <div class="absolute bottom-0 left-0 h-24 w-24 rounded-full bg-accent/15 blur-3xl"></div>
                        <div class="relative">
                            <span
                                class="inline-flex rounded-full border border-warning/30 bg-warning/10 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] text-warning">
                                Producto destacado
                            </span>
                            <h3 class="mt-4 text-2xl font-bold text-on-primary">
                                {{ $spotlightProduct['name'] ?? 'Sin datos disponibles' }}
                            </h3>
                            <p class="mt-2 text-sm text-primary-100">
                                {{ $spotlightProduct['detail'] ?? 'No hay información suficiente para destacar un producto todavía.' }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4 p-6">
                        @if ($spotlightProduct)
                            <div class="rounded-2xl bg-primary-700/60 p-4">
                                <div class="flex items-center justify-between gap-4">
                                    <span class="text-sm text-primary-200">Clave interna</span>
                                    <span class="text-sm font-semibold text-on-primary">{{ $spotlightProduct['sku'] }}</span>
                                </div>
                                <div class="mt-3 spark-divider"></div>
                                <div class="mt-3 flex items-center justify-between gap-4">
                                    <span class="text-sm text-primary-200">En paquetes</span>
                                    <span class="text-sm font-semibold text-secondary">
                                        {{ number_format($spotlightProduct['package_count']) }}
                                    </span>
                                </div>
                                <div class="mt-3 spark-divider"></div>
                                <div class="mt-3 flex items-center justify-between gap-4">
                                    <span class="text-sm text-primary-200">Valor estimado</span>
                                    <span class="text-sm font-semibold text-on-primary">
                                        {{ $formatCurrency($spotlightProduct['inventory_value']) }}
                                    </span>
                                </div>
                            </div>

                            <div class="rounded-2xl bg-primary-700/60 p-4">
                                <div class="flex items-center justify-between gap-4">
                                    <span class="text-sm text-primary-200">Disponibilidad</span>
                                    <span
                                        class="inline-flex rounded-full border px-3 py-1 text-xs font-semibold {{ $toneClasses[$spotlightProduct['status_tone']] }}">
                                        {{ $spotlightProduct['status_label'] }}
                                    </span>
                                </div>
                                <p class="mt-3 text-sm font-semibold text-on-primary">
                                    {{ $formatQuantity($spotlightProduct['available']) }} {{ $spotlightProduct['unit'] }}
                                    disponibles
                                </p>
                            </div>
                        @else
                            <div class="rounded-2xl bg-primary-700/60 p-4">
                                <p class="text-sm font-semibold text-on-primary">Sin producto destacado</p>
                                <p class="mt-1 text-xs text-primary-200">
                                    En cuanto exista catálogo suficiente aparecerá aquí el ítem con mayor peso operativo.
                                </p>
                            </div>
                        @endif
                    </div>
                </section>

                <section class="rounded-3xl bg-primary-800 p-6 shadow-2xl shadow-primary-900/20">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Resumen por tipo</p>
                            <h3 class="mt-2 text-xl font-bold text-on-primary">Composición del catálogo</h3>
                        </div>
                        <span class="material-symbols-outlined text-accent">category</span>
                    </div>

                    <div class="mt-6 space-y-3">
                        @forelse ($roleSummary as $role)
                            <div class="rounded-2xl bg-primary-700/60 p-4">
                                <div class="flex items-center justify-between gap-4">
                                    <span class="text-sm font-semibold text-on-primary">{{ $role['label'] }}</span>
                                    <span
                                        class="inline-flex rounded-full border px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] {{ $toneClasses[$role['tone']] }}">
                                        {{ number_format($role['count']) }}
                                    </span>
                                </div>
                                <p class="mt-2 text-xs text-primary-200">
                                    {{ $formatQuantity($role['units']) }} unidades registradas en este grupo.
                                </p>
                            </div>
                        @empty
                            <div class="rounded-2xl bg-primary-700/60 p-4">
                                <p class="text-sm font-semibold text-on-primary">Sin categorías visibles</p>
                                <p class="mt-1 text-xs text-primary-200">El resumen aparecerá cuando existan productos
                                    registrados.</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="rounded-3xl bg-primary-800 p-6 shadow-2xl shadow-primary-900/20">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Alertas</p>
                            <h3 class="mt-2 text-xl font-bold text-on-primary">Productos con seguimiento</h3>
                        </div>
                        <span class="material-symbols-outlined text-warning">warning</span>
                    </div>

                    <div class="mt-6 space-y-3">
                        @forelse ($lowStockProducts as $product)
                            <div class="rounded-2xl bg-primary-700/60 p-4">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm font-semibold text-on-primary">{{ $product['name'] }}</p>
                                        <p class="mt-1 text-xs text-primary-200">{{ $product['sku'] }}</p>
                                    </div>
                                    <span
                                        class="inline-flex rounded-full border px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] {{ $toneClasses[$product['status_tone']] }}">
                                        {{ $product['status_label'] }}
                                    </span>
                                </div>
                                <p class="mt-3 text-xs leading-6 text-primary-100">
                                    {{ $formatQuantity($product['available']) }} {{ $product['unit'] }} disponibles.
                                    {{ $formatQuantity($product['reserved']) }} reservadas para eventos.
                                </p>
                            </div>
                        @empty
                            <div class="rounded-2xl bg-primary-700/60 p-4">
                                <p class="text-sm font-semibold text-on-primary">Sin alertas activas</p>
                                <p class="mt-1 text-xs text-primary-200">
                                    El catálogo no presenta faltantes ni productos pendientes de inventariar.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </aside>
        </div>
    </div>
@endsection

@section('extra-script')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡No podrás revertir esto!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + id).submit();
                }
            });
        }
    </script>
@endsection
