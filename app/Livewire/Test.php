<?php

namespace App\Livewire;

use Livewire\Component;

class Test extends Component
{
    public $test = "Hello World!";

    public function testing(string $test){
        $this->test = $test;
    }

    public function render()
    {
        return view('livewire.test');
    }
}
