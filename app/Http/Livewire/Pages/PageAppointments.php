<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class PageAppointments extends Component
{

    public $myTab = 1;

    public function myTab($value)
    {
        return $this->myTab = $value;
    }

    public function render()
    {
        return view('livewire.pages.page-appointments')
            ->extends('layouts.app')
            ->section('content');
    }
}
