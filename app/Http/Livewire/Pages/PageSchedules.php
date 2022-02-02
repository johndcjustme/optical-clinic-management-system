<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class PageSchedules extends Component
{
    public function render()
    {
        return view('livewire.pages.page-schedules')
            ->extends('layouts.app')
            ->section('content');
    }
}
