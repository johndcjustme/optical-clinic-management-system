<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('SCSS/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.0.0-beta2-web/css/all.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    {{-- <link rel="stylesheet" href="{{ asset('js/jquery-3.6.0.min.js') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('Scandia-Regular/style.css') }}"> --}}
    
    <title>Document</title>
    
    @livewireStyles
</head>
<body>
    
    {{-- main page div  --}}
    <div class="outer_container full_vh overflow_hidden relative">
        {{-- sidenav  --}}
        @livewire('components.organisms.layouts.sidenav')
        <section class="section_main full_vh full_w">
            {{-- top bar  --}}
            @livewire('components.organisms.layouts.topbar')
            {{-- main content --}}
            <div class="main_content overflow_hidden full_w">

                @yield('content')

            </div>

        </section>
    </div>

    @livewireScripts
</body>
</html>