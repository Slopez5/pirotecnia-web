<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="equipament_id">Equipo</label>
            <select class="form-control" id="equipament_id" wire:model="equipament_id">
                <option value="">Seleccione un equipo</option>
                @foreach ($equipaments as $equipament)
                    <option value="{{ $equipament->id }}">{{ $equipament->name }}</option>
                @endforeach
            </select>
            @error('equipament_id')
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

    {{-- Table with equipaments in Package the table has max height --}}
    <div class="table-responsive">
        @isset($equipamentsInPackage)

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Equipo</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipamentsInPackage as $equipament)
                        <tr>
                            <td>{{ $equipament->name }}</td>
                            <td>{{ $equipament->pivot->quantity }}</td>
                            <td>
                                {{-- icon trash --}}
                                <button class="btn btn-danger" wire:click="removeEquipament({{ $equipament->id }})">
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
                            {{ $equipamentsInPackage->links('vendor.pagination.bootstrap-4') }}
                        </td>
                    </tr>
                </tfoot>
            @endisset
        </table>
    </div>

</div>

@script
    <script>
        Livewire.on('confirmDeleteEquipament', (request) => {
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
                    Livewire.dispatch('deleteEquipament', {
                        equipamentId: request.id
                    });
                }
            });
        });
    </script>
@endscript
