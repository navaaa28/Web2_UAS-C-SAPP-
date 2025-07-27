<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') !== 'false' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased" :class="{ 'bg-gray-900 text-gray-100': darkMode, 'bg-gray-100 text-gray-900': !darkMode }">
        <div class="min-h-screen flex flex-col">
            @include('layouts.header')
            
            <div class="flex-grow flex flex-col sm:justify-center items-center pt-6 sm:pt-0" :class="{ 'bg-gray-900': darkMode, 'bg-gray-100': !darkMode }">
                <div>
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current" :class="{ 'text-gray-400': darkMode, 'text-gray-500': !darkMode }" />
                    </a>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg" :class="{ 'bg-gray-800': darkMode, 'bg-white': !darkMode }">
                    {{ $slot }}
                </div>
            </div>
        </div>
        
        <script>
            // Set dark mode as default if no preference is stored
            if (localStorage.getItem('darkMode') === null) {
                localStorage.setItem('darkMode', 'true');
            }
        </script>
    </body>
</html>
