<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class PageLogin extends Component
{
    public function render()
    {
        return view('livewire.pages.page-login')
            ->extends('layouts.app')
            ->section('content');
    }
}
