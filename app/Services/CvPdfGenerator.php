<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\JobOffer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class CvPdfGenerator
{
    public function generateForOffer(JobOffer $offer): void
    {

        $slug = Str::slug($offer->company.'-'.$offer->title) ?: (string) $offer->id;

        $cvPath = "cv/{$offer->id}-{$slug}-cv.pdf";
        $letterPath = "cv/{$offer->id}-{$slug}-carta.pdf";

        $cvPdf = Pdf::loadView('pdf.cv', ['data' => $offer->adapted_cv_data])->output();

        Storage::disk('s3')->put($cvPath, $cvPdf);

        if (! Storage::disk('s3')->exists($cvPath)) {
            throw new RuntimeException("No se pudo generar el PDF del CV para la oferta #{$offer->id}.");
        }

        $letterPdf = Pdf::loadView('pdf.cover-letter', [
            'coverLetter' => $offer->cover_letter,
            'contact' => [
                'name' => $offer->adapted_cv_data['full_name'] ?? '',
                'email' => $offer->adapted_cv_data['email'] ?? '',
                'phone' => $offer->adapted_cv_data['phone'] ?? '',
                'website' => $offer->adapted_cv_data['website'] ?? '',
            ],
            'company' => $offer->company,
            'title' => $offer->title,
        ])->output();

        Storage::disk('s3')->put($letterPath, $letterPdf);

        if (! Storage::disk('s3')->exists($letterPath)) {
            throw new RuntimeException("No se pudo generar el PDF de la carta para la oferta #{$offer->id}.");
        }

        $offer->update([
            'cv_pdf_path' => $cvPath,
            'cover_letter_pdf_path' => $letterPath,
        ]);
    }
}
