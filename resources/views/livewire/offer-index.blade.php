<div>
    <h1 class="text-xl font-bold mb-4">Mis ofertas</h1>

    @if($offers->isEmpty())
        <p>Todavía no has analizado ninguna oferta.</p>
    @else
        <ul class="space-y-2">
            @foreach($offers as $offer)
                <li class="border p-3 rounded">
                    <strong>{{ $offer->company ?? 'Sin empresa' }}</strong> — {{ $offer->title ?? 'Sin título' }}
                    <br>
                    Estado: {{ $offer->status }}
                    @if($offer->fit_score !== null)
                        · Fit: {{ $offer->fit_score }}%
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
