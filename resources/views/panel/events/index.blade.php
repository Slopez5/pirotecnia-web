@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Eventos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Eventos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    @php
        $now = \Carbon\Carbon::now('America/Mexico_City');
        $endOfWeek = $now->copy()->endOfWeek();
        $endOfMonth = $now->copy()->endOfMonth();

        $resolveEventSubtotal = static function ($event) {
            if ((float) $event->price > 0) {
                return (float) $event->price;
            }

            return $event->packages->sum(function ($package) {
                $quantity = (int) ($package->pivot->quantity ?? 1);
                $unitPrice = (float) (($package->pivot->price ?? 0) > 0 ? $package->pivot->price : $package->price);

                return $unitPrice * max($quantity, 1);
            });
        };

        $resolveEventTotal = static function ($event) use ($resolveEventSubtotal) {
            $subtotal = $resolveEventSubtotal($event);
            $discount = (float) $event->discount;
            $discountAmount = $discount > 1 ? $discount : $subtotal * $discount;

            return max($subtotal - $discountAmount + (float) $event->travel_expenses, 0);
        };

        $eventsThisWeek = $events->filter(function ($event) use ($now, $endOfWeek) {
            $eventDate = \Carbon\Carbon::parse($event->event_date, 'America/Mexico_City');

            return $eventDate->between($now, $endOfWeek, true);
        })->count();

        $eventsThisMonth = $events->filter(function ($event) use ($now, $endOfMonth) {
            $eventDate = \Carbon\Carbon::parse($event->event_date, 'America/Mexico_City');

            return $eventDate->between($now, $endOfMonth, true);
        })->count();

        $eventsWithCrew = $events->filter(fn($event) => $event->employees->isNotEmpty())->count();
        $projectedRevenue = $events->sum(fn($event) => $resolveEventTotal($event));
        $nearestEvent = $events->first();
    @endphp

    <div class="mt-16 w-full max-w-[1600px] space-y-8 p-8">
        <section class="grid gap-6 xl:grid-cols-[minmax(0,1.45fr)_minmax(320px,0.8fr)]">
            <div class="relative overflow-hidden rounded-3xl bg-primary-800 p-8 shadow-2xl shadow-primary-900/20">
                <div class="absolute -left-12 top-10 h-40 w-40 rounded-full bg-accent/10 blur-3xl"></div>
                <div class="absolute -right-8 -top-8 h-44 w-44 rounded-full bg-secondary/10 blur-3xl"></div>
                <div class="relative">
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-secondary">Agenda Comercial</p>
                    <h2 class="mt-4 text-4xl font-bold tracking-tight text-on-primary">Calendario de espectaculos</h2>
                    <p class="mt-3 max-w-2xl text-sm leading-7 text-primary-200">
                        Organiza las contrataciones de Pirotecnia San Rafael con una vista alineada al branding del panel,
                        enfocada en clientes, fechas, paquetes y seguimiento operativo.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('events.create') }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-secondary px-5 py-3 text-sm font-bold text-on-secondary shadow-lg shadow-secondary/20 transition-all hover:bg-secondary-600 active:scale-95">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add_circle</span>
                            Crear evento
                        </a>
                        <a href="#event-schedule"
                            class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-5 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600">
                            <span class="material-symbols-outlined">calendar_month</span>
                            Ver agenda
                        </a>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl bg-gradient-to-br from-primary to-primary-700 p-8 shadow-2xl shadow-primary-900/30">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary-100">Siguiente evento</p>
                        @if ($nearestEvent)
                            <p class="mt-3 text-3xl font-bold text-on-primary">
                                {{ \Carbon\Carbon::parse($nearestEvent->event_date, 'America/Mexico_City')->locale('es')->isoFormat('D MMM') }}
                            </p>
                            <p class="mt-2 text-sm text-primary-100">
                                {{ $nearestEvent->client_name ?: 'Cliente sin nombre' }}
                            </p>
                        @else
                            <p class="mt-3 text-3xl font-bold text-on-primary">Sin agenda</p>
                            <p class="mt-2 text-sm text-primary-100">No hay eventos futuros registrados.</p>
                        @endif
                    </div>
                    <span class="material-symbols-outlined text-4xl text-secondary">celebration</span>
                </div>
                <div class="mt-8 space-y-4">
                    <div class="rounded-2xl bg-on-primary/10 p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Esta semana</p>
                        <p class="mt-2 text-lg font-semibold text-on-primary">{{ $eventsThisWeek }} eventos programados</p>
                    </div>
                    <div class="rounded-2xl bg-on-primary/10 p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Equipos asignados</p>
                        <p class="mt-2 text-lg font-semibold text-on-primary">{{ $eventsWithCrew }} eventos con personal ligado</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-2xl bg-primary-800 p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary-200">Eventos futuros</p>
                <p class="mt-4 text-3xl font-bold text-on-primary">{{ $events->count() }}</p>
                <p class="mt-2 text-sm text-primary-200">contratos activos dentro de la agenda operativa.</p>
            </article>
            <article class="rounded-2xl bg-primary-800 p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary-200">Esta semana</p>
                <p class="mt-4 text-3xl font-bold text-on-primary">{{ $eventsThisWeek }}</p>
                <p class="mt-2 text-sm text-primary-200">eventos que requieren seguimiento cercano.</p>
            </article>
            <article class="rounded-2xl bg-primary-800 p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary-200">Este mes</p>
                <p class="mt-4 text-3xl font-bold text-on-primary">{{ $eventsThisMonth }}</p>
                <p class="mt-2 text-sm text-primary-200">fechas contempladas en el cierre mensual.</p>
            </article>
            <article class="rounded-2xl bg-primary-800 p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary-200">Ingreso proyectado</p>
                <p class="mt-4 text-3xl font-bold text-on-primary">${{ number_format($projectedRevenue, 2) }}</p>
                <p class="mt-2 text-sm text-primary-200">estimado con precio, descuento y viaticos.</p>
            </article>
        </section>

        <section class="overflow-hidden rounded-3xl bg-primary-800 shadow-2xl shadow-primary-900/20" id="event-schedule">
            <div class="flex flex-col gap-4 border-b border-primary-700/60 px-8 py-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Directorio de agenda</p>
                    <h3 class="mt-2 text-2xl font-bold text-on-primary">Eventos programados</h3>
                    <p class="mt-1 text-sm text-primary-200">Consulta cliente, fecha, paquete, responsable y monto de cada contratación.</p>
                </div>
                <div class="flex flex-wrap items-center gap-3 text-xs font-semibold">
                    <span class="rounded-full border border-primary-600/60 bg-primary-700/70 px-3 py-2 text-primary-100">
                        {{ $events->count() }} en agenda
                    </span>
                    <span class="rounded-full border border-secondary/30 bg-secondary/10 px-3 py-2 text-secondary">
                        {{ $eventsThisWeek }} esta semana
                    </span>
                    <span class="rounded-full border border-accent/30 bg-accent/10 px-3 py-2 text-accent">
                        {{ $eventsWithCrew }} con equipo asignado
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-primary-700/60 bg-primary-700/40">
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-[0.24em] text-primary-200">Cliente</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-[0.24em] text-primary-200">Fecha</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-[0.24em] text-primary-200">Tipo y paquete</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-[0.24em] text-primary-200">Responsable</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-[0.24em] text-primary-200">Estatus</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-[0.24em] text-primary-200 text-right">Monto</th>
                            <th class="px-8 py-5 text-xs font-bold uppercase tracking-[0.24em] text-primary-200 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-primary-700/60">
                        @forelse ($events as $event)
                            @php
                                $eventDate = \Carbon\Carbon::parse($event->event_date, 'America/Mexico_City');
                                $packageNames = $event->packages->pluck('name')->filter()->implode(', ');
                                $responsible = $event->employees->first();
                                $eventTotal = $resolveEventTotal($event);

                                if ($eventDate->isToday()) {
                                    $statusLabel = 'Hoy';
                                    $statusBadge = 'border-warning/30 bg-warning/10 text-warning';
                                    $statusDot = 'bg-warning';
                                } elseif ($eventDate->between($now, $now->copy()->addDays(7), true)) {
                                    $statusLabel = 'Esta semana';
                                    $statusBadge = 'border-secondary/30 bg-secondary/10 text-secondary';
                                    $statusDot = 'bg-secondary';
                                } else {
                                    $statusLabel = 'Programado';
                                    $statusBadge = 'border-accent/30 bg-accent/10 text-accent';
                                    $statusDot = 'bg-accent';
                                }
                            @endphp
                            <tr class="transition-colors hover:bg-primary-700/40">
                                <td class="px-8 py-6">
                                    <div class="space-y-1">
                                        <p class="font-semibold text-on-primary">{{ $event->client_name ?: 'Cliente sin nombre' }}</p>
                                        <p class="text-sm text-primary-200">{{ $event->event_address ?: 'Sin direccion del evento' }}</p>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="space-y-1">
                                        <p class="font-semibold text-on-primary">
                                            {{ $eventDate->locale('es')->isoFormat('D MMM YYYY') }}
                                        </p>
                                        <p class="text-sm text-primary-200">{{ $eventDate->format('H:i') }} hrs</p>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="space-y-2">
                                        <span class="inline-flex rounded-full border border-primary-600/60 bg-primary-700/70 px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] text-primary-100">
                                            {{ optional($event->typeEvent)->name ?: 'Sin tipo' }}
                                        </span>
                                        <p class="max-w-sm text-sm text-primary-200">
                                            {{ $packageNames !== '' ? \Illuminate\Support\Str::limit($packageNames, 52) : ($event->products->isNotEmpty() ? 'Paquete personalizado' : 'Sin paquete asignado') }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    @if ($responsible)
                                        <div class="space-y-1">
                                            <p class="font-semibold text-on-primary">{{ $responsible->name }}</p>
                                            <p class="text-sm text-primary-200">{{ $responsible->phone ?: 'Sin telefono registrado' }}</p>
                                        </div>
                                    @else
                                        <span class="inline-flex rounded-full border border-warning/30 bg-warning/10 px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] text-warning">
                                            Sin asignar
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] {{ $statusBadge }}">
                                        <span class="h-2 w-2 rounded-full {{ $statusDot }}"></span>
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <p class="font-semibold text-on-primary">${{ number_format($eventTotal, 2) }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('events.show', $event->id) }}"
                                            class="inline-flex items-center justify-center rounded-lg p-2 text-primary-200 transition-all hover:bg-primary/10 hover:text-primary"
                                            title="Ver evento">
                                            <span class="material-symbols-outlined">visibility</span>
                                        </a>
                                        <a href="{{ route('events.edit', $event->id) }}"
                                            class="inline-flex items-center justify-center rounded-lg p-2 text-primary-200 transition-all hover:bg-secondary/10 hover:text-secondary"
                                            title="Editar evento">
                                            <span class="material-symbols-outlined">edit</span>
                                        </a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center rounded-lg p-2 text-primary-200 transition-all hover:bg-error/10 hover:text-error"
                                                onclick="return confirm('¿Deseas eliminar este evento?')"
                                                title="Eliminar evento">
                                                <span class="material-symbols-outlined">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-8 py-16 text-center">
                                    <div class="mx-auto flex max-w-md flex-col items-center">
                                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary-700 text-primary-100">
                                            <span class="material-symbols-outlined text-3xl">celebration</span>
                                        </div>
                                        <h4 class="mt-5 text-xl font-bold text-on-primary">Aun no hay eventos futuros</h4>
                                        <p class="mt-2 text-sm leading-6 text-primary-200">
                                            Empieza la agenda registrando la siguiente contratación para mantener la operación
                                            comercial y logística dentro del panel.
                                        </p>
                                        <a href="{{ route('events.create') }}"
                                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-secondary px-5 py-3 text-sm font-bold text-on-secondary transition-colors hover:bg-secondary-600">
                                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add_circle</span>
                                            Registrar primer evento
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col gap-3 border-t border-primary-700/60 px-8 py-5 text-sm text-primary-200 sm:flex-row sm:items-center sm:justify-between">
                <p>
                    Mostrando <span class="font-semibold text-on-primary">{{ $events->count() }}</span>
                    {{ \Illuminate\Support\Str::plural('evento', $events->count()) }} en esta vista.
                </p>
                <a href="{{ route('events.create') }}"
                    class="inline-flex items-center gap-2 font-semibold text-secondary transition-colors hover:text-secondary-300">
                    <span class="material-symbols-outlined text-base">add_circle</span>
                    Agregar evento
                </a>
            </div>
        </section>
    </div>
@endsection
