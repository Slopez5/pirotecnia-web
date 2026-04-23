@extends('templates.adminlte')

@section('main-content')
    <div class="mx-auto mt-16 w-full max-w-5xl space-y-8 px-4 py-6 sm:p-8">
        <div class="rounded-3xl bg-primary-800 p-8 shadow-2xl shadow-primary-900/20">
            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-secondary">Configuración</p>
            <h2 class="mt-3 text-4xl font-bold text-on-primary">Nuevo tipo de cliente</h2>
            <p class="mt-2 max-w-2xl text-sm text-primary-200">
                Registra una categoría para clasificar ventas y clientes dentro del panel.
            </p>
        </div>

        <form action="{{ route('client-types.store') }}" class="rounded-3xl bg-primary-800 p-8 shadow-2xl shadow-primary-900/20"
            method="POST">
            @csrf

            @include('panel.settings.client_types.partials.form')

            <div class="mt-8 flex flex-wrap gap-3">
                <button
                    class="inline-flex items-center gap-2 rounded-xl bg-secondary px-5 py-3 text-sm font-bold text-on-secondary transition-colors hover:bg-secondary-600"
                    type="submit">
                    <span class="material-symbols-outlined">save</span>
                    Guardar
                </button>
                <a class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-5 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600"
                    href="{{ route('settings.client-types.index') }}">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
