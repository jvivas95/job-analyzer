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
    public string $name = '';

    public string $title = '';
    public string $location = '';
    public string $email = '';
    public string $phone = '';
    public string $linkedin = '';
    public ?string $website = null;
    public ?string $secondary_url = null;

    #[Validate('required|string|min:50')]
    public string $summary = '';

    #[Validate('required|array')]
    public array $experience = [];

    public ?array $projects = [];

    #[Validate('required')]
    public array $skills = [];
    public string $newSkill = '';
    public array $education = [];
    public array $soft_skills = [];
    public array $languages = [];

    public function mount(): void
    {
        $user = Auth::user();
        $profile = Auth::user()->profile;

        $this->name = $user->name ?? '';
        $this->title = $profile->title ?? '';
        $this->location = $profile->location ?? '';
        $this->email = $user->email ?? '';
        $this->phone = $profile->phone ?? '';
        $this->linkedin = $profile->linkedin ?? '';
        $this->website = $profile->website ?? '';
        $this->secondary_url = $profile->secondary_url ?? '';
        $this->summary = $profile->summary ?? '';
        $this->experience = (array) ($profile->experience ?? []);
        $this->projects = (array) ($profile->projects ?? []);
        $this->skills = (array) ($profile->skills ?? []);
        $this->education = (array) ($profile->education ?? []);
        $this->soft_skills = (array) ($profile?->soft_skills ?? []);
        $this->languages = (array) ($profile->languages ?? []);

        if(empty($this->experience)){
            $this->addExperience();
        }
    }

    public function save(): void
    {
        $this->validate();

        Auth::user()->profile()->updateOrCreate(
            ['user_id' => Auth::id()], // Condición de búsqueda
            [
                'title'           => $this->title,
                'location'        => $this->location,
                'email'           => $this->email,
                'phone'           => $this->phone,
                'linkedin'        => $this->linkedin,
                'website'         => $this->website,
                'secondary_url'   => $this->secondary_url,
                'summary'         => $this->summary,
                'experience' => $this->experience,
                'projects'   => $this->projects,
                'skills'          => $this->skills,
                'education'  => $this->education,
                'soft_skills'     => $this->soft_skills,
                'languages'       => $this->languages,
            ]
        );

        session()->flash('success', 'Perfil actualizado correctamente');
    }

    public function addSkill(): void
    {
        $trimed = trim($this->newSkill);

        if ($trimed !== '' && !in_array($trimed, $this->skills, true)) {
            $this->skills[] = $trimed;
        }

        $this->newSkill = '';
    }

    public function removeSkill(int $index): void
    {
        unset($this->skills[$index]);
        $this->skills = array_values($this->skills);
    }

    public function addExperience(): void
    {
        $this->experience [] = [
            'role' => '',
            'company' => '',
            'start_date' => '',
            'end_date' => '',
            'description' => '',
        ];
    }

    public function removeExperience(int $index): void
    {
        unset($this->experience[$index]);
        $this->experience = array_values($this->experience);
    }

    public function addProject(): void
    {
        $this->projects [] = [
            'name' => '',
            'url' => '',
            'secondary_url' => '',
            'description' => '',
        ];
    }

    public function removeProject(int $index): void
    {
        unset($this->projects[$index]);
        $this->projects = array_values($this->projects);
    }

}
