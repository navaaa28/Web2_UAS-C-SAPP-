@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#070A13] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
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
                <h2 class="text-2xl font-bold text-white">Setup Two Factor Authentication</h2>
                <p class="mt-2 text-gray-400">Secure your account with an extra layer of protection</p>
            </div>
        </div>

        <!-- QR Code Section -->
        <div class="relative mb-8">
            <div class="absolute -inset-1">
                <div class="w-full h-full mx-auto opacity-20 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
            </div>
            <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 p-6">
                <div class="text-center">
                    <p class="text-gray-300 mb-4">Scan this QR code with your authenticator app:</p>
                    <div class="inline-block p-4 bg-white rounded-lg">
                        {!! QrCode::size(200)->generate($qrCodeUrl) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Secret Key Section -->
        <div class="relative mb-8">
            <div class="absolute -inset-1">
                <div class="w-full h-full mx-auto opacity-20 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
            </div>
            <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 p-6">
                <p class="text-gray-300 mb-4">Or enter this secret key manually:</p>
                <div class="relative">
                    <div class="absolute -inset-1 opacity-20 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
                    <div class="relative bg-[#1A2333]/50 p-4 rounded-lg border border-gray-700">
                        <code class="text-blue-400 font-mono text-sm break-all">{{ $secretKey }}</code>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verification Form -->
        <div class="relative">
            <div class="absolute -inset-1">
                <div class="w-full h-full mx-auto opacity-20 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
            </div>
            <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 p-6">
                <form method="POST" action="{{ route('2fa.enable') }}">
                    @csrf
                    <input type="hidden" name="secret" value="{{ $secretKey }}">
                    
                    <div class="mb-6">
                        <label for="code" class="block text-sm font-medium text-gray-300 mb-2">Verification Code</label>
                        <div class="relative">
                            <div class="absolute -inset-1 opacity-0 group-focus-within:opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <input id="code" 
                                   type="text" 
                                   name="code" 
                                   class="relative block w-full px-4 py-3 bg-[#1A2333]/50 text-white border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center text-2xl tracking-widest"
                                   required 
                                   autofocus
                                   maxlength="6"
                                   pattern="[0-9]*"
                                   inputmode="numeric"
                                   placeholder="••••••">
                        </div>
                        @error('code')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="group relative inline-flex items-center">
                            <div class="absolute -inset-1 opacity-0 group-hover:opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <span class="relative inline-flex items-center px-6 py-3 bg-[#1A2333]/50 text-blue-500 border border-blue-500/20 rounded-lg hover:bg-[#1A2333]/70 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Enable 2FA
                            </span>
                        </button>
                    </div>
                </form>
            </div>
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