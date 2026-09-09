<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

use App\Jobs\ProcessJobOffer;
use App\Models\JobOffer;

class AnalyzeJobOffer extends Command
{
    protected $signature = 'job:analyze
        {--url= : URL pública de la oferta a analizar}
        {--file= : Ruta a un .txt con el texto de la oferta}
        {--company= : Nombre de la empresa (opcional)}
        {--title= : Título del puesto (opcional)}';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $description = $this->resolveDescription();

        if (blank($description)){
            $this->error('No se pudo obtener el texto de la oferta. Usa --url, --file, o pega el texto cuando se te pida.');
            return self::FAILURE;
        }

        $offer = JobOffer::create([
            'title' => $this->option('title'),
            'company'     => $this->option('company'),
            'description' => $description,
            'url'         => $this->option('url'),
            'status'      => 'pending',
        ]);

        ProcessJobOffer::dispatch($offer);

        $this->info("Oferta #{$offer->id} encolada correctamente. Ejecuta 'php artisan queue:work' para procesarla.");

        return self::SUCCESS;
    }

    private function resolveDescription(): ?string
    {
        if ($url = $this->option('url')){
            return $this->fetchAndStripHtml($url);
        }

        if ($file = $this->option('file')){
            return is_file($file) ? file_get_contents($file) : null;
        }

        $this->line('Pega el texto de la oferta y termina con Ctrl+Z + Enter (Windows) o Ctrl+D (Linux/Mac):');

        $handle = fopen('php://stdin', 'r');
        $content = stream_get_contents($handle);
        fclose($handle);

        return trim((string) $content) ?: null;

    }

    private function fetchAndStripHtml(string $url): ?string
    {
        $response = Http::timeout(20)->get($url);

        if($response->failed()){
            return null;
        }

        $text = strip_tags($response->body());
        $text = preg_replace('/\s+/', ' ', $text);

        return trim((string) $text);
    }
}
