<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - C-SAPP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#070A13]">
    <div class="min-h-screen flex flex-col items-center">
        <!-- Navbar -->
        <nav class="w-full bg-[#0A1628]/50 backdrop-blur-sm border-b border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="/" class="text-xl font-bold text-white flex items-center">
                                <img src="{{ asset('storage/images/LOGO.png') }}" alt="C-SAPP Logo" class="h-8 w-auto mr-2">
                                C-SAPP
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors duration-200">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">Register</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col items-center justify-center w-full px-4">
            <div class="max-w-md w-full">
                <!-- Card Container -->
                <div class="relative">
                    <div class="absolute -inset-1">
                        <div class="w-full h-full mx-auto opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
                    </div>
                    
                    <div class="relative bg-[#0A1628] rounded-xl overflow-hidden">
                        <div class="p-8">
                            <!-- Icon -->
                            <div class="flex justify-center mb-6">
                                <div class="relative">
                                    <div class="absolute -inset-4 opacity-20 blur-lg bg-blue-500 rounded-full"></div>
                                    <div class="relative bg-blue-500/10 p-4 rounded-full">
                                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Title -->
                            <h2 class="text-2xl font-bold text-white text-center mb-2">Reset Password</h2>
                            <p class="text-gray-400 text-center text-sm mb-8">
                                Enter your email address and we'll send you a password reset link
                            </p>

                            <!-- Form -->
                            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                                @csrf

                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <!-- Email Input -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                            </svg>
                                        </div>
                                        <input id="email" 
                                               type="email" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               class="block w-full pl-10 pr-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                               required 
                                               autofocus
                                               placeholder="Enter your email address">
                                    </div>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="w-full flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Send Reset Link
                                </button>
                            </form>

                            <!-- Back to Login -->
                            <div class="mt-6 text-center">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-800"></div>
                                    </div>
                                    <div class="relative flex justify-center text-xs uppercase">
                                        <span class="px-2 bg-[#0A1628] text-gray-400">Or</span>
                                    </div>
                                </div>

                                <a href="{{ route('login') }}" class="mt-4 inline-flex items-center text-sm text-gray-400 hover:text-white transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Back to Login
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
