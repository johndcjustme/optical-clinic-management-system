<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Patient;
use PDF;



class CreatePdf extends Component
{
    public function render()
    {


        $pdf = PDF::loadView('livewire.pages.create-pdf', [
            'patients' => Patient::all(),
        ]);
     
        $pdf->download('tutsmake.pdf');


        return view('livewire.pages.create-pdf', [
                'patients' => Patient::all(),
            ])
            ->extends('layouts.app')
            ->section('content');
           
        
    }
}
