@php
    $labelClass = 'text-[11px] font-semibold uppercase tracking-[0.24em] text-primary-200';
    $inputClass =
        'w-full rounded-2xl border border-primary-600/40 bg-primary-900/70 px-4 py-3 text-sm text-on-primary placeholder:text-primary-300 transition focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/20';
    $errorClass = 'text-xs font-semibold text-secondary';
@endphp

<div class="space-y-6">
    @if (!$package)
        <div class="rounded-3xl border border-primary-700/60 bg-primary-900/30 p-6">
            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-secondary">Paso pendiente</p>
            <h4 class="mt-3 text-xl font-bold text-on-primary">Guarda primero el paquete</h4>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-primary-200">
                El equipamiento se puede asociar cuando el paquete ya fue creado. Una vez guardado el paso inicial,
                esta tab queda disponible automáticamente.
            </p>
        </div>
    @else
        <form class="space-y-6" wire:submit.prevent="save">
            <div class="grid gap-5 lg:grid-cols-[minmax(0,1fr)_200px]">
                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="equipment_id">Equipo</label>
                    <select class="{{ $inputClass }} appearance-none" id="equipment_id" wire:model="equipment_id">
                        <option value="">Seleccione un equipo</option>
                        @foreach ($equipments as $equipment)
                            <option value="{{ $equipment->id }}">{{ $equipment->name }}</option>
                        @endforeach
                    </select>
                    @error('equipment_id')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="{{ $labelClass }}" for="quantity">Cantidad</label>
                    <input class="{{ $inputClass }}" id="quantity" min="1" type="number" wire:model="quantity">
                    @error('quantity')
                        <p class="{{ $errorClass }}">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div
                class="flex flex-col gap-4 rounded-2xl border border-primary-700/60 bg-primary-900/40 p-5 sm:flex-row sm:items-center sm:justify-between">
                <p class="max-w-xl text-sm text-primary-200">
                    Vincula el equipo operativo indispensable para montar el paquete y deja cerrada su preparación desde
                    esta misma alta.
                </p>
                <div class="flex flex-wrap gap-3">
                    <button
                        class="inline-flex items-center gap-2 rounded-xl bg-secondary px-4 py-3 text-sm font-bold text-on-secondary transition-colors hover:bg-secondary-600"
                        type="submit">
                        <span class="material-symbols-outlined text-base">add_circle</span>
                        Guardar equipo
                    </button>
                    <button
                        class="inline-flex items-center gap-2 rounded-xl bg-primary-700 px-4 py-3 text-sm font-semibold text-on-primary transition-colors hover:bg-primary-600"
                        type="button" wire:click="finish">
                        <span class="material-symbols-outlined text-base">check_circle</span>
                        Finalizar
                    </button>
                </div>
            </div>
        </form>

        <section class="overflow-hidden rounded-3xl bg-primary-800 shadow-2xl shadow-primary-900/10">
            <div class="flex flex-col gap-3 border-b border-primary-700/60 px-6 py-6 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-secondary">Preparación técnica</p>
                    <h4 class="mt-3 text-xl font-bold text-on-primary">Equipamiento vinculado</h4>
                </div>
                <div class="rounded-full border border-primary-700/60 bg-primary-900/30 px-4 py-2 text-sm text-primary-200">
                    {{ $equipmentsInPackage ? number_format($equipmentsInPackage->total()) : 0 }} registros
                </div>
            </div>

            <div class="overflow-x-auto">
                @isset($equipmentsInPackage)
                    <table class="responsive-stack-table responsive-stack-table-dark min-w-full text-left">
                        <thead>
                            <tr class="border-b border-primary-700/60 bg-primary-900/40">
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-[0.22em] text-primary-200">
                                    Equipo
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-[0.22em] text-primary-200">
                                    Cantidad
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-[0.22em] text-primary-200">
                                    Unidad
                                </th>
                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-[0.22em] text-primary-200">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-primary-700/40">
                            @forelse ($equipmentsInPackage as $equipment)
                                <tr class="transition-colors hover:bg-primary-700/20">
                                    <td class="px-6 py-5" data-label="Equipo">
                                        <p class="font-semibold text-on-primary">{{ $equipment->name }}</p>
                                        <p class="mt-1 text-xs text-primary-200">
                                            {{ $equipment->description ?: 'Sin descripción adicional.' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-5 text-center text-sm font-semibold text-on-primary" data-label="Cantidad">
                                        {{ $equipment->pivot->quantity }}
                                    </td>
                                    <td class="px-6 py-5 text-center text-sm text-primary-200" data-label="Unidad">
                                        {{ $equipment->unit ?: 'Pza' }}
                                    </td>
                                    <td class="px-6 py-5 text-right" data-label="Acciones">
                                        <button
                                            class="inline-flex items-center justify-center rounded-xl bg-error/10 p-2.5 text-error transition-colors hover:bg-error/20"
                                            type="button" wire:click="removeequipment({{ $equipment->id }})">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-8 text-sm text-primary-200" colspan="4">
                                        Aún no hay equipamiento agregado a este paquete.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if ($equipmentsInPackage->hasPages())
                        <div class="border-t border-primary-700/60 px-6 py-4">
                            {{ $equipmentsInPackage->links() }}
                        </div>
                    @endif
                @endisset
            </div>
        </section>
    @endif
</div>

@script
    <script>
        Livewire.on('confirmDeleteequipment', (request) => {
            const styles = getComputedStyle(document.documentElement);
            const secondary = styles.getPropertyValue('--color-secondary').trim() || '#E40D81';
            const error = styles.getPropertyValue('--color-error').trim() || '#BA1A1A';

            Swal.fire({
                title: '¿Deseas eliminar ' + request.name + '?',
                text: 'No podrás revertir esto.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: secondary,
                cancelButtonColor: error,
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteequipment', {
                        equipmentId: request.id
                    });
                }
            });
        });
    </script>
@endscript
