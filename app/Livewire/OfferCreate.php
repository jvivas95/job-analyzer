<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Models\JobOffer;
use App\Services\JobOfferIntake;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

use Livewire\Attributes\Validate;

#[Layout('layouts.app')]
class OfferCreate extends Component
{

    #[Validate('required|string|min:20')]
    public string $description = '';

    #[Validate('nullable|url')]
    public ?string $url = null;

    #[Validate('nullable|string|max:255')]
    public ?string $company = null;

    #[Validate('nullable|string|max:255')]
    public ?string $title = null;

    public function render()
    {
        return view('livewire.offer-create');
    }

    public function save(): void
    {
        app(JobOfferIntake::class)->handle(
            userId: Auth::id(),
            description: $this->description,
            url: $this->url,
            company: $this->company,
            title: $this->title
        );

        session()->flash('succes', 'Oferta encolada correctamente');

        $this->redirect(route('offers.index'), navigate: true);

    }
}
