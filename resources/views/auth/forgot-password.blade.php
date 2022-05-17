<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>


        <x-auth-card-title>
            <x-slot name="title">
                Forgot Password
            </x-slot>
            <x-slot name="description">
                Enter your email address and we'll send you a link to reset your password.
            </x-slot>
        </x-auth-card-title>



        <!-- Session Status -->
        <x-auth-session-status class="" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mt_10">
                <x-label for="email" :value="__('Email Address')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Enter email address..." :value="old('email')" required autofocus />
            </div>

            <div class="flex flex_x_end" style="margin-top: 1.5em;">
                <x-button style="width:100%;">
                    {{ __('Send link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
