<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('SCSS/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.0.0-web/css/all.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    {{-- <link rel="stylesheet" href="{{ asset('js/jquery-3.6.0.min.js') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('Scandia-Regular/style.css') }}"> --}}
    
    <title>Document</title>
    
    @livewireStyles
</head>
<body>

    {{-- main page div  --}}
    <div class="outer_container full_vh overflow_hidden">
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


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/analytic_stats.js') }}"></script>


    <script src="{{ asset('js/modal.js') }}"></script>




    @livewireScripts
</body>
</html>