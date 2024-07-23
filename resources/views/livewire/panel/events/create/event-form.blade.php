<div>
    <form method="POST" wire:submit.prevent="save">
        @csrf
        {{-- Date --}}
        <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" class="form-control" wire:model="date">
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
        {{-- Event DateTime --}}
        <div class="form-group">
            <label for="event_datetime">Fecha y hora del evento</label>
            <input type="datetime-local" class="form-control" wire:model="event_datetime">
            <div>
                @error('event_datetime')
                    <small class="text-danger"> {{ $message }}</small>
                @enderror
            </div>
        </div>
        {{-- Event Type --}}
        <div class="form-group">
            <label for="event_type">Tipo de evento</label>
            <select class="form-control" wire:model.live="event_type">
                <option value="Boda">Boda</option>
                <option value="XV años">XV años</option>
                <option value="Bautizo">Bautizo</option>
                <option value="Primera Comunión">Primera Comunión</option>
                <option value="Cumpleaños">Cumpleaños</option>
                <option value="Aniversario">Aniversario</option>
                <option value="Graduación">Graduación</option>
                <option value="Otro">Otro</option>
            </select>
        </div>
        {{-- Package --}}
        <div class="form-group">
            <label for="package_id">Paquete</label>
            <select class="form-control" wire:model.live="package_id">
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- if prodcts have products show radio buttons with options --}}
        @if (count($products))
            @foreach ($products as $indexProducts => $product)
                @isset($product->pivot)
                    @for ($indexMaterial = 0; $indexMaterial < $product->pivot->quantity; $indexMaterial++)
                        <div class="form-group">
                            <label for="products">Productos</label>

                            @foreach ($product->products as $material)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                        name="products-{{ $indexProducts }}-{{ $indexMaterial }}"
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
        <button type="submit" class="btn btn-primary" {{!$this->enableSave ? 'disabled' : ''}}>Guardar</button>

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
            <p>test</p>
            <button wire:click="saveAndContinue" class="btn btn-primary">Continuar</button>
            <button wire:click="closeAlert" class="btn btn-danger">Cancelar</button>
        </div>
    @endif
</div>
