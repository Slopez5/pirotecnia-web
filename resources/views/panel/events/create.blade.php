@extends('templates.adminlte')

@section('main-content')
    <div class="mx-auto mt-16 w-full max-w-[1680px] space-y-8 px-4 py-6 sm:p-8">
        <header class="overflow-hidden rounded-3xl bg-primary-800 p-6 shadow-2xl shadow-primary-900/20">
            <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
                <div class="max-w-3xl">
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-secondary">Alta Operativa</p>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-on-primary">Crear nuevo evento</h2>
                    <p class="mt-2 text-sm leading-6 text-primary-200">
                        Registra la contratación y captura cliente, agenda, composición del evento y seguimiento comercial.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('events.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-5 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Volver a eventos
                    </a>
                    <a href="#event-form-shell"
                        class="inline-flex items-center gap-2 rounded-xl bg-secondary px-5 py-3 text-sm font-bold text-on-secondary shadow-lg shadow-secondary/20 transition-all hover:bg-secondary-600 active:scale-95">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">edit_calendar</span>
                        Capturar contratación
                    </a>
                </div>
            </div>

            <div class="mt-5 grid gap-3 md:grid-cols-3">
                <div class="rounded-2xl border border-primary-700/60 bg-primary-900/30 px-4 py-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Cliente</p>
                    <p class="mt-1 text-sm text-on-primary">Nombre, teléfono y dirección de contacto.</p>
                </div>
                <div class="rounded-2xl border border-primary-700/60 bg-primary-900/30 px-4 py-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Operación</p>
                    <p class="mt-1 text-sm text-on-primary">Fecha, hora, ubicación y personal asignado.</p>
                </div>
                <div class="rounded-2xl border border-primary-700/60 bg-primary-900/30 px-4 py-3">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Comercial</p>
                    <p class="mt-1 text-sm text-on-primary">Paquetes, anticipo, viáticos, descuento y notas.</p>
                </div>
            </div>
        </header>

        <section class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_320px]" id="event-form-shell">
            <div class="overflow-hidden rounded-3xl bg-primary-800 shadow-2xl shadow-primary-900/20">
                <div class="border-b border-primary-700/60 px-8 py-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Registro Comercial</p>
                    <h3 class="mt-2 text-2xl font-bold text-on-primary">Captura del evento</h3>
                    <p class="mt-1 text-sm text-primary-200">
                        El formulario ya está conectado al backend. Solo ajusta la información y guarda.
                    </p>
                </div>
                <div class="p-8">
                    <livewire:panel.events.event-form />
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl bg-primary-800 p-6 shadow-2xl shadow-primary-900/20">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-accent">Recomendación</p>
                    <h4 class="mt-3 text-xl font-bold text-on-primary">Da de alta paquetes sin salir</h4>
                    <p class="mt-3 text-sm leading-7 text-primary-200">
                        Dentro del selector de paquetes puedes usar la opción para agregar uno nuevo y volver al evento.
                    </p>
                </div>
                <div class="rounded-3xl bg-primary-800 p-6 shadow-2xl shadow-primary-900/20">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-warning">Seguimiento</p>
                    <h4 class="mt-3 text-xl font-bold text-on-primary">Después del guardado</h4>
                    <p class="mt-3 text-sm leading-7 text-primary-200">
                        El evento aparecerá en la agenda, el dashboard y el calendario operativo del panel.
                    </p>
                </div>
            </aside>
        </section>
    </div>
@endsection
