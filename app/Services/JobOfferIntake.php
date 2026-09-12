<?php
declare(strict_types=1);

namespace App\Services;

use App\Jobs\ProcessJobOffer;
use App\Models\JobOffer;
use InvalidArgumentException;


class JobOfferIntake
{
    public function handle(
        int $userId,
        string $description,
        ?string $url = null,
        ?string $company = null,
        ?string $title = null
    ): JobOffer
    {
        if (blank($description)) {
            throw new InvalidArgumentException('La descripción de la oferta no puede estar vacía');
        }


        $offer = JobOffer::create([
            'user_id' => $userId,
            'title' => $title,
            'company' => $company,
            'description' => $description,
            'url' => $url,
            'status' => 'pending',
        ]);

        ProcessJobOffer::dispatch($offer);

        return $offer;
    }
}
