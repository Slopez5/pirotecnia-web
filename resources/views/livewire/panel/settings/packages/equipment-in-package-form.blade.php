<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="equipment_id">Equipo</label>
            <select class="form-control" id="equipment_id" wire:model="equipment_id">
                <option value="">Seleccione un equipo</option>
                @foreach ($equipments as $equipment)
                    <option value="{{ $equipment->id }}">{{ $equipment->name }}</option>
                @endforeach
            </select>
            @error('equipment_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        {{-- Quantity with default 1 --}}
        <div class="form-group">
            <label for="quantity">Cantidad</label>
            <input type="number" class="form-control" id="quantity" wire:model="quantity" value="1">
            @error('quantity')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="row justify-content-between">
            <div class="col">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            <div class="col text-end">
                <button type="button" class="btn btn-success" wire:click="finish">Finalizar</button>
            </div>
        </div>

    </form>
    {{-- spacer --}}
    <div class="mb-3"></div>

    {{-- Table with equipments in Package the table has max height --}}
    <div class="table-responsive">
        @isset($equipmentsInPackage)

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Equipo</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipmentsInPackage as $equipment)
                        <tr>
                            <td>{{ $equipment->name }}</td>
                            <td>{{ $equipment->pivot->quantity }}</td>
                            <td>
                                {{-- icon trash --}}
                                <button class="btn btn-danger" wire:click="removeequipment({{ $equipment->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            {{-- Pagination --}}
                            {{ $equipmentsInPackage->links('vendor.pagination.bootstrap-4') }}
                        </td>
                    </tr>
                </tfoot>
            @endisset
        </table>
    </div>

</div>

@script
    <script>
        Livewire.on('confirmDeleteequipment', (request) => {
            Swal.fire({
                title: '¿Deseas eliminar ' + request.name + '?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
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
