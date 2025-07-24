@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0B1120] to-[#0A0F1C] text-white px-4 py-12">
    <div class="max-w-md w-full">
        <div class="bg-[#1A2333]/40 backdrop-blur-xl border border-blue-800 rounded-2xl shadow-xl p-8 relative overflow-hidden">
            <div class="absolute -top-1/2 -left-1/2 w-full h-full bg-gradient-to-tr from-blue-600 to-purple-600 opacity-10 blur-2xl transform rotate-12"></div>

            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-center text-white">Masuk ke Akun Anda</h2>
                <p class="text-sm text-gray-400 mt-2 text-center">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-400 hover:underline">Daftar di sini</a>
                </p>

                <x-auth-session-status class="mt-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6 mt-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="mt-1 block w-full rounded-lg bg-[#0F172A] border border-gray-700 text-white px-4 py-3 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="you@example.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                class="mt-1 block w-full rounded-lg bg-[#0F172A] border border-gray-700 text-white px-4 py-3 pr-10 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="••••••••">
                            <span onclick="togglePassword('password', this)"
                                class="absolute right-3 top-3.5 cursor-pointer text-gray-400 hover:text-blue-400">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2 text-sm text-gray-300">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-600 bg-gray-800 text-blue-500 focus:ring-blue-500">
                            <span>Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-400 hover:underline">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit"
                            class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white font-semibold rounded-lg transition-all duration-300">
                            <svg class="w-5 h-5 mr-2 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Masuk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toggle Password Script -->
<script>
    function togglePassword(id, el) {
        const input = document.getElementById(id);
        const icon = el.querySelector('i');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
