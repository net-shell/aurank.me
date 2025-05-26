<?php

namespace App\Livewire\Links;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class SubmitLink extends Component
{
    public $url = '';

    protected $rules = [
        'url' => 'required|url|unique:links,url'
    ];

    public function submit()
    {
        $this->validate();

        Link::create([
            'url' => $this->url,
            'user_id' => Auth::id()
        ]);

        $this->reset('url');
        $this->dispatch('link-submitted');
    }

    public function render()
    {
        return view('livewire.links.submit-link');
    }
}
