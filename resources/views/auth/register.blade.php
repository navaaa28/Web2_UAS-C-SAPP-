@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12 bg-gray-50 dark:bg-gradient-to-br dark:from-[#071021] dark:to-[#07141d]">
    <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Decorative left panel -->
        <div class="hidden md:flex items-center justify-center p-8 rounded-2xl bg-gradient-to-br from-[#10b981] via-[#06b6d4] to-[#06b6d4] text-white shadow-xl overflow-hidden relative" style="background-blend-mode: multiply;">
            <div class="absolute inset-0 opacity-25 blur-2xl bg-gradient-to-tr from-black/10 to-transparent mix-blend-overlay"></div>
            <div class="relative z-10 text-center space-y-4">
                <img src="/storage/images/LOGO.png" alt="Logo" class="mx-auto w-24 h-24 object-contain" onerror="this.style.display='none'">
                <h3 class="text-2xl font-bold">Bergabung dan Mulai Belajar</h3>
                <p class="opacity-90 max-w-xs mx-auto">Daftar sekarang untuk mengakses kursus, kuis, dan komunitas.</p>
                <div class="mt-4 flex items-center justify-center space-x-3">
                    <div class="text-sm px-3 py-1 bg-white/20 rounded-full">Gratis</div>
                    <div class="text-sm px-3 py-1 bg-white/20 rounded-full">Akses penuh</div>
                </div>
            </div>
        </div>

    <!-- Form panel -->
    <div class="bg-white dark:bg-[#0B1220] border border-gray-200 dark:border-gray-800 rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Daftar Akun Baru</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Masuk di sini</a></p>

            <div class="mt-6">
                <div class="grid grid-cols-1 gap-3">
                    <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="flex items-center justify-center gap-3 w-full border border-gray-200 dark:border-gray-700 rounded-lg px-4 py-2 text-sm hover:bg-gray-50 dark:hover:bg-gray-800 transition bg-white/60 dark:bg-transparent">
                        <i class="fab fa-google text-red-500"></i>
                        <span class="text-gray-700 dark:text-gray-200">Daftar dengan Google</span>
                    </a>
                    <!-- GitHub signup disabled -->
                </div>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                    </div>
                    <div class="relative flex justify-center text-xs">
                        <span class="bg-white dark:bg-[#0B1220] px-3 text-gray-400">atau gunakan email Anda</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5" novalidate>
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                        <input id="name" name="name" type="text" required value="{{ old('name') }}" placeholder="Nama Lengkap"
                            class="mt-1 block w-full rounded-lg bg-gray-50 dark:bg-[#071423] border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3 placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:outline-none">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}" placeholder="nama@email.com"
                            class="mt-1 block w-full rounded-lg bg-gray-50 dark:bg-[#071423] border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3 placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:outline-none">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" required placeholder="••••••••" oninput="checkPasswordStrength(this.value)"
                                class="mt-1 block w-full rounded-lg bg-gray-50 dark:bg-[#071423] border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3 pr-10 placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:outline-none">
                            <button type="button" onclick="togglePassword('password', this)" aria-label="Tampilkan password" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-green-500 focus:outline-none">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <div id="password-strength-text" class="mt-2 text-sm"></div>
                        <ul id="password-requirements" class="text-xs text-gray-400 mt-1 space-y-1"></ul>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Konfirmasi Password</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="••••••••"
                                class="mt-1 block w-full rounded-lg bg-gray-50 dark:bg-[#071423] border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3 pr-10 placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:outline-none">
                            <button type="button" onclick="togglePassword('password_confirmation', this)" aria-label="Tampilkan konfirmasi password" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-green-500 focus:outline-none">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <div>
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-[#10b981] to-[#06b6d4] hover:from-[#0ea56f] text-white font-semibold rounded-lg transition-shadow duration-200 shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Daftar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toggle Password & Password Strength Script -->
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

    function checkPasswordStrength(password) {
        const requirements = [
            { test: p => p.length >= 8, text: 'Minimal 8 karakter' },
            { test: p => /[a-z]/.test(p), text: 'Ada huruf kecil' },
            { test: p => /[A-Z]/.test(p), text: 'Ada huruf besar' },
            { test: p => /[0-9]/.test(p), text: 'Ada angka' },
            { test: p => /[^a-zA-Z0-9]/.test(p), text: 'Ada simbol' }
        ];
        const reqList = document.getElementById('password-requirements');
        if (!reqList) return;
        reqList.innerHTML = '';
        let validCount = 0;
        requirements.forEach(req => {
            const li = document.createElement('li');
            if (req.test(password)) {
                li.innerHTML = `<span class='text-green-400'>✔</span> ${req.text}`;
                validCount++;
            } else {
                li.innerHTML = `<span class='text-red-400'>✖</span> ${req.text}`;
            }
            reqList.appendChild(li);
        });
        const strengthText = document.getElementById('password-strength-text');
        if (!strengthText) return;
        if (password.length === 0) {
            strengthText.textContent = '';
        } else if (validCount === requirements.length) {
            strengthText.textContent = 'Password sudah kuat!';
            strengthText.className = 'mt-2 text-sm text-green-400';
        } else {
            strengthText.textContent = 'Password belum memenuhi semua syarat.';
            strengthText.className = 'mt-2 text-sm text-red-400';
        }
    }
</script>

<!-- Font Awesome CDN (small footprint link) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
