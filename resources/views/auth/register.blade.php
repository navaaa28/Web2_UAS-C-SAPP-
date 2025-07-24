@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0B1120] to-[#0A0F1C] px-4 py-12 text-white">
    <div class="max-w-md w-full">
        <div class="bg-[#1A2333]/40 backdrop-blur-xl border border-blue-800 rounded-2xl shadow-xl p-8 relative overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute -top-1/2 -left-1/2 w-full h-full bg-gradient-to-tr from-blue-600 to-purple-600 opacity-10 blur-2xl transform rotate-12"></div>

            <div class="relative z-10">
                <h2 class="text-3xl font-bold text-center text-white">Daftar Akun Baru</h2>
                <p class="text-sm text-gray-400 mt-2 text-center">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-400 hover:underline">Masuk di sini</a>
                </p>

                <form method="POST" action="{{ route('register') }}" class="space-y-6 mt-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300">Nama</label>
                        <input id="name" name="name" type="text" required value="{{ old('name') }}"
                            placeholder="Nama Lengkap"
                            class="mt-2 block w-full rounded-lg bg-[#0F172A] border border-gray-700 px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            class="mt-2 block w-full rounded-lg bg-[#0F172A] border border-gray-700 px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" required
                                placeholder="••••••••"
                                class="mt-2 block w-full rounded-lg bg-[#0F172A] border border-gray-700 px-4 py-3 pr-10 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                oninput="checkPasswordStrength(this.value)">
                            <span onclick="togglePassword('password', this)" class="absolute right-3 top-3.5 cursor-pointer text-gray-400 hover:text-blue-400">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                        <div id="password-strength-text" class="mt-2 text-sm"></div>
                        <ul id="password-requirements" class="text-xs text-gray-400 mt-1 space-y-1"></ul>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Konfirmasi Password</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                placeholder="••••••••"
                                class="mt-2 block w-full rounded-lg bg-[#0F172A] border border-gray-700 px-4 py-3 pr-10 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <span onclick="togglePassword('password_confirmation', this)" class="absolute right-3 top-3.5 cursor-pointer text-gray-400 hover:text-blue-400">
                                <i class="far fa-eye"></i>
                            </span>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-400" />
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white font-semibold rounded-lg transition-all duration-300">
                            <svg class="w-5 h-5 mr-2 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Daftar
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

    function checkPasswordStrength(password) {
        const requirements = [
            { test: p => p.length >= 8, text: 'Minimal 8 karakter' },
            { test: p => /[a-z]/.test(p), text: 'Ada huruf kecil' },
            { test: p => /[A-Z]/.test(p), text: 'Ada huruf besar' },
            { test: p => /[0-9]/.test(p), text: 'Ada angka' },
            { test: p => /[^a-zA-Z0-9]/.test(p), text: 'Ada simbol' }
        ];
        const reqList = document.getElementById('password-requirements');
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

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
