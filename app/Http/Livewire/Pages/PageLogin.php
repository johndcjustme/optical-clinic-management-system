<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;


class PageLogin extends Component
{

    public $currentView = 1;
    public $uri;

    public $currentPage;

    public $registerPatient = true;

    public $login = [
        'email' => '',
        'password' => '',
    ];

    public $patient = [
        'fname' => '',
        'lname' => '',
        'mname' => '',
        'email' => '',
        'password' => '',
        'password_confirm' => '',
    ];

    public $user = [
        'passcode' => '',
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirm' => '',
    ];

    public function mount()
    {
        if (request()->path() == 'page/login'):
            $this->currentPage = 'login';
        endif;
        if (request()->path() == 'page/register'):
            $this->currentPage = 'register';
        endif;
        if (request()->path() == 'page/forgot-password'):
            $this->currentPage = 'forgot-password';
        endif;
        if (request()->path() == 'page/reset-password'):
            $this->currentPage = 'reset-password';
        endif;
    }

    public function resetFields($data)
    {
        switch ($data) {
            case 'patient':
                $this->reset([
                    'patient',
                ]);
                break;
        }
    }

    public function find_old_user()
    {
       return User::where('email', $this->patient['email'])
                ->orWhere('email', $this->login['email'])
                ->orWhere('email', $this->user['email'])
                ->first();
    }

    public function find_old_patient()
    {
        return Patient::where('patient_email', $this->patient['email'])
                    ->orWhere('patient_email', $this->login['email'])
                    ->orWhere('patient_email', $this->user['email'])
                    ->first();
    }


    public function registerPatient()
    {
        // dd(
        //     $this->patient['fname'] .  
        //     $this->patient['lname'] .  
        //     $this->patient['mname'] .  
        //     $this->patient['email'] .  
        //     $this->patient['password'] . 
        //     $this->patient['password_confirm'] 
        // );
        $validateData = $this->validate(
            [
                'patient.email' => 'required|email',
                'patient.password' => 'required|min:6|max:24',
                'patient.fname' => 'required',
                'patient.lname' => 'required',
            ],
            [
                'patient.email.required' => 'The :attribute required.',
                'patient.email.email' => 'The :attribute must be a proper email address.',
                'patient.fname.required' => 'The :attribute is required.',
                'patient.lname.required' => 'The :attribute is required.',
            ],
            [
                'patient.email' => 'email address',
                'patient.password' => 'password',
                'patient.fname' => 'first name',
                'patient.lname' => 'lastname name',
            ],
        );


        if ($this->find_old_user()):
            session()->flash('isEmailTaken', 'This email has already been taken.');
        elseif ($this->find_old_patient()): 
            session()->flash('isEmailTaken', 'This email has already been taken.');
        else: 
            if ($this->patient['password'] === $this->patient['password_confirm']):
                $registerPatient = Patient::create([
                    'patient_fname' => $this->patient['fname'],
                    'patient_lname' => $this->patient['lname'],
                    'patient_mname' => $this->patient['mname'],
                    'patient_email' => $this->patient['email'],
                    'patient_password' => Hash::make($this->patient['password']),
                ]);

                if ($registerPatient):
                    $this->resetFields('patient');
                    session()->flash('success', 'You are successfully registered. You can now log in.');
                else: 
                    session()->flash('error', 'An error has occured.');
                endif;
            else:
                session()->flash('isPasswordMatched', 'The password did not matched!');
            endif;
        endif;    
    }
    
    public function registerUser()
    {
                // dd(
        //     $this->user['passcode'] . " " . 
        //     $this->user['name'] . " " . 
        //     $this->user['email'] . " " . 
        //     $this->user['password'] . " " . 
        //     $this->user['password_confirm'] . " "
        // );
        $validateData = $this->validate(
            [
                'user.email' => 'required|email',
                'user.password' => 'required|min:6|max:24',
                'user.password_confirm' => 'required|min:6|max:24',
                'user.name' => 'required',
                'user.passcode' => 'required',
            ],
            [
                'user.email.required' => ':attribute is required.',
                'user.email.email' => ':attribute must be a proper email address.',
                'user.passcode.required' => ':attribute is required.',
                'user.name' => 'Your :attribute is required.',
                'user.password_confirm' => 'required',
            ],
            [
                'user.email' => 'email address',
                'user.passcode' => 'passcode',
                'user.name' => 'user name',
                'user.password' => 'password',
                'user.password_confirm' => 'confirm password',
            ],
        );


        // if ($this->find_old_user()):
        //     session()->flash('isEmailTaken', 'This email has already been taken.');
        // elseif ($this->find_old_patient()): 
        //     session()->flash('isEmailTaken', 'This email has already been taken.');
        // else: 
            $findUserPasscode = User::where('passcode', $this->user['passcode'])->first();
            if ($findUserPasscode):
                if (!empty($findUserPasscode->email) && ($findUserPasscode->email === $this->user['email'])):
                    if ($this->user['password'] === $this->user['password_confirm']):
                        $registerUser = User::where('id', $findUserPasscode->id)->update([
                            'name' => $this->user['name'],
                            'avatar' => 'default-avatar-user.png',
                            'password' => Hash::make($this->user['password']),
                        ]);
                        if ($registerUser):
                            $this->reset('user');
                            session()->flash('success', 'You are successfully registered. You can now log in.');
                        else: 
                            session()->flash('error', 'An error has occured.');
                        endif;
                    else:
                        session()->flash('isPasswordMatched', 'The password did not matched!');
                    endif;
                elseif (!empty($findUserPasscode->email) && $findUserPasscode->email !== $this->user['email']):
                    session()->flash('error', 'Your Email address didn\'t matched our records. Pls try again');
                else:
                    session()->flash('error', 'This user has been registered already.');
                endif;
            else:
                session()->flash('error', 'Invalid passcode. Please contact your administrator.');
            endif;
        // endif;


    }

    public function loginUser() 
    {

        $validateData = $this->validate(
            [
                'login.email' => 'required|email',
                'login.password' => 'required|min:6|max:24',
            ],
            [
                'login.email.required' => ':attribute is required',
                'login.email.email' => ':attribute must be a valid email address',
                'login.password.required' => ':attribute must be at least 6 characters.',
            ],
            [
                'login.email' => 'Email address',
                'login.password' => 'password',
            ]
        );

        if($this->find_old_user()):
            if (Hash::check($this->login['password'], $this->find_old_user()->password)):
                session()->put([
                    'curr_user_id' => $this->find_old_user()->id, 
                    'curr_user_name' => $this->find_old_user()->name,
                    'curr_user_email' => $this->find_old_user()->email,
                    'curr_user_avatar' => $this->find_old_user()->avatar,
                    'curr_user_passcode' => $this->find_old_user()->passcode,
                    'curr_user_role' => $this->find_old_user()->user_role,
                ]);
                $this->reset(['login']);
                return redirect('/dashboard');
            else: 
                session()->flash('error', 'Invalid email or password.');
                $this->login['password'] = '';
            endif;
        elseif ($this->find_old_patient()):
           if (Hash::check($this->login['password'], $this->find_old_patient()->patient_password)):
                // session()->put(['curr_user_id' => $this->find_old_patient()->id, 'curr_user_name' => $this->find_old_patient()->patient_fname]);
                // $this->reset(['login']);
                // return redirect('/dashboard');
                dd('patient logged in');
           else: 
                session()->flash('error', 'Invalid email or password.');
                $this->login['password'] = '';
           endif;
        else:
            session()->flash('error', 'This email did not matched our records.');
        endif;
    }

    public function changeView(Request $req, $view) 
    {

        $this->uri = $req->path();
        echo 'hello';
    }


    public function render()
    {
        return view('livewire.pages.page-login')
            ->extends('layouts.app')
            ->section('content');
    }
}

