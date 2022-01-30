<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class PageLanding extends Component
{

    public $search;
    
    public function render()
    {
        return view('livewire.pages.page-landing')
            ->extends('layouts.app')
            ->section('content');
    }
}
