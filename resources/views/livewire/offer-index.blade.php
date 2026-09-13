<div wire:poll.5s="$refresh" class="min-h-screen bg-[#0a1111] px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="mb-8 overflow-hidden rounded-[28px] border border-[#24463f] bg-[#0d1716] shadow-[0_0_0_1px_rgba(88,166,146,0.12),0_20px_40px_rgba(10,18,17,0.7)]">
            <div class="border-b border-[#24463f] bg-[radial-gradient(circle_at_top_left,_rgba(95,201,169,0.16),_transparent_34%)] p-6 sm:p-8">
                <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-[0.32em] text-[#8fe7c3]">dashboard</p>
                        <h1 class="mt-3 text-3xl font-bold tracking-tight text-[#edf8f4] sm:text-4xl">Mis ofertas</h1>
                    </div>

                    <a href="{{ route('offers.create') }}"
                       class="inline-flex items-center justify-center rounded-xl border border-[#325f57] bg-[#143932] px-5 py-3 text-sm font-semibold text-[#ebfff8] transition hover:border-[#4a8a7b] hover:bg-[#1a4a41]">
                        + Nueva oferta
                    </a>
                </div>
            </div>
        </div>

        @if($offers->isEmpty())
            <div class="rounded-[28px] border border-dashed border-[#2a4a46] bg-[#0d1716] p-10 text-center shadow-[inset_0_0_18px_rgba(143,231,195,0.04)]">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-[#325f57] bg-[#123a34] text-2xl text-[#9feac8]">✦</div>
                <h2 class="mt-5 text-xl font-semibold text-[#edf8f4]">Todavía no tienes ofertas</h2>
                <p class="mt-2 text-sm text-[#a7b8b3]">Añade tu primera oferta para empezar a analizar tu fit profesional.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach($offers as $offer)
                    @php
                        $badgeColor = match(true) {
                            $offer->status === 'failed' => 'bg-[#391d1f] text-[#f7b8bf] border border-[#5a2c31]',
                            $offer->status === 'pending', $offer->status === 'processing' => 'bg-[#141f1d] text-[#dfeae7] border border-[#2b3937]',
                            $offer->isHighFit() => 'bg-[#17372d] text-[#a8f0c8] border border-[#2d5a4d]',
                            default => 'bg-[#2b2317] text-[#f3d290] border border-[#4a3a22]',
                        };

                        $scoreLabel = $offer->status === 'processed' ? $offer->fit_score . '%' : ucfirst($offer->status);
                    @endphp

                    <a href="{{ route('offers.show', $offer) }}"
                       class="group block rounded-[26px] border border-[#223d39] bg-[#0d1716] p-5 shadow-[0_0_0_1px_rgba(136,194,177,0.08),0_18px_32px_rgba(7,12,11,0.75)] transition duration-200 hover:-translate-y-1 hover:border-[#3a5c55] hover:bg-[#101d1b]">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-[10px] font-semibold uppercase tracking-[0.28em] text-[#7f9a96]">Oferta</p>
                                <h3 class="mt-2 truncate text-lg font-semibold text-[#edf8f4]">{{ $offer->company ?? 'Sin empresa' }}</h3>
                            </div>

                            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.12em] {{ $badgeColor }}">
                                {{ $scoreLabel }}
                            </span>
                        </div>

                        <div class="mt-5 rounded-2xl border border-[#213b37] bg-[#0a1413] p-4">
                            <p class="text-sm text-[#dfeae7]">{{ $offer->title ?? 'Sin título' }}</p>
                        </div>

                        <div class="mt-5 flex items-center justify-between text-sm text-[#9aa9a4]">
                            <span class="uppercase tracking-[0.18em] text-[#7f9a96]">Estado</span>
                            <span class="font-medium text-[#edf8f4]">{{ ucfirst($offer->status) }}</span>
                        </div>

                        @if($offer->status === 'processed' && $offer->fit_score !== null)
                            <div class="mt-3 flex items-center justify-between text-sm text-[#9aa9a4]">
                                <span class="uppercase tracking-[0.18em] text-[#7f9a96]">Match</span>
                                <span class="font-semibold {{ $offer->isHighFit() ? 'text-[#a8f0c8]' : 'text-[#f3d290]' }}">
                                    {{ $offer->fit_score }}%
                                </span>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
