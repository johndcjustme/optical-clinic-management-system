@php
    $role = 2;
@endphp

<x-guest-layout>
    <x-auth-card>
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
            <div class="form-control w-full max-w-xs mt-3">
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" type="text" name="name" placeholder="Enter your name..." :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="form-control w-full max-w-xs mt-3">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" type="email" name="email" placeholder="Enter email address..." :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="form-control w-full max-w-xs mt-3">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" type="password" name="password" placeholder="Enter password..." required  autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="form-control w-full max-w-xs mt-3">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" type="password" name="password_confirmation"  placeholder="Confirm password..." required />
            </div>

            <div class="mt-7">
                <x-button style="width:100%;">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

        <x-slot name="footer">
            <p class="text-center mt-8">
                Registered already? 
                <a class="link" href="{{ route('login') }}">Login Here</a>
            </p>
        </x-slot>
    </x-auth-card>
</x-guest-layout>
