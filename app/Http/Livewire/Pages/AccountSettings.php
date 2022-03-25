<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountSettings extends Component
{
    use WithFileUploads;

    public $profilephoto;
    public $currTab = 'profile';
    public $find_curr_user;
    public $editProfile = false;
    public $path = 'public/photos/avatars/';
    public $defaultAvatarName = 'default-avatar-user.png';
    // public $resetAvatar = false;
    protected $listeners = ['mount'];

    public $user = [
        'resetAvatar' => false,
        'id' => '',
        'name' => '',
        'email' => '',
        'avatar' => '',
        'password' => '',
        'curr_password' => '',
        'new_password' => '',
        'confirm_new_password' => '',
    ];
    

    public function mount()
    {
        $userId = Auth::user()->id;
        $this->find_curr_user = User::where('id', $userId)->first();
        $this->user['id'] = $this->find_curr_user->id;
        $this->user['name'] = $this->find_curr_user->name;
        $this->user['email'] = $this->find_curr_user->email;
        $this->user['avatar'] = $this->find_curr_user->avatar;

    }

    public function updatedPhoto()
    {
        $this->validate([
            'profilephoto' => 'image|max:1024',
        ]);
    }

    public function updateUserProfile()
    {
        $validateData = $this->validate(
            [
                'user.name' => 'nullable',
                'user.email' => 'required|email',
            ],
            [
                'user.email.required' => 'Email address is required.',
                'user.email.email' => 'Must be a valid email address.',
            ],
        );




        if (empty($this->profilephoto) || ($this->profilephoto === null)) {
            if ($this->user['resetAvatar']) {
                $this->find_curr_user->update([
                    'name' => $this->user['name'],
                    'email' => $this->user['email'],
                    'avatar' => $this->defaultAvatarName,
                ]);
            } else {
                $this->find_curr_user->update([
                    'name' => $this->user['name'],
                    'email' => $this->user['email'],
                ]);
            }
            $this->user['resetAvatar'] = false;
        } else {
            $this->find_curr_user->update([
                'name' => $this->user['name'],
                'email' => $this->user['email'],
                'avatar' => $this->profilephoto->hashName(),
            ]);
            $this->profilephoto->store($this->path);
        }

        if ($this->find_curr_user) {
            $this->editProfile = false;
            session()->flash('message', 'Changes applied succesfully.');
        } else {
            session()->flash('message', 'An error has occured. Please try again.');
        }
        // dd($this->user['name'] . ' ' . $this->user['email'] . ' ' . $this->profilephoto);
    }

    public function changePassword()
    {
        $validateData = $this->validate(
            [
                'user.curr_password' => 'required|min:6|max:24',
                'user.new_password' => 'required|min:6|max:24',
                'user.confirm_new_password' => 'required|min:6|max:24',
            ],
            [
                'user.curr_password.required' => 'required',
                'user.new_password.required' => 'required',
                'user.confirm_new_password.required' => 'required',
                'user.curr_password.min' => 'Minimum of 6 characters',
                'user.new_password.min' => 'Minimum of 6 characters ',
                'user.confirm_new_password.min' => 'Minimum of 6 characters',
            ],
        );

        if (Hash::check($this->user['curr_password'], $this->find_curr_user->password)) {
            if ($this->user['new_password'] !== $this->user['curr_password']) {
                if ($this->user['new_password'] === $this->user['confirm_new_password']) {
                    $this->find_curr_user->update([
                        'password' => Hash::make($this->user['new_password']),
                    ]);
                    if($this->find_curr_user) {
                        session()->flash('success', 'Your password was successfully changed.');
                        $this->user['curr_password'] = '';
                        $this->user['new_password'] = '';
                        $this->user['confirm_new_password'] = '';
                    }
                } else {
                    session()->flash('isNewPasswordMatched', 'Your new password did not matched.');
                }
            } else {
                session()->flash('isNewPasswordMatched', 'Your new password is matching with your current password. Please try another password.');
                $this->user['new_password'] = '';
                $this->user['confirm_new_password'] = '';
            }
        } else {
            session()->flash('isCurrPasswordMatched', 'Your current password did not matched.');
        }
    }


    public function render()
    {
        return view('livewire.pages.account-settings')
            ->extends('layouts.app')
            ->section('content');
    }
}
