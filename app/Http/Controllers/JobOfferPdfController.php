<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JobOffer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobOfferPdfController extends Controller
{
    //
    public function download(JobOffer $offer, string $type)
    {
        abort_if($offer->user_id !== Auth::id(), 403);

        $path = match ($type) {
            'cv' => $offer->cv_pdf_path,
            'letter' => $offer->cover_letter_pdf_path,
            default => abort(404),
        };

        abort_if(blank($path), 404);

        return Storage::disk('s3')->download($path);
    }
}
