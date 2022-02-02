<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class PageUsers extends Component
{
    public function render()
    {
        return view('livewire.pages.page-users')
            ->extends('layouts.app')
            ->section('content');
    }
}
