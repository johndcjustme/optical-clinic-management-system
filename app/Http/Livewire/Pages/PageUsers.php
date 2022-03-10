<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;


class PageUsers extends Component
{
    use WithFileUploads;

    public $user_added = 'User successfully added.';
    public $user_updated = 'User successfully updated.';

    public $selectedUsers = [];

    public $avatar;

            
    public $modal = [
        'show' => false,
        'isAddUser' => false,
        'isUpdateUser' => false,
    ];

    public $user = [
        'id' => '',
        'avatar' => '',
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirm' => '',
        'role' => '',
    ];

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email',
        'user.password' => 'required|min:6',
        'user.password_confirm' => 'required|min:6',
        'user.role' => 'required',
    ];

    public function render()
    {

        return view('livewire.pages.page-users', ['users' => User::all()])
            ->extends('layouts.app')
            ->section('content');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
        ]);
    }


    public function resetFields()
    {
        $this->reset(['user']);
    }
            
    public function addUser()
    {
        $this->validate([
            'user.avatar' => 'image',
        ]);

        $path = 'public/photos/avatars/';
    
        if ($this->user['password'] === $this->user['password_confirm']) {
            $userAdded = User::create([
                'name' => $this->user['name'],
                'email' => $this->user['email'],
                'user_role' => $this->user['role'],
                'password' => Hash::make($this->user['password']),
                // 'user_photo_path' => 'storage/photos/avatars' . $this->user['avatar']->hashName(),
            ]);
            if (!empty($this->user['avatar'])) {
                // $this->user['avatar'];
                $this->user['avatar']->store($path);
            }
            session()->flash('message', $this->user_added);
            $this->userCloseModal();
        } else {
            session()->flash('errorPass', 'password dont match');
        }
    }

    public function updateUser()
    {
        $userUpdated = User::find($this->user['id']);
        $userUpdated->update([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'user_role' => $this->user['role'],
        ]);
        session()->flash('message', $this->user_updated);
        $this->userCloseModal();
    }

    public function deleteUsers()
    {
        User::query()
            ->whereIn('id', $this->selectedUsers)
            ->delete();
        $this->selectedUsers = [];
    }

    public function userShowModal($data, $id) 
    {
        switch ($data) {
            case 'isAddUser':
                $this->modal['isAddUser'] = true;
                break;
            case 'isUpdateUser':
                $updatingUser = User::findOrFail($id);
                    $this->user['id'] = $updatingUser->id;
                    $this->user['name'] = $updatingUser->name;
                    $this->user['email'] = $updatingUser->email;
                    $this->user['password'] = $updatingUser->password;
                    $this->user['role'] = $updatingUser->user_role;
                $this->modal['isUpdateUser'] = true;
                break;            
        }
        $this->modal['show'] = true;
    }


    public function userCloseModal()
    {
        $this->reset(['modal']);
        $this->resetFields();
    }
}
