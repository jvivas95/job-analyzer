<?php
declare(strict_types=1);

namespace App\Jobs;

use App\DTOs\JobAnalysisResult;
use App\Models\JobOffer;
use App\Services\CvPdfGenerator;
use App\Services\Profile\ProfileCvTransformer;

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
    public function handle(JobAnalyzerService $analyzer, ProfileCvTransformer $cvTransformer): void
    {
        //
        $this->offer->update(['status' => 'processing']);

        try{

            $result = $analyzer->analyzeAndAdapt($this->offer);

            $this->offer->update([
                'fit_score' => $result->fitScore,
                'analysis_result' => $result->toArray(),
                'adapted_cv_data' => $this->buildAdaptedCvData($result, $cvTransformer),
                'cover_letter' => $result->coverLetter,
                'status' => 'processed',
                'failure_reason' => null,
            ]);

            if ($this->offer->fresh()->isHighFit()) {
                app(CvPdfGenerator::class)->generateForOffer($this->offer->fresh());
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

    private function buildAdaptedCvData(JobAnalysisResult $result, ProfileCvTransformer $cvTransformer): array
        {

            $profile = $this->offer->user->profile;

            $base = $cvTransformer->toCvArray($profile);
            $base['summary'] = $result->adaptedSummary;
            $base['highlighted_projects'] = $result->highlightedProjects;

            return $base;
        }
}
