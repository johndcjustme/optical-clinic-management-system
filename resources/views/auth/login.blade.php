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

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="" type="email" name="email" placeholder="Enter email address..." :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class=""
                                type="password"
                                name="password"
                                placeholder="Enter password..."
                                required 
                                autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            {{-- <div class="block mt_9">
                <div for="remember_me" class="ui checkbox pointer">
                    <input id="remember_me" type="checkbox" class="mr_3" name="remember">
                    <label for="remember_me" class="pointer" style="opacity: 0.8">{{ __('Remember me') }}</label>
                </div>
            </div> --}}
            <div style="text-align: right"> 
                @if (Route::has('password.request'))
                    <a class="font_m" href="{{ route('password.request') }}" style="font-size: 0.95rem">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex flex_x_between flex_y_center mt_20">

                <x-button style="width:100%;">
                    Login
                </x-button>
            </div>
        </form>

    </x-auth-card>
    <div class="extra content" style="margin-top: 1em;">
        <center>
            <p class="ui text grey" style="font-size: 0.95rem">
                No account? 
                <a class="" href="{{ route('register') }}" style="font-size: 0.95rem"> <span class="ui text blue"> Register Here</span></a>
            </p>
        </center>
    </div>
</x-guest-layout>
