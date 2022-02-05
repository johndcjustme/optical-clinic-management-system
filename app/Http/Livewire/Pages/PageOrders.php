<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class PageOrders extends Component
{
    public $myTab = 1;

    public function myTab($value)
    {
        return $this->myTab = $value;
    }

    public function render()
    {
        return view('livewire.pages.page-orders')
            ->extends('layouts.app')
            ->section('content');
    }
}
