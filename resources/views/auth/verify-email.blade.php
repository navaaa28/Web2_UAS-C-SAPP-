@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0B1120] to-[#0A0F1C] px-4 py-12 text-white">
    <div class="max-w-md w-full">
        <div class="bg-[#1A2333]/40 backdrop-blur-xl border border-blue-800 rounded-2xl shadow-xl p-8 relative overflow-hidden">
            <!-- Background Glow -->
            <div class="absolute -top-1/2 -left-1/2 w-full h-full bg-gradient-to-tr from-blue-600 to-purple-600 opacity-10 blur-2xl transform rotate-12"></div>
            <div class="relative z-10">
                <h2 class="text-2xl font-bold text-center text-white mb-4">Verifikasi Email Kamu</h2>
                <div class="mb-4 text-sm text-gray-300 text-center">
                    {{ __('Terima kasih telah mendaftar! Sebelum mulai, silakan verifikasi email kamu dengan klik link yang sudah dikirim ke email. Jika belum menerima email, kamu bisa meminta ulang di bawah ini.') }}
                </div>
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-400 text-center">
                        {{ __('Link verifikasi baru sudah dikirim ke email kamu.') }}
                    </div>
                @endif
                <div class="mt-6 flex flex-col gap-4">
                    <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white font-semibold rounded-lg transition-all duration-300">
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-gray-600 to-gray-800 hover:from-gray-700 hover:to-gray-900 text-white font-semibold rounded-lg transition-all duration-300">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
