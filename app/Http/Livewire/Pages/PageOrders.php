<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;


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

    public function storage($url) 
    {
        if (!empty($url) || ($url != null)) {
            return Storage::disk('avatars')->url($url); } 
        else {
            return Storage::disk('avatars')->url('default-user-avatar.png'); } 
    }
}
