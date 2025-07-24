<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Materi Pelatihan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search and Filter Section -->
            <div class="mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="relative">
                            <input type="text" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari materi...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <select class="rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Level</option>
                            <option value="beginner">Pemula</option>
                            <option value="intermediate">Menengah</option>
                            <option value="advanced">Lanjutan</option>
                        </select>
                        <select class="rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Kategori</option>
                            <option value="network">Keamanan Jaringan</option>
                            <option value="web">Keamanan Web</option>
                            <option value="mobile">Keamanan Mobile</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Fundamental Security Category -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Keamanan Fundamental</h3>
                            <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Pemula</span>
                        </div>
                        <div class="space-y-4">
                            <!-- Module 1 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Pengenalan Keamanan Siber</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Pelajari dasar-dasar keamanan siber, terminologi, dan konsep penting dalam industri.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">8 pelajaran • 2 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                            <!-- Module 2 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Keamanan Password</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Praktik terbaik dalam membuat dan mengelola password yang kuat dan aman.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">6 pelajaran • 1.5 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Network Security Category -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Keamanan Jaringan</h3>
                            <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Menengah</span>
                        </div>
                        <div class="space-y-4">
                            <!-- Module 1 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Firewall & VPN</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Konfigurasi dan manajemen firewall serta penggunaan VPN untuk keamanan jaringan.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">10 pelajaran • 3 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                            <!-- Module 2 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Deteksi Intrusi</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Implementasi sistem deteksi dan pencegahan intrusi (IDS/IPS).</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">8 pelajaran • 2.5 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Web Security Category -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Keamanan Web</h3>
                            <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Lanjutan</span>
                        </div>
                        <div class="space-y-4">
                            <!-- Module 1 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Keamanan Aplikasi Web</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Identifikasi dan mitigasi kerentanan umum pada aplikasi web (OWASP Top 10).</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">12 pelajaran • 4 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                            <!-- Module 2 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Pengujian Penetrasi</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Teknik dan metodologi pengujian penetrasi untuk aplikasi web.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">10 pelajaran • 3.5 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Security Category -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Keamanan Mobile</h3>
                            <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Menengah</span>
                        </div>
                        <div class="space-y-4">
                            <!-- Module 1 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Keamanan Android</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Praktik keamanan terbaik untuk pengembangan dan penggunaan aplikasi Android.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">9 pelajaran • 3 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                            <!-- Module 2 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Keamanan iOS</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Keamanan platform iOS dan pengembangan aplikasi yang aman.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">9 pelajaran • 3 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cloud Security Category -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Keamanan Cloud</h3>
                            <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Lanjutan</span>
                        </div>
                        <div class="space-y-4">
                            <!-- Module 1 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">AWS Security</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Implementasi keamanan di lingkungan AWS Cloud.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">11 pelajaran • 4 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                            <!-- Module 2 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Azure Security</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Keamanan dan compliance di Microsoft Azure.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">10 pelajaran • 3.5 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Incident Response Category -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Respons Insiden</h3>
                            <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Lanjutan</span>
                        </div>
                        <div class="space-y-4">
                            <!-- Module 1 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Manajemen Insiden</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Proses dan prosedur penanganan insiden keamanan.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">8 pelajaran • 3 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                            <!-- Module 2 -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Digital Forensik</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">Teknik investigasi dan analisis forensik digital.</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">10 pelajaran • 4 jam</span>
                                    <a href="#" class="text-sm font-medium text-blue-500 hover:text-blue-600">Mulai Belajar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 