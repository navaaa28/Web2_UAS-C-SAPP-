<x-admin>
    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative mb-8">
                <div class="absolute -inset-1">
                    <div class="w-full h-full mx-auto opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
                </div>
                <div class="relative bg-white/80 dark:bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-200 dark:border-gray-800 p-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Detail Pengguna</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Informasi lengkap pengguna</p>
                    <div class="flex items-center space-x-6 mb-6">
                        <div class="h-16 w-16 rounded-lg bg-white dark:bg-[#1A2333]/50 border border-gray-200 dark:border-gray-800 flex items-center justify-center">
                            <span class="text-2xl font-bold text-blue-500">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <div class="text-xl font-semibold text-white">{{ $user->name }}</div>
                            <div class="text-gray-400 text-sm">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="text-gray-400 text-xs mb-1">Tanggal Bergabung</div>
                            <div class="text-white">{{ $user->created_at->format('d M Y') }}</div>
                        </div>
                        <div>
                            <div class="text-gray-400 text-xs mb-1">Status Email</div>
                            @if($user->email_verified_at)
                                <span class="px-3 py-1 text-xs font-medium rounded-lg bg-green-500/10 text-green-400 border border-green-500/20">Terverifikasi</span>
                            @else
                                <span class="px-3 py-1 text-xs font-medium rounded-lg bg-red-500/10 text-red-400 border border-red-500/20">Belum Verifikasi</span>
                            @endif
                        </div>
                        <div>
                            <div class="text-gray-400 text-xs mb-1">Admin</div>
                            @if($user->is_admin)
                                <span class="px-3 py-1 text-xs font-medium rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/20">Ya</span>
                            @else
                                <span class="px-3 py-1 text-xs font-medium rounded-lg bg-gray-500/10 text-gray-400 border border-gray-500/20">Tidak</span>
                            @endif
                        </div>
                        <div>
                            <div class="text-gray-400 text-xs mb-1">2FA Aktif</div>
                            @if($user->google2fa_enabled)
                                <span class="px-3 py-1 text-xs font-medium rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/20">Ya</span>
                            @else
                                <span class="px-3 py-1 text-xs font-medium rounded-lg bg-gray-500/10 text-gray-400 border border-gray-500/20">Tidak</span>
                            @endif
                        </div>
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700/50 hover:bg-gray-600/50 text-gray-200 font-medium rounded-md transition-all duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar Pengguna
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin> 