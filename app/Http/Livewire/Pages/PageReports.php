<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class PageReports extends Component
{
    public function render()
    {
        return view('livewire.pages.page-reports')
        ->extends('layouts.app')
        ->section('content');
    }
}
