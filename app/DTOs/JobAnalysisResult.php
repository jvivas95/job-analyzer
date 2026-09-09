<?php
declare(strict_types=1);

namespace App\DTOs;

final class JobAnalysisResult
{
    public function __construct(
        public readonly int $fitScore,
        public readonly array $matchingSkills,
        public readonly array $missingSkills,
        public readonly string $reason,
        public readonly string $adaptedSummary,
        public readonly array $highlightedProjects,
        public readonly string $coverLetter,

    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            fitScore: (int) ($data['fit_score'] ?? 0),
            matchingSkills: $data['matching_skills'] ?? [],
            missingSkills: $data['missing_skills'] ?? [],
            reason: $data['reason'] ?? '',
            adaptedSummary: $data['adapted_summary'] ?? '',
            highlightedProjects: $data['highlighted_projects'] ?? [],
            coverLetter: $data['cover_letter'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'fit_score' => $this->fitScore,
            'matching_skills' => $this->matchingSkills,
            'missing_skills' => $this->missingSkills,
            'reason' => $this->reason,
            'adapted_summary' => $this->adaptedSummary,
            'highlighted_projects' => $this->highlightedProjects,
            'cover_letter' => $this->coverLetter,
        ];
    }
}
