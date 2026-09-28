<div class="min-h-[calc(100vh-4rem)] bg-[#f3f6f2] px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <div class="mx-auto max-w-6xl">
        <a href="{{ route('offers.index') }}" wire:navigate class="inline-flex items-center gap-2 text-sm font-medium text-[#53675f] transition hover:text-[#27634d]">
            <span aria-hidden="true">←</span>
            Volver a mis ofertas
        </a>

        @php
            $statusLabel = match($offer->status) {
                'pending' => 'Pendiente',
                'processing' => 'En análisis',
                'processed' => 'Analizada',
                'failed' => 'Error en el análisis',
                default => ucfirst($offer->status),
            };
        @endphp

        <header class="mt-6 flex flex-col gap-5 border-b border-[#dce4dd] pb-7 lg:flex-row lg:items-end lg:justify-between">
            <div class="min-w-0">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#a65b3e]">Detalle de oportunidad</p>
                <h1 class="mt-2 break-words font-display text-4xl leading-tight text-[#20332e]">{{ $offer->title ?? 'Puesto sin título' }}</h1>
                <p class="mt-2 text-base text-[#65746d]">{{ $offer->company ?? 'Empresa sin especificar' }}</p>
            </div>

            <div class="flex flex-wrap items-center gap-2.5">
                <span class="inline-flex rounded-md bg-white px-3 py-2 text-sm font-medium text-[#53675f] ring-1 ring-inset ring-[#dce4dd]">{{ $statusLabel }}</span>
                @if($offer->fit_score !== null)
                    <span class="inline-flex rounded-md px-3 py-2 text-sm font-semibold {{ $offer->isHighFit() ? 'bg-[#e5f2e8] text-[#27634d]' : 'bg-[#f8eee4] text-[#9b5a31]' }}">{{ $offer->fit_score }}% de afinidad</span>
                @endif
            </div>
        </header>

        <div class="grid gap-8 py-8 lg:grid-cols-[minmax(0,1fr)_16rem] lg:gap-12">
            <div class="min-w-0 divide-y divide-[#dce4dd]">
                @if($offer->status === 'failed')
                    <section class="border-l-2 border-[#b94f43] bg-[#fbe9e6] px-4 py-4 text-sm leading-6 text-[#78362f]">
                        <h2 class="font-semibold">No se pudo completar el análisis</h2>
                        <p class="mt-1">{{ $offer->failure_reason }}</p>
                    </section>
                @elseif(in_array($offer->status, ['pending', 'processing'], true))
                    <section class="border-l-2 border-[#da9b57] bg-[#fbf3e7] px-4 py-4 text-sm leading-6 text-[#765127]">
                        <h2 class="font-semibold">El análisis está en curso</h2>
                        <p class="mt-1">Esta página se actualizará cuando los resultados estén listos.</p>
                    </section>
                @endif

                @if($offer->analysis_result)
                    <section class="py-7 first:pt-0">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <h2 class="font-display text-2xl text-[#20332e]">Lectura del encaje</h2>
                            <span class="rounded-md bg-[#eaf2ec] px-2.5 py-1 text-xs font-semibold text-[#27634d]">Análisis asistido</span>
                        </div>
                        <p class="mt-4 max-w-3xl text-sm leading-7 text-[#53675f]">{{ $offer->analysis_result['reason'] ?? '' }}</p>

                        <div class="mt-7 grid gap-7 sm:grid-cols-2">
                            @if(!empty($offer->analysis_result['matching_skills']))
                                <div>
                                    <h3 class="text-xs font-semibold uppercase tracking-[0.14em] text-[#27634d]">Coincide con tu perfil</h3>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        @foreach($offer->analysis_result['matching_skills'] as $skill)
                                            <span class="rounded-md bg-[#e5f2e8] px-2.5 py-1.5 text-xs font-medium text-[#27634d]">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if(!empty($offer->analysis_result['missing_skills']))
                                <div>
                                    <h3 class="text-xs font-semibold uppercase tracking-[0.14em] text-[#a65b3e]">Requisitos por reforzar</h3>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        @foreach($offer->analysis_result['missing_skills'] as $skill)
                                            <span class="rounded-md bg-[#f6e8dc] px-2.5 py-1.5 text-xs font-medium text-[#92533b]">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>
                @endif

                @if($offer->adapted_cv_data && !empty($offer->adapted_cv_data['summary']))
                    <section class="py-7">
                        <h2 class="font-display text-2xl text-[#20332e]">Resumen profesional adaptado</h2>
                        <p class="mt-4 max-w-3xl text-sm leading-7 text-[#53675f]">{{ $offer->adapted_cv_data['summary'] }}</p>
                    </section>
                @endif

                @if($offer->cover_letter)
                    <section class="py-7">
                        <h2 class="font-display text-2xl text-[#20332e]">Carta de presentación</h2>
                        <p class="mt-4 max-w-3xl whitespace-pre-line text-sm leading-7 text-[#53675f]">{{ $offer->cover_letter }}</p>
                    </section>
                @endif
            </div>

            <aside class="border-t border-[#dce4dd] pt-6 lg:border-l lg:border-t-0 lg:pl-7 lg:pt-0">
                <h2 class="text-xs font-semibold uppercase tracking-[0.14em] text-[#65746d]">Documentos</h2>
                @if($offer->cv_pdf_path || $offer->cover_letter_pdf_path)
                    <div class="mt-4 grid gap-2">
                        @if($offer->cv_pdf_path)
                            <a href="{{ route('offers.download', ['offer' => $offer, 'type' => 'cv']) }}" class="inline-flex items-center justify-center rounded-md bg-[#27634d] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#1e513d]">Descargar CV</a>
                        @endif
                        @if($offer->cover_letter_pdf_path)
                            <a href="{{ route('offers.download', ['offer' => $offer, 'type' => 'letter']) }}" class="inline-flex items-center justify-center rounded-md border border-[#b9cbbf] bg-white px-4 py-2.5 text-sm font-semibold text-[#27634d] transition hover:bg-[#eaf2ec]">Descargar carta</a>
                        @endif
                    </div>
                @else
                    <p class="mt-3 text-sm leading-6 text-[#7a8881]">Los documentos aparecerán aquí cuando el análisis termine.</p>
                @endif
            </aside>
        </div>
    </div>
</div>
