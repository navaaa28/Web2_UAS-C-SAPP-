@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#070A13] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <!-- Header Section -->
        <div class="relative mb-8">
            <div class="absolute -inset-1">
                <div class="w-full h-full mx-auto opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
            </div>
            <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 p-6 text-center">
                <div class="flex justify-center mb-4">
                    <div class="relative">
                        <div class="absolute -inset-1 opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 rounded-full"></div>
                        <div class="relative bg-[#1A2333]/50 p-3 rounded-full border border-blue-500/20">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-white">Two-Factor Authentication</h2>
                <p class="mt-2 text-gray-400">Please enter the verification code from your authenticator app</p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="relative">
            <div class="absolute -inset-1">
                <div class="w-full h-full mx-auto opacity-20 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
            </div>
            <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 p-6">
                <form method="POST" action="{{ route('2fa.verify') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="code" class="block text-sm font-medium text-gray-300 mb-2">Verification Code</label>
                        <div class="relative">
                            <div class="absolute -inset-1 opacity-0 group-focus-within:opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <input id="code" 
                                   name="code" 
                                   type="text" 
                                   class="relative block w-full px-4 py-3 bg-[#1A2333]/50 text-white border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center text-2xl tracking-widest"
                                   required 
                                   autocomplete="off"
                                   maxlength="6"
                                   pattern="[0-9]*"
                                   inputmode="numeric"
                                   placeholder="••••••">
                        </div>
                        @error('code')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <div class="absolute -inset-1 opacity-0 group-hover:opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <span class="relative flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Verify Code
                            </span>
                        </button>
                        <a href="{{ route('login') }}" class="group relative w-full flex justify-center py-3 px-4 border border-gray-700 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-[#1A2333]/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            <div class="absolute -inset-1 opacity-0 group-hover:opacity-30 blur-lg filter bg-gradient-to-r from-gray-600 to-gray-500 transition-opacity duration-200"></div>
                            <span class="relative flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to Login
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Help Section -->
        <div class="mt-8 text-center">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-800"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-[#070A13] text-gray-400">Need help?</span>
                </div>
            </div>
            <p class="mt-4 text-sm text-gray-400">
                If you're having trouble with 2FA, please contact support.
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const codeInput = document.getElementById('code');
        
        // Auto-focus pada input
        codeInput.focus();
        
        // Auto-submit saat 6 digit terisi
        codeInput.addEventListener('input', function(e) {
            // Hanya izinkan angka
            this.value = this.value.replace(/[^0-9]/g, '');
            
            if (this.value.length === 6) {
                this.form.submit();
            }
        });

        // Tambahkan animasi saat input
        codeInput.addEventListener('keyup', function(e) {
            if (this.value.length > 0) {
                this.classList.add('border-blue-500');
            } else {
                this.classList.remove('border-blue-500');
            }
        });
    });
</script>
@endpush
@endsection 