<div wire:poll.5s="$refresh" class="min-h-[calc(100vh-4rem)] bg-[#f3f6f2] px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <div class="mx-auto max-w-7xl">
        <header class="mb-8 flex flex-col gap-5 border-b border-[#dce4dd] pb-6 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#a65b3e]">Tu búsqueda</p>
                <h1 class="mt-2 font-display text-4xl leading-tight text-[#20332e]">Mis ofertas</h1>
                <p class="mt-2 text-sm text-[#65746d]">Revisa tus oportunidades y el estado de cada análisis.</p>
            </div>

            <a href="{{ route('offers.create') }}" wire:navigate class="inline-flex items-center justify-center gap-2 rounded-md bg-[#27634d] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#1e513d] focus:outline-none focus:ring-2 focus:ring-[#39785d] focus:ring-offset-2">
                <span aria-hidden="true" class="text-lg leading-none">+</span>
                Nueva oferta
            </a>
        </header>

        @if($offers->isEmpty())
            <div class="border-b border-[#dce4dd] py-16 text-center">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-md bg-[#f6e8dc] text-xl text-[#a65b3e]" aria-hidden="true">+</span>
                <h2 class="mt-5 font-display text-2xl text-[#20332e]">Todavía no tienes ofertas</h2>
                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#65746d]">Añade una oportunidad para comparar sus requisitos con tu experiencia y preparar tu candidatura.</p>
                <a href="{{ route('offers.create') }}" wire:navigate class="mt-6 inline-flex rounded-md border border-[#b9cbbf] px-4 py-2.5 text-sm font-semibold text-[#27634d] transition hover:bg-white">Analizar primera oferta</a>
            </div>
        @else
            <div class="divide-y divide-[#dce4dd] border-y border-[#dce4dd]">
                @foreach($offers as $offer)
                    @php
                        $badgeColor = match(true) {
                            $offer->status === 'failed' => 'bg-[#fbe9e6] text-[#9b3f34]',
                            $offer->status === 'pending', $offer->status === 'processing' => 'bg-[#edf0ee] text-[#53675f]',
                            $offer->isHighFit() => 'bg-[#e5f2e8] text-[#27634d]',
                            default => 'bg-[#f8eee4] text-[#9b5a31]',
                        };

                        $statusLabel = match($offer->status) {
                            'pending' => 'Pendiente',
                            'processing' => 'En análisis',
                            'processed' => 'Analizada',
                            'failed' => 'Error',
                            default => ucfirst($offer->status),
                        };

                        $scoreLabel = $offer->status === 'processed' ? $offer->fit_score . '% de afinidad' : $statusLabel;
                    @endphp

                    <a href="{{ route('offers.show', $offer) }}" wire:navigate class="group grid gap-3 py-5 transition hover:bg-white/70 sm:grid-cols-[minmax(0,1fr)_auto] sm:items-center sm:px-4">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-semibold text-[#20332e] group-hover:text-[#27634d]">{{ $offer->title ?? 'Puesto sin título' }}</p>
                            <p class="mt-1 truncate text-sm text-[#65746d]">{{ $offer->company ?? 'Empresa sin especificar' }}</p>
                        </div>

                        <div class="flex flex-wrap items-center gap-3 sm:justify-end">
                            <span class="text-xs text-[#7a8881]">{{ $offer->created_at?->format('d/m/Y') }}</span>
                            <span class="inline-flex rounded-md px-2.5 py-1.5 text-xs font-semibold {{ $badgeColor }}">{{ $scoreLabel }}</span>
                            <span aria-hidden="true" class="hidden text-lg text-[#9aa69f] transition group-hover:translate-x-0.5 group-hover:text-[#27634d] sm:inline">→</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
