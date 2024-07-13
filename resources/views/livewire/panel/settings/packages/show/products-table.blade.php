<x-card title="Material" icon="fas fa-box">
    <x-slot:tools>
        <button class="btn btn-primary btn-sm" wire:click='addProduct'>
            <i class="fas fa-plus"></i>
        </button>
    </x-slot>
    <x-slot:body class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="col-4">Descripción</th>
                    <th class="col-1">Cantidad</th>
                    <th class="col-1">Precio</th>
                    <th class="col-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($package->materials as $index => $product)
                    <tr wire:key="{{ $product->id }}">
                        <td>
                            {{ $product->name }}
                        </td>
                        <td>
                            @if ($this->isEditMode && $this->product_id_selected == $product->id)
                                <input type="text" wire:model="quantity" class="form-control">
                            @else
                                {{ $product->pivot->quantity }}
                            @endif
                        </td>
                        <td>
                            {{ $product->price }}
                        </td>
                        <td>
                            @if ($this->isEditMode && $this->product_id_selected == $product->id)
                                <button class="btn btn-success btn-sm" wire:click="editProduct({{ $product->id }})">
                                    <i class="fas fa-save"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" wire:click="cancelEdit">
                                    <i class="fas fa-window-close"></i>
                                </button>
                            @else
                                <button class="btn btn-primary btn-sm" wire:click="editProduct({{ $product->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form wire:submit='removeProduct({{ $product->id }})' class="d-inline">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @if ($this->isAddProduct)
                    <tr>
                        <td>
                            <select wire:model="product_id" class="form-control">
                                <option value="">Seleccione un producto</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" wire:model="quantity" class="form-control">
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model='isMultiple'>
                                <label class="form-check-label" for="flexCheckDefault">
                                </label>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" wire:click="saveProduct">
                                <i class="fas fa-save"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" wire:click="cancelAddProduct">
                                <i class="fas fa-window-close"></i>
                            </button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </x-slot>
</x-card>
