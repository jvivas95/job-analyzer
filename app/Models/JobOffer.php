<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Override;

class JobOffer extends Model
{
    //
    protected $fillable = [
        'title',
        'company',
        'description',
        'url',
        'fit_score',
        'analysis_result',
        'adapted_cv_data',
        'cover_letter',
        'cv_pdf_path',
        'cover_letter_pdf_path',
        'status',
        'failure_reason',
    ];
    #[Override]
    protected function casts(): array
    {
        return[
            'analysis_result' => 'array',
            'adapted_cv_data' => 'array',
            'fit_score' => 'integer',
        ];
    }

    public function isHighFit(): bool
    {
        return ($this->fit_score ?? 0) >= 80;
    }

    public function scopeProcessed(Builder $query): Builder
    {
        return $query->where('status', 'processed');
    }

    public function scopeHighFit(Builder $query, int $threshold = 80): Builder
    {
        return $query->where('fit_score', '>=', $threshold);
    }
}
