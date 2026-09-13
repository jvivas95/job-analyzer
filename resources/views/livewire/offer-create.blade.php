<div class="min-h-screen bg-[#0a1111] px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-6xl gap-6 lg:grid-cols-[1.3fr_0.7fr]">
        <div class="rounded-[30px] border border-[#24463f] bg-[#0d1716] p-6 shadow-[0_0_0_1px_rgba(88,166,146,0.12),0_20px_40px_rgba(10,18,17,0.75)] sm:p-8">
            <div class="mb-8 flex items-center justify-between gap-4">
                <div>
                    <p class="text-[10px] font-semibold uppercase tracking-[0.32em] text-[#8fe7c3]">Nuevo análisis</p>
                    <h1 class="mt-3 text-3xl font-bold tracking-tight text-[#edf8f4]">Analizar oferta</h1>
                </div>

                <a href="{{ route('offers.index') }}"
                   class="inline-flex items-center rounded-full border border-[#2f4d49] bg-[#122c29] px-3 py-1.5 text-sm text-[#dfeae7] transition hover:border-[#4a8a7b] hover:text-[#edf8f4]">
                    Volver
                </a>
            </div>

            <form wire:submit="save" class="space-y-6">
                <div>
                    <label for="description" class="mb-2 block text-sm font-medium uppercase tracking-[0.18em] text-[#a8f0c8]">Descripción de la oferta</label>
                    <textarea wire:model="description" id="description" rows="8"
                        class="mt-1 block w-full rounded-2xl border border-[#2a4441] bg-[#0b1413] px-4 py-3 text-sm text-[#edf8f4] shadow-[inset_0_0_18px_rgba(143,231,195,0.04)] transition focus:border-[#4a8a7b] focus:outline-none focus:ring-2 focus:ring-[#2d5d55]/30"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="url" class="mb-2 block text-sm font-medium uppercase tracking-[0.18em] text-[#a8f0c8]">URL (opcional)</label>
                        <input wire:model="url" id="url" type="text"
                            class="mt-1 block w-full rounded-xl border border-[#2a4441] bg-[#0b1413] px-4 py-3 text-sm text-[#edf8f4] transition focus:border-[#4a8a7b] focus:outline-none focus:ring-2 focus:ring-[#2d5d55]/30">
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>

                    <div>
                        <label for="company" class="mb-2 block text-sm font-medium uppercase tracking-[0.18em] text-[#a8f0c8]">Empresa (opcional)</label>
                        <input wire:model="company" id="company" type="text"
                            class="mt-1 block w-full rounded-xl border border-[#2a4441] bg-[#0b1413] px-4 py-3 text-sm text-[#edf8f4] transition focus:border-[#4a8a7b] focus:outline-none focus:ring-2 focus:ring-[#2d5d55]/30">
                    </div>

                    <div>
                        <label for="title" class="mb-2 block text-sm font-medium uppercase tracking-[0.18em] text-[#a8f0c8]">Título del puesto (opcional)</label>
                        <input wire:model="title" id="title" type="text"
                            class="mt-1 block w-full rounded-xl border border-[#2a4441] bg-[#0b1413] px-4 py-3 text-sm text-[#edf8f4] transition focus:border-[#4a8a7b] focus:outline-none focus:ring-2 focus:ring-[#2d5d55]/30">
                    </div>
                </div>

                <button type="submit"
                    class="inline-flex w-full items-center justify-center rounded-xl border border-[#40756d] bg-[#123a34] px-5 py-3.5 text-sm font-semibold uppercase tracking-[0.16em] text-[#ecfff8] transition hover:border-[#5fb39a] hover:bg-[#18463f]">
                    Analizar oferta
                </button>
            </form>
        </div>

        <aside class="rounded-[30px] border border-[#24463f] bg-[#0d1716] p-6 shadow-[0_20px_40px_rgba(10,18,17,0.7)]">
            <div class="mb-5">
                <p class="text-[10px] font-semibold uppercase tracking-[0.32em] text-[#8fe7c3]">Qué incluye</p>
                <h2 class="mt-3 text-2xl font-bold text-[#edf8f4]">Tu análisis</h2>
            </div>

            <div class="space-y-4">
                <div class="rounded-2xl border border-[#24463f] bg-[#0f1c1a] p-4">
                    <div class="mb-2 flex h-9 w-9 items-center justify-center rounded-xl border border-[#325f57] bg-[#143932] text-sm font-bold text-[#a8f0c8]">1</div>
                    <h3 class="font-semibold text-[#edf8f4]">Revisión del puesto</h3>
                    <p class="mt-1 text-sm text-[#a7b8b3]">Compara la oferta con tus habilidades y experiencia real.</p>
                </div>

                <div class="rounded-2xl border border-[#24463f] bg-[#0f1c1a] p-4">
                    <div class="mb-2 flex h-9 w-9 items-center justify-center rounded-xl border border-[#325f57] bg-[#143932] text-sm font-bold text-[#a8f0c8]">2</div>
                    <h3 class="font-semibold text-[#edf8f4]">Identificación de gaps</h3>
                    <p class="mt-1 text-sm text-[#a7b8b3]">Detecta qué competencias te faltan y qué conviene reforzar.</p>
                </div>

                <div class="rounded-2xl border border-[#24463f] bg-[#0f1c1a] p-4">
                    <div class="mb-2 flex h-9 w-9 items-center justify-center rounded-xl border border-[#325f57] bg-[#143932] text-sm font-bold text-[#a8f0c8]">3</div>
                    <h3 class="font-semibold text-[#edf8f4]">CV y carta adaptados</h3>
                    <p class="mt-1 text-sm text-[#a7b8b3]">Genera una propuesta de adaptación para que tu candidatura encaje mejor.</p>
                </div>
            </div>
        </aside>
    </div>
</div>
