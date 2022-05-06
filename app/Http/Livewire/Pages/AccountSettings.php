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


    public $avatar;

    public $myAvatar;

    public $name;

    public $email;

    public $currentPassword = '';

    public $newPassword = '';

    public $confirmPassword = '';

    public $confirm = [
        'updateAccount' => false,
    ];







    public function render()
    {
        return view('livewire.pages.account-settings')
            ->extends('layouts.app')
            ->section('content');
    }

    public function mount()
    {
        $user = Auth::user();
        $this->avatar = $user->avatar;
        $this->name = $user->name;
        $this->email = $user->email;
    }


    public function updateAccount()
    {
        $this->validate(
            [
                'name' => 'required|max:10',
                'email' => 'required|email'
            ],
            [
                'name.required' => 'Required',
                'name.max' => 'Max: 10',
                'email.required' => 'Required',
                'email.email' => 'Enter valid email',
            ]);


        $user = User::findOrFail(Auth::user()->id)->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if ($user) {
            return redirect('/account')->with('accountUpdated', 'Your account has been updated successfully.');
        } else {
            $this->dispatchBrowserEvent('toast', [
                'class' => 'error',
                'title' => 'Error',
                'message' => 'An error has occured. Please try again.']);
        }

        $this->reset(['confirm']);
    }

    public function changePassword()
    {

        $this->validate(
            [
                'currentPassword' => 'required|min:6',
                'newPassword' => 'required|min:6',
                'confirmPassword' => 'required|min:6|same:newPassword',   
            ],
            [
                'currentPassword.required' => 'Required',
                'newPassword.required' => 'Required',
                'confirmPassword.required' => 'Required',
                
                'currentPassword.min' => 'Min: 6',
                'newPassword.min' => 'Min: 6',
                'confirmPassword.min' => 'Min: 6',

                'confirmPassword.same' => 'Your new password did not match with the repeat password.',
        ]);


        if (Hash::check($this->currentPassword, Auth::user()->password)) {
            $user = User::findOrFail(Auth::user()->id)->update(['password' => Hash::make($this->confirmPassword)]);
            $user
                ? session()->flash('passwordChanged', 'Password has been successfull updated.')
                : session()->flash('passwordChangedError', 'There\'s and error updating your password.');
        } 
        else {
            session()->flash('passwordChangedError', 'Your current password did not match. Please try again');
        }

        $this->reset(['currentPassword', 'newPassword', 'confirmPassword']);
    }

    public function updateAvatar()
    {
        $this->validate([
            'myAvatar' => 'image|max:1024',
        ]);
        dd($this->myAvatar);

        $user = User::findOrFail(Auth::user()->id)->update(['avatar' => $this->myAvatar]);
        $user ? dd('success') : dd('malas');
    }
}
