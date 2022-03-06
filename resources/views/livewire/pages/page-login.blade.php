@php
    $displayOnLogin = '';
    $loginRegister_link = '';
    $loginRegister_label = '';

    if ($this->currentPage == 'login') {
        // $currentPage = request()->path();
        $wireSubmit = 'loginUser';
        $btnLabel = 'Log in';
        $loginRegister_link = '/page/register';
        $loginRegister_label = 'Register';
        // $displayOnRegister = 'nodisplay';
        // $displayOnLogin = '';
        $title = 'Welcome Back';
    }

    if ($this->currentPage == 'register') {
        // $currentPage = request()->path();
        $btnLabel = 'Register';
        $loginRegister_link = '/page/login';
        $loginRegister_label = 'Login';
        // $displayOnRegister = '';
        // $displayOnLogin = 'nodisplay';
        $title = 'Register as';

        $registerPatient ? $wireSubmit = 'registerPatient' : $wireSubmit = 'registerUser';
    }

    if ($this->currentPage == 'forgot-password') {
        // $currentPage = request()->path();
        $btnLabel = 'Send Email';
        $title = 'Forgot Password';
        $wireSubmit = '';
    }

    if ($this->currentPage == 'reset-password') {
        // $currentPage = request()->path();
        $btnLabel = 'Reset Now';
        $title = 'Reset Password';
        $wireSubmit = '';
    }
@endphp

<div class="full_vh full_vw bg_light_200 overflow_hidden">
    <div class="overflow_y noscroll full_h py_20 {{ $this->currentPage == 'login' || $this->currentPage == 'forgot-password' || $this->currentPage == 'reset-password' ? 'flex flex_center' : '' }}">
        <div style="max-width: 300px; min-width: 250px; width:100%; margin-right:auto;margin-left:auto;">
            <div class="card animate_opacity overflow_hidden full_w">
                <div>
                    <div class="mb_10 animate_left">
                        <img onclick="location.assign('/')" src="{{ asset('images/dango-logo-nolabel.png')}}" height="75px" alt="">
                    </div>
                    <div class="animate_opacity">
                        <h4 style="font-weight: normal">{{ $title }} 
                            <span class="accent_1 font_bold {{ $this->currentPage == 'register' ? '' : 'nodisplay' }}">{{  $registerPatient ? 'Patient' : 'User' }}</span>
                        </h4><br>
                    </div>
                    <div class="{{ $this->currentPage == 'register' ? '' : 'nodisplay' }}">
                        <div class="gap_1 mb_20">
                            <div class="full_w flex gap_1">
                                <x-atom.tab-links.link tab-title="Patient" wire-click="$set('registerPatient', true)" sub-page="{{ $registerPatient }}"/>
                                <x-atom.tab-links.link tab-title="User" wire-click="$set('registerPatient', false)" sub-page="{{ $registerPatient === false}}"/>
                                {{-- <button wire:click.prevent="$toggle('registerPatient')" class="full_w">Patient</button> --}}
                            </div>
                            
                        </div>
                    </div>
                    <form wire:submit.prevent="{{ $wireSubmit }}">

                        @switch($this->currentPage)
                            @case('login')
                                @if (session()->has('error'))
                                    <x-atom.alert.alert has="error" type="error"/>
                                @elseif (session()->has('success'))
                                    <x-atom.alert.alert has="success" type="success"/>
                                @endif
                                <div class="">
                                    <input wire:model.defer="login.email" class="animate_left" type="text" placeholder="Username">
                                    @error('login.email')
                                        <span class="text_error " style="font-size: 0.85rem;">{{ $message }}</span>
                                    @enderror
                                    <input wire:model.defer="login.password" class="animate_right" type="password" placeholder="Password">
                                    @error('login.password')
                                        <span class="text_error " style="font-size: 0.85rem;">{{ $message }}</span>
                                    @enderror
                                </div>
                                @break

                            @case('register')
                                <div class="">
                                    @if (session()->has('error'))
                                        <x-atom.alert.alert has="error" type="error"/>
                                    @elseif (session()->has('success'))
                                        <x-atom.alert.alert has="success" type="success"/> 
                                    @endif
                                    @if ($registerPatient)
                                        <fieldset>
                                            <legend>Personal Details</legend><br>
                                            <label for="">First Name</label>
                                            <input wire:model.defer="patient.fname" type="text">
                                            @error('patient.fname') <span class="text_error">{{ $message }}</span><br> @enderror
                                            <label for="">Last Name</label>
                                            <input wire:model.defer="patient.lname" type="text">
                                            @error('patient.lname') <span class="text_error">{{ $message }}</span><br> @enderror
                                            <label for="">M.I.</label>
                                            <input wire:model.defer="patient.mname" type="text" name="" id="">
                                        </fieldset>
                                        <br>
                                        <div class="mt_10">
                                            <fieldset>
                                                <legend>Login Details</legend><br>
                                                <label for="">Email Address</label>
                                                <input wire:model.defer="patient.email" type="email">
                                                @error('patient.email') <span class="text_error">{{ $message }}</span><br> @enderror
                                                @if (session()->has('isEmailTaken'))
                                                    <span class="text_error">{{ session('isEmailTaken') }}</span><br>
                                                @endif
                                                <label for="">Create Password</label>
                                                <input wire:model.defer="patient.password" type="password">
                                                @error('patient.password') <span class="text_error">{{ $message }}</span><br> @enderror
                                                <label for="">Confirm Password</label>
                                                <input wire:model.defer="patient.password_confirm" type="password">
                                                @error('patient.password') <span class="text_error">{{ $message }}</span><br> @enderror
                                                @if (session()->has('isPasswordMatched'))
                                                    <span class="text_error">{{ session('isPasswordMatched') }}</span><br>
                                                @endif
                                            </fieldset>
                                        </div>
                                    @else 
                                        <label for="">Passcode</label>
                                        <input  wire:model.defer="user.passcode" type="text">
                                        @error('user.passcode') <span class="text_error">{{ $message }}</span><br> @enderror
                                        <label for="">User Name</label>
                                        <input  wire:model.defer="user.name" type="text">
                                        @error('user.name') <span class="text_error">{{ $message }}</span><br> @enderror
                                        <br><br>
                                        {{-- <h5 class="dark_100 mb_8 mt_10">Login details</h5> --}}
                                        <fieldset>
                                            <legend>Login Details</legend><br>
                                            <label for="">Email Address</label>
                                            <input  wire:model.defer="user.email" type="text" placeholder="Confirm your email address">
                                            @error('user.email') <span class="text_error">{{ $message }}</span><br> @enderror
                                            @if (session()->has('isEmailTaken'))
                                                <span class="text_error">{{ session('isEmailTaken') }}</span><br>
                                            @endif
                                            <label for="">Create Password</label>
                                            <input  wire:model.defer="user.password" type="password">
                                            @error('user.password') <span class="text_error">{{ $message }}</span><br> @enderror
                                            <label for="">Confirm Password</label>
                                            <input  wire:model.defer="user.password_confirm" type="password">
                                            @error('user.password_confirm') <span class="text_error">{{ $message }}</span><br> @enderror
                                            @if (session()->has('isPasswordMatched'))
                                                <span class="text_error">{{ session('isPasswordMatched') }}</span><br>
                                            @endif
                                        </fieldset>
                                    @endif
                                </div>
                                @break
                            @break

                            @case('forgot-password')
                                <input type="email" placeholder="Enter email address">
                            @break

                            @case('reset-password')
                                <label for="">Email Address</label>
                                <input type="email" name="" id="">
                                <label for="">New Password</label>
                                <input type="password">
                                <label for="">Confirm Password</label>
                                <input type="password">
                            @break
                        @endswitch
                        
                        <div class="flex flex_y_center flex_x_between mt_10">
                            <div class="animate_left">
                                <p class="font_medium {{ $displayOnLogin }}">
                                    @if ($this->currentPage == 'login')
                                        <a href="forgot-password" class="nodecoration">Forgot password</a>
                                    @endif
                                </p>
                            </div>
                            <div class="animate_right">
                                <button type="submit">{{ $btnLabel }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt_10 text_center">
                <a href="{{ $loginRegister_link }}" class="font_m">{{ $loginRegister_label }}</a>
            </div>

            {{ session()->get('curr_user_name') }}
            
        </div>
    </div>
</div>