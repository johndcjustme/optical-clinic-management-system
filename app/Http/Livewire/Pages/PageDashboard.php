<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class PageDashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.page-dashboard')
            ->extends('layouts.app')
            ->section('content');
    }
}
