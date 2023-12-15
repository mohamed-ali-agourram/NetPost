<?php

namespace App\Livewire\Search;

use Livewire\Attributes\Url;
use Livewire\Component;

class SearchBox extends Component
{
    #[Url( as: 'search')]
    public $search;

    public function handleSubmit()
    {
        $this->validate([
            'search' => 'required|string|max:255',
        ]);

        $this->redirectRoute("search", ['search' => $this->search], navigate: true);
    }

    public function render()
    {
        return view('livewire.search.search-box');
    }
}
