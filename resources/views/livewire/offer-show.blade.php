<div class="space-y-6">

    <div>
        <a href="{{ route('offers.index') }}" class="text-sm text-indigo-600">&larr; Volver al listado</a>
    </div>

    <div>
        <h1 class="text-2xl font-bold">{{ $offer->company ?? 'Sin empresa' }}</h1>
        <p class="text-gray-600">{{ $offer->title ?? 'Sin título' }}</p>
    </div>

    <div class="flex items-center gap-4">
        <span class="px-2 py-1 rounded text-sm bg-gray-200">
            Estado: {{ $offer->status }}
        </span>

        @if($offer->fit_score !== null)
            <span class="px-2 py-1 rounded text-sm {{ $offer->isHighFit() ? 'bg-green-200' : 'bg-yellow-200' }}">
                Fit: {{ $offer->fit_score }}%
            </span>
        @endif
    </div>

    @if($offer->status === 'failed')
        <div class="bg-red-100 text-red-700 p-3 rounded">
            Falló el análisis: {{ $offer->failure_reason }}
        </div>
    @endif

    @if($offer->analysis_result)
        <div class="border rounded p-4 space-y-3">
            <h2 class="font-semibold">Análisis</h2>

            <p>{{ $offer->analysis_result['reason'] ?? '' }}</p>

            @if(!empty($offer->analysis_result['matching_skills']))
                <div>
                    <strong>Coincide en:</strong>
                    <ul class="list-disc list-inside">
                        @foreach($offer->analysis_result['matching_skills'] as $skill)
                            <li>{{ $skill }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($offer->analysis_result['missing_skills']))
                <div>
                    <strong>Faltan:</strong>
                    <ul class="list-disc list-inside">
                        @foreach($offer->analysis_result['missing_skills'] as $skill)
                            <li>{{ $skill }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif

    @if($offer->adapted_cv_data && !empty($offer->adapted_cv_data['summary']))
        <div class="border rounded p-4">
            <h2 class="font-semibold mb-2">Resumen adaptado</h2>
            <p>{{ $offer->adapted_cv_data['summary'] }}</p>
        </div>
    @endif

    @if($offer->cover_letter)
        <div class="border rounded p-4">
            <h2 class="font-semibold mb-2">Carta de presentación</h2>
            <p class="whitespace-pre-line">{{ $offer->cover_letter }}</p>
        </div>
    @endif

    @if($offer->cv_pdf_path || $offer->cover_letter_pdf_path)
        <div class="flex gap-4">
            @if($offer->cv_pdf_path)
                <a href="{{ route('offers.download', ['offer' => $offer, 'type' => 'cv']) }}"
                    class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Descargar CV
                </a>
            @endif

            @if($offer->cover_letter_pdf_path)
                <a href="{{ route('offers.download', ['offer' => $offer, 'type' => 'letter']) }}"
                    class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Descargar carta
                </a>
            @endif
        </div>
    @endif

</div>
