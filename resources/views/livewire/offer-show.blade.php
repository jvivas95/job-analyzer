<div class="min-h-screen bg-[#0a1111] px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-6xl">
        <div class="mb-6">
            <a href="{{ route('offers.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#2b4441] bg-[#0d1716] px-3 py-1.5 text-sm text-[#dfeae7] transition hover:border-[#4a8a7b] hover:text-[#edf8f4]">
                <span aria-hidden="true">←</span>
                Volver al listado
            </a>
        </div>

        <div class="overflow-hidden rounded-[30px] border border-[#24463f] bg-[#0d1716] shadow-[0_0_0_1px_rgba(88,166,146,0.12),0_20px_40px_rgba(10,18,17,0.75)]">
            <div class="border-b border-[#24463f] bg-[radial-gradient(circle_at_top_left,_rgba(95,201,169,0.16),_transparent_36%)] p-6 sm:p-8">
                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-[0.32em] text-[#8fe7c3]">Oferta</p>
                        <h1 class="mt-3 text-3xl font-bold tracking-tight text-[#edf8f4] sm:text-4xl">
                            {{ $offer->company ?? 'Sin empresa' }}
                        </h1>
                        <p class="mt-2 text-base text-[#dfeae7]">{{ $offer->title ?? 'Sin título' }}</p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center rounded-full border border-[#2f4d49] bg-[#122c29] px-3 py-1.5 text-xs font-medium uppercase tracking-[0.18em] text-[#dfeae7]">
                            Estado: {{ $offer->status }}
                        </span>

                        @if($offer->fit_score !== null)
                            <span class="inline-flex items-center rounded-full px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.18em] {{ $offer->isHighFit() ? 'border border-[#2d5a4d] bg-[#17372d] text-[#a8f0c8]' : 'border border-[#4a3a22] bg-[#2b2317] text-[#f3d290]' }}">
                                Fit: {{ $offer->fit_score }}%
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="space-y-6 p-6 sm:p-8">
                @if($offer->status === 'failed')
                    <div class="rounded-2xl border border-[#5a2c31] bg-[#391d1f] p-4 text-sm text-[#f7b8bf]">
                        <span class="font-semibold">Falló el análisis:</span> {{ $offer->failure_reason }}
                    </div>
                @endif

                @if($offer->analysis_result || $offer->adapted_cv_data || $offer->cover_letter)
                    <div class="grid gap-6 xl:grid-cols-[1.3fr_0.7fr]">
                        @if($offer->analysis_result)
                            <section class="rounded-[24px] border border-[#24463f] bg-[#0b1413] p-5">
                                <div class="mb-4 flex items-center justify-between">
                                    <h2 class="text-lg font-semibold text-[#edf8f4]">Análisis</h2>
                                    <span class="rounded-full border border-[#325f57] bg-[#143932] px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.22em] text-[#a8f0c8]">AI</span>
                                </div>

                                <p class="text-sm leading-7 text-[#dfeae7]">{{ $offer->analysis_result['reason'] ?? '' }}</p>

                                <div class="mt-5 space-y-5">
                                    @if(!empty($offer->analysis_result['matching_skills']))
                                        <div>
                                            <h3 class="mb-3 text-[10px] font-semibold uppercase tracking-[0.28em] text-[#9feac8]">Coincide en</h3>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($offer->analysis_result['matching_skills'] as $skill)
                                                    <span class="rounded-full border border-[#2d5a4d] bg-[#17372d] px-2.5 py-1 text-xs font-medium text-[#a8f0c8]">{{ $skill }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if(!empty($offer->analysis_result['missing_skills']))
                                        <div>
                                            <h3 class="mb-3 text-[10px] font-semibold uppercase tracking-[0.28em] text-[#f3d290]">Faltan</h3>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($offer->analysis_result['missing_skills'] as $skill)
                                                    <span class="rounded-full border border-[#4a3a22] bg-[#2b2317] px-2.5 py-1 text-xs font-medium text-[#f3d290]">{{ $skill }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </section>
                        @endif

                        <div class="space-y-6">
                            @if($offer->adapted_cv_data && !empty($offer->adapted_cv_data['summary']))
                                <section class="rounded-[24px] border border-[#24463f] bg-[#0b1413] p-5">
                                    <h2 class="text-lg font-semibold text-[#edf8f4]">Resumen adaptado</h2>
                                    <p class="mt-3 text-sm leading-7 text-[#dfeae7]">{{ $offer->adapted_cv_data['summary'] }}</p>
                                </section>
                            @endif

                            @if($offer->cv_pdf_path || $offer->cover_letter_pdf_path)
                                <section class="rounded-[24px] border border-[#24463f] bg-[#0b1413] p-5">
                                    <h2 class="text-lg font-semibold text-[#edf8f4]">Descargas</h2>
                                    <div class="mt-4 flex flex-col gap-3">
                                        @if($offer->cv_pdf_path)
                                            <a href="{{ route('offers.download', ['offer' => $offer, 'type' => 'cv']) }}"
                                               class="inline-flex items-center justify-center rounded-xl border border-[#325f57] bg-[#143932] px-4 py-2.5 text-sm font-semibold text-[#ecfff8] transition hover:border-[#5fb39a] hover:bg-[#18463f]">
                                                Descargar CV
                                            </a>
                                        @endif

                                        @if($offer->cover_letter_pdf_path)
                                            <a href="{{ route('offers.download', ['offer' => $offer, 'type' => 'letter']) }}"
                                               class="inline-flex items-center justify-center rounded-xl border border-[#2f4d49] bg-[#122c29] px-4 py-2.5 text-sm font-semibold text-[#dfeae7] transition hover:border-[#4a8a7b] hover:bg-[#173834]">
                                                Descargar carta
                                            </a>
                                        @endif
                                    </div>
                                </section>
                            @endif
                        </div>
                    </div>
                @endif

                @if($offer->cover_letter)
                    <section class="rounded-[24px] border border-[#24463f] bg-[#0b1413] p-5">
                        <h2 class="text-lg font-semibold text-[#edf8f4]">Carta de presentación</h2>
                        <div class="mt-4 rounded-2xl border border-[#24463f] bg-[#0a1212] p-4">
                            <p class="whitespace-pre-line text-sm leading-7 text-[#dfeae7]">{{ $offer->cover_letter }}</p>
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
</div>
