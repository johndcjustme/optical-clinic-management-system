<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('SCSS/main.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.0.0-beta2-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('js/jquery-3.6.0.min.js') }}">
    
    <title>Document</title>

    @livewireStyles
</head>
<body>

        @yield('content')

        
    @livewireScripts
</body>
</html>