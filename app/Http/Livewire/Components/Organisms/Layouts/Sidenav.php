<?php

namespace App\Http\Livewire\Components\Organisms\Layouts;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Sidenav extends Component
{

    public function storage($url) 
    {
        if (!empty($url) || ($url != NULL)) 
            return Storage::disk('avatars')->url($url); 
        else 
            return Storage::disk('avatars')->url('default-user-avatar.png'); 
    }
    

    public function render()
    {
        return view('livewire.components.organisms.layouts.sidenav');
    }
}
