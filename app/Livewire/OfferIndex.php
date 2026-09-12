<?php

namespace App\Livewire;

use App\Models\JobOffer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class OfferIndex extends Component
{
    public function render()
    {
        $offers = JobOffer::where('user_id', Auth::id())->latest()->get();

        return view ('livewire.offer-index', compact('offers'));
    }
}
