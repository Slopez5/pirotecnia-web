@extends('templates.adminlte')

@section('main-content')
    <div class="mx-auto mt-16 w-full max-w-[1680px] space-y-8 px-4 py-6 sm:p-8">
        <section class="grid gap-6 xl:grid-cols-[minmax(0,1.45fr)_360px]">
            <div class="relative overflow-hidden rounded-3xl bg-primary-800 p-8 shadow-2xl shadow-primary-900/20">
                <div class="absolute -left-12 top-8 h-40 w-40 rounded-full bg-accent/10 blur-3xl"></div>
                <div class="absolute -right-10 bottom-0 h-44 w-44 rounded-full bg-secondary/10 blur-3xl"></div>
                <div class="relative">
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-secondary">Ajuste Operativo</p>
                    <h2 class="mt-4 text-4xl font-bold tracking-tight text-on-primary">Editar evento</h2>
                    <p class="mt-3 max-w-2xl text-sm leading-7 text-primary-200">
                        Actualiza datos comerciales, paquetes y asignaciones del evento sin salir de la capa visual del panel.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('events.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-5 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600">
                            <span class="material-symbols-outlined">arrow_back</span>
                            Volver a eventos
                        </a>
                        <a href="{{ route('events.show', $event->id) }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-secondary px-5 py-3 text-sm font-bold text-on-secondary shadow-lg shadow-secondary/20 transition-all hover:bg-secondary-600 active:scale-95">
                            <span class="material-symbols-outlined">visibility</span>
                            Ver detalle
                        </a>
                    </div>
                </div>
            </div>

            <aside class="rounded-3xl bg-gradient-to-br from-primary to-primary-700 p-8 shadow-2xl shadow-primary-900/30">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary-100">Evento actual</p>
                        <p class="mt-3 text-2xl font-bold text-on-primary">{{ $event->client_name ?: 'Sin cliente' }}</p>
                    </div>
                    <span class="material-symbols-outlined text-4xl text-warning">edit_note</span>
                </div>
                <div class="mt-8 space-y-4">
                    <div class="rounded-2xl bg-on-primary/10 p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Fecha</p>
                        <p class="mt-2 text-sm text-on-primary">
                            {{ \Carbon\Carbon::parse($event->event_date, 'America/Mexico_City')->locale('es')->isoFormat('D MMM YYYY, HH:mm') }}
                        </p>
                    </div>
                    <div class="rounded-2xl bg-on-primary/10 p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Ubicación</p>
                        <p class="mt-2 text-sm text-on-primary">{{ $event->event_address ?: 'Sin dirección registrada' }}</p>
                    </div>
                </div>
            </aside>
        </section>

        <section class="overflow-hidden rounded-3xl bg-primary-800 shadow-2xl shadow-primary-900/20">
            <div class="border-b border-primary-700/60 px-8 py-6">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Edición Comercial</p>
                <h3 class="mt-2 text-2xl font-bold text-on-primary">Actualiza la contratación</h3>
                <p class="mt-1 text-sm text-primary-200">El formulario reutiliza el mismo flujo temático de alta.</p>
            </div>
            <div class="p-8">
                <livewire:panel.events.event-form :event="$event" />
            </div>
        </section>
    </div>
@endsection
