@php
    $role = 2;
@endphp

<x-guest-layout>
    <x-auth-card>
        {{-- <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot> --}}

        <x-auth-card-title>
            <x-slot name="title">
                Let's get stated
            </x-slot>
            <x-slot name="description">
                Create an Account to get all features
            </x-slot>
        </x-auth-card-title>


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Enter your name..." :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Enter email address..." :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                placeholder="Enter password..."
                                required 
                                autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" 
                                placeholder="Confirm password..."
                                required />
            </div>

            <div class="flex flex_y_center flex_x_between" style="margin-top: 2em;">
                <div></div>
                <x-button style="width:100%;">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

    </x-auth-card>
    <div class="extra content" style="margin-top: 1em;">
        <center>
            <p class="ui text grey" style="font-size: 0.95rem">
                Registered already? 
                <a class="" href="{{ route('login') }}" style="font-size: 0.95rem"> <span class="ui text blue"> Login Here</span></a>
            </p>
        </center>
    </div>
</x-guest-layout>
