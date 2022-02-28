<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithFileUploads;

class AccountSettings extends Component
{
    use WithFileUploads;

    public $profilephoto;

    public function updatedPhoto()
    {
        $this->validate([
            'profilephoto' => 'image|max:1024',
        ]);
    }
 


    public function render()
    {
        return view('livewire.pages.account-settings')
            ->extends('layouts.app')
            ->section('content');
    }
}
