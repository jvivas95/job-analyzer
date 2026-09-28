<x-app-layout>
    <div class="min-h-[calc(100vh-4rem)] bg-[#f3f6f2] px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        <div class="mx-auto max-w-7xl">
            <header class="mb-8 flex flex-col gap-5 border-b border-[#dce4dd] pb-7 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#a65b3e]">Panel de trabajo</p>
                    <h1 class="mt-2 font-display text-4xl leading-tight text-[#20332e]">Hola, {{ $greetingName }}</h1>
                    <p class="mt-2 text-sm text-[#65746d]">Aquí tienes el estado de tus oportunidades y tu perfil profesional.</p>
                </div>
                <a href="{{ route('offers.create') }}" wire:navigate class="inline-flex items-center justify-center gap-2 rounded-md bg-[#27634d] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#1e513d] focus:outline-none focus:ring-2 focus:ring-[#39785d] focus:ring-offset-2">
                    <span aria-hidden="true" class="text-lg leading-none">+</span>
                    Analizar una oferta
                </a>
            </header>

            <section aria-label="Resumen de actividad" class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-md border border-[#dce4dd] bg-white p-5">
                    <p class="text-sm font-medium text-[#65746d]">Ofertas guardadas</p>
                    <p class="mt-3 font-display text-3xl text-[#20332e]">{{ $stats['total'] }}</p>
                    <p class="mt-1 text-xs text-[#7a8881]">Oportunidades en tu espacio</p>
                </article>
                <article class="rounded-md border border-[#dce4dd] bg-white p-5">
                    <p class="text-sm font-medium text-[#65746d]">Análisis completados</p>
                    <p class="mt-3 font-display text-3xl text-[#20332e]">{{ $stats['analyzed'] }}</p>
                    <p class="mt-1 text-xs text-[#7a8881]">Ofertas con resultados disponibles</p>
                </article>
                <article class="rounded-md border border-[#dce4dd] bg-white p-5">
                    <p class="text-sm font-medium text-[#65746d]">Buen encaje</p>
                    <p class="mt-3 font-display text-3xl text-[#27634d]">{{ $stats['high_fit'] }}</p>
                    <p class="mt-1 text-xs text-[#7a8881]">Por encima del umbral de afinidad</p>
                </article>
                <article class="rounded-md border border-[#dce4dd] bg-white p-5">
                    <p class="text-sm font-medium text-[#65746d]">Documentos generados</p>
                    <p class="mt-3 font-display text-3xl text-[#20332e]">{{ $stats['documents'] }}</p>
                    <p class="mt-1 text-xs text-[#7a8881]">CV y cartas listos para descargar</p>
                </article>
            </section>

            <div class="mt-8 grid gap-10 lg:grid-cols-[minmax(0,1fr)_19rem] lg:gap-12">
                <section aria-labelledby="recent-offers-heading" class="min-w-0">
                    <div class="flex flex-wrap items-end justify-between gap-3 border-b border-[#dce4dd] pb-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#a65b3e]">Actividad reciente</p>
                            <h2 id="recent-offers-heading" class="mt-1 font-display text-2xl text-[#20332e]">Tus últimas ofertas</h2>
                        </div>
                        @if($recentOffers->isNotEmpty())
                            <a href="{{ route('offers.index') }}" wire:navigate class="text-sm font-semibold text-[#27634d] transition hover:text-[#1e513d]">Ver todas <span aria-hidden="true">→</span></a>
                        @endif
                    </div>

                    @if($recentOffers->isEmpty())
                        <div class="border-b border-[#dce4dd] py-10">
                            <p class="font-display text-xl text-[#20332e]">Empieza con una oferta que te interese</p>
                            <p class="mt-2 max-w-xl text-sm leading-6 text-[#65746d]">Compara sus requisitos con tu perfil y obtén una lectura del encaje, un CV y una carta adaptados.</p>
                            <a href="{{ route('offers.create') }}" wire:navigate class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-[#27634d] hover:text-[#1e513d]">Añadir primera oferta <span aria-hidden="true">→</span></a>
                        </div>
                    @else
                        <div class="divide-y divide-[#dce4dd] border-b border-[#dce4dd]">
                            @foreach($recentOffers as $offer)
                                @php
                                    $statusLabel = match($offer->status) {
                                        'pending' => 'Pendiente',
                                        'processing' => 'En análisis',
                                        'processed' => 'Analizada',
                                        'failed' => 'Error',
                                        'discarded' => 'Descartada',
                                        default => ucfirst($offer->status),
                                    };
                                    $statusColor = match($offer->status) {
                                        'failed' => 'bg-[#fbe9e6] text-[#9b3f34]',
                                        'pending', 'processing' => 'bg-[#edf0ee] text-[#53675f]',
                                        'processed' => $offer->isHighFit() ? 'bg-[#e5f2e8] text-[#27634d]' : 'bg-[#f8eee4] text-[#9b5a31]',
                                        default => 'bg-white text-[#65746d] ring-1 ring-inset ring-[#dce4dd]',
                                    };
                                @endphp
                                <a href="{{ route('offers.show', $offer) }}" wire:navigate class="group grid gap-3 py-4 transition hover:bg-white/70 sm:grid-cols-[minmax(0,1fr)_auto] sm:items-center sm:px-3">
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-semibold text-[#20332e] group-hover:text-[#27634d]">{{ $offer->title ?? 'Puesto sin título' }}</p>
                                        <p class="mt-1 truncate text-sm text-[#65746d]">{{ $offer->company ?? 'Empresa sin especificar' }}</p>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3 sm:justify-end">
                                        <span class="text-xs text-[#7a8881]">{{ $offer->created_at?->format('d/m/Y') }}</span>
                                        @if($offer->status === 'processed' && $offer->fit_score !== null)
                                            <span class="text-xs font-medium text-[#53675f]">{{ $offer->fit_score }}% afinidad</span>
                                        @endif
                                        <span class="inline-flex rounded-md px-2.5 py-1.5 text-xs font-semibold {{ $statusColor }}">{{ $statusLabel }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif

                    @if($stats['in_progress'] > 0 || $stats['failed'] > 0)
                        <div class="mt-5 flex flex-wrap gap-x-6 gap-y-2 text-sm text-[#65746d]">
                            @if($stats['in_progress'] > 0)
                                <p><span class="font-semibold text-[#53675f]">{{ $stats['in_progress'] }}</span> análisis en curso</p>
                            @endif
                            @if($stats['failed'] > 0)
                                <a href="{{ route('offers.index') }}" wire:navigate class="font-medium text-[#9b3f34] hover:underline">{{ $stats['failed'] }} {{ $stats['failed'] === 1 ? 'análisis necesita' : 'análisis necesitan' }} revisión</a>
                            @endif
                        </div>
                    @endif
                </section>

                <aside class="border-t border-[#dce4dd] pt-6 lg:border-l lg:border-t-0 lg:pl-7 lg:pt-0">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.14em] text-[#a65b3e]">Tu base de partida</p>
                            <h2 class="mt-1 font-display text-2xl text-[#20332e]">Perfil profesional</h2>
                        </div>
                        <span class="text-sm font-semibold text-[#27634d]">{{ $profileProgress['percentage'] }}%</span>
                    </div>
                    <div class="mt-4 h-2 overflow-hidden rounded-full bg-[#dce4dd]" role="progressbar" aria-label="Completitud del perfil" aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $profileProgress['percentage'] }}">
                        <div class="h-full rounded-full bg-[#39785d] transition-[width]" style="width: {{ $profileProgress['percentage'] }}%"></div>
                    </div>
                    <p class="mt-2 text-xs text-[#7a8881]">{{ $profileProgress['completed'] }} de {{ $profileProgress['total'] }} datos esenciales completos</p>

                    <ul class="mt-5 grid gap-3">
                        @foreach($profileChecklist as $item)
                            <li class="flex items-center gap-2.5 text-sm {{ $item['complete'] ? 'text-[#53675f]' : 'text-[#7a8881]' }}">
                                <span aria-hidden="true" class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full {{ $item['complete'] ? 'bg-[#e5f2e8] text-[#27634d]' : 'bg-[#edf0ee] text-[#7a8881]' }}">{{ $item['complete'] ? '✓' : '·' }}</span>
                                {{ $item['label'] }}
                            </li>
                        @endforeach
                    </ul>

                    <p class="mt-5 text-sm leading-6 text-[#65746d]">
                        {{ $profileIsReady ? 'Tu perfil tiene lo necesario para analizar ofertas y adaptar candidaturas.' : 'Completa estos datos para que el análisis pueda comparar las ofertas con tu experiencia.' }}
                    </p>
                    <a href="{{ route('profile.edit') }}" wire:navigate class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-[#27634d] transition hover:text-[#1e513d]">
                        {{ $profileIsReady ? 'Revisar mi perfil' : 'Completar mi perfil' }}
                        <span aria-hidden="true">→</span>
                    </a>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
