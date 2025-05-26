<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Rating;

#[Layout('components.layouts.app')]
class HomePage extends Component
{
    public $recentRatings;

    public function mount()
    {
        $this->recentRatings = Rating::with(['link', 'user'])
            ->latest()
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.home-page', [
            'recentRatings' => $this->recentRatings
        ]);
    }
}
