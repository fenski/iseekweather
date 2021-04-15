<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'iSeekWeather')</title>

        <!-- Fonts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container mx-auto max-w-4xl w-full whitespace-nowrap ">
            <div class="text-3xl py-2">
                <img src="/img/head.png" style="max-width:300px;">
            </div>

            @yield('body')
        </div>
    </body>

    @yield('scripts')
</html>
