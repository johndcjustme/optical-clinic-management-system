<?php

namespace App\Http\Livewire\Components\Organisms\Layouts;

use Livewire\Component;

class Sidenav extends Component
{

    public function pages($page) {
        if ($this->page == 'dashboard') {
            return redirect('/dashboard');
        }
        elseif ($this->page = 'users') {
            return redirect('/users');
        }         
        else {
            dd('bla');
        }
    }

    public function render()
    {
        return view('livewire.components.organisms.layouts.sidenav');
    }
}
