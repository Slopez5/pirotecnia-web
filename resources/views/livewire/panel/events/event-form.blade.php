@php
    $sectionClass = 'rounded-3xl border border-primary-700/60 bg-primary-900/40 p-6 shadow-soft';
    $sectionHeaderClass =
        'mb-6 flex flex-col gap-3 border-b border-primary-700/60 pb-4 lg:flex-row lg:items-start lg:justify-between';
    $labelClass = 'text-[11px] font-semibold uppercase tracking-[0.24em] text-primary-200';
    $inputClass =
        'w-full rounded-2xl border border-primary-600/40 bg-primary-900/70 px-4 py-3 text-sm text-on-primary placeholder:text-primary-300 transition focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/20';
    $textareaClass = $inputClass . ' min-h-28';
    $errorClass = 'text-xs font-semibold text-secondary';
@endphp

<div class="space-y-6">
    <div class="grid gap-4 md:grid-cols-3">
        <article class="rounded-2xl border border-primary-700/60 bg-primary-900/40 p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary-200">Modo</p>
            <p class="mt-3 text-2xl font-bold text-on-primary">{{ $isEditMode ? 'Edición' : 'Nuevo registro' }}</p>
            <p class="mt-2 text-sm text-primary-200">Flujo {{ $isEditMode ? 'de actualización' : 'de alta comercial' }}
                activo.</p>
        </article>
        <article class="rounded-2xl border border-primary-700/60 bg-primary-900/40 p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary-200">Paquetes registrados</p>
            <p class="mt-3 text-2xl font-bold text-on-primary">{{ $packages->count() }}</p>
            <p class="mt-2 text-sm text-primary-200">opciones comerciales listas para asociar.</p>
        </article>
        <article class="rounded-2xl border border-primary-700/60 bg-primary-900/40 p-5">
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary-200">Personal disponible</p>
            <p class="mt-3 text-2xl font-bold text-on-primary">{{ $employees->count() }}</p>
            <p class="mt-2 text-sm text-primary-200">colaboradores para asignar al operativo.</p>
        </article>
    </div>

    <form class="space-y-6" method="POST" wire:submit.prevent="save">
        @csrf

        <section class="{{ $sectionClass }}">
            <div class="{{ $sectionHeaderClass }}">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Cliente</p>
                    <h4 class="mt-2 text-xl font-bold text-on-primary">Datos de contacto</h4>
                </div>
                <p class="max-w-xl text-sm text-primary-200">
                    Registra la información base para identificar rápidamente al cliente y mantener trazabilidad del
                    contrato.
                </p>
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="phone">Teléfono</label>
                    <input class="{{ $inputClass }}" id="phone" placeholder="55 0000 0000" type="text"
                        wire:model="phone">
                    @error('phone')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="client_name">Nombre del cliente</label>
                    <input class="{{ $inputClass }}" id="client_name" placeholder="Ej. Juan Pérez" type="text"
                        wire:model="client_name">
                    @error('client_name')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="{{ $labelClass }}" for="client_address">Dirección del cliente</label>
                    <input class="{{ $inputClass }}" id="client_address"
                        placeholder="Calle, número, colonia y ciudad del cliente" type="text"
                        wire:model="client_address">
                    @error('client_address')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </section>

        <section class="{{ $sectionClass }}">
            <div class="{{ $sectionHeaderClass }}">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-accent">Programación</p>
                    <h4 class="mt-2 text-xl font-bold text-on-primary">Datos del evento</h4>
                </div>
                <p class="max-w-xl text-sm text-primary-200">
                    Define fecha de registro, agenda del evento y la ubicación operativa que usará el equipo.
                </p>
            </div>

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="date">Fecha de registro</label>
                    <input class="{{ $inputClass }}" id="date" type="date" wire:model="date" disabled>
                    @error('date')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="event_date">Fecha del evento</label>
                    <input class="{{ $inputClass }}" id="event_date" type="date" wire:model="event_date">
                    @error('event_date')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="event_time">Hora del evento</label>
                    <input class="{{ $inputClass }}" id="event_time" type="time" wire:model="event_time">
                    @error('event_time')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="event_type_id">Tipo de evento</label>
                    <select class="{{ $inputClass }} appearance-none" id="event_type_id"
                        wire:model.live="event_type_id">
                        <option value="">Seleccione un tipo de evento</option>
                        @foreach ($eventTypes as $eventType)
                            <option value="{{ $eventType->id }}">{{ $eventType->name }}</option>
                        @endforeach
                    </select>
                    @error('event_type_id')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2 md:col-span-2 xl:col-span-4">
                    <label class="{{ $labelClass }}" for="event_address">Dirección del evento</label>
                    <input class="{{ $inputClass }}" id="event_address"
                        placeholder="Ubicación exacta donde se montará el espectáculo" type="text"
                        wire:model="event_address">
                    @error('event_address')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </section>

        <section class="{{ $sectionClass }}">
            <div class="{{ $sectionHeaderClass }}">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-warning">Modalidad</p>
                    <h4 class="mt-2 text-xl font-bold text-on-primary">Cómo se construirá este evento</h4>
                </div>
                <p class="max-w-xl text-sm text-primary-200">
                    Elige si trabajarás con paquetes registrados o con una composición personalizada que solo viva
                    dentro de este evento.
                </p>
            </div>

            <div class="grid gap-4 xl:grid-cols-2">
                <button @class([
                    'rounded-2xl border p-6 text-left transition-all',
                    'border-secondary bg-secondary/10 shadow-lg shadow-secondary/10' =>
                        $packageMode === 'registered',
                    'border-primary-700/60 bg-primary-800/60 hover:border-primary-500/60' =>
                        $packageMode !== 'registered',
                    'cursor-not-allowed opacity-55' => $packages->isEmpty(),
                ])
                    @if ($packages->isNotEmpty()) wire:click="$set('packageMode', 'registered')" @endif
                    type="button">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Opción 1</p>
                            <h5 class="mt-2 text-lg font-bold text-on-primary">Paquete registrado</h5>
                            <p class="mt-2 text-sm leading-6 text-primary-200">
                                Usa uno o varios paquetes ya dados de alta y, si hace falta, complementa con selección
                                de materiales variables.
                            </p>
                        </div>
                        <span
                            class="material-symbols-outlined {{ $packageMode === 'registered' ? 'text-secondary' : 'text-primary-200' }}">
                            inventory_2
                        </span>
                    </div>
                    <div class="mt-5 flex flex-wrap items-center gap-3 text-xs font-semibold">
                        <span
                            class="rounded-full border border-primary-600/60 bg-primary-700/70 px-3 py-1 text-primary-100">
                            {{ $packages->count() }} disponibles
                        </span>
                        @if ($packages->isEmpty())
                            <span class="rounded-full border border-warning/30 bg-warning/10 px-3 py-1 text-warning">
                                Sin catálogo cargado
                            </span>
                        @endif
                    </div>
                </button>

                <button @class([
                    'rounded-2xl border p-6 text-left transition-all',
                    'border-accent bg-accent/10 shadow-lg shadow-accent/10' =>
                        $packageMode === 'custom',
                    'border-primary-700/60 bg-primary-800/60 hover:border-primary-500/60' =>
                        $packageMode !== 'custom',
                ]) type="button" wire:click="$set('packageMode', 'custom')">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-accent">Opción 2</p>
                            <h5 class="mt-2 text-lg font-bold text-on-primary">Paquete personalizado</h5>
                            <p class="mt-2 text-sm leading-6 text-primary-200">
                                Construye el evento agregando productos reales del catálogo. No se registrará un
                                `Package`; solo se guardará la composición del evento.
                            </p>
                        </div>
                        <span
                            class="material-symbols-outlined {{ $packageMode === 'custom' ? 'text-accent' : 'text-primary-200' }}">
                            auto_awesome_motion
                        </span>
                    </div>
                    <div class="mt-5 flex flex-wrap items-center gap-3 text-xs font-semibold">
                        <span class="rounded-full border border-accent/30 bg-accent/10 px-3 py-1 text-accent">
                            Flexible y sin catálogo
                        </span>
                        <span
                            class="rounded-full border border-primary-600/60 bg-primary-700/70 px-3 py-1 text-primary-100">
                            Guarda materiales directos
                        </span>
                    </div>
                </button>
            </div>
        </section>

        @if ($packageMode === 'registered')
            <section class="{{ $sectionClass }}">
                <div class="{{ $sectionHeaderClass }}">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-warning">Paquetes</p>
                        <h4 class="mt-2 text-xl font-bold text-on-primary">Configuración comercial</h4>
                    </div>
                    <p class="max-w-xl text-sm text-primary-200">
                        Asocia uno o varios paquetes. Si falta alguno, usa la opción de alta rápida desde el selector.
                    </p>
                </div>

                <div class="space-y-5">
                    @for ($i = 0; $i < $countPackageInputs; $i++)
                        <div class="rounded-2xl border border-primary-700/60 bg-primary-800/60 p-5">
                            <div class="grid gap-4 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end">
                                <div class="space-y-2">
                                    <label class="{{ $labelClass }}" for="package_id_{{ $i }}">Paquete
                                        {{ $i + 1 }}</label>
                                    <select class="{{ $inputClass }} appearance-none"
                                        id="package_id_{{ $i }}"
                                        wire:model.live="package_id.{{ $i }}">
                                        <option value="">Seleccione un paquete</option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}">
                                                {{ $package->name }} - ${{ number_format($package->price, 2) }}
                                            </option>
                                        @endforeach
                                        <option value="-1">Agregar paquete</option>
                                    </select>
                                    @if ($i === $countPackageInputs - 1)
                                        <p class="text-xs text-primary-200">
                                            Usa la opción <span class="font-semibold text-secondary">Agregar
                                                paquete</span> si
                                            necesitas registrarlo sin salir del evento.
                                        </p>
                                    @endif
                                    @error('package_id')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex flex-wrap gap-3 lg:justify-end">
                                    @if ($i === $countPackageInputs - 1)
                                        <button
                                            class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600"
                                            type="button" wire:click="addPackageInput">
                                            <span class="material-symbols-outlined text-base">add</span>
                                            Agregar otro
                                        </button>
                                    @elseif ($countPackageInputs > 1)
                                        <button
                                            class="inline-flex items-center gap-2 rounded-xl bg-error/10 px-4 py-3 text-sm font-semibold text-error transition-colors hover:bg-error/20"
                                            type="button" wire:click="removePackageInput({{ $i }})">
                                            <span class="material-symbols-outlined text-base">delete</span>
                                            Quitar
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </section>
        @else
            <section class="{{ $sectionClass }}">
                <div class="{{ $sectionHeaderClass }}">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-accent">Composición
                            personalizada</p>
                        <h4 class="mt-2 text-xl font-bold text-on-primary">Constructor del evento</h4>
                    </div>
                    <p class="max-w-xl text-sm text-primary-200">
                        Agrega productos reales al evento sin dar de alta un paquete formal. La composición se guardará
                        solo dentro de esta contratación.
                    </p>
                </div>

                <div class="space-y-6">
                    <div class="rounded-2xl border border-accent/30 bg-accent/10 p-5">
                        <p class="text-sm font-semibold text-accent">Flujo recomendado</p>
                        <p class="mt-2 text-sm leading-6 text-primary-100">
                            1. Busca productos por nombre.
                            2. Define una cantidad base.
                            3. Agrégalos al evento.
                            4. Captura el <span class="font-semibold">precio final</span> en la sección comercial.
                        </p>
                    </div>

                    <div class="grid gap-4 xl:grid-cols-[minmax(0,1fr)_180px]">
                        <div class="space-y-2">
                            <label class="{{ $labelClass }}" for="customProductSearch">Buscar productos</label>
                            <input class="{{ $inputClass }}" id="customProductSearch"
                                placeholder="Ej. cake, bomba, cruz del sur..." type="text"
                                wire:model.live.debounce.300ms="customProductSearch">
                        </div>
                        <div class="space-y-2">
                            <label class="{{ $labelClass }}" for="customProductQuantity">Cantidad a agregar</label>
                            <input class="{{ $inputClass }}" id="customProductQuantity" min="1"
                                type="number" wire:model.live="customProductQuantity">
                        </div>
                    </div>

                    <div class="grid gap-4 xl:grid-cols-[minmax(0,1.05fr)_minmax(320px,0.95fr)]">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-sm font-semibold text-on-primary">Catálogo de productos</p>
                                    <p class="text-xs text-primary-200">Selecciona piezas reales para construir este
                                        evento.</p>
                                </div>
                                <span
                                    class="rounded-full border border-primary-600/60 bg-primary-700/70 px-3 py-1 text-xs font-semibold text-primary-100">
                                    {{ $customCatalogProducts->count() }} visibles
                                </span>
                            </div>

                            @if ($customCatalogProducts->isNotEmpty())
                                <div class="grid gap-3 md:grid-cols-2">
                                    @foreach ($customCatalogProducts as $catalogProduct)
                                        <button
                                            class="group rounded-2xl border border-primary-700/60 bg-primary-800/60 p-4 text-left transition-all hover:border-accent/40 hover:bg-primary-900/60"
                                            type="button" wire:click="addCustomProduct({{ $catalogProduct->id }})">
                                            <div class="flex items-start justify-between gap-3">
                                                <div>
                                                    <p class="text-sm font-semibold text-on-primary">
                                                        {{ $catalogProduct->name }}</p>
                                                    @php
                                                        $descriptor = collect([
                                                            $catalogProduct->caliber
                                                                ? $catalogProduct->caliber . '"'
                                                                : null,
                                                            $catalogProduct->shots
                                                                ? $catalogProduct->shots . ' tiros'
                                                                : null,
                                                            $catalogProduct->shape ?: null,
                                                            $catalogProduct->unit ?: null,
                                                        ])
                                                            ->filter()
                                                            ->implode(' · ');
                                                    @endphp
                                                    @if ($descriptor !== '')
                                                        <p class="mt-1 text-xs text-primary-200">{{ $descriptor }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <span
                                                    class="material-symbols-outlined text-primary-200 transition group-hover:text-accent">add_circle</span>
                                            </div>
                                            <div class="mt-4 flex flex-wrap items-center gap-2 text-xs font-semibold">
                                                <span
                                                    class="rounded-full border border-primary-600/60 bg-primary-700/70 px-3 py-1 text-primary-100">
                                                    Stock
                                                    {{ $catalogProduct->inventories->first()->pivot->quantity ?? 0 }}
                                                </span>
                                                @if (isset($customSelectedIndex[$catalogProduct->id]))
                                                    <span
                                                        class="rounded-full border border-accent/30 bg-accent/10 px-3 py-1 text-accent">
                                                        Agregado x{{ $customSelectedIndex[$catalogProduct->id] }}
                                                    </span>
                                                @endif
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            @else
                                <div class="rounded-2xl border border-primary-700/60 bg-primary-800/60 p-5">
                                    <p class="text-sm font-semibold text-on-primary">Sin resultados</p>
                                    <p class="mt-2 text-sm text-primary-200">No encontré materiales con ese filtro.
                                        Prueba otro nombre o borra la búsqueda.</p>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-sm font-semibold text-on-primary">Resumen del paquete personalizado
                                    </p>
                                    <p class="text-xs text-primary-200">Edita cantidades o elimina piezas antes de
                                        guardar.</p>
                                </div>
                                <div class="flex flex-wrap gap-2 text-xs font-semibold">
                                    <span
                                        class="rounded-full border border-accent/30 bg-accent/10 px-3 py-1 text-accent">
                                        {{ $customSelectionItems->count() }} materiales
                                    </span>
                                    <span
                                        class="rounded-full border border-primary-600/60 bg-primary-700/70 px-3 py-1 text-primary-100">
                                        {{ $customSelectionItems->sum('quantity') }} piezas
                                    </span>
                                </div>
                            </div>

                            @error('customProducts')
                                <p class="{{ $errorClass }}">{{ $message }}</p>
                            @enderror

                            @if ($customSelectionItems->isNotEmpty())
                                <div class="space-y-3">
                                    @foreach ($customSelectionItems as $item)
                                        <article
                                            class="rounded-2xl border border-primary-700/60 bg-primary-800/60 p-4">
                                            <div class="flex items-start justify-between gap-4">
                                                <div>
                                                    <p class="text-sm font-semibold text-on-primary">
                                                        {{ $item['name'] }}</p>
                                                    @if ($item['descriptor'] !== '')
                                                        <p class="mt-1 text-xs text-primary-200">
                                                            {{ $item['descriptor'] }}</p>
                                                    @endif
                                                    <p class="mt-2 text-xs font-semibold text-primary-100">Stock
                                                        actual: {{ $item['stock'] }}</p>
                                                </div>
                                                <button
                                                    class="inline-flex items-center gap-2 rounded-xl bg-error/10 px-3 py-2 text-xs font-semibold text-error transition-colors hover:bg-error/20"
                                                    type="button"
                                                    wire:click="removeCustomProduct({{ $item['index'] }})">
                                                    <span class="material-symbols-outlined text-base">delete</span>
                                                    Quitar
                                                </button>
                                            </div>
                                            <div class="mt-4 grid gap-3 sm:grid-cols-[140px_auto] sm:items-end">
                                                <div class="space-y-2">
                                                    <label class="{{ $labelClass }}"
                                                        for="custom_product_qty_{{ $item['index'] }}">Cantidad</label>
                                                    <input class="{{ $inputClass }}"
                                                        id="custom_product_qty_{{ $item['index'] }}" min="1"
                                                        type="number"
                                                        wire:model.live="customProducts.{{ $item['index'] }}.quantity">
                                                </div>
                                                <p class="text-xs text-primary-200">
                                                    Esta cantidad se guardará directamente en los materiales del evento.
                                                </p>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>
                            @else
                                <div class="rounded-2xl border border-warning/30 bg-warning/10 p-5">
                                    <p class="text-sm font-semibold text-warning">Aún no hay materiales agregados</p>
                                    <p class="mt-2 text-sm text-primary-100">
                                        Usa el catálogo de la izquierda para ir agregando productos al evento antes de
                                        guardar.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="grid gap-6 2xl:grid-cols-[minmax(0,0.95fr)_minmax(0,1.05fr)]">
            <div class="{{ $sectionClass }}">
                <div class="{{ $sectionHeaderClass }}">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Operación</p>
                        <h4 class="mt-2 text-xl font-bold text-on-primary">Equipo responsable</h4>
                    </div>
                    <a class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600"
                        href="{{ route('employees.create') }}">
                        <span class="material-symbols-outlined text-base">badge</span>
                        Alta de empleado
                    </a>
                </div>

                <div class="space-y-5">
                    @for ($i = 0; $i < $countEmployeeInputs; $i++)
                        <div class="rounded-2xl border border-primary-700/60 bg-primary-800/60 p-5">
                            <div class="grid gap-4 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end">
                                <div class="space-y-2">
                                    <label class="{{ $labelClass }}"
                                        for="employee_id_{{ $i }}">Encargado {{ $i + 1 }}</label>
                                    <select class="{{ $inputClass }} appearance-none"
                                        id="employee_id_{{ $i }}"
                                        wire:model="employee_id.{{ $i }}">
                                        <option value="">Seleccione un encargado</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex flex-wrap gap-3 lg:justify-end">
                                    @if ($i === $countEmployeeInputs - 1)
                                        <button
                                            class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600"
                                            type="button" wire:click="addEmployeeInput">
                                            <span class="material-symbols-outlined text-base">add</span>
                                            Agregar otro
                                        </button>
                                    @elseif ($countEmployeeInputs > 1)
                                        <button
                                            class="inline-flex items-center gap-2 rounded-xl bg-error/10 px-4 py-3 text-sm font-semibold text-error transition-colors hover:bg-error/20"
                                            type="button" wire:click="removeEmployeeInput({{ $i }})">
                                            <span class="material-symbols-outlined text-base">delete</span>
                                            Quitar
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="{{ $sectionClass }}">
                <div class="{{ $sectionHeaderClass }}">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-accent">Condiciones</p>
                        <h4 class="mt-2 text-xl font-bold text-on-primary">Ajustes comerciales</h4>
                    </div>
                    <p class="max-w-md text-sm text-primary-200">
                        Configura descuento, anticipos y notas que complementan el cierre de la contratación.
                    </p>
                </div>

                @if ($packageMode === 'custom')
                    <div class="mb-5 rounded-2xl border border-warning/30 bg-warning/10 p-4">
                        <p class="text-sm font-semibold text-warning">Precio final requerido</p>
                        <p class="mt-2 text-sm text-primary-100">
                            Como este evento no registrará un paquete formal, el campo <span
                                class="font-semibold">Precio final</span>
                            será la referencia para agenda, contrato y métricas.
                        </p>
                    </div>
                @endif

                <div class="grid gap-5 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="discount">Descuento</label>
                        <input class="{{ $inputClass }}" id="discount" placeholder="10% o $1,500"
                            type="text" wire:model="discountString">
                        @error('discount')
                            <p class="{{ $errorClass }}">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="deposit">Anticipo</label>
                        <input class="{{ $inputClass }}" id="deposit" placeholder="$0.00" type="text"
                            wire:model="deposit">
                        @error('deposit')
                            <p class="{{ $errorClass }}">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="viatic">Viáticos</label>
                        <input class="{{ $inputClass }}" id="viatic" placeholder="$0.00" type="text"
                            wire:model="viatic">
                        @error('viatic')
                            <p class="{{ $errorClass }}">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="price">Precio final</label>
                        <input class="{{ $inputClass }}" id="price" placeholder="$0.00" type="text"
                            wire:model="price">
                        @error('price')
                            <p class="{{ $errorClass }}">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($packageMode === 'custom')
                        <div class="space-y-2 md:col-span-2">
                            <label class="{{ $labelClass }}" for="contract_description">Descripción en contrato</label>
                            <textarea class="{{ $textareaClass }}" id="contract_description"
                                placeholder="Opcional. Describe cómo debe presentarse este paquete personalizado ante el cliente en el contrato."
                                wire:model="contract_description"></textarea>
                            <p class="text-xs text-primary-200">
                                Si la capturas, el contrato mostrará esta descripción comercial en lugar del desglose
                                técnico de materiales.
                            </p>
                            @error('contract_description')
                                <p class="{{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <div class="space-y-2 md:col-span-2">
                        <label class="{{ $labelClass }}" for="notes">Notas</label>
                        <textarea class="{{ $textareaClass }}" id="notes"
                            placeholder="Observaciones, acuerdos especiales o requerimientos del cliente" wire:model="notes"></textarea>
                        @error('notes')
                            <p class="{{ $errorClass }}">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </section>

        @if ($packageMode === 'registered')
            <section class="{{ $sectionClass }}">
                <div class="{{ $sectionHeaderClass }}">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-warning">Materiales variables
                        </p>
                        <h4 class="mt-2 text-xl font-bold text-on-primary">Selección por paquete</h4>
                    </div>
                    <p class="max-w-xl text-sm text-primary-200">
                        Cuando un paquete requiera elegir materiales equivalentes, aquí podrás decidir qué producto se
                        usará.
                    </p>
                </div>

                @if (count($products))
                    <div class="space-y-4">
                        @foreach ($products as $indexProducts => $product)
                            @isset($product->pivot)
                                @for ($indexMaterial = 0; $indexMaterial < $product->pivot->quantity; $indexMaterial++)
                                    @php
                                        $selectionKey = $indexProducts . '_' . $indexMaterial;
                                    @endphp
                                    <article class="rounded-2xl border border-primary-700/60 bg-primary-800/60 p-5">
                                        <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
                                            <div>
                                                <p class="text-lg font-semibold text-on-primary">{{ $product->name }}</p>
                                                <p class="mt-1 text-sm text-primary-200">
                                                    Selecciona el material para la unidad {{ $indexMaterial + 1 }}.
                                                </p>
                                            </div>
                                            <span
                                                class="inline-flex items-center rounded-full border border-warning/30 bg-warning/10 px-3 py-1 text-xs font-bold uppercase tracking-[0.18em] text-warning">
                                                {{ $product->pivot->quantity }} requerido(s)
                                            </span>
                                        </div>

                                        <div class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-3">
                                            @foreach ($product->products as $material)
                                                <label
                                                    class="group block cursor-pointer rounded-2xl border border-primary-700/60 bg-primary-900/40 p-4 transition-all hover:border-accent/40 hover:bg-primary-900/70">
                                                    <input class="peer sr-only"
                                                        name="products-{{ $indexProducts }}-{{ $indexMaterial }}"
                                                        type="radio" value="{{ $material->id }}"
                                                        wire:key="product-option-{{ $selectionKey }}-{{ $material->id }}"
                                                        wire:model="radioSelected.{{ $selectionKey }}">
                                                    <span
                                                        class="block rounded-xl border border-transparent p-2 transition-all peer-checked:border-accent/40 peer-checked:bg-accent/10">
                                                        <span class="flex items-start justify-between gap-3">
                                                            <span>
                                                                <span class="block text-sm font-semibold text-on-primary">
                                                                    {{ $material->name }}
                                                                </span>
                                                                <span class="mt-1 block text-xs text-primary-200">
                                                                    Stock registrado:
                                                                    {{ $material->inventories->first()->pivot->quantity ?? 0 }}
                                                                </span>
                                                            </span>
                                                            <span
                                                                class="material-symbols-outlined text-primary-200 transition peer-checked:text-accent">radio_button_checked</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </article>
                                @endfor
                            @endisset
                        @endforeach
                    </div>
                @else
                    <div class="rounded-2xl border border-accent/30 bg-accent/10 p-5">
                        <p class="text-sm font-semibold text-accent">Sin variables adicionales</p>
                        <p class="mt-2 text-sm text-primary-100">
                            Los paquetes seleccionados no requieren elección manual de materiales en esta etapa.
                        </p>
                    </div>
                @endif
            </section>
        @endif

        @if (session()->has('message'))
            <div class="rounded-2xl border border-success/30 bg-success/10 p-4">
                <p class="text-sm font-semibold text-success">{{ session('message') }}</p>
            </div>
        @endif

        @if ($this->showAlert)
            <div class="rounded-2xl border border-warning/30 bg-warning/10 p-5">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div class="flex gap-3">
                        <span class="material-symbols-outlined text-warning">warning</span>
                        <div>
                            <p class="text-sm font-semibold text-warning">Confirmación requerida</p>
                            <p class="mt-1 text-sm text-primary-100">
                                {{ $this->errorMessage ?: 'Se detectó una validación pendiente antes de guardar el evento.' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <button
                            class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600"
                            type="button" wire:click="closeAlert">
                            Revisar selección
                        </button>
                        <button
                            class="inline-flex items-center gap-2 rounded-xl bg-warning px-4 py-3 text-sm font-bold text-on-warning transition-colors hover:bg-warning-400"
                            type="button" wire:click="saveAndContinue">
                            Continuar de todos modos
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <div
            class="flex flex-col gap-4 rounded-3xl border border-primary-700/60 bg-primary-800/80 p-5 backdrop-blur lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-semibold text-on-primary">
                    {{ $isEditMode ? 'Actualiza el evento cuando termines los ajustes.' : 'Guarda el evento para enviarlo a la agenda operativa.' }}
                </p>
                <p class="mt-1 text-sm text-primary-200">El registro usará la configuración actual del backend y sus
                    relaciones.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600"
                    href="{{ route('events.index') }}">
                    <span class="material-symbols-outlined text-base">close</span>
                    Cancelar
                </a>
                <button @class([
                    'inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-bold transition-all',
                    'bg-secondary text-on-secondary shadow-lg shadow-secondary/20 hover:bg-secondary-600 active:scale-95' =>
                        $this->enableSave,
                    'cursor-not-allowed bg-primary-700 text-primary-200 opacity-60' => !$this->enableSave,
                ]) @disabled(!$this->enableSave) type="submit"
                    wire:loading.attr="disabled">
                    <span class="material-symbols-outlined text-base" wire:loading.remove
                        wire:target="save,saveAndContinue">
                        save
                    </span>
                    <span wire:loading.remove wire:target="save,saveAndContinue">
                        {{ $isEditMode ? 'Actualizar evento' : 'Guardar evento' }}
                    </span>
                    <span wire:loading wire:target="save,saveAndContinue">Guardando...</span>
                </button>
            </div>
        </div>
    </form>

    <x-modal id="new-package" title="Nuevo paquete">
        <x-slot:body class="space-y-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-secondary">Alta rápida</p>
                <p class="mt-2 text-sm text-primary-200">
                    Guarda el paquete y después podrás seleccionarlo dentro del mismo evento.
                </p>
            </div>
            <livewire:panel.settings.packages.package-form :isTabs="false" />
        </x-slot:body>
    </x-modal>

    <x-modal id="new-employee" title="Nuevo encargado">
        <x-slot:body class="space-y-4">
            <p class="text-sm text-primary-200">
                El alta de empleados se administra desde el módulo correspondiente.
            </p>
            <a class="inline-flex items-center gap-2 rounded-xl bg-secondary px-4 py-3 text-sm font-bold text-on-secondary transition-colors hover:bg-secondary-600"
                href="{{ route('employees.create') }}">
                <span class="material-symbols-outlined text-base">badge</span>
                Ir a empleados
            </a>
        </x-slot:body>
    </x-modal>
</div>

@script
    <script>
        const toggleModalVisibility = (id, shouldOpen) => {
            if (!id) {
                return;
            }

            const modalElement = document.getElementById(id);

            if (!modalElement) {
                return;
            }

            modalElement.classList.toggle('hidden', !shouldOpen);
            modalElement.classList.toggle('flex', shouldOpen);
            modalElement.setAttribute('aria-hidden', shouldOpen ? 'false' : 'true');
            document.body.classList.toggle('overflow-hidden', shouldOpen);
        };

        Livewire.on('closeModal', (data) => {
            toggleModalVisibility(data[0]?.id, false);
        });

        Livewire.on('openModal', (data) => {
            toggleModalVisibility(data[0]?.id, true);
        });

        window.addEventListener('app-modal-close', (event) => {
            toggleModalVisibility(event.detail?.id, false);
        });

        window.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape') {
                return;
            }

            document.querySelectorAll('[role="dialog"]').forEach((modalElement) => {
                if (!modalElement.classList.contains('hidden')) {
                    toggleModalVisibility(modalElement.id, false);
                }
            });
        });
    </script>
@endscript
