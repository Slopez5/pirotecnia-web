<x-card title="Productos" icon="fas fa-box">
    <x-slot:tools>
        <button class="btn btn-primary btn-sm" wire:click='switchToAddProductMode'>
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
                {{-- {{ dd($package->products) }} --}}
                @foreach ($package->productGroups as $idnex => $product)
                    <tr wire:key="{{ $product->id }}">
                        <td>
                            {{ $product->name }}

                        </td>
                        <td>
                            @if ($this->isEditMode && $this->productId == $product->id)
                                <input type="text" wire:model="quantity" class="form-control">
                            @else
                                {{ $product->pivot->quantity }}
                            @endif
                        </td>
                        <td>
                            {{ $product->unit }}

                        </td>
                        <td>
                            @if ($this->isEditMode && $this->productId == $product->id)
                                <button class="btn btn-success btn-sm" wire:click="editProductInPackage({{ $product->id }})">
                                    <i class="fas fa-save"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" wire:click="cancelEditProduct">
                                    <i class="fas fa-window-close"></i>
                                </button>
                            @else
                                <button class="btn btn-primary btn-sm" wire:click="switchToEditMode({{ $product->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form wire:submit='removeProductFromPackage({{ $product->id }})' class="d-inline">
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
                            <select wire:model.live="productId" class="form-control">
                                <option value="">Selecciona un producto</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                                <option value="0">Otro</option>
                            </select>
                            <div>
                                @error('productId')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            @if ($this->isAddNewProduct)
                                <input type="text" wire:model="product" class="form-control">
                                <div>
                                    @error('product')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endif
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
                            <button class="btn btn-success btn-sm" wire:click="addProductToPackage">
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
