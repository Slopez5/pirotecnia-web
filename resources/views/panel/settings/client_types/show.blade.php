@extends('templates.adminlte')

@section('main-content')
    <div class="mx-auto mt-16 w-full max-w-5xl space-y-8 px-4 py-6 sm:p-8">
        @if (session('status'))
            <div class="rounded-2xl border border-accent/20 bg-accent/10 px-5 py-4 text-sm font-semibold text-accent">
                {{ session('status') }}
            </div>
        @endif

        <div class="rounded-3xl bg-primary-800 p-8 shadow-2xl shadow-primary-900/20">
            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-secondary">Detalle</p>
            <h2 class="mt-3 text-4xl font-bold text-on-primary">{{ $clientType->name }}</h2>
            <p class="mt-2 max-w-2xl text-sm text-primary-200">{{ $clientType->description }}</p>

            <div class="mt-8 grid gap-4 sm:grid-cols-3">
                <article class="rounded-2xl bg-primary-700/60 p-4">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Ventas asociadas</p>
                    <p class="mt-3 text-3xl font-bold text-on-primary">{{ number_format($clientType->sales_count) }}</p>
                </article>
                <article class="rounded-2xl bg-primary-700/60 p-4">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Creado</p>
                    <p class="mt-3 text-xl font-bold text-on-primary">
                        {{ optional($clientType->created_at)?->locale('es')->isoFormat('D MMM YYYY') ?? '--' }}
                    </p>
                </article>
                <article class="rounded-2xl bg-primary-700/60 p-4">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-200">Estado</p>
                    <p class="mt-3 text-xl font-bold {{ $clientType->sales_count > 0 ? 'text-secondary' : 'text-warning' }}">
                        {{ $clientType->sales_count > 0 ? 'Activo' : 'Inactivo' }}
                    </p>
                </article>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <a class="inline-flex items-center gap-2 rounded-xl bg-secondary px-5 py-3 text-sm font-bold text-on-secondary transition-colors hover:bg-secondary-600"
                href="{{ route('client-types.edit', $clientType->id) }}">
                <span class="material-symbols-outlined">edit</span>
                Editar
            </a>
            <a class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-5 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600"
                href="{{ route('settings.client-types.index') }}">
                <span class="material-symbols-outlined">arrow_back</span>
                Volver al listado
            </a>
        </div>
    </div>
@endsection
