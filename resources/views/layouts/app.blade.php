<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') !== 'false' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>C-SAPP - Cyber Security Awareness Program</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Styles -->
        @stack('styles')

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('storage/images/LOGO.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('storage/images/LOGO.png') }}">
    </head>
    <body class="font-sans antialiased min-h-screen flex flex-col" :class="{ 'bg-gray-900 text-gray-100': darkMode, 'bg-gray-100 text-gray-900': !darkMode }">
        <div class="min-h-0 flex flex-col">
            @include('layouts.header')

            <!-- Page Content -->
            <main class="flex-grow">
                @if (isset($header))
                    <header class="bg-white/50 dark:bg-gray-800/50 shadow backdrop-blur-sm">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                        <div class="bg-green-500/20 border border-green-500/30 text-green-400 px-4 py-3 rounded relative backdrop-blur-sm" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                        <div class="bg-red-500/20 border border-red-500/30 text-red-400 px-4 py-3 rounded relative backdrop-blur-sm" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Page Content -->
                @if (View::hasSection('fullwidth'))
                    {{-- Render a full-bleed section provided by the page (e.g. hero) --}}
                    @yield('fullwidth')
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            @yield('content')
                        </div>
                    </div>
                @else
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            @yield('content')
                        </div>
                    </div>
                @endif
            </main>

            @include('layouts.footer')
        </div>

        @stack('scripts')
        
        <script>
            // Set dark mode as default if no preference is stored
            if (localStorage.getItem('darkMode') === null) {
                localStorage.setItem('darkMode', 'true');
            }
        </script>

        {{-- NOTE: Auto-logout-on-unload script removed because it was sending a logout POST
             whenever the page was hidden/unloaded (including normal internal navigation).
             This caused users to be logged out when they clicked header links.

             If you want an automatic session-termination behavior on browser close, we
             should implement a safer approach or rely on server-side session timeouts.
        --}}
    </body>
</html>
