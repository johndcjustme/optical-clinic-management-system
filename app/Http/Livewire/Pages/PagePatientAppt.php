<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class PagePatientAppt extends Component
{
    public function render()
    {
        return view('livewire.pages.page-patient-appt')
            ->extends('layouts.app')
            ->section('content');;
    }
}
