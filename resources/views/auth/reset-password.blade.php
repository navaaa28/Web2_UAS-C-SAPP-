@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0B1120] to-[#0A0F1C] px-4 py-12 text-white">
    <div class="max-w-md w-full">
        <div class="bg-[#1A2333]/40 backdrop-blur-xl border border-blue-800 rounded-2xl shadow-xl p-8 relative overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute -top-1/2 -left-1/2 w-full h-full bg-gradient-to-tr from-blue-600 to-purple-600 opacity-10 blur-2xl transform rotate-12"></div>
            <div class="relative z-10">
                <div class="flex flex-col items-center mb-6">
                    <img src="/storage/images/LOGO.png" alt="C-SAPP" class="h-12 mb-2">
                    <h2 class="text-2xl font-bold text-center text-white">Reset Password</h2>
                </div>
                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                        <input id="email" class="mt-2 block w-full rounded-lg bg-[#0F172A] border border-gray-700 px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <input id="password" class="mt-2 block w-full rounded-lg bg-[#0F172A] border border-gray-700 px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none" type="password" name="password" required autocomplete="new-password" oninput="checkPasswordStrength(this.value)" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
                        <div id="password-strength-text" class="mt-2 text-sm"></div>
                        <ul id="password-requirements" class="text-xs text-gray-400 mt-1 space-y-1"></ul>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Konfirmasi Password</label>
                        <input id="password_confirmation" class="mt-2 block w-full rounded-lg bg-[#0F172A] border border-gray-700 px-4 py-3 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-400" />
                    </div>
                    <div>
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white font-semibold rounded-lg transition-all duration-300">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
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
@endsection
