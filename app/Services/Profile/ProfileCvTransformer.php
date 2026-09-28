<?php
declare(strict_types=1);

namespace App\Services\Profile;

use App\Models\Profile;

class ProfileCvTransformer
{

    public function toCvArray(Profile $profile): array
    {
        return array_filter([
            'full_name' => $profile->full_name,
            'title' => $profile->title,
            'location' => $profile->location,
            'email' => $profile->email,
            'phone' => $profile->phone,
            'linkedin' => $profile->linkedin,
            'website' => $profile->website,
            'summary' => $profile->summary,

            'experience' => $this->cleanBlock($profile->experience),
            'projects' => $this->cleanBlock($profile->projects),
            'education' => $this->cleanBlock($profile->education),

            'skills' => $profile->skills,
            'soft_skills' => $profile->soft_skills,
            'languages' => $profile->languages,
        ], fn ($v) => !is_null($v) && $v !=='' && $v !== []);
    }

    public function cleanBlock(?array $items): array
    {
        if(empty($items)){
            return [];
        }

        return collect($items)
            ->map(function ($item){
                $cleaned = array_filter($item, function ($value){
                    if (is_array($value)){
                        return !empty(array_filter($value));
                    }
                    return $value !== null && $value !== '';
                });
                return $this->isMeaningful($cleaned) ? $cleaned : null;
            })
            ->filter()
            ->values()
            ->all();
    }

    public function isMeaningful(array $item): bool
    {
        $identifierKeys = ['role', 'company', 'name', 'degree', 'institution'];

        foreach($identifierKeys as $key){
            if (!empty($item[$key])) {
                return true;
            }
        }

        return false;
    }
}
