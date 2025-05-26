<?php

namespace App\Livewire\Links;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Rating;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class RatingSlider extends Component
{
    public $link;
    public $score = 0;
    public $comment = '';
    public $screenshot;

    public function mount(Link $link)
    {
        $this->link = $link;
    }

    public function rate()
    {
        $this->validate([
            'score' => 'required|numeric|between:-1,1',
            'comment' => 'nullable|string|max:500'
        ]);

        $rating = Rating::updateOrCreate(
            [
                'link_id' => $this->link->id,
                'user_id' => Auth::id()
            ],
            [
                'score' => $this->score
            ]
        );

        if ($this->comment || $this->screenshot) {
            $rating->evidence()->create([
                'comment' => $this->comment,
                'user_id' => Auth::id()
            ]);
        }

        $this->dispatch('rated');
    }

    public function render()
    {
        return view('livewire.links.rating-slider');
    }
}
