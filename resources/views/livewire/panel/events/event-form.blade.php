<div>
    <form method="POST" wire:submit.prevent="save">
        @csrf
        {{-- Date --}}
        <div class="form-group">
            {{-- <label for="date">Fecha</label> --}}
            <input type="date" class="form-control" wire:model="date" hidden>
            <div>
                @error('date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Phone --}}
        <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" class="form-control" wire:model="phone">
            <div>
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- client name --}}
        <div class="form-group">
            <label for="client_name">Nombre del cliente</label>
            <input type="text" class="form-control" wire:model="client_name">
            <div>
                @error('client_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Client Address --}}
        <div class="form-group">
            <label for="client_address">Dirección del cliente</label>
            <input type="text" class="form-control" wire:model="client_address">
            <div>
                @error('client_address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Event Address --}}
        <div class="form-group">
            <label for="event_address">Dirección del evento</label>
            <input type="text" class="form-control" wire:model="event_address">
            <div>
                @error('event_address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Event Date --}}
        <div class="form-group">
            <label for="event_datetime">Fecha del evento</label>
            <input type="date" class="form-control" wire:model="event_date">
            <div>
                @error('event_date')
                    <small class="text-danger"> {{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Event Time --}}
        <div class="form-group">
            <label for="event_time">Hora del evento</label>
            {{-- input time with format am/pm --}}
            <input type="time" id="time" class="form-control" wire:model="event_time">
            <div>
                @error('event_time')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Event Type --}}
        <div class="form-group">
            <label for="event_type">Tipo de evento</label>
            <select class="form-control" wire:model.live="event_type_id">
                <option value="">Seleccione un tipo de evento</option>
                @if ($eventTypes != null)
                    @foreach ($eventTypes as $index => $eventType)
                        <option value="{{ $eventType->id }}">{{ $eventType->name }}</option>
                    @endforeach

                @endif

            </select>
        </div>
        {{-- Package --}}
        @for ($i = 0; $i < $countPackageInputs; $i++)
            <div class="form-group">
                <label for="package_id">Paquete {{ $i + 1 }}</label>
                <select class="form-control" id="package_id_{{ $i }}" wire:model.live="package_id.{{ $i }}">
                    <option value="">Seleccione un paquete</option>
                    @if ($packages != null)
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}">
                                {{ $package->name }} - ${{ $package->price }}
                            </option>
                        @endforeach
                        <option value="-1">Agregar paquete</option>
                    @endif
                </select>
                {{-- add button in left screen to add more packages --}}
                <div class="row justify-content-end">
                    <div class="col-auto">
                        @if ($i == $countPackageInputs - 1)
                            <div>
                                {{-- Add package link underline --}}
                                <small class="text-primary" wire:click="addPackageInput"><i class="fas fa-plus"></i>
                                    <u>Agregar paquete</u></small>

                            </div>
                        @else
                            <div>
                                <small class="text-danger" wire:click="removePackageInput({{ $i }})"><i
                                        class="fas fa-trash"></i> <u>Quitar paquete </u></small>
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    @error('package_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        @endfor
        {{-- Discount --}}
        <div class="form-group">
            <label for="discount">Descuento</label>
            <input type="text" class="form-control" wire:model="discountString">
            <div>
                @error('discount')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Anticipo --}}
        <div class="form-group">
            <label for="deposit">Anticipo</label>
            <input type="text" class="form-control" wire:model="deposit">
            <div>
                @error('deposit')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Viaticos --}}
        <div class="form-group">
            <label for="viatic">Viáticos</label>
            <input type="text" class="form-control" wire:model="viatic">
            <div>
                @error('viatic')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Precio (Opcional) --}}
        <div class="form-group">
            <label for="price">Precio</label>
            <input type="text" class="form-control" wire:model="price">
            <div>
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Notas --}}
        <div class="form-group">
            <label for="notes">Notas</label>
            <textarea class="form-control" wire:model="notes"></textarea>
            <div>
                @error('notes')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- encargados del evento --}}
        @for ($i = 0; $i < $countEmployeeInputs; $i++)
            <div class="form-group">
                <label for="employee_id">Encargado {{ $i + 1 }}</label>
                <select class="form-control" wire:model="employee_id.{{ $i }}">
                    <option value="">Seleccione un encargado</option>
                    @if ($employees != null)
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    @endif
                </select>
                {{-- add button in left screen to add more employees --}}
                <div class="row justify-content-end">
                    <div class="col-auto">
                        @if ($i == $countEmployeeInputs - 1)
                            <div>
                                {{-- Add employee link underline --}}
                                <small class="text-primary" wire:click="addEmployeeInput"><i class="fas fa-plus"></i>
                                    <u>Agregar encargado</u></small>
                            </div>
                        @else
                            <div>
                                <small class="text-danger" wire:click="removeEmployeeInput({{ $i }})"><i
                                        class="fas fa-trash"></i> <u>Quitar encargado</u></small>
                            </div>
                        @endif
                    </div>
                </div>
                <div>
                    @error('employee_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

        @endfor
        {{-- if prodcts have products show radio buttons with options --}}
        @if (count($products))
            @foreach ($products as $indexProducts => $product)
                @isset($product->pivot)
                    @for ($indexMaterial = 0; $indexMaterial < $product->pivot->quantity; $indexMaterial++)
                        <div class="form-group">
                            <label for="products">Productos</label>

                            @foreach ($product->products as $material)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="products-{{ $indexProducts }}-{{ $indexMaterial }}"
                                        value="{{ $material->id }}" wire:model="radioSelected.{{ $indexMaterial }}">
                                    <label class="form-check-label"
                                        for="products-{{ $indexProducts }}-{{ $indexMaterial }}">{{ $material->name }}({{ $material->inventories->first()->pivot->quantity ?? 0 }})</label>
                                </div>
                            @endforeach

                        </div>
                    @endfor
                @endisset
            @endforeach
        @endif
        {{-- Button --}}
        <button type="submit" class="btn btn-primary" {{ !$this->enableSave ? 'disabled' : '' }}>Guardar</button>

    </form>

    {{-- Success Message --}}

    @if (session()->has('message'))
        <div class="alert alert-success mt-3">
            {{ session('message') }}
        </div>
    @endif

    {{-- Error Message in Modal with button continue and cancel --}}
    @if ($this->showAlert)
        <div class="alert alert-danger mt-3">
            <p>{{$this->errorMessage ?? ""}}</p>
            <button wire:click="saveAndContinue" class="btn btn-primary">Continuar</button>
            <button wire:click="closeAlert" class="btn btn-danger">Cancelar</button>
        </div>
    @endif

    {{-- Modal New Package--}}
    <x-modal id="new-package" title="Nuevo Paquete">
        <x-slot:body>
            <livewire:panel.settings.packages.package-form :isTabs="false">
                </x-slot>
    </x-modal>

    {{-- Modal New Emplyee --}}
    <x-modal id="new-employee" title="Nuevo Encargado">
        <x-slot:body>

            </x-slot>
    </x-modal>
</div>


@script
<script>

    Livewire.on('closeModal', (data) => {
        let modalElement = document.getElementById(data[0].id);
        let modalInstance = new bootstrap.Modal(modalElement);

        if (modalInstance) {
            modalInstance.hide(); // Cerrar el modal
            modalInstance.dispose(); // Destruir la instancia
        } else {
            // Si no hay una instancia activa, la creamos para poder cerrarla
            modalInstance = new bootstrap.Modal(modalElement);
            modalInstance.hide();
            modalInstance.dispose();
        }

        // Eliminar el backdrop si persiste
        let backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }

        // Eliminar clase modal-open del body
        if (document.body.classList.contains('modal-open')) {
            document.body.classList.remove('modal-open');
        }

        // Resetear cualquier estilo en el body que pudo haber quedado
        document.body.style = '';
    });

    Livewire.on('openModal', (data) => {
        let modalElement = document.getElementById(data[0].id);
        let modalInstance = new bootstrap.Modal(modalElement);

        if (modalInstance) {
            modalInstance.show(); // Mostrar el modal
        } else {
            // Si no hay una instancia activa, la creamos para poder mostrarla
            modalInstance = new bootstrap.Modal(modalElement);
            modalInstance.show();
        }

        // Agregar clase modal-open al body
        if (!document.body.classList.contains('modal-open')) {
            document.body.classList.add('modal-open');
        }

        // Agregar estilos al body para evitar el scroll
        document.body.style.overflow = 'hidden';
        document.body.style.paddingRight = '17px'; // Ancho del scrollbar
    });

</script>
@endscript