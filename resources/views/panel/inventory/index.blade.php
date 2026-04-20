@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inventario</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Inventario</li>
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

        $toneIconClasses = [
            'secondary' => 'text-secondary',
            'accent' => 'text-accent',
            'warning' => 'text-warning',
            'error' => 'text-error',
        ];

        $kpis = [
            [
                'label' => 'Valor del inventario',
                'value' => $formatCurrency($inventoryStats['inventoryValue']),
                'helper' => $formatQuantity($inventoryStats['productCount']) . ' productos registrados',
                'icon' => 'payments',
                'tone' => 'secondary',
            ],
            [
                'label' => 'Unidades disponibles',
                'value' => $formatQuantity($inventoryStats['availableUnits']),
                'helper' => 'Stock utilizable para ventas y eventos',
                'icon' => 'inventory_2',
                'tone' => 'accent',
            ],
            [
                'label' => 'Unidades apartadas',
                'value' => $formatQuantity($inventoryStats['reservedUnits']),
                'helper' => 'Reservadas en eventos pendientes de salida',
                'icon' => 'bookmark_manager',
                'tone' => 'warning',
            ],
            [
                'label' => 'Alertas activas',
                'value' => $formatQuantity($inventoryStats['criticalCount'] + $inventoryStats['lowStockCount']),
                'helper' => $inventoryStats['criticalCount'] . ' criticos y ' . $inventoryStats['lowStockCount'] . ' en seguimiento',
                'icon' => 'warning',
                'tone' => 'error',
            ],
        ];
    @endphp

    <div class="mt-16 w-full max-w-[1680px] space-y-8 p-8">
        <section class="grid gap-6 xl:grid-cols-[minmax(0,1.5fr)_minmax(320px,0.85fr)]">
            <div class="relative overflow-hidden rounded-3xl bg-primary-800 p-8 shadow-2xl shadow-primary-900/20">
                <div class="absolute -left-10 top-10 h-44 w-44 rounded-full bg-accent/10 blur-3xl"></div>
                <div class="absolute -right-10 -top-12 h-48 w-48 rounded-full bg-secondary/10 blur-3xl"></div>

                <div class="relative flex h-full flex-col justify-between gap-8">
                    <div class="flex flex-wrap items-center gap-3">
                        <span
                            class="inline-flex rounded-full border border-primary-600/60 bg-primary-700/70 px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] text-primary-100">
                            {{ $inventory->name ?? 'Inventario principal' }}
                        </span>
                        <span
                            class="inline-flex rounded-full border border-accent/30 bg-accent/10 px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] text-accent">
                            {{ $inventory->location ?? 'Ubicacion sin registrar' }}
                        </span>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.32em] text-secondary">Centro de Inventario</p>
                        <h2 class="mt-4 font-heading text-4xl font-bold tracking-tight text-on-primary xl:text-5xl">
                            Stock operativo y reservas del almacen principal.
                        </h2>
                        <p class="mt-3 max-w-3xl text-sm leading-7 text-primary-200">
                            Vista centralizada de productos, materiales apartados para eventos, alertas de disponibilidad y
                            valor acumulado del inventario activo.
                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <div
                                class="inline-flex items-center gap-2 rounded-xl border border-primary-600/50 bg-primary-700/60 px-4 py-3 text-sm text-primary-100">
                                <span class="material-symbols-outlined text-secondary">category</span>
                                {{ $formatQuantity($inventoryStats['productCount']) }} registros activos
                            </div>
                            <div
                                class="inline-flex items-center gap-2 rounded-xl border border-primary-600/50 bg-primary-700/60 px-4 py-3 text-sm text-primary-100">
                                <span class="material-symbols-outlined text-accent">deployed_code</span>
                                {{ $formatQuantity($inventoryStats['availableUnits']) }} unidades utilizables
                            </div>
                            <div
                                class="inline-flex items-center gap-2 rounded-xl border border-primary-600/50 bg-primary-700/60 px-4 py-3 text-sm text-primary-100">
                                <span class="material-symbols-outlined text-warning">event_upcoming</span>
                                {{ $formatQuantity($inventoryStats['reservedUnits']) }} apartadas para eventos
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <article class="rounded-2xl border border-primary-600/40 bg-primary-700/60 p-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Productos con alerta
                            </p>
                            <p class="mt-3 text-3xl font-bold text-on-primary">
                                {{ $inventoryStats['criticalCount'] + $inventoryStats['lowStockCount'] }}
                            </p>
                        </article>
                        <article class="rounded-2xl border border-primary-600/40 bg-primary-700/60 p-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Valor disponible</p>
                            <p class="mt-3 text-3xl font-bold text-on-primary">
                                {{ $formatCurrency($inventoryStats['inventoryValue']) }}
                            </p>
                        </article>
                        <article class="rounded-2xl border border-primary-600/40 bg-primary-700/60 p-4">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Prioridad de compra
                            </p>
                            <p class="mt-3 text-3xl font-bold text-secondary">
                                {{ $inventoryStats['criticalCount'] > 0 ? 'Alta' : 'Estable' }}
                            </p>
                        </article>
                    </div>
                </div>
            </div>

            <aside class="rounded-3xl bg-gradient-to-br from-primary to-primary-700 p-8 shadow-2xl shadow-primary-900/30">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Centro de Acciones</p>
                <h3 class="mt-3 text-3xl font-bold text-on-primary">Gestion del almacen</h3>
                <p class="mt-2 text-sm text-primary-100">
                    Accesos directos para compras, alta de productos y consulta del catalogo interno.
                </p>

                <div class="mt-8 grid gap-3">
                    <a href="{{ route('purchases.create') }}"
                        class="inline-flex items-center justify-between rounded-2xl bg-on-primary/10 px-5 py-4 text-sm font-semibold text-on-primary transition-colors hover:bg-on-primary/20">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-warning">local_shipping</span>
                            Registrar compra
                        </span>
                        <span class="material-symbols-outlined text-primary-200">arrow_outward</span>
                    </a>

                    <a href="{{ route('products.create') }}"
                        class="inline-flex items-center justify-between rounded-2xl bg-on-primary/10 px-5 py-4 text-sm font-semibold text-on-primary transition-colors hover:bg-on-primary/20">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-accent">add_box</span>
                            Alta de producto
                        </span>
                        <span class="material-symbols-outlined text-primary-200">arrow_outward</span>
                    </a>

                    <a href="{{ route('settings.products.index') }}"
                        class="inline-flex items-center justify-between rounded-2xl bg-secondary px-5 py-4 text-sm font-bold text-on-secondary shadow-lg shadow-secondary/20 transition-all hover:bg-secondary-600 active:scale-[0.99]">
                        <span class="flex items-center gap-3">
                            <span class="material-symbols-outlined">inventory</span>
                            Catalogo de productos
                        </span>
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>

                <div class="mt-8 rounded-2xl bg-on-primary/10 p-5">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Resumen por categoria
                    </p>

                    <div class="mt-4 space-y-3">
                        @forelse ($categorySummary as $category)
                            <div class="rounded-2xl bg-primary-800/40 p-4">
                                <div class="flex items-center justify-between gap-4">
                                    <span class="text-sm font-semibold text-on-primary">{{ $category['label'] }}</span>
                                    <span
                                        class="inline-flex rounded-full border px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] {{ $toneClasses[$category['tone']] }}">
                                        {{ $category['count'] }}
                                    </span>
                                </div>
                                <p class="mt-2 text-xs text-primary-200">
                                    {{ $formatQuantity($category['units']) }} unidades registradas en esta categoria.
                                </p>
                            </div>
                        @empty
                            <div class="rounded-2xl bg-primary-800/40 p-4">
                                <p class="text-sm font-semibold text-on-primary">Sin categorias registradas</p>
                                <p class="mt-1 text-xs text-primary-200">Aun no hay productos vinculados a este almacen.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </aside>
        </section>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($kpis as $kpi)
                <article class="relative overflow-hidden rounded-3xl bg-primary-800 p-6 shadow-2xl shadow-primary-900/20">
                    <div class="absolute right-4 top-4 opacity-15">
                        <span class="material-symbols-outlined text-6xl {{ $toneIconClasses[$kpi['tone']] }}">
                            {{ $kpi['icon'] }}
                        </span>
                    </div>
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">{{ $kpi['label'] }}</p>
                    <p class="mt-4 text-4xl font-bold text-on-primary">{{ $kpi['value'] }}</p>
                    <p class="mt-4 text-sm text-primary-200">{{ $kpi['helper'] }}</p>
                </article>
            @endforeach
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[minmax(0,1.7fr)_minmax(320px,0.85fr)]">
            <section class="overflow-hidden rounded-3xl bg-primary-800 shadow-2xl shadow-primary-900/20">
                <div class="flex flex-col gap-4 border-b border-primary-700/60 px-6 py-6 lg:flex-row lg:items-end lg:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-secondary">Inventario Activo</p>
                        <h3 class="mt-3 text-2xl font-bold text-on-primary">Productos y materiales registrados</h3>
                        <p class="mt-2 text-sm text-primary-200">
                            Stock actual, reservas por evento y disponibilidad utilizable antes de la salida de almacen.
                        </p>
                    </div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-on-primary/10 px-4 py-2 text-sm text-primary-100">
                        <span class="material-symbols-outlined text-accent">monitoring</span>
                        {{ $formatQuantity($inventoryStats['productCount']) }} filas visibles
                    </div>
                </div>

                @if ($productRows->isEmpty())
                    <div class="p-10">
                        <div class="rounded-3xl border border-primary-700/60 bg-primary-700/50 p-8 text-center">
                            <span class="material-symbols-outlined text-5xl text-primary-200">inventory_2</span>
                            <p class="mt-4 text-lg font-bold text-on-primary">Sin productos en inventario</p>
                            <p class="mt-2 text-sm text-primary-200">
                                Registra compras o agrega productos al catalogo para comenzar a operar esta vista.
                            </p>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-primary-700/70">
                                <tr>
                                    <th class="px-6 py-4 text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                        Clave</th>
                                    <th class="px-6 py-4 text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                        Producto</th>
                                    <th class="px-6 py-4 text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                        Categoria</th>
                                    <th
                                        class="px-6 py-4 text-center text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                        Stock</th>
                                    <th
                                        class="px-6 py-4 text-center text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                        Apartado</th>
                                    <th
                                        class="px-6 py-4 text-center text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                        Disponible</th>
                                    <th
                                        class="px-6 py-4 text-right text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                        Precio base</th>
                                    <th
                                        class="px-6 py-4 text-center text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">
                                        Estado</th>
                                    <th class="px-6 py-4"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary-700/50">
                                @foreach ($productRows as $row)
                                    <tr class="transition-colors hover:bg-primary-700/35">
                                        <td class="px-6 py-5 text-sm font-bold text-secondary">{{ $row['sku'] }}</td>
                                        <td class="px-6 py-5">
                                            <div class="flex flex-col">
                                                <span class="font-semibold text-on-primary">{{ $row['name'] }}</span>
                                                <span class="mt-1 text-xs text-primary-200">{{ $row['detail'] }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <span
                                                class="inline-flex rounded-full border px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] {{ $toneClasses[$row['category_tone']] }}">
                                                {{ $row['category_label'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <p class="text-lg font-bold text-on-primary">{{ $formatQuantity($row['quantity']) }}</p>
                                            <p class="text-xs text-primary-200">{{ $row['unit'] }}</p>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <p class="text-lg font-bold text-warning">{{ $formatQuantity($row['reserved']) }}</p>
                                            <p class="text-xs text-primary-200">eventos</p>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <p class="text-lg font-bold text-on-primary">{{ $formatQuantity($row['available']) }}</p>
                                            <p class="text-xs text-primary-200">utilizable</p>
                                        </td>
                                        <td class="px-6 py-5 text-right font-semibold text-on-primary">
                                            {{ $formatCurrency($row['price']) }}
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <span
                                                class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] {{ $toneClasses[$row['status_tone']] }}">
                                                <span class="material-symbols-outlined text-[16px]">{{ $row['status_icon'] }}</span>
                                                {{ $row['status_label'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <a class="inline-flex items-center gap-2 rounded-xl bg-on-primary/10 px-3 py-2 text-xs font-semibold text-on-primary transition hover:bg-on-primary/20"
                                                href="{{ route('products.show', $row['id']) }}">
                                                Ver ficha
                                                <span class="material-symbols-outlined text-sm">arrow_outward</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col gap-3 border-t border-primary-700/60 bg-primary-700/30 px-6 py-4 text-sm text-primary-200 sm:flex-row sm:items-center sm:justify-between">
                        <p>
                            Mostrando {{ $formatQuantity($inventoryStats['productCount']) }} productos con
                            {{ $formatQuantity($inventoryStats['reservedUnits']) }} unidades apartadas.
                        </p>
                        <p class="font-semibold text-on-primary">
                            Criticos: {{ $inventoryStats['criticalCount'] }} · Seguimiento: {{ $inventoryStats['lowStockCount'] }}
                        </p>
                    </div>
                @endif
            </section>

            <div class="space-y-8">
                <section class="rounded-3xl bg-primary-800 p-6 shadow-2xl shadow-primary-900/20">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-accent">Agenda de Salidas</p>
                            <h3 class="mt-2 text-xl font-bold text-on-primary">Proximos consumos</h3>
                        </div>
                        <span class="material-symbols-outlined text-3xl text-accent">event_available</span>
                    </div>

                    <div class="mt-6 space-y-4">
                        @forelse ($upcomingConsumptions as $consumption)
                            <article class="rounded-2xl border border-primary-700/50 bg-primary-700/45 p-4">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm font-semibold text-on-primary">{{ $consumption['title'] }}</p>
                                        <p class="mt-1 text-xs uppercase tracking-[0.18em] text-primary-200">
                                            {{ $consumption['type'] }}
                                        </p>
                                    </div>
                                    <span
                                        class="inline-flex rounded-full border border-accent/30 bg-accent/10 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] text-accent">
                                        {{ $consumption['date_label'] }}
                                    </span>
                                </div>
                                <p class="mt-4 text-sm leading-relaxed text-primary-100">{{ $consumption['summary'] }}</p>
                                <div class="mt-4 flex items-center justify-between text-xs text-primary-200">
                                    <span>{{ $formatQuantity($consumption['requested_units']) }} unidades apartadas</span>
                                    <span>{{ $consumption['relative_label'] }}</span>
                                </div>
                            </article>
                        @empty
                            <div class="rounded-2xl border border-primary-700/50 bg-primary-700/45 p-4">
                                <p class="text-sm font-semibold text-on-primary">Sin eventos programados</p>
                                <p class="mt-1 text-xs text-primary-200">
                                    No hay consumos de inventario registrados en la agenda inmediata.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="rounded-3xl border border-error/20 bg-error/5 p-6 shadow-2xl shadow-error/10">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-error">Alerta Operativa</p>
                            <h3 class="mt-2 text-xl font-bold text-on-surface">Reposicion urgente</h3>
                        </div>
                        <span class="material-symbols-outlined text-3xl text-error">warning</span>
                    </div>

                    <p class="mt-3 text-sm text-muted">
                        Productos y materiales por debajo del umbral de seguridad o ya sin disponibilidad utilizable.
                    </p>

                    <div class="mt-6 space-y-3">
                        @forelse ($lowStockProducts as $product)
                            <div class="rounded-2xl border border-border bg-surface p-4 shadow-soft">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm font-semibold text-on-surface">{{ $product['name'] }}</p>
                                        <p class="mt-1 text-xs text-muted">{{ $product['category_label'] }} · {{ $product['unit'] }}
                                        </p>
                                    </div>
                                    <span
                                        class="inline-flex rounded-full border px-3 py-1 text-[11px] font-bold uppercase tracking-[0.18em] {{ $toneClasses[$product['status_tone']] }}">
                                        {{ $product['status_label'] }}
                                    </span>
                                </div>
                                <div class="mt-4 flex items-center justify-between text-sm">
                                    <span class="text-muted">Disponible</span>
                                    <span class="font-bold text-error">{{ $formatQuantity($product['available']) }}</span>
                                </div>
                                <div class="mt-2 flex items-center justify-between text-sm">
                                    <span class="text-muted">Apartado</span>
                                    <span class="font-semibold text-warning">{{ $formatQuantity($product['reserved']) }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-2xl border border-border bg-surface p-4 shadow-soft">
                                <p class="text-sm font-semibold text-on-surface">Sin alertas activas</p>
                                <p class="mt-1 text-xs text-muted">
                                    El inventario no registra productos con disponibilidad comprometida.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <a class="mt-6 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-error px-4 py-3 text-sm font-bold text-on-primary transition hover:bg-error/90"
                        href="{{ route('purchases.create') }}">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        Generar orden de compra
                    </a>
                </section>
            </div>
        </div>
    </div>
@endsection
