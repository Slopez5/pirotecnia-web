@php
    $labelClass = 'text-[11px] font-semibold uppercase tracking-[0.24em] text-primary-200';
    $inputClass =
        'w-full rounded-2xl border border-primary-600/40 bg-primary-900/70 px-4 py-3 text-sm text-on-primary placeholder:text-primary-300 transition focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/20';
    $errorClass = 'text-xs font-semibold text-secondary';
@endphp

<div class="space-y-6">
    <form class="space-y-6" wire:submit.prevent="save">
        <div class="grid gap-5 md:grid-cols-2">
            <div class="space-y-2">
                <label class="{{ $labelClass }}" for="package_name">Nombre</label>
                <input class="{{ $inputClass }}" id="package_name" placeholder="Ej. Show premium 10 minutos"
                    type="text" wire:model="name">
                @error('name')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="{{ $labelClass }}" for="experience">Experiencia</label>
                <select class="{{ $inputClass }} appearance-none" id="experience" wire:model="experience_id">
                    <option value="">Selecciona una experiencia</option>
                    @foreach ($experienceLevels as $experience)
                        <option value="{{ $experience->id }}">{{ $experience->name }}</option>
                    @endforeach
                </select>
                @error('experience_id')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="{{ $labelClass }}" for="price">Precio</label>
                <input class="{{ $inputClass }}" id="price" placeholder="$0.00" type="text" wire:model="price">
                @error('price')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="{{ $labelClass }}" for="duration">Duración</label>
                <input class="{{ $inputClass }}" id="duration" placeholder="Ej. 10 min" type="text"
                    wire:model="duration">
                @error('duration')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="{{ $labelClass }}" for="description">Descripción</label>
                <textarea class="{{ $inputClass }} min-h-28" id="description"
                    placeholder="Describe qué incluye el paquete y su propuesta comercial" wire:model="description"></textarea>
                @error('description')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="{{ $labelClass }}" for="video_url">Link del video</label>
                <input class="{{ $inputClass }}" id="video_url" placeholder="https://..." type="text"
                    wire:model="video_url">
                @error('video_url')
                    <p class="{{ $errorClass }}">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div
            class="flex flex-col gap-4 rounded-2xl border border-primary-700/60 bg-primary-900/40 p-5 sm:flex-row sm:items-center sm:justify-between">
            <p class="max-w-xl text-sm text-primary-200">
                Guarda el paquete para que aparezca de inmediato en el selector del evento actual.
            </p>
            <div class="flex flex-wrap gap-3">
                <button
                    class="inline-flex items-center gap-2 rounded-xl bg-secondary px-4 py-3 text-sm font-bold text-on-secondary transition-colors hover:bg-secondary-600"
                    type="submit">
                    <span class="material-symbols-outlined text-base">save</span>
                    Guardar paquete
                </button>
                @if ($isTabs)
                    <button
                        class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600"
                        type="button" wire:click="nextTab">
                        <span class="material-symbols-outlined text-base">arrow_forward</span>
                        Siguiente
                    </button>
                @endif
            </div>
        </div>
    </form>
</div>

@script
    <script>
        const showPackageFeedback = (title, text) => {
            if (!window.Swal) {
                return;
            }

            window.Swal.fire(title, text, 'success');
        };

        Livewire.on('packageUpdated', () => {
            showPackageFeedback('Paquete actualizado', 'El paquete ha sido actualizado correctamente.');

            @if ($isTabs)
                if (typeof window.$ === 'function') {
                    changeTab('materials');
                    localStorage.setItem('activeTab', 'materials');
                }
            @endif
        });

        Livewire.on('packageCreated', () => {
            showPackageFeedback('Paquete creado', 'El paquete ha sido creado correctamente.');

            @if ($isTabs)
                if (typeof window.$ === 'function') {
                    $('#custom-tabs-two-tab a[href="#materials"]').removeClass('disabled');
                    $('#custom-tabs-two-tab a[href="#equipments"]').removeClass('disabled');
                    changeTab('materials');
                }
            @endif
        });

        @if ($isTabs)
            Livewire.on('nextToMaterials', () => {
                if (typeof window.$ === 'function') {
                    changeTab('materials');
                    localStorage.setItem('activeTab', 'materials');
                }
            });

            function changeTab(tabId) {
                window.$('#custom-tabs-two-tab a[href="#' + tabId + '"]').tab('show');
            }
        @endif
    </script>
@endscript
