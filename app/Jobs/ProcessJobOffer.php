<?php
declare(strict_types=1);

namespace App\Jobs;

use App\DTOs\JobAnalysisResult;
use App\Models\JobOffer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Services\JobAnalyzerService;

class ProcessJobOffer implements ShouldQueue
{
    use Queueable;

    public int $tries = 2;
    public int $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly JobOffer $offer
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(JobAnalyzerService $analyzer): void
    {
        //
        $this->offer->update(['status' => 'processing']);

        try{

            $result = $analyzer->analyzeAndAdapt($this->offer);

            $this->offer->update([
                'fit_score' => $result->fitScore,
                'analysis_result' => $result->toArray(),
                'adapted_cv_data' => $this->buildAdaptedCvData($result),
                'cover_letter' => $result->coverLetter,
                'status' => 'processed',
            ]);

            if ($this->offer->fresh()->isHighFit()) {
                // TODO: generar PDF
            }

        }

        catch(\Throwable $e) {

            $this->offer->update([
                'status' => 'failed',
                'failure_reason' => $e->getMessage(),
            ]);

            throw $e;

        }

    }

    private function buildAdaptedCvData(JobAnalysisResult $result): array
        {
            $base = config('cv_base');
            $base['summary'] = $result->adaptedSummary;
            $base['highlighted_projects'] = $result->highlightedProjects;

            return $base;
        }
}
