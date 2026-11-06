<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Luxury Real Estate') }}</title>

        <!-- Fonts & Styles -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Vite or Custom Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="font-family: 'Figtree', sans-serif; background-color: #F7F5EF; margin: 0;">
        <div style="min-height: 100vh;">
            
            <!-- Navigation bar jodi thake -->
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header style="background: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                    <div style="max-width: 1100px; margin: 0 auto; padding: 16px 20px;">
                        {{ $header }}
                    </div>
                </header>
            @endisset

           <!-- Page Content -->
            <main>
                @yield('content')
                
                @isset($slot)
                    {{ $slot }}
                @endisset
            </main>
            
        </div>
    </body>
</html>