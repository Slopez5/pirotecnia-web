<div>
    <form wire:submit.prevent="save">

        <div class="form-group">
            <label for="material_id">Material</label>
            <select class="form-control" id="material_id" wire:model="material_id">
                <option value="">Seleccione un material</option>
                @foreach ($materials as $material)
                    <option value="{{ $material->id }}">{{ $material->name }}
                        {{ $material->caliber != '' ? $material->caliber . "''" : '' }}{{ $material->caliber != '' && $material->shots != '' ? 'x' : '' }}{{ $material->shots != '' ? "$material->shots" : '' }}
                        {{ $material->shape }}</option>
                @endforeach
            </select>
            @error('material_id')
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
                <button type="button" class="btn btn-success" wire:click="nextTab">Siguiente</button>
            </div>
        </div>
    </form>

    {{-- spacer --}}
    <div class="mb-3"></div>

    {{-- Table with materials in Package the table has max height --}}
    <div class="table-responsive">
        @isset($materialsInPackage)
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Material</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materialsInPackage as $material)
                        <tr>
                            <td>{{ $material->name }}
                                {{ $material->caliber != '' ? $material->caliber . "''" : '' }}{{ $material->caliber != '' && $material->shots != '' ? 'x' : '' }}{{ $material->shots != '' ? "$material->shots" : '' }}
                                {{ $material->shape }}</td>
                            <td>{{ $material->pivot->quantity }}</td>
                            <td>
                                {{-- icon trash --}}
                                <button class="btn btn-danger" wire:click="removeMaterial({{ $material->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                {{-- Fotter pagination --}}
                <tfoot>
                    <tr>
                        <td colspan="3">
                            {{ $materialsInPackage->links('vendor.pagination.bootstrap-4') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        @endisset
    </div>


</div>

@script
    <script>
        // Load the range slider when the component is mounted
        
        Livewire.on('selectCake', (request) => {
            setTimeout(() => {
                loadRangeSlider(request.minPrice, request.maxPrice);
            }, 0);
        });


        function loadRangeSlider(minPrice, maxPrice) {
            console.log(minPrice, maxPrice);
            $('#range_1').ionRangeSlider({
                min: minPrice,
                max: maxPrice,
                from: minPrice,
                to: maxPrice,
                type: 'double',
                step: 1,
                prefix: "$",
                prettify: true,
                hasGrid: true
            });
        }



        Livewire.on('confirmDeleteMaterial', (request) => {
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
                    Livewire.dispatch('deleteMaterial', {
                        materialId: request.id
                    });
                }
            })
        });

        Livewire.on('nextToequipments', () => {
            changeTab('equipments');
        });

        function changeTab(tabId) {
            $('#custom-tabs-two-tab a[href="#' + tabId + '"]').tab('show');
        }
    </script>
@endscript
