<?php

namespace App\Livewire\Search;

use Livewire\Component;

class SearchPage extends Component
{
    public $search = "Hello World!";

    public function render()
    {
        return view('livewire.search.search-page');
    }
}
