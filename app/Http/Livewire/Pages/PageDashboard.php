<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\User;

class PageDashboard extends Component
{

    // public $mysession;
    // public $mysessionid;
    
    public function mount()
    {
        // $this->currentUser = new User();
        // if(session()->has('curr_user_id')) {
            
        //     $this->mysession_name = session()->get('curr_user_name');
        //     $this->mysession_id = session()->get('curr_user_id');
        //     $this->mysession_avatar = session()->get('curr_user_avatar');
        //     $this->mysession_role = session()->get('curr_user_role');
        //     $this->mysession_email = session()->get('curr_user_email');
        //     $this->mysession_passcode = session()->get('curr_user_passcode');

        // } else {
        //     $this->mysession = 'nothig';
        // }
    }
    
    public function render()
    {
        
           
        return view('livewire.pages.page-dashboard')
            ->extends('layouts.app')
            ->section('content');
    }
}
