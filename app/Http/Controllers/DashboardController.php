<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $offerStats = JobOffer::query()
            ->where('user_id', $user->id)
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as analyzed', ['processed'])
            ->selectRaw('SUM(CASE WHEN status = ? AND fit_score >= ? THEN 1 ELSE 0 END) as high_fit', [
                'processed',
                config('jobanalyzer.threshold'),
            ])
            ->selectRaw('SUM(CASE WHEN status IN (?, ?) THEN 1 ELSE 0 END) as in_progress', [
                'pending',
                'processing',
            ])
            ->selectRaw('SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as failed', ['failed'])
            ->selectRaw('(SUM(CASE WHEN cv_pdf_path IS NOT NULL THEN 1 ELSE 0 END) + SUM(CASE WHEN cover_letter_pdf_path IS NOT NULL THEN 1 ELSE 0 END)) as documents')
            ->first();

        $stats = [
            'total' => (int) $offerStats->total,
            'analyzed' => (int) $offerStats->analyzed,
            'high_fit' => (int) $offerStats->high_fit,
            'in_progress' => (int) $offerStats->in_progress,
            'failed' => (int) $offerStats->failed,
            'documents' => (int) $offerStats->documents,
        ];

        $profile = $user->profile;
        $profileChecklist = [
            ['label' => 'Nombre completo', 'complete' => filled($profile?->full_name)],
            [
                'label' => 'Resumen profesional',
                'complete' => filled($profile?->summary) && Str::length(trim($profile->summary)) >= 50,
            ],
            ['label' => 'Experiencia', 'complete' => ! empty($profile?->experience)],
            ['label' => 'Habilidades', 'complete' => ! empty($profile?->skills)],
        ];
        $completedProfileItems = collect($profileChecklist)->where('complete', true)->count();
        $profileProgress = [
            'completed' => $completedProfileItems,
            'total' => count($profileChecklist),
            'percentage' => (int) round($completedProfileItems / count($profileChecklist) * 100),
        ];

        $recentOffers = JobOffer::query()
            ->where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get(['id', 'title', 'company', 'status', 'fit_score', 'created_at']);

        return view('dashboard', [
            'greetingName' => Str::before($user->name, ' '),
            'stats' => $stats,
            'profileChecklist' => $profileChecklist,
            'profileProgress' => $profileProgress,
            'profileIsReady' => $completedProfileItems === count($profileChecklist),
            'recentOffers' => $recentOffers,
        ]);
    }
}
