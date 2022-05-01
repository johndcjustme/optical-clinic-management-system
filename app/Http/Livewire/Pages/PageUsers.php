<?php

namespace App\Http\Livewire\Pages;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;



class PageUsers extends Component
{
    use WithFileUploads;
    use WithPagination;



    public $user_added = 'User successfully added.';

    public $user_updated = 'User successfully updated.';

    public $selectedUsers = [];

    public $avatar;

    public $subPage = 1;

    // public $role;

    public $changePassword = false;

    public $modalRoleTab = false;

    public $pageNumber = 2;

    public $filter;

    public $roleName = '';

    public $confirmDeleteRole = false;

    public $searchUser = '';

    public $confirm = [
        'deleteUser'    => false,
        'deletedUser'   => false,
        'deleteUsers'   => false,
        'deletedUsers'  => false,
    ];

    protected $queryString = [
        'subPage' => ['except' => ''],
        'searchUser' => ['except' => ''],
        // 'role' => ['except' => ''],
    ];

            
    public $modal = [
        'show' => false,
        'add' => false,
        'update' => false,
    ];

    public $user = [
        'id' => '',
        'preview' => '',
        'avatar' => '',
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
        // 'role' => '',
    ];

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email',
        'user.password' => 'required|min:6',
        'user.password_confirmation' => 'required|min:6',
        // 'user.role' => 'required',
    ];

    public function render()
    {

    

        $searchUser = $this->searchUser . '%';

        // $data = [
        //     'admins' => User::where('user_role', 1)->where('user_role', 2)->get(),
        //     'users' => User::with('role')->where('name', 'like', $searchUser)->get(),
        //     'allRoles' => Role::all(),
        // ];

        // if (!empty($this->role)) {
        //     $data += ['roles' => Role::where('id', $this->role)->get()];    
        // } else {
        //     $data += ['roles' => Role::all()];    
        // }


        return view('livewire.pages.page-users')
            ->extends('layouts.app')
            ->section('content');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
        ]);
    }

    public function updatedSubPage()
    {
        //
    }

    public function subPage($value)
    {
        return $value;
    }

    public function resetFields()
    {
        $this->reset([
            'user', 
            // 'modalRoleTab'
        ]);
    }




    public function createOrUpdateUser()
    {
        !empty($this->user['id'])
            ? $this->updateUser()
            : $this->addUser();
    }


    public function addUser()
    {
        $this->validate(
            [
                'user.name' => 'required|string|max:255',
                'user.email' => 'required|string|email|max:255|unique:users,email',
                // 'user.role' => 'required',
                'user.password' => 'required|min:6',
                'user.password_confirmation' => 'required|min:6',
                'avatar' => 'image|max:1024|nullable',
            ],
            [
                'user.name.required' => 'Required',
                'user.email.required' => 'Required',
                'user.email.unique' => 'Email already taken',
                'user.password.required' => 'Required',
                'user.password.min' => 'Too short',
                'user.password_confirmation.required' => 'Required',
                'user.password_confirmation.min' => 'Too short',
                // 'user.role.required' => 'Required',
            ],
        );

        $newUser = [
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'password' => Hash::make($this->user['password']),
            // 'role_id' => $this->user['role'],
        ];

        if (!empty($this->avatar)) {
            $newUser += ['avatar' => $this->avatar->hashName()];
            $this->avatar->store('/', 'avatars');
        }

        if ($this->user['password'] == $this->user['password_confirmation']) {
            $user = User::create($newUser);

            $this->closeModal();

            $this->dispatchBrowserEvent('toast',[
                'title'   => NULL,
                'class'   => 'success',
                'message' => 'User Successfully Added.',
            ]);

        } else {
            session()->flash('passwordUnmatched', 'Your password did not match.'); 
        }

    }

    public function updateUser()
    {
        $this->validate(
            [
                'user.name' => 'required|string|max:255',
                'user.email' => 'required|string|email|max:255|unique:users,email,' . $this->user['id'],
                // 'user.role' => 'required',
                'avatar' => 'image|max:1024|nullable',
            ],
            [
                'user.name.required' => 'Required',
                'user.email.required' => 'Required',
                'user.email.unique' => 'Email already taken',
                // 'user.role.required' => 'Required',
            ],
        );

        $USER = User::findOrFail($this->user['id']);

        $updateUser = [
            'name' => $this->user['name'],
            // 'role_id' => $this->user['role'],
            'email' => $this->user['email'],
        ];

        if (!empty($this->avatar)) {
            Storage::disk('avatars')->exists($USER->avatar)
                ? Storage::disk('avatars')->delete($USER->avatar) 
                : NULL;

            $updateUser += ['avatar' => $this->avatar->hashName()];
            $this->avatar->store('/', 'avatars');         
        }

        $USER->update($updateUser);

        $this->closeModal();

        $this->dispatchBrowserEvent('toast',[
            'title'   => NULL,
            'class'   => 'success',
            'message' => 'Updated successfully.',
        ]);
    }





    public function deleteUser($userId)
    {
        $this->user['id'] = $userId;
        $this->confirm['deleteUser'] = true;
        $this->dispatchBrowserEvent('confirm-dialog');
    }

    public function deletedUser()
    {
        $USER = User::findOrFail($this->user['id']);

        if (!empty($USER->avatar)) {
            Storage::disk('avatars')->exists($USER->avatar)
                ? Storage::disk('avatars')->delete($USER->avatar) : '';
        }

        $USER->destroy($this->user['id']);

        $this->dispatchBrowserEvent('confirm-dialog-close');

        $this->dispatchBrowserEvent('toast',[
            'title'   => NULL,
            'class'   => 'success',
            'message' => 'Deleted successfully.',
        ]);
    }

    public function deleteUsers()
    {
        $this->confirm['deleteUsers'] = true;
        $this->dispatchBrowserEvent('confirm-dialog');
    }

    public function deletedUsers()
    {

        $users = User::find($this->selectedUsers);

        foreach ($users as $user) {
            if ($user->avatar) {
                Storage::disk('avatars')->exists($user->avatar) 
                    ? Storage::disk('avatars')->delete($user->avatar) : '';
            }
        }

        User::destroy($this->selectedUsers);

        $this->selectedUsers = [];

        $this->dispatchBrowserEvent('confirm-dialog-close');

        $this->dispatchBrowserEvent('toast',[
            'title'   => NULL,
            'class'   => 'success',
            'message' => 'Deleted successfully.',
        ]);
    }
    
    public function confirm()
    {
        $this->confirm['deleteUser']
            ? $this->deletedUser()
            : NULL;
        $this->confirm['deleteUsers']
            ? $this->deletedUsers()
            : NULL;
    }







    public function changePassword()
    {
        $this->validate(
            [
                'user.password' => 'required|min:6',
                'user.password_confirmation' => 'required|min:6',
            ],
            [
                'user.password.required' => 'Required',
                'user.password.min' => 'Too short',
                'user.password_confirmation.required' => 'Required',
                'user.password_confirmation.min' => 'Too short',
            ]
        );


        $user = User::findOrFail($this->user['id']);

        if ($this->user['password'] == $this->user['password_confirmation']) {
             if (Hash::check($this->user['password'], $user->password)) {
                 session()->flash('passwordUnmatched', 'Your new password matched your current password.'); 
             } else {
                 $user->update(['password' => Hash::make($this->user['password'])]);
                 $this->dispatchBrowserEvent('toast',[
                    'title'   => NULL,
                    'class'   => 'success',
                    'message' => 'Your new password has been set successfully.',
                    
                ]);
                $this->user['password'] = '';
                $this->user['password_confirmation'] = '';
                $this->changePassword = false;
             }
        } else {
            session()->flash('passwordUnmatched', 'Your password did not match.'); 
        }
    }









            
    public function xaddUser()
    {
        $this->validate([
            'user.avatar' => 'image',
        ]);

        $path = 'public/photos/avatars/';
    
        if ($this->user['password'] === $this->user['password_confirmation']) {
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
            $this->closeModal();
        } else {
            session()->flash('errorPass', 'password dont match');
        }
    }

    public function xupdateUser()
    {
        $userUpdated = User::find($this->user['id']);
        $userUpdated->update([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'user_role' => $this->user['role'],
        ]);
        session()->flash('message', $this->user_updated);
        $this->closeModal();
    }

    public function addRole()
    {
        $this->validate([
            'roleName' => 'required',
        ]);


        Role::create([
            'name' => Str::lower(Str::replace(' ', '_', $this->roleName)),
            'display_name' => Str::title($this->roleName),
            'Description' => Str::title($this->roleName),
        ]);

        $this->reset(['roleName']);
    }

    // public function deleteRole($roleId)
    // {
    //     Role::destroy($roleId);
    // }




    // public function openModalRoles($action)
    // {
    //     $this->modalRoleTab = true;
    //     $this->modal['add'] = true;
    //     $this->modal['show'] = true;
    // }

    public function showModal($action, $id) 
    {
        switch ($action) {
            case 'add':
                $this->modal['add'] = true;
                break;
            case 'update':
                $user = User::findOrFail($id);
                    $this->user['id']         = $user->id;
                    $this->user['name']       = $user->name;
                    $this->user['email']      = $user->email;
                    $this->user['role']       = $user->role_id;
                    $this->user['avatar']     = $user->avatar;
                $this->modal['update']  = true;
                break;            
        }

        $this->modal['show'] = true;
    }


    public function closeModal()
    {
        $this->reset([
            'modal', 
            // 'confirmDeleteRole', 
            'avatar', 'changePassword']);
        $this->resetErrorBag();
        $this->resetFields();
    }








    public function date($date) { return \Carbon\Carbon::parse($date)->isoFormat('MMM D, YYYY'); }

    public function storage($url) 
    {
        if (!empty($url) || ($url != NULL)) 
            return Storage::disk('avatars')->url($url); 
        else 
            return Storage::disk('avatars')->url('default-user-avatar.png'); 
    }
    
}
