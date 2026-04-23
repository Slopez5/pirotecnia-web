@extends('templates.adminlte')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Crear empleado</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Empleados</a></li>
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-content')
    @php
        $inputClass =
            'w-full rounded-2xl border border-primary-600/40 bg-primary-900/70 px-4 py-3 text-sm text-on-primary placeholder:text-primary-300 transition focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/20';
        $textareaClass = $inputClass . ' min-h-28';
        $labelClass = 'text-[11px] font-semibold uppercase tracking-[0.24em] text-primary-200';
        $errorClass = 'text-xs font-semibold text-secondary';
        $sectionClass = 'rounded-3xl border border-primary-700/60 bg-primary-900/40 p-6 shadow-soft';
        $levelsCount = $experienceLevels->count();
    @endphp

    <div class="mx-auto mt-16 w-full max-w-[1600px] space-y-8 px-4 py-6 sm:p-8">
        <section class="grid gap-6 xl:grid-cols-[minmax(0,1.4fr)_minmax(320px,0.86fr)]">
            <div class="relative overflow-hidden rounded-3xl bg-primary-800 p-8 shadow-2xl shadow-primary-900/20">
                <div class="absolute -left-10 top-10 h-40 w-40 rounded-full bg-secondary/10 blur-3xl"></div>
                <div class="absolute -right-10 -top-10 h-44 w-44 rounded-full bg-accent/10 blur-3xl"></div>
                <div class="relative">
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-secondary">Alta operativa</p>
                    <h2 class="mt-4 text-4xl font-bold tracking-tight text-on-primary">Registrar nuevo empleado</h2>
                    <p class="mt-3 max-w-2xl text-sm leading-7 text-primary-200">
                        Captura los datos base del colaborador para integrarlo al directorio operativo con contacto,
                        nivel de experiencia, salario y evidencia fotográfica.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('employees.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-5 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600">
                            <span class="material-symbols-outlined">arrow_back</span>
                            Volver al directorio
                        </a>
                    </div>
                </div>
            </div>

            <aside class="rounded-3xl bg-gradient-to-br from-primary to-primary-700 p-8 shadow-2xl shadow-primary-900/30">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Checklist de captura</p>
                <h3 class="mt-3 text-3xl font-bold text-on-primary">Alta mínima requerida</h3>
                <p class="mt-2 text-sm text-primary-100">
                    El backend necesita nombre, correo, teléfono y nivel de experiencia para permitir el registro.
                </p>

                <div class="mt-8 space-y-3">
                    <div class="rounded-2xl bg-on-primary/10 p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Campos obligatorios</p>
                        <p class="mt-2 text-sm font-semibold text-on-primary">Nombre, email, teléfono y nivel</p>
                    </div>
                    <div class="rounded-2xl bg-on-primary/10 p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Niveles disponibles</p>
                        <p class="mt-2 text-sm font-semibold text-on-primary">{{ $levelsCount }} configurados</p>
                    </div>
                    <div class="rounded-2xl bg-on-primary/10 p-4">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-primary-100">Foto de perfil</p>
                        <p class="mt-2 text-sm font-semibold text-on-primary">Opcional, hasta 2 MB</p>
                    </div>
                </div>
            </aside>
        </section>

        @if ($errors->any())
            <section class="rounded-3xl border border-error/30 bg-error/10 p-5 shadow-soft">
                <p class="text-sm font-semibold text-error">No se pudo guardar el empleado</p>
                <ul class="mt-3 space-y-2 text-sm text-primary-100">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </section>
        @endif

        <form action="{{ route('employees.store') }}" class="space-y-6" enctype="multipart/form-data" method="POST">
            @csrf

            <section class="grid gap-6 xl:grid-cols-[minmax(0,1.05fr)_minmax(320px,0.95fr)]">
                <div class="{{ $sectionClass }}">
                    <div class="mb-6 flex flex-col gap-3 border-b border-primary-700/60 pb-4 lg:flex-row lg:items-start lg:justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Identidad</p>
                            <h4 class="mt-2 text-xl font-bold text-on-primary">Datos del colaborador</h4>
                        </div>
                        <p class="max-w-xl text-sm text-primary-200">
                            Registra la información base para que el equipo pueda ubicar, contactar y administrar al
                            empleado desde el panel.
                        </p>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div class="space-y-2 md:col-span-2">
                            <label class="{{ $labelClass }}" for="name">Nombre completo</label>
                            <input class="{{ $inputClass }}" id="name" name="name"
                                placeholder="Ej. Juan Pérez López" type="text" value="{{ old('name') }}">
                            @error('name')
                                <p class="{{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="{{ $labelClass }}" for="email">Correo electrónico</label>
                            <input class="{{ $inputClass }}" id="email" name="email"
                                placeholder="empleado@empresa.com" type="email" value="{{ old('email') }}">
                            @error('email')
                                <p class="{{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="{{ $labelClass }}" for="phone">Teléfono</label>
                            <input class="{{ $inputClass }}" id="phone" name="phone" placeholder="55 0000 0000"
                                type="text" value="{{ old('phone') }}">
                            @error('phone')
                                <p class="{{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="{{ $labelClass }}" for="address">Dirección</label>
                            <textarea class="{{ $textareaClass }}" id="address" name="address"
                                placeholder="Calle, número, colonia y referencias">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="{{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="{{ $sectionClass }}">
                    <div class="mb-6 flex flex-col gap-3 border-b border-primary-700/60 pb-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-accent">Operación</p>
                            <h4 class="mt-2 text-xl font-bold text-on-primary">Asignación interna</h4>
                        </div>
                        <p class="text-sm text-primary-200">
                            Define el nivel de experiencia, salario base y la fotografía opcional del colaborador.
                        </p>
                    </div>

                    <div class="grid gap-5">
                        <div class="space-y-2">
                            <label class="{{ $labelClass }}" for="experience_level">Nivel de experiencia</label>
                            <select class="{{ $inputClass }} appearance-none" id="experience_level" name="experience_level">
                                <option value="">Selecciona un nivel</option>
                                @foreach ($experienceLevels as $experienceLevel)
                                    <option value="{{ $experienceLevel->id }}"
                                        @selected((string) old('experience_level') === (string) $experienceLevel->id)>
                                        {{ $experienceLevel->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('experience_level')
                                <p class="{{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="{{ $labelClass }}" for="salary">Salario</label>
                            <input class="{{ $inputClass }}" id="salary" name="salary" placeholder="$0.00"
                                type="text" value="{{ old('salary') }}">
                            @error('salary')
                                <p class="{{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="{{ $labelClass }}" for="photo">Foto de perfil</label>
                            <input class="{{ $inputClass }} file:mr-4 file:rounded-xl file:border-0 file:bg-secondary file:px-4 file:py-2 file:text-sm file:font-semibold file:text-on-secondary hover:file:bg-secondary-600"
                                accept="image/*" id="photo" name="photo" type="file">
                            <p class="text-xs text-primary-200">PNG, JPG o WEBP. Se almacenará dentro del expediente del empleado.</p>
                            @error('photo')
                                <p class="{{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </section>

            <section class="flex flex-col gap-3 rounded-3xl border border-primary-700/60 bg-primary-800 p-6 shadow-soft sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold text-on-primary">Registro listo para enviarse</p>
                    <p class="mt-1 text-sm text-primary-200">
                        Al guardar, el empleado quedará disponible en el directorio del panel.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('employees.index') }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-5 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600">
                        <span class="material-symbols-outlined text-base">close</span>
                        Cancelar
                    </a>
                    <button
                        class="inline-flex items-center gap-2 rounded-xl bg-secondary px-5 py-3 text-sm font-bold text-on-secondary shadow-lg shadow-secondary/20 transition-all hover:bg-secondary-600 active:scale-95"
                        type="submit">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">person_add</span>
                        Guardar empleado
                    </button>
                </div>
            </section>
        </form>
    </div>
@endsection
