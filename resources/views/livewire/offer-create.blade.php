<div>
    <h1 class="text-xl font-bold mb-4">Analizar nueva oferta</h1>

    <form wire:submit="save" class="space-y-4">
        <div>
            <label class="block font-medium">Descripción de la oferta</label>
            <textarea wire:model="description" rows="8" class="w-full border rounded p-2"></textarea>
            @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">URL (opcional)</label>
            <input type="text" wire:model="url" class="w-full border rounded p-2">
            @error('url') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-medium">Empresa (opcional)</label>
            <input type="text" wire:model="company" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium">Título del puesto (opcional)</label>
            <input type="text" wire:model="title" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
            Analizar oferta
        </button>
    </form>
</div>
