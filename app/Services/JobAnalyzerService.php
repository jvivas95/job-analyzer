<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\JobAnalysisResult;
use App\Models\JobOffer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class JobAnalyzerService
{
    private const string ENDPOINT = 'https://api.openai.com/v1/chat/completions';
    private const string MODEL = 'gpt-4o-mini';

    public function __construct(
        private ?string $apiKey = null,
    ) {
        $this->apiKey = $apiKey ?? config('services.openai.key');
    }

    public function analyzeAndAdapt(JobOffer $offer): JobAnalysisResult
    {
        if (blank($this->apiKey)) {
            throw new RuntimeException('OPENAI_API_KEY no configurada.');
        }

        $response = Http::withToken($this->apiKey)
            ->timeout(90)
            ->post(self::ENDPOINT, [
                'model' => self::MODEL,
                'response_format' => [
                    'type' => 'json_schema',
                    'json_schema' => [
                        'name' => 'job_analysis_response',
                        'strict' => true,
                        'schema' => $this->jsonSchema(),
                    ],
                ],
                'messages' => [
                    ['role' => 'system', 'content' => $this->systemPrompt()],
                    ['role' => 'user', 'content' => $this->userPrompt($offer)],
                ],
                'temperature' => 0.3,
            ]);

        if ($response->failed()) {
            Log::error('OpenAI API request failed', [
                'offer_id' => $offer->id,
                'status'   => $response->status(),
                'body'     => $response->body(),
            ]);

            throw new RuntimeException('Failed to analyze job description');
        }

        $content = $response->json('choices.0.message.content');

        if (blank($content)) {
            throw new RuntimeException('Respuesta vacía de OpenAI.');
        }

        $data = json_decode($content, true);

        return JobAnalysisResult::fromArray($data ?? []);
    }

    private function systemPrompt(): string
    {
        // config('cv_base') es la única fuente de verdad de tu perfil.
        $cv = json_encode(config('cv_base'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return <<<PROMPT
        Eres un reclutador técnico con más de 15 años de experiencia, especializado en perfiles backend PHP/Laravel y Python.

        PERFIL DEL CANDIDATO (JSON):
        {$cv}

        Analiza la oferta de empleo que te va a pasar el usuario frente a este perfil. Sé estricto: no infles el fit_score.

        Instrucciones para cada campo de tu respuesta:
        - fit_score: 0-100, según stack técnico real, seniority requerido y experiencia real del candidato.
        - matching_skills: habilidades del candidato que SÍ coinciden con la oferta.
        - missing_skills: requisitos de la oferta que el candidato no cubre.
        - reason: 2-3 frases explicando la puntuación, en español, honesto y directo.
        - adapted_summary: resumen profesional (máx. 60 palabras) reescrito para encajar con esta oferta.
        - highlighted_projects: qué proyectos del candidato destacar para esta oferta, y por qué.
        - cover_letter: carta de presentación en español, profesional, directa, máx. 250 palabras.
        PROMPT;
    }

    private function userPrompt(JobOffer $offer): string
    {
        return "OFERTA DE EMPLEO\n"
            . "Empresa: {$offer->company}\n"
            . "Título: {$offer->title}\n\n"
            . $offer->description;
    }

    private function jsonSchema(): array
    {
        return [
            'type' => 'object',
            'additionalProperties' => false,
            'properties' => [
                'fit_score' => ['type' => 'integer'],
                'matching_skills' => [
                    'type' => 'array',
                    'items' => ['type' => 'string'],
                    'description' => 'Lista de habilidades que coinciden con la descripción del trabajo',
                ],
                'missing_skills' => [
                    'type' => 'array',
                    'items' => ['type' => 'string'],
                    'description' => 'Lista de habilidades que faltan en el CV del candidato',
                ],
                'reason' => ['type' => 'string'],
                'adapted_summary' => ['type' => 'string'],
                'highlighted_projects' => [
                    'type' => 'array',
                    'items' => ['type' => 'string'],
                    'description' => 'Lista de proyectos destacados del candidato',
                ],
                'cover_letter' => ['type' => 'string'],
            ],
            'required' => [
                'fit_score',
                'matching_skills',
                'missing_skills',
                'reason',
                'adapted_summary',
                'highlighted_projects',
                'cover_letter',
            ],
        ];
    }
}
