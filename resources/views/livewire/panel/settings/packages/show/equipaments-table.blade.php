<x-card title="Equipo" icon="fas fa-box">
    <x-slot:tools>
        <button class="btn btn-primary btn-sm" wire:click='switchToAddEquipamentMode'>
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
                @foreach ($package->equipaments as $index => $equipament)
                    <tr wire:key="{{ $equipament->id }}">
                        <td>
                            {{ $equipament->name }}
                        </td>
                        <td>
                            @if ($this->isEditMode && $this->equipamentId == $equipament->id)
                                <input type="text" wire:model="quantity" class="form-control">
                                <div>
                                    @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            @else
                                {{ $equipament->pivot->quantity }}
                            @endif
                        </td>
                        <td>
                            {{ $equipament->unit }}
                        </td>
                        <td>
                            @if ($this->isEditMode && $this->equipamentId == $equipament->id)
                                <button class="btn btn-success btn-sm" wire:click="editEquipamentInPackage({{ $equipament->id }})">
                                    <i class="fas fa-save"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" wire:click="cancelEditEquipament">
                                    <i class="fas fa-window-close"></i>
                                </button>
                            @else
                                <button class="btn btn-primary btn-sm" wire:click="switchToEditMode({{ $equipament->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form wire:submit='removeEquipamentFromPackage({{ $equipament->id }})' class="d-inline">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @if ($this->isAddEquipament)
                    <tr>
                        <td>
                            <select wire:model="equipamentId" class="form-control">
                                <option value="">Seleccione un equipo</option>
                                @foreach ($equipaments as $equipament)
                                    <option value="{{ $equipament->id }}">{{ $equipament->name }}</option>
                                @endforeach
                            </select>
                            <div>
                                @error('equipamentId') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </td>
                        <td>
                            <input type="text" wire:model="quantity" class="form-control">
                            <div>
                                @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </td>
                        <td>
                            <input type="text" wire:model="unit" class="form-control">
                            <div>
                                @error('unit') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" wire:click="addEquipamentToPackage">
                                <i class="fas fa-save"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" wire:click="cancelAddEquipament">
                                <i class="fas fa-window-close"></i>
                            </button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </x-slot>
</x-card>