<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ProfileEdit extends Component
{
    #[Validate('required|string|max:255')]
    public string $full_name = '';

    public string $title = '';
    public string $location = '';
    public string $email = '';
    public string $phone = '';
    public string $linkedin = '';
    public ?string $website = null;
    public ?string $secondary_url = null;

    #[Validate('required|string|min:50')]
    public string $summary = '';

    #[Validate('required|string|min:50')]
    public string $experience_text = '';

    public ?string $projects_text = null;

    #[Validate('required|string')]
    public string $skills = '';
    public string $education_text = '';
    public ?string $soft_skills = null;
    public string $languages = '';

    public function mount(): void
    {
        $profile = Auth::user()->profile;

        $this->full_name = $profile->full_name ?? '';
        $this->title = $profile->title ?? '';
        $this->location = $profile->location ?? '';
        $this->email = $profile->email ?? '';
        $this->phone = $profile->phone ?? '';
        $this->linkedin = $profile->linkedin ?? '';
        $this->website = $profile->website ?? '';
        $this->secondary_url = $profile->secondary_url ?? '';
        $this->summary = $profile->summary ?? '';
        $this->experience_text = $profile->experience_text ?? '';
        $this->projects_text = $profile->projects_text ?? '';
        $this->skills = $profile->skills ? implode(', ', $profile->skills) : '';
        $this->education_text = $profile->education_text ?? '';
        $this->soft_skills = $profile->soft_skills ?? '';
        $this->languages = $profile->languages ?? '';
    }

    public function save(): void
    {
        $this->validate();

        Auth::user()->profile->update([
            'full_name'       => $this->full_name,
            'title'           => $this->title,
            'location'        => $this->location,
            'email'           => $this->email,
            'phone'           => $this->phone,
            'linkedin'        => $this->linkedin,
            'website'         => $this->website,
            'secondary_url'   => $this->secondary_url,
            'summary'         => $this->summary,
            'experience_text' => $this->experience_text,
            'projects_text'   => $this->projects_text,
            'skills'          => array_map('trim', explode(',', $this->skills)),
            'education_text'  => $this->education_text,
            'soft_skills'     => $this->soft_skills,
            'languages'       => $this->languages,
        ]);

        session()->flash('success', 'Perfil actualizado correctamente');
    }

}
