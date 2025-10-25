@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12 bg-gray-50 dark:bg-gradient-to-br dark:from-[#071021] dark:to-[#07141d]">
    <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Decorative left panel -->
        <div class="hidden md:flex items-center justify-center p-8 rounded-2xl bg-gradient-to-br from-[#0f6af1] via-[#3248d6] to-[#6b5ef8] text-white shadow-xl overflow-hidden relative" style="background-blend-mode: multiply;">
            <div class="absolute inset-0 opacity-25 blur-2xl bg-gradient-to-tr from-black/1000 to-transparent mix-blend-overlay"></div>
            <div class="relative z-10 text-center space-y-4">
                <img src="/storage/images/LOGO.png" alt="Logo" class="mx-auto w-24 h-24 object-contain" onerror="this.style.display='none'">
                <h3 class="text-2xl font-bold">Selamat Datang</h3>
                <p class="opacity-90 max-w-xs mx-auto">Masuk untuk melanjutkan kursus, kuis, dan fitur komunitas. Jaga kerahasiaan akun Anda.</p>
                <div class="mt-4 flex items-center justify-center space-x-3">
                    <div class="text-sm px-3 py-1 bg-white/20 rounded-full">Terhubung</div>
                    <div class="text-sm px-3 py-1 bg-white/20 rounded-full">Belajar</div>
                </div>
            </div>
        </div>

    <!-- Form panel -->
    <div class="bg-white dark:bg-[#0B1220] border border-gray-200 dark:border-gray-800 rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Masuk ke akun Anda</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Daftar di sini</a></p>

            <x-auth-session-status class="mt-4" :status="session('status')" />

            <div class="mt-6">
                <div class="grid grid-cols-1 gap-3">
                    <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="flex items-center justify-center gap-3 w-full border border-gray-200 dark:border-gray-700 rounded-lg px-4 py-2 text-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition bg-white/60 dark:bg-transparent">
                        <i class="fab fa-google text-red-500"></i>
                        <span class="text-gray-700 dark:text-gray-200">Masuk dengan Google</span>
                    </a>
                    <!-- GitHub login disabled -->
                </div>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="bg-white dark:bg-[#0B1220] px-3 text-gray-400">atau gunakan email Anda</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="mt-1 block w-full rounded-lg bg-gray-50 dark:bg-[#071423] border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="you@example.com" aria-describedby="email-desc">
                        <p id="email-desc" class="sr-only">Masukkan alamat email yang terdaftar</p>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required
                                class="mt-1 block w-full rounded-lg bg-gray-50 dark:bg-[#071423] border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3 pr-10 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="••••••••" aria-describedby="password-desc">
                            <button type="button" onclick="togglePassword('password', this)" aria-label="Tampilkan password"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-500 focus:outline-none">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <p id="password-desc" class="sr-only">Masukkan kata sandi Anda</p>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-300">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span>Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Lupa password?</a>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-[#1e66f5] to-[#6b5ef8] hover:from-[#1b57d8] text-white font-semibold rounded-lg transition-shadow duration-200 shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                            <span>Masuk</span>
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

        if (!input) return;

        if (input.type === "password") {
            input.type = "text";
            if (icon) { icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
        } else {
            input.type = "password";
            if (icon) { icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
        }
    }
</script>

<!-- Font Awesome CDN (small footprint link) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
