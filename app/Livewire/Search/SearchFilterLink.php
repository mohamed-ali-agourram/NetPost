<?php

namespace App\Livewire\Search;

use Livewire\Component;

class SearchFilterLink extends Component
{
    public $filter_name;
    public $filter;

    public function toggle_filter(string $filter)
    {
        dd($filter);
    }

    public function render()
    {
        return view('livewire.search.search-filter-link');
    }
}
