<x-card title="Materiales" icon="fas fa-box">
    <x-slot:tools>
        <button class="btn btn-primary btn-sm" wire:click='switchToAddMaterialMode'>
            <i class="fas fa-plus"></i>
        </button>
    </x-slot>
    <x-slot:body class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>

                    <th class="col-4">Descripción</th>
                    <th class="col-1">Cantidad</th>
                    <th class="col-1">Unidad</th>
                    <th class="col-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($package->materials as $idnex => $material)
                    <tr wire:key="{{ $material->id }}">
                        <td>
                            {{ $material->name }}

                        </td>
                        <td>
                            @if ($this->isEditMode && $this->materialId == $material->id)
                                <input type="text" wire:model="quantity" class="form-control">
                            @else
                                {{ $material->pivot->quantity }}
                            @endif
                        </td>
                        <td>
                            {{ $material->unit }}

                        </td>
                        <td>
                            @if ($this->isEditMode && $this->materialId == $material->id)
                                <button class="btn btn-success btn-sm"
                                    wire:click="editMaterialInPackage({{ $material->id }})">
                                    <i class="fas fa-save"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" wire:click="cancelEditMaterial">
                                    <i class="fas fa-window-close"></i>
                                </button>
                            @else
                                <button class="btn btn-primary btn-sm"
                                    wire:click="switchToEditMode({{ $material->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form wire:submit='removeMaterialFromPackage({{ $material->id }})' class="d-inline">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @if ($this->isAddMaterial)
                    <tr>
                        <td>
                            <select wire:model.live="materialId" class="form-control">
                                <option value="">Selecciona un material</option>
                                @foreach ($materials as $material)
                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach

                            </select>
                            <div>
                                @error('materialId')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <input type="text" wire:model="quantity" class="form-control">
                            <div>
                                @error('quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </td>
                        <td>

                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" wire:click="addMaterialToPackage">
                                <i class="fas fa-save"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" wire:click="cancelAddMaterial">
                                <i class="fas fa-window-close"></i>
                            </button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </x-slot>
</x-card>
