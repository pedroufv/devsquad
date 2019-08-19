<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="{{ asset('css/landing.css') }}" rel="stylesheet"/>

    </head>
    <body>

        @include('landing.header')

        @include('landing.content')


{{--        @include('landing.footer')--}}


    </body>
</html>
