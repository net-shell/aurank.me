<?php

namespace App\Livewire\Links;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Link;

#[Layout('components.layouts.app')]
class LinkShow extends Component
{
    public Link $link;

    public function mount(Link $link)
    {
        $this->link = $link;
    }

    public function getTotalRatingProperty()
    {
        return $this->link->ratings->sum('score');
    }

    public function getPositiveRatingsProperty()
    {
        return $this->link->ratings->where('score', '>', 0);
    }

    public function getNegativeRatingsProperty()
    {
        return $this->link->ratings->where('score', '<', 0);
    }

    public function render()
    {
        return view('livewire.links.link-show');
    }
}
