<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowPosts extends Component
{

    public $count = 4;
    public $search;

    public function increment()
    {
        $this->count++;
    }
    public function decrement() 
    {
        $this->count--;
    }
    // public $message = 'Hello World';


    public function render()
    {
        return view('livewire.show-posts')
            ->extends('layouts.app')
            ->section('content');
    }
}
