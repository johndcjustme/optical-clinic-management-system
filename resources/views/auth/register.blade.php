@php
    $role = 2;
@endphp

<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>


        <div class="flex gap_1 mb_10">
            <x-atom.tab-links.link tab-title="Patient" wire-click="inventoryChangeTable(1)" sub-page=""/>
            <x-atom.tab-links.link tab-title="User" wire-click="inventoryChangeTable(1)" sub-page=""/>
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />


        {{-- <div class="flex gap_1"> --}}
                {{-- <x-atom.tab-links.link tab-title="Items" wire-click="inventoryChangeTable(1)" sub-page="{{ $this->myTab() == 1 }}"/> --}}

        {{-- </div> --}}

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="hidden" name="role" value="{{ $role }}">
            <!-- Name -->
            @if ($role == 1)
            <div>
                <x-label for="passcode" :value="__('Passcode')" />

                <x-input id="passcode" class="block mt-1 w-full" type="text" name="passcode" :value="old('passcode')" required autofocus />
            </div>

            @endif


            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex flex_y_center flex_x_between mt_10">
                <a class="font_m" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
