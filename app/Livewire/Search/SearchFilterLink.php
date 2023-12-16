<?php

namespace App\Livewire\Search;

use Livewire\Component;

class SearchFilterLink extends Component
{
    public $filter_name;
    public $filter;
    public $search;

    public function toggle_filter(string $filter)
    {
        $this->redirectRoute("search", ['search' => $this->search, "filter" => $this->filter_name], navigate: true);
    }

    public function render()
    {
        return view('livewire.search.search-filter-link');
    }
}
