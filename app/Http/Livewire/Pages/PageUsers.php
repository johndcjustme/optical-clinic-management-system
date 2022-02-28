<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class PageUsers extends Component
{

    public $userShowModal = false,
                $isAddUser = false,
                $isUpdateUser = false;


    public function render()
    {
        return view('livewire.pages.page-users')
            ->extends('layouts.app')
            ->section('content');
    }

    public function resetField($data)
    {
        switch ($data) {
            case 'modalOnClose':
                $this->reset([
                    'userShowModal',
                    'isAddUser',
                    'isUpdateUser',
                ]);
                break;
        }
    }
            
    public function addUser()
    {
        dd('adding user');
    }

    public function updateUser($id)
    {

    }

    public function deleteUser($id)
    {

    }

    public function userShowModal($data, $id) 
    {
        switch ($data) {
            case 'isAddUser':
                $this->isAddUser = true;
                break;
            case 'isUpdateUser':
                $this->isUpdateUser = true;
                break;            
        }
        $this->userShowModal = true;
    }

    public function userCloseModal()
    {
       $this->resetField('modalOnClose');
    }



}
