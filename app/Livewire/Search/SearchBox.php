<?php

namespace App\Livewire\Search;

use Livewire\Attributes\Url;
use Livewire\Component;

class SearchBox extends Component
{
    #[Url( as: 'search')]
    public $search;
    #[Url( as: 'filter')]
    public $filter = "all";

    public function handleSubmit()
    {
        $this->validate([
            'search' => 'required|string|max:255',
        ]);

        $this->redirectRoute("search", ['search' => $this->search, "filter" => $this->filter], navigate: true);
    }

    public function render()
    {
        return view('livewire.search.search-box');
    }
}
