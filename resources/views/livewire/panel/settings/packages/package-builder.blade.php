@php
    $sectionClass = 'rounded-3xl border border-primary-700/60 bg-primary-800 p-6 shadow-2xl shadow-primary-900/10 sm:p-8';
    $fieldClass =
        'w-full rounded-2xl border border-primary-600/40 bg-primary-900/70 px-4 py-3 text-sm text-on-primary placeholder:text-primary-300 transition focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/20';
    $ghostButtonClass =
        'inline-flex items-center justify-center gap-2 rounded-2xl border border-primary-600/50 bg-primary-900/40 px-4 py-3 text-sm font-semibold text-primary-100 transition hover:border-primary-400/60 hover:bg-primary-900/70 hover:text-on-primary disabled:cursor-not-allowed disabled:opacity-60';
    $labelClass = 'text-xs font-bold uppercase tracking-[0.22em] text-primary-200';
    $feedbackClasses = match ($feedback['tone'] ?? null) {
        'secondary' => 'border-secondary/40 bg-secondary/10 text-secondary',
        'accent' => 'border-accent/40 bg-accent/10 text-accent',
        default => 'border-warning/40 bg-warning/10 text-warning',
    };
@endphp

<div class="mx-auto mt-16 w-full max-w-[1680px] space-y-8 px-4 py-6 sm:p-8">
    <div class="flex flex-col gap-6 xl:flex-row xl:items-end xl:justify-between">
        <div>
            <nav class="mb-3 flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-[0.24em] text-primary-200">
                <a class="transition-colors hover:text-on-primary" href="{{ route('dashboard') }}">Inicio</a>
                <span class="material-symbols-outlined text-[14px] text-primary-300">chevron_right</span>
                <a class="transition-colors hover:text-on-primary" href="{{ route('settings.index') }}">Configuración</a>
                <span class="material-symbols-outlined text-[14px] text-primary-300">chevron_right</span>
                <a class="transition-colors hover:text-on-primary" href="{{ route('settings.packages.index') }}">Paquetes</a>
                <span class="material-symbols-outlined text-[14px] text-primary-300">chevron_right</span>
                <span class="text-secondary">{{ $isEditing ? 'Editar paquete' : 'Nuevo paquete' }}</span>
            </nav>

            <h2 class="font-heading text-4xl font-extrabold tracking-tight text-on-primary sm:text-5xl">
                {{ $isEditing ? 'Editar paquete' : 'Crear nuevo paquete' }}
            </h2>
            <p class="mt-3 max-w-3xl text-sm leading-7 text-primary-200">
                {{ $isEditing
                    ? 'Actualiza la ficha comercial, los insumos y el equipamiento del paquete desde la misma pantalla.'
                    : 'Captura la ficha comercial, asigna materiales y equipamiento desde una sola pantalla y guarda el paquete con datos reales del catálogo.' }}
            </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap xl:justify-end">
            <a class="{{ $ghostButtonClass }}" href="{{ route('settings.packages.index') }}">
                <span class="material-symbols-outlined text-base">close</span>
                Cancelar
            </a>
            <button class="{{ $ghostButtonClass }}" type="button" wire:click="saveDraft" wire:loading.attr="disabled">
                <span class="material-symbols-outlined text-base">draft</span>
                {{ $isEditing ? 'Guardar cambios' : 'Guardar borrador' }}
            </button>
            <button
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-secondary px-6 py-3 text-sm font-bold text-on-secondary shadow-lg shadow-secondary/20 transition hover:bg-secondary-600 disabled:cursor-not-allowed disabled:opacity-60"
                type="button" wire:click="savePackage" wire:loading.attr="disabled">
                <span class="material-symbols-outlined text-base">save</span>
                {{ $isEditing ? 'Actualizar paquete' : 'Guardar paquete' }}
            </button>
        </div>
    </div>

    @if ($feedback)
        <div class="rounded-2xl border px-5 py-4 {{ $feedbackClasses }}">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined mt-0.5 text-lg">campaign</span>
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.2em]">{{ $feedback['title'] }}</p>
                    <p class="mt-1 text-sm leading-6 text-primary-100">{{ $feedback['text'] }}</p>
                </div>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-2xl border border-error/40 bg-error/10 px-5 py-4 text-sm text-primary-100">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined mt-0.5 text-lg text-error">warning</span>
                <div class="space-y-1">
                    <p class="font-bold uppercase tracking-[0.2em] text-error">Hay datos pendientes</p>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-12 gap-8 items-start">
        <div class="col-span-12 space-y-8 lg:col-span-8">
            <section class="{{ $sectionClass }}">
                <div class="mb-8 flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-secondary/15 text-secondary">
                        <span class="material-symbols-outlined">info</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-primary-200">Ficha base</p>
                        <h3 class="font-heading text-2xl font-bold text-on-primary">Datos Generales</h3>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="package-name">Nombre del paquete</label>
                        <input class="{{ $fieldClass }}" id="package-name" type="text"
                            placeholder="Paquete Explosión Dorada" wire:model.live="name" />
                    </div>

                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="package-code">Clave (ID)</label>
                        <input class="{{ $fieldClass }} cursor-not-allowed opacity-80" id="package-code" readonly
                            type="text" value="{{ $packageCode }}" />
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="{{ $labelClass }}" for="package-description">Descripción</label>
                        <textarea class="{{ $fieldClass }}" id="package-description" rows="4"
                            placeholder="Describe el enfoque comercial y operativo del paquete."
                            wire:model.live="description"></textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="package-event-type">Tipo de evento</label>
                        <select class="{{ $fieldClass }}" id="package-event-type" wire:model.live="event_type_id">
                            <option value="">Selecciona un tipo</option>
                            @foreach ($this->eventTypes as $eventType)
                                <option value="{{ $eventType->id }}">{{ $eventType->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="space-y-2">
                            <label class="{{ $labelClass }}" for="package-duration">Duración (min)</label>
                            <input class="{{ $fieldClass }}" id="package-duration" min="1" step="1"
                                type="number" wire:model.live="duration" />
                        </div>
                        <div class="space-y-2">
                            <label class="{{ $labelClass }}">Estatus</label>
                            <div class="flex h-[52px] items-center">
                                <span class="rounded-full border px-4 py-1.5 text-xs font-bold uppercase tracking-[0.18em] {{ $statusMeta['classes'] }}">
                                    {{ $statusMeta['label'] }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="{{ $labelClass }}" for="package-video-url">Video de referencia</label>
                        <input class="{{ $fieldClass }}" id="package-video-url" type="url"
                            placeholder="https://youtube.com/..." wire:model.blur="video_url" />
                    </div>
                </div>
            </section>

            <section class="{{ $sectionClass }}">
                <div class="mb-8 flex flex-col gap-4 xl:flex-row xl:items-start xl:justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-accent/15 text-accent">
                            <span class="material-symbols-outlined">inventory_2</span>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-primary-200">Catálogo vinculado</p>
                            <h3 class="font-heading text-2xl font-bold text-on-primary">Productos Incluidos</h3>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a class="{{ $ghostButtonClass }}" href="{{ route('products.create') }}">
                            <span class="material-symbols-outlined text-base">add_circle</span>
                            Crear nuevo producto
                        </a>
                        <button
                            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-accent px-4 py-3 text-sm font-bold text-on-accent shadow-lg shadow-accent/20 transition hover:bg-accent-600 disabled:cursor-not-allowed disabled:opacity-60"
                            type="button" wire:click="addMaterial" wire:loading.attr="disabled">
                            <span class="material-symbols-outlined text-base">add</span>
                            Agregar producto
                        </button>
                    </div>
                </div>

                <div class="mb-6 grid gap-4 md:grid-cols-[minmax(0,1fr)_160px]">
                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="material-select">Producto o material</label>
                        <select class="{{ $fieldClass }}" id="material-select" wire:model.live="selected_material_id">
                            <option value="">Selecciona un insumo</option>
                            @foreach ($this->products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->name }}
                                    @if ($product->caliber)
                                        · Cal. {{ $product->caliber }}
                                    @endif
                                    @if ($product->product_role_id == 2)
                                        · Material
                                    @else
                                        · Producto
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if ($selectedMaterial?->caliber)
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-accent">
                                Calibre seleccionado: {{ $selectedMaterial->caliber }}
                            </p>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="material-quantity">Cantidad</label>
                        <input class="{{ $fieldClass }}" id="material-quantity" min="1" step="0.01"
                            type="number" wire:model.live="selected_material_quantity" />
                    </div>
                </div>

                @if ($materialRows->isEmpty())
                    <div class="rounded-2xl border border-dashed border-primary-600/50 bg-primary-900/30 px-6 py-10 text-center">
                        <span class="material-symbols-outlined text-4xl text-primary-300">inventory</span>
                        <p class="mt-4 text-lg font-bold text-on-primary">Aún no hay productos en el paquete</p>
                        <p class="mx-auto mt-2 max-w-2xl text-sm leading-6 text-primary-200">
                            Selecciona un producto del catálogo y agrégalo. Si todavía no existe, puedes darlo de alta
                            desde el acceso rápido y volver al flujo.
                        </p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="responsive-stack-table responsive-stack-table-dark min-w-[760px] w-full text-left">
                            <thead>
                                <tr class="border-b border-primary-700/60 bg-primary-900/40 text-[11px] uppercase tracking-[0.22em] text-primary-200">
                                    <th class="px-4 py-4 font-bold">Producto</th>
                                    <th class="px-4 py-4 font-bold text-center">Cantidad</th>
                                    <th class="px-4 py-4 font-bold text-center">Unidad</th>
                                    <th class="px-4 py-4 font-bold text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materialRows as $row)
                                    <tr class="border-b border-primary-700/40 align-top text-sm text-primary-100" wire:key="package-material-{{ $row['id'] }}">
                                        <td class="px-4 py-5">
                                            <div class="space-y-2">
                                                <div class="flex flex-wrap items-center gap-3">
                                                    <p class="font-semibold text-on-primary">{{ $row['name'] }}</p>
                                                    <span class="rounded-full border border-accent/30 bg-accent/10 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.18em] text-accent">
                                                        {{ $row['typeLabel'] }}
                                                    </span>
                                                    @if ($row['caliber'])
                                                        <span class="rounded-full border border-warning/30 bg-warning/10 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.18em] text-warning">
                                                            Cal. {{ $row['caliber'] }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <p class="text-xs leading-5 text-primary-200">{{ $row['detail'] }}</p>
                                            </div>
                                        </td>
                                        <td class="px-4 py-5 text-center">
                                            <input class="w-24 rounded-xl border border-primary-600/40 bg-primary-900/70 px-3 py-2 text-center text-sm text-on-primary focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/20"
                                                min="1" step="0.01" type="number"
                                                value="{{ $row['quantity'] }}"
                                                wire:change="updateMaterialQuantity({{ $row['id'] }}, $event.target.value)" />
                                        </td>
                                        <td class="px-4 py-5 text-center text-primary-200">{{ $row['unit'] }}</td>
                                        <td class="px-4 py-5 text-right">
                                            <button
                                                class="inline-flex items-center justify-center rounded-xl border border-error/30 bg-error/10 p-2 text-error transition hover:bg-error/20"
                                                type="button" wire:click="removeMaterial({{ $row['id'] }})">
                                                <span class="material-symbols-outlined text-base">delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>

            <section class="{{ $sectionClass }}">
                <div class="mb-8 flex flex-col gap-4 xl:flex-row xl:items-start xl:justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-warning/15 text-warning">
                            <span class="material-symbols-outlined">construction</span>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-primary-200">Soporte técnico</p>
                            <h3 class="font-heading text-2xl font-bold text-on-primary">Equipamiento Requerido</h3>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a class="{{ $ghostButtonClass }}" href="{{ route('equipments.create') }}">
                            <span class="material-symbols-outlined text-base">add_circle</span>
                            Crear nuevo equipamiento
                        </a>
                        <button
                            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-warning px-4 py-3 text-sm font-bold text-on-warning shadow-lg shadow-warning/20 transition hover:bg-warning-600 disabled:cursor-not-allowed disabled:opacity-60"
                            type="button" wire:click="addEquipment" wire:loading.attr="disabled">
                            <span class="material-symbols-outlined text-base">add</span>
                            Agregar equipo
                        </button>
                    </div>
                </div>

                <div class="mb-6 grid gap-4 md:grid-cols-[minmax(0,1fr)_160px]">
                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="equipment-select">Equipamiento</label>
                        <select class="{{ $fieldClass }}" id="equipment-select" wire:model.live="selected_equipment_id">
                            <option value="">Selecciona un equipo</option>
                            @foreach ($this->equipments as $equipment)
                                <option value="{{ $equipment->id }}">{{ $equipment->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="equipment-quantity">Cantidad</label>
                        <input class="{{ $fieldClass }}" id="equipment-quantity" min="1" step="0.01"
                            type="number" wire:model.live="selected_equipment_quantity" />
                    </div>
                </div>

                <div class="space-y-3">
                    @forelse ($equipmentRows as $row)
                        <div class="flex flex-col gap-4 rounded-2xl border border-primary-700/60 bg-primary-900/40 p-4 sm:flex-row sm:items-center sm:justify-between"
                            wire:key="package-equipment-{{ $row['id'] }}">
                            <div class="flex min-w-0 items-center gap-4">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-primary-900 text-primary-200">
                                    <span class="material-symbols-outlined">settings_input_component</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="truncate font-semibold text-on-primary">{{ $row['name'] }}</p>
                                    <p class="mt-1 text-xs leading-5 text-primary-200">{{ $row['description'] }}</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-primary-200">Cant.</span>
                                    <input class="w-24 rounded-xl border border-primary-600/40 bg-primary-900/70 px-3 py-2 text-center text-sm text-on-primary focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/20"
                                        min="1" step="0.01" type="number"
                                        value="{{ $row['quantity'] }}"
                                        wire:change="updateEquipmentQuantity({{ $row['id'] }}, $event.target.value)" />
                                    <span class="text-xs text-primary-200">{{ $row['unit'] }}</span>
                                </div>
                                <button
                                    class="inline-flex items-center justify-center rounded-xl border border-error/30 bg-error/10 p-2 text-error transition hover:bg-error/20"
                                    type="button" wire:click="removeEquipment({{ $row['id'] }})">
                                    <span class="material-symbols-outlined text-base">close</span>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-primary-600/50 bg-primary-900/30 px-6 py-10 text-center">
                            <span class="material-symbols-outlined text-4xl text-primary-300">construction</span>
                            <p class="mt-4 text-lg font-bold text-on-primary">Aún no hay equipo asignado</p>
                            <p class="mx-auto mt-2 max-w-2xl text-sm leading-6 text-primary-200">
                                Vincula el equipamiento técnico que este show necesita para operación y montaje.
                            </p>
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="{{ $sectionClass }}">
                <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-secondary/15 text-secondary">
                            <span class="material-symbols-outlined">military_tech</span>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-primary-200">Perfil operativo</p>
                            <h3 class="font-heading text-2xl font-bold text-on-primary">Nivel de Experiencia</h3>
                        </div>
                    </div>

                    <a class="inline-flex items-center gap-2 text-sm font-bold text-secondary transition hover:text-secondary-300"
                        href="{{ route('experience-levels.create') }}">
                        <span class="material-symbols-outlined text-base">add</span>
                        Crear nuevo nivel
                    </a>
                </div>

                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($this->experienceLevels as $level)
                        @php
                            $isActive = (string) $experience_id === (string) $level->id;
                        @endphp
                        <button
                            class="{{ $isActive ? 'border-secondary bg-secondary/10 text-on-primary' : 'border-primary-700/60 bg-primary-900/40 text-primary-100 hover:border-primary-400/60 hover:bg-primary-900/70' }} rounded-2xl border p-5 text-left transition-all"
                            type="button" wire:click="$set('experience_id', '{{ $level->id }}')">
                            <p class="font-bold {{ $isActive ? 'text-secondary' : 'text-on-primary' }}">{{ $level->name }}</p>
                            <p class="mt-2 text-xs leading-5 text-primary-200">
                                {{ $level->description ?: 'Nivel disponible para asignar a este paquete.' }}
                            </p>
                        </button>
                    @endforeach
                </div>
            </section>

            <section class="{{ $sectionClass }}">
                <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-warning/15 text-warning">
                            <span class="material-symbols-outlined">payments</span>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-primary-200">Condiciones comerciales</p>
                            <h3 class="font-heading text-2xl font-bold text-on-primary">Precios y Vigencias</h3>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-primary-700/60 bg-primary-900/30 px-4 py-3 text-xs leading-5 text-primary-200">
                        El historial mostrado aquí representa el precio actual que quedará registrado con el paquete.
                    </div>
                </div>

                <div class="mb-10 grid gap-6 md:grid-cols-3">
                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="package-price">Precio actual (MXN)</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-primary-300">$</span>
                            <input class="{{ $fieldClass }} pl-8" id="package-price" type="text"
                                placeholder="45000.00" wire:model.live="price" />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="package-valid-from">Fecha inicio</label>
                        <input class="{{ $fieldClass }}" id="package-valid-from" type="date"
                            wire:model.live="valid_from" />
                    </div>

                    <div class="space-y-2">
                        <label class="{{ $labelClass }}" for="package-valid-until">Fecha fin</label>
                        <input class="{{ $fieldClass }}" id="package-valid-until" type="date"
                            wire:model.live="valid_until" />
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center justify-between gap-4">
                        <h4 class="text-xs font-bold uppercase tracking-[0.22em] text-primary-200">Historial de Precios</h4>
                        <span class="text-xs text-primary-300">Sin versionado histórico adicional por ahora</span>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-primary-700/60 bg-primary-900/30">
                        <table class="responsive-stack-table responsive-stack-table-dark w-full text-left text-sm">
                            <thead>
                                <tr class="border-b border-primary-700/60 bg-primary-900/50 text-[11px] uppercase tracking-[0.22em] text-primary-200">
                                    <th class="px-4 py-4 font-bold">Versión</th>
                                    <th class="px-4 py-4 font-bold">Precio</th>
                                    <th class="px-4 py-4 font-bold">Vigencia</th>
                                    <th class="px-4 py-4 font-bold">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($priceHistoryRows as $row)
                                    <tr class="border-b border-primary-700/40 text-primary-100">
                                        <td class="px-4 py-4 font-semibold text-on-primary">{{ $row['version'] }}</td>
                                        <td class="px-4 py-4 font-bold text-on-primary">{{ $row['price'] }}</td>
                                        <td class="px-4 py-4 text-primary-200">{{ $row['validity'] }}</td>
                                        <td class="px-4 py-4">
                                            <span class="rounded-full border px-3 py-1 text-[10px] font-bold uppercase tracking-[0.18em] {{ $row['status']['classes'] }}">
                                                {{ $row['status']['label'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-4 py-6 text-sm text-primary-200" colspan="4">
                                            Captura un precio para generar el snapshot comercial inicial de este paquete.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-span-12 lg:col-span-4">
            <div class="space-y-8 lg:sticky lg:top-24">
                <div class="overflow-hidden rounded-3xl border border-primary-700/60 bg-primary-800 shadow-2xl shadow-primary-900/20">
                    <div class="border-b border-primary-700/60 bg-primary-900/40 px-6 py-5">
                        <h3 class="font-heading text-xl font-bold text-on-primary">Resumen de Paquete</h3>
                    </div>
                    <div class="space-y-8 p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm text-primary-200">Nombre:</span>
                                <span class="max-w-[220px] truncate text-right font-semibold text-on-primary">{{ $summary['name'] }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm text-primary-200">Total productos:</span>
                                <span class="font-semibold text-on-primary">
                                    {{ number_format($summary['materialCount']) }} ítems
                                </span>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm text-primary-200">Unidades programadas:</span>
                                <span class="font-semibold text-on-primary">
                                    {{ rtrim(rtrim(number_format($summary['materialUnits'], 2, '.', ''), '0'), '.') ?: '0' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm text-primary-200">Total equipo:</span>
                                <span class="font-semibold text-on-primary">
                                    {{ number_format($summary['equipmentCount']) }} equipos
                                </span>
                            </div>
                            <div class="border-t border-primary-700/60 pt-4">
                                <div class="flex items-end justify-between gap-4">
                                    <span class="text-sm text-primary-200">Precio actual:</span>
                                    <span class="font-heading text-3xl font-black text-secondary">{{ $summary['formattedPrice'] }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-xs font-bold uppercase tracking-[0.22em] text-primary-200">Validación de captura</h4>
                            <div class="space-y-3">
                                @foreach ($validationItems as $item)
                                    <div class="flex items-start gap-3">
                                        <span class="material-symbols-outlined mt-0.5 text-lg {{ $item['passed'] ? 'text-accent' : 'text-warning' }}"
                                            style="font-variation-settings: 'FILL' 1;">
                                            {{ $item['passed'] ? 'check_circle' : 'warning' }}
                                        </span>
                                        <span class="text-sm leading-6 {{ $item['passed'] ? 'text-on-primary' : 'text-primary-200 italic' }}">
                                            {{ $item['label'] }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="space-y-3 rounded-2xl border border-primary-700/60 bg-primary-900/40 p-4">
                            <p class="text-xs font-bold uppercase tracking-[0.22em] text-primary-200">Lectura rápida</p>
                            <div class="space-y-2 text-sm leading-6 text-primary-100">
                                <p>
                                    Tipo:
                                    <span class="font-semibold text-on-primary">
                                        {{ $selectedEventType?->name ?: 'Sin tipo asignado' }}
                                    </span>
                                </p>
                                <p>
                                    Experiencia:
                                    <span class="font-semibold text-on-primary">
                                        {{ $selectedExperience?->name ?: 'Pendiente de definir' }}
                                    </span>
                                </p>
                                <p>
                                    Estado:
                                    <span class="font-semibold text-on-primary">{{ $summary['status'] }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button
                                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-primary px-6 py-4 text-sm font-black uppercase tracking-[0.22em] text-on-primary shadow-xl shadow-primary-900/20 transition hover:bg-primary-600 disabled:cursor-not-allowed disabled:opacity-60"
                                type="button" wire:click="finalizePackage" wire:loading.attr="disabled">
                                <span class="material-symbols-outlined text-base">task_alt</span>
                                {{ $isEditing ? 'Guardar y ver detalle' : 'Finalizar Paquete' }}
                            </button>
                            <p class="mt-4 text-center text-xs leading-5 text-primary-200">
                                {{ $isEditing
                                    ? 'Al guardar, se conservan los cambios y se redirige al detalle del paquete.'
                                    : 'Al finalizar, el paquete queda listo para operar y se redirige al detalle del registro.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-3xl border border-primary-700/60 bg-gradient-to-br from-primary via-primary-700 to-primary-900 p-6 shadow-2xl shadow-primary-900/20">
                    <div class="absolute -right-10 top-0 h-32 w-32 rounded-full bg-secondary/20 blur-3xl"></div>
                    <div class="absolute -left-8 bottom-0 h-28 w-28 rounded-full bg-accent/20 blur-3xl"></div>

                    <div class="relative">
                        <p class="text-[11px] font-bold uppercase tracking-[0.32em] text-secondary">Vista Previa</p>
                        <h4 class="mt-3 font-heading text-2xl font-bold text-on-primary">Simulación de Espectáculo</h4>
                        <p class="mt-3 text-sm leading-6 text-primary-100">
                            La ficha comercial, el inventario programado y el equipamiento técnico quedarán consolidados
                            en el detalle del paquete.
                        </p>

                        <div class="mt-6 flex h-40 items-end rounded-2xl border border-primary-600/50 bg-primary-900/40 p-5">
                            <div class="flex items-center gap-3">
                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-secondary text-on-secondary">
                                    <span class="material-symbols-outlined">celebration</span>
                                </div>
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-primary-200">Paquete listo</p>
                                    <p class="font-semibold text-on-primary">{{ $summary['name'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
