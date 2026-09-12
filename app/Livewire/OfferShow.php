<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Models\JobOffer;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class OfferShow extends Component
{

    public JobOffer $offer;

    public function mount(JobOffer $offer): void
    {
        abort_if($offer->user_id !== Auth::id(), 403);

        $this->offer = $offer;
    }

    public function render()
    {
        return view('livewire.offer-show');
    }
}
