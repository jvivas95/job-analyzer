<div class="min-h-[calc(100vh-4rem)] bg-[#f3f6f2] px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <div class="mx-auto max-w-6xl">
        <div class="mb-8 flex items-center justify-between gap-4 border-b border-[#dce4dd] pb-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#a65b3e]">Nueva oportunidad</p>
                <h1 class="mt-2 font-display text-4xl leading-tight text-[#20332e]">Analizar oferta</h1>
                <p class="mt-2 text-sm text-[#65746d]">Pega la descripción para compararla con tu perfil.</p>
            </div>
            <a href="{{ route('offers.index') }}" wire:navigate class="shrink-0 rounded-md border border-[#b9cbbf] px-3 py-2 text-sm font-medium text-[#53675f] transition hover:bg-white hover:text-[#20332e]">Volver</a>
        </div>

        <div class="grid gap-10 lg:grid-cols-[minmax(0,1fr)_17rem]">
            <form wire:submit="save" class="grid gap-6">
                <div class="grid gap-2">
                    <label for="description" class="text-sm font-semibold text-[#30443c]">Descripción de la oferta <span class="text-[#a65b3e]">*</span></label>
                    <textarea wire:model="description" id="description" rows="10" placeholder="Pega aquí el texto completo de la oferta de empleo..." class="block w-full resize-y rounded-md border border-[#d4ded6] bg-white px-4 py-3 text-sm leading-6 text-[#20332e] shadow-sm placeholder:text-[#9aa69f] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15"></textarea>
                    <p class="text-xs text-[#7a8881]">Incluye responsabilidades y requisitos para obtener un análisis más completo.</p>
                    <x-input-error :messages="$errors->get('description')" class="text-sm text-[#a64036]" />
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="grid gap-2 sm:col-span-2">
                        <label for="url" class="text-sm font-semibold text-[#30443c]">Enlace a la oferta <span class="font-normal text-[#7a8881]">(opcional)</span></label>
                        <input wire:model="url" id="url" type="url" placeholder="https://empresa.com/empleo" class="w-full rounded-md border border-[#d4ded6] bg-white px-4 py-3 text-sm text-[#20332e] shadow-sm placeholder:text-[#9aa69f] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15">
                        <x-input-error :messages="$errors->get('url')" class="text-sm text-[#a64036]" />
                    </div>
                    <div class="grid gap-2">
                        <label for="company" class="text-sm font-semibold text-[#30443c]">Empresa <span class="font-normal text-[#7a8881]">(opcional)</span></label>
                        <input wire:model="company" id="company" type="text" placeholder="Nombre de la empresa" class="w-full rounded-md border border-[#d4ded6] bg-white px-4 py-3 text-sm text-[#20332e] shadow-sm placeholder:text-[#9aa69f] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15">
                        <x-input-error :messages="$errors->get('company')" class="text-sm text-[#a64036]" />
                    </div>
                    <div class="grid gap-2">
                        <label for="title" class="text-sm font-semibold text-[#30443c]">Puesto <span class="font-normal text-[#7a8881]">(opcional)</span></label>
                        <input wire:model="title" id="title" type="text" placeholder="Título del puesto" class="w-full rounded-md border border-[#d4ded6] bg-white px-4 py-3 text-sm text-[#20332e] shadow-sm placeholder:text-[#9aa69f] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15">
                        <x-input-error :messages="$errors->get('title')" class="text-sm text-[#a64036]" />
                    </div>
                </div>

                <button type="submit" wire:loading.attr="disabled" wire:target="save" class="inline-flex w-full items-center justify-center rounded-md bg-[#27634d] px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-[#1e513d] focus:outline-none focus:ring-2 focus:ring-[#39785d] focus:ring-offset-2 disabled:cursor-wait disabled:opacity-70 sm:w-fit sm:min-w-52">
                    <span wire:loading.remove wire:target="save">Analizar oferta</span>
                    <span wire:loading wire:target="save">Enviando oferta...</span>
                </button>
            </form>

            <aside class="border-t border-[#dce4dd] pt-6 lg:border-l lg:border-t-0 lg:pl-7 lg:pt-0">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#a65b3e]">Qué recibirás</p>
                <h2 class="mt-2 font-display text-2xl text-[#20332e]">Una lectura clara del encaje</h2>
                <ol class="mt-6 divide-y divide-[#dce4dd]">
                    <li class="flex gap-3 py-4 first:pt-0">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-md bg-[#e5f2e8] text-xs font-semibold text-[#27634d]">1</span>
                        <div><h3 class="text-sm font-semibold text-[#30443c]">Coincidencias</h3><p class="mt-1 text-sm leading-5 text-[#65746d]">Experiencia y habilidades relacionadas con el puesto.</p></div>
                    </li>
                    <li class="flex gap-3 py-4">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-md bg-[#f6e8dc] text-xs font-semibold text-[#a65b3e]">2</span>
                        <div><h3 class="text-sm font-semibold text-[#30443c]">Aspectos por reforzar</h3><p class="mt-1 text-sm leading-5 text-[#65746d]">Requisitos que no aparecen en tu perfil actual.</p></div>
                    </li>
                    <li class="flex gap-3 py-4 last:pb-0">
                        <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-md bg-[#eaf2ec] text-xs font-semibold text-[#27634d]">3</span>
                        <div><h3 class="text-sm font-semibold text-[#30443c]">Material adaptado</h3><p class="mt-1 text-sm leading-5 text-[#65746d]">Resumen de CV y carta de presentación personalizados.</p></div>
                    </li>
                </ol>
            </aside>
        </div>
    </div>
</div>
