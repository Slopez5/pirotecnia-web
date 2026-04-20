@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('main-content')
    <div class="mt-16 p-8 space-y-8">
        <!-- Quick Actions Bar -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-on-primary tracking-tight">Panel de Control</h2>
                <p class="text-primary-200 text-sm">Resumen operativo y métricas en tiempo real</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('employees.create') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-primary-800 text-on-primary rounded-lg font-medium hover:bg-primary-700 transition-colors group">
                    <span
                        class="material-symbols-outlined text-secondary group-hover:scale-110 transition-transform">add_circle</span>
                    Alta de Empleado
                </a>
                <a href="{{ route('sales.create') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-primary-800 text-on-primary rounded-lg font-medium hover:bg-primary-700 transition-colors group">
                    <span
                        class="material-symbols-outlined text-accent group-hover:scale-110 transition-transform">receipt_long</span>
                    Registrar Venta
                </a>
                <a href="{{ route('events.create') }}"
                    class="flex items-center gap-2 px-4 py-6 bg-gradient-to-br from-primary to-primary-600 text-on-primary rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">rocket_launch</span>
                    Crear Nuevo Evento
                </a>
            </div>
        </div>
        <!-- KPI Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <livewire:dashboard.kpi-card title="Ingreso contratado" icon="payments" backgroundColorIcon="bg-primary/10"
                colorIcon="text-primary" :value="$monthlyRevenue" indicatorIcon="trending_up"
                :indicatorLabel="$monthlyRevenueIndicator" :indicatorColor="$monthlyRevenueIndicatorColor" />
            <livewire:dashboard.kpi-card title="Próximos eventos" icon="event_available" backgroundColorIcon="bg-accent/10"
                colorIcon="text-accent" :value="$eventsNext30Days" indicatorIcon="event_upcoming"
                :indicatorLabel="$eventsNext30Indicator" indicatorColor="text-primary-200" />
            <livewire:dashboard.kpi-card title="Bajo stock" icon="warning" backgroundColorIcon="bg-error/10"
                colorIcon="text-error" :value="$lowStockCount" indicatorIcon="priority_high"
                :indicatorLabel="$lowStockIndicator" :indicatorColor="$lowStockIndicatorColor" />
            <livewire:dashboard.kpi-card title="Paquetes contratados" icon="package_2"
                backgroundColorIcon="bg-secondary/10" colorIcon="text-secondary" :value="$packagesThisMonth"
                indicatorIcon="inventory_2" :indicatorLabel="$packagesThisMonthIndicator"
                :indicatorColor="$packagesThisMonthIndicatorColor" />
        </div>
        <!-- Bento Grid Section -->
        <div class="grid grid-cols-12 gap-8 items-start">
            <!-- Main Chart: Ventas Mensuales -->
            <div class="col-span-12 lg:col-span-8 bg-primary-800 p-8 rounded-3xl">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h3 class="text-xl font-bold text-on-primary">Rendimiento Comercial</h3>
                        <p class="text-primary-200 text-sm">Ingreso contratado por mes durante el año actual</p>
                    </div>
                    <div class="flex gap-2 bg-primary-700 p-1 rounded-lg text-xs">
                        <span class="px-3 py-1 font-semibold bg-primary-100 text-primary-800 rounded-md">Ingresos</span>
                        <span class="px-3 py-1 font-semibold text-primary-200">Eventos</span>
                    </div>
                </div>
                <livewire:chart type="line" :series="$monthlyRevenueSeries" />

            </div>
            <!-- Secondary Chart: Dona/Eventos -->
            <div class="col-span-12 lg:col-span-4 bg-primary-800 p-8 rounded-3xl h-full flex flex-col">
                <h3 class="text-xl font-bold text-on-primary mb-2">Eventos por Categoría</h3>
                <p class="text-primary-200 text-sm mb-8">Distribución anual de contrataciones por tipo de evento</p>
                <livewire:chart type="dona" :segments="$eventTypeSegments" centerLabel="Eventos" />
            </div>
            <!-- Upcoming Events Table -->
            <div class="col-span-12 lg:col-span-8 bg-primary-800 rounded-3xl overflow-hidden">
                <div class="p-8 pb-4">
                    <h3 class="text-xl font-bold text-on-primary">Próximos Eventos</h3>
                </div>
                <div class="overflow-x-auto px-2">
                    <livewire:dashboard.event-list :events="$upcomingEvents" />

                </div>
            </div>
            <!-- Low Stock Sidebar List -->
            <div class="col-span-12 lg:col-span-4 bg-primary-800 p-8 rounded-3xl h-full">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-on-primary">Bajo Stock</h3>
                    <a class="text-primary text-xs font-semibold hover:underline" href="{{ route('inventories.index') }}">Ver Todo</a>
                </div>
                <div class="space-y-4">
                    @forelse ($lowStockItems as $item)
                        <livewire:info-summary-card :icon="$item['icon']" :title="$item['title']"
                            :subtitle="$item['subtitle']" :value="$item['value']" :subValue="$item['subValue']"
                            :color="$item['color']" :key="'low-stock-'.$loop->index" />
                    @empty
                        <div class="rounded-2xl bg-primary-700/70 p-4">
                            <p class="text-sm font-semibold text-on-primary">Sin alertas de inventario</p>
                            <p class="mt-1 text-xs text-primary-200">No hay productos por debajo del minimo definido.</p>
                        </div>
                    @endforelse
                </div>
                <div
                    class="mt-8 bg-gradient-to-br from-primary-700 to-primary-600 p-6 rounded-2xl border border-primary-500/20 relative overflow-hidden">
                    <span
                        class="material-symbols-outlined absolute -right-4 -bottom-4 text-7xl text-on-primary/5 rotate-12">inventory</span>
                    <p class="text-on-primary font-bold mb-2">Resumen de Almacén</p>
                    <p class="text-primary-200 text-xs mb-4">
                        @if ($lowStockCount > 0)
                            {{ $criticalLowStockCount }} críticos y {{ $lowStockCount - $criticalLowStockCount }} en seguimiento por debajo del mínimo.
                        @else
                            Inventario estable, sin productos por debajo del mínimo de seguridad.
                        @endif
                    </p>
                    <a href="{{ route('purchases.create') }}"
                        class="w-full py-2 bg-on-primary/10 hover:bg-on-primary/20 text-on-primary rounded-lg text-sm font-semibold transition-colors">
                        Generar Orden
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
