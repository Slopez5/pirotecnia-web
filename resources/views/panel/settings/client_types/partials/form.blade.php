<div class="grid gap-6">
    <label class="grid gap-2">
        <span class="text-sm font-semibold text-primary-200">Nombre</span>
        <input
            class="w-full rounded-xl border border-primary-600/50 bg-primary-700/70 px-4 py-3 text-sm text-on-primary outline-none transition focus:border-secondary"
            name="name" type="text" value="{{ old('name', $clientType->name ?? '') }}">
        @error('name')
            <span class="text-xs font-semibold text-error">{{ $message }}</span>
        @enderror
    </label>

    <label class="grid gap-2">
        <span class="text-sm font-semibold text-primary-200">Descripción</span>
        <textarea
            class="min-h-32 w-full rounded-xl border border-primary-600/50 bg-primary-700/70 px-4 py-3 text-sm text-on-primary outline-none transition focus:border-secondary"
            name="description">{{ old('description', $clientType->description ?? '') }}</textarea>
        @error('description')
            <span class="text-xs font-semibold text-error">{{ $message }}</span>
        @enderror
    </label>
</div>
