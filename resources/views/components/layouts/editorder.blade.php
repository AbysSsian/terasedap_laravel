<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        @stack('styles')
        <title>{{ $title ?? 'Terasedap' }}</title>
    </head>
    <body>
        <header style="text-align: center">
            <img src="{{asset('images/terasedap_logo.png')}}" alt="" style="height: 60px;">
        </header>
        {{ $slot }}
    </body>
</html>
