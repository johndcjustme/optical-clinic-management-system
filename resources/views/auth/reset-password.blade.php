<x-guest-layout>
    <x-auth-card>
        {{-- <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot> --}}


        <x-auth-card-title>
            <x-slot name="title">
                Reset password
            </x-slot>
            <x-slot name="description">
                Enter your new password below, we're just being extra safe.
            </x-slot>
        </x-auth-card-title>


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="form-control w-full max-w-xs mt-3">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="form-control w-full max-w-xs mt-3">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" type="password" name="password" placeholder="Enter new password..." required />
            </div>

            <!-- Confirm Password -->
            <div class="form-control w-full max-w-xs mt-3">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm new password..." required />
            </div>

            <div class="mt-7">
                <x-button>
                    {{ __('Reset Now') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
