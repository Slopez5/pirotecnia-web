<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" wire:model="name">
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" wire:model="description"></textarea>
            <span id="charCount" class="text-sm text-muted">0/2000 caracteres</span>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="price">Precio</label>
            <input type="text" class="form-control" id="price" wire:model="price">
            @error('price')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="duration">Duración</label>
            <input type="text" class="form-control" id="duration" wire:model="duration">
            @error('duration')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        {{-- Link video_url --}}
        <div class="form-group">
            <label for="video_url">Link del video</label>
            <input type="text" class="form-control" id="video_url" wire:model="video_url">
            @error('video_url')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="experience">Experiencia</label>
            <select class="form-control" id="experience" wire:model="experience_id">
                <option value="">Selecciona una experiencia</option>
                @foreach ($experienceLevels as $experience)
                    <option value="{{ $experience->id }}">{{ $experience->name }}</option>
                @endforeach
            </select>
            @error('experience_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="row justify-content-between">
            <div class="col">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            @if ($isTabs)
                <div class="col text-end">
                    <button type="button" class="btn btn-success" wire:click="nextTab">Siguiente</button>
                </div>
            @endif
        </div>


    </form>
</div>

@script
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('description');
            const charCount = document.getElementById('charCount');
            const maxLines = 5;
            const maxChars = 2000; // Set your character limit here
            const lineHeight = parseFloat(getComputedStyle(textarea).lineHeight);
            const maxHeight = lineHeight * maxLines;

            textarea.addEventListener('input', function() {
                // Truncate text if it exceeds the character limit
                if (this.value.length > maxChars) {
                    this.value = this.value.substring(0, maxChars);
                }
                // Adjust height
                this.style.height = 'auto';
                if (this.scrollHeight > maxHeight) {
                    this.style.height = maxHeight + 'px';
                } else {
                    this.style.height = (this.scrollHeight) + 'px';
                }

                // Update character count
                const currentLength = this.value.length;
                charCount.textContent = `${currentLength}/${maxChars} caracteres`;
            });

            // Initial adjustment for pre-existing content, if any
            if (textarea.scrollHeight > maxHeight) {
                textarea.style.height = maxHeight + 'px';
            } else {
                textarea.style.height = 'auto';
                textarea.style.height = (textarea.scrollHeight) + 'px';
            }

            // Initial character count update
            charCount.textContent = `${textarea.value.length}/${maxChars} caracteres`;
        });


        Livewire.on('packageUpdated', () => {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Swal.fire(
                'Paquete Actualizado',
                'El paquete ha sido actualizado correctamente',
                'success'
            )
            // change tab
            changeTab('materials');
            localStorage.setItem('activeTab', 'materials');


        });

        Livewire.on('packageCreated', () => {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Swal.fire(
                'Paquete Creado',
                'El paquete ha sido creado correctamente',
                'success'
            )

            // enable materials tab
            $('#custom-tabs-two-tab a[href="#materials"]').removeClass('disabled');
            $('#custom-tabs-two-tab a[href="#equipments"]').removeClass('disabled');
            changeTab('materials');
        });

        Livewire.on('nextToMaterials', () => {
            changeTab('materials');
            localStorage.setItem('activeTab', 'materials');
        });

        function changeTab(tabId) {
            $('#custom-tabs-two-tab a[href="#' + tabId + '"]').tab('show');
        }
    </script>
@endscript
