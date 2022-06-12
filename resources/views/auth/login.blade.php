<x-guest-layout>
    <x-auth-card>
        {{-- <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot> --}}

        <x-auth-card-title>
            <x-slot name="title">
                Welcome back!
            </x-slot>
            <x-slot name="description">
                Login to your account to continue
            </x-slot>
        </x-auth-card-title>

    
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" class="mt-5">
            @csrf

            <!-- Email Address -->
            <div class="form-control w-full">
                {{-- <x-label for="email" :value="__('Email')" /> --}}
                <x-input id="email" class="" type="email" name="email" placeholder="Enter email address..." :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="form-control w-full mt-3">
                {{-- <x-label for="password" :value="__('Password')" /> --}}
                <x-input id="password" class="" type="password" name="password" placeholder="Enter password..." required  autocomplete="current-password" />
            </div>

            <div class="flex justify-between items-center mt-7">
                <div> 
                    @if (Route::has('password.request'))
                        <a class="link link-hover text-blue-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
    
                <div>
                    <x-button>
                        Login
                    </x-button>
                </div>
            </div>
           
        </form>

        {{-- <x-slot name="footer">
            <p class="text-center mt-8">
                No account? 
                <a class="link" href="{{ route('register') }}">Register Here</a>
            </p>
        </x-slot> --}}
    </x-auth-card>
</x-guest-layout>



 <!-- Remember Me -->
            {{-- <div class="block mt_9">
                <div for="remember_me" class="ui checkbox pointer">
                    <input id="remember_me" type="checkbox" class="mr_3" name="remember">
                    <label for="remember_me" class="pointer" style="opacity: 0.8">{{ __('Remember me') }}</label>
                </div>
            </div> --}}