<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\JobOffer;

class CvPdfGenerator
{

    public function generateForOffer(JobOffer $offer):void
    {

        $slug = Str::slug($offer->company . '-' . $offer->title) ?: (string) $offer->id;

        $cvPath = "cv/{$offer->id}-{$slug}-cv.pdf";
        $letterPath= "cv/{$offer->id}-{$slug}-carta.pdf";

        Storage::disk('local')->makeDirectory('cv');

        Pdf::loadView("pdf.cv", ['data' => $offer->adapted_cv_data])
            ->save(Storage::disk('local')->path($cvPath));

        Pdf::loadView("pdf.cover-letter", [
            'coverLetter' => $offer->cover_letter,
            'contact' => $offer->adapted_cv_data['contact'] ?? [],
            'company' => $offer->company,
            ])
            ->save(Storage::disk('local')->path($letterPath));

        $offer->update([
            'cv_pdf_path' => $cvPath,
            'cover_letter_pdf_path' => $letterPath,
        ]);
    }
}
