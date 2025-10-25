<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') !== 'false' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" :class="{ 'bg-gray-100 text-gray-900': !darkMode, 'bg-[#070A13] text-gray-100': darkMode }">
    <div class="min-h-screen">
        <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-72 bg-white/80 dark:bg-[#1A2333]/20 backdrop-blur-sm border-r border-gray-200 dark:border-gray-800">
            <div class="flex items-center justify-between h-16 px-6 border-b border-gray-800">
                <div class="flex items-center">
                    <div class="relative">
                        <div class="absolute -inset-1">
                            <div class="w-full h-full mx-auto opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
                        </div>
                        <svg class="relative w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <span class="ml-3 text-xl font-bold text-gray-900 dark:text-white">Admin Panel</span>
                </div>
            </div>
            <nav class="mt-8">
                <div class="px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 dark:bg-[#1A2333]/70 text-blue-700 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1A2333]/50' }}">
                        <div class="relative">
                            <div class="absolute -inset-1 {{ request()->routeIs('admin.dashboard') ? 'opacity-50' : 'opacity-0 group-hover:opacity-30' }} blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <svg class="relative w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        </div>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="group flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-[#1A2333]/70 text-white' : 'hover:bg-[#1A2333]/50' }}">
                        <a href="{{ route('admin.users.index') }}" class="group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-blue-100 dark:bg-[#1A2333]/70 text-blue-700 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1A2333]/50' }}">
                        <div class="relative">
                            <div class="absolute -inset-1 {{ request()->routeIs('admin.users.*') ? 'opacity-50' : 'opacity-0 group-hover:opacity-30' }} blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <svg class="relative w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        </div>
                        Pengguna
                    </a>
                    <a href="{{ route('admin.modules.index') }}" class="group flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.modules.*') ? 'bg-[#1A2333]/70 text-white' : 'hover:bg-[#1A2333]/50' }}">
                        <a href="{{ route('admin.modules.index') }}" class="group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.modules.*') ? 'bg-blue-100 dark:bg-[#1A2333]/70 text-blue-700 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1A2333]/50' }}">
                        <div class="relative">
                            <div class="absolute -inset-1 {{ request()->routeIs('admin.modules.*') ? 'opacity-50' : 'opacity-0 group-hover:opacity-30' }} blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <svg class="relative w-5 h-5 mr-3 {{ request()->routeIs('admin.modules.*') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        </div>
                        Modul
                    </a>
                    <a href="{{ route('admin.quizzes.index') }}" class="group flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.quizzes.*') ? 'bg-[#1A2333]/70 text-white' : 'hover:bg-[#1A2333]/50' }}">
                        <a href="{{ route('admin.quizzes.index') }}" class="group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.quizzes.*') ? 'bg-blue-100 dark:bg-[#1A2333]/70 text-blue-700 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1A2333]/50' }}">
                        <div class="relative">
                            <div class="absolute -inset-1 {{ request()->routeIs('admin.quizzes.*') ? 'opacity-50' : 'opacity-0 group-hover:opacity-30' }} blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <svg class="relative w-5 h-5 mr-3 {{ request()->routeIs('admin.quizzes.*') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        </div>
                        Kuis
                    </a>
                    <a href="{{ route('admin.simulations.index') }}" class="group flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.simulations.*') ? 'bg-[#1A2333]/70 text-white' : 'hover:bg-[#1A2333]/50' }}">
                        <a href="{{ route('admin.simulations.index') }}" class="group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.simulations.*') ? 'bg-blue-100 dark:bg-[#1A2333]/70 text-blue-700 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1A2333]/50' }}">
                        <div class="relative">
                            <div class="absolute -inset-1 {{ request()->routeIs('admin.simulations.*') ? 'opacity-50' : 'opacity-0 group-hover:opacity-30' }} blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <svg class="relative w-5 h-5 mr-3 {{ request()->routeIs('admin.simulations.*') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        </div>
                        Simulasi
                    </a>
                    <a href="{{ route('admin.surveys.index') }}" class="group flex items-center px-4 py-3 text-gray-300 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.surveys.*') ? 'bg-[#1A2333]/70 text-white' : 'hover:bg-[#1A2333]/50' }}">
                        <a href="{{ route('admin.surveys.index') }}" class="group flex items-center px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.surveys.*') ? 'bg-blue-100 dark:bg-[#1A2333]/70 text-blue-700 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1A2333]/50' }}">
                        <div class="relative">
                            <div class="absolute -inset-1 {{ request()->routeIs('admin.surveys.*') ? 'opacity-50' : 'opacity-0 group-hover:opacity-30' }} blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <svg class="relative w-5 h-5 mr-3 {{ request()->routeIs('admin.surveys.*') ? 'text-blue-500' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        </div>
                        Survei
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="ml-72">
            <!-- Top Navigation -->
            <div class="bg-white/80 dark:bg-[#1A2333]/30 backdrop-blur-sm border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50">
                <div class="flex items-center justify-end h-16 px-8">
                    <div class="flex items-center space-x-4">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="hidden md:block text-left">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-300">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">Administrator</div>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-[#1A2333] border border-gray-200 dark:border-gray-800"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 style="display: none; z-index: 100;">
                                <div class="py-1">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1A2333]/70 hover:text-gray-900 dark:hover:text-white">
                                        <i class="fas fa-user mr-2"></i>Profile
                                    </a>
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1A2333]/70 hover:text-gray-900 dark:hover:text-white">
                                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                    </a>
                                    <div class="border-t border-gray-800 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1A2333]/70 hover:text-gray-900 dark:hover:text-white">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="p-8 relative z-0">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-6">
                        <div class="bg-green-500/20 border border-green-500/30 text-green-400 px-4 py-3 rounded-lg relative backdrop-blur-sm" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6">
                        <div class="bg-red-500/20 border border-red-500/30 text-red-400 px-4 py-3 rounded-lg relative backdrop-blur-sm" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html> 