<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{

    /*
    any variable that is defined publicly is available in that particular component
    */


    public $count = 3;

    public function increment(){
        $this->count++;
    }

    public function decrement(){
        $this->count--;
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
