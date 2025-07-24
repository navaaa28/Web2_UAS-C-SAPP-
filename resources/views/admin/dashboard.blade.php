<x-admin>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Admin Welcome Section -->
            <div class="relative">
                <div class="absolute -inset-1">
                    <div class="w-full h-full mx-auto opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
                </div>
                <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 p-6 sm:p-8 mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-white">Selamat Datang, Admin {{ Auth::user()->name }}!</h2>
                            <p class="mt-2 text-gray-300">Kelola sistem pembelajaran keamanan siber dengan mudah dan aman</p>
                        </div>
                        <div class="hidden sm:block">
                            <div class="relative">
                                <div class="absolute -inset-1">
                                    <div class="w-full h-full mx-auto opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
                                </div>
                                <div class="relative bg-[#1A2333]/50 rounded-xl p-3">
                                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- User Statistics -->
                <div class="group relative">
                    <div class="absolute -inset-1">
                        <div class="w-full h-full mx-auto opacity-20 blur-lg filter group-hover:opacity-30 transition duration-200 bg-gradient-to-r from-blue-600 to-blue-500"></div>
                    </div>
                    <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Statistik Pengguna
                            </h3>
                            <div class="space-y-6">
                                <div class="bg-[#1A2333]/50 rounded-lg p-4 group-hover:bg-[#1A2333]/70 transition duration-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-400">Total Pengguna</p>
                                            <p class="text-2xl font-bold text-white mt-1">{{ $totalUsers }}</p>
                                        </div>
                                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-3">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-[#1A2333]/50 rounded-lg p-4 group-hover:bg-[#1A2333]/70 transition duration-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-400">Pengguna Aktif</p>
                                            <p class="text-2xl font-bold text-white mt-1">{{ $activeUsers }}</p>
                                        </div>
                                        <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-lg p-3">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Management -->
                <div class="group relative">
                    <div class="absolute -inset-1">
                        <div class="w-full h-full mx-auto opacity-20 blur-lg filter group-hover:opacity-30 transition duration-200 bg-gradient-to-r from-blue-600 to-blue-500"></div>
                    </div>
                    <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Manajemen Konten
                            </h3>
                            <div class="space-y-6">
                                <div class="bg-[#1A2333]/50 rounded-lg p-4 group-hover:bg-[#1A2333]/70 transition duration-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-400">Total Modul</p>
                                            <p class="text-2xl font-bold text-white mt-1">{{ $totalModules }}</p>
                                        </div>
                                        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-3">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-[#1A2333]/50 rounded-lg p-4 group-hover:bg-[#1A2333]/70 transition duration-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-400">Total Kuis</p>
                                            <p class="text-2xl font-bold text-white mt-1">{{ \App\Models\Quiz::count() }}</p>
                                        </div>
                                        <div class="bg-gradient-to-r from-yellow-600 to-yellow-700 rounded-lg p-3">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Overview -->
                <div class="group relative">
                    <div class="absolute -inset-1">
                        <div class="w-full h-full mx-auto opacity-20 blur-lg filter group-hover:opacity-30 transition duration-200 bg-gradient-to-r from-blue-600 to-blue-500"></div>
                    </div>
                    <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Ringkasan Sistem
                            </h3>
                            <div class="space-y-6">
                                <div class="bg-[#1A2333]/50 rounded-lg p-4 group-hover:bg-[#1A2333]/70 transition duration-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-400">Rata-rata Skor Kuis</p>
                                            <p class="text-2xl font-bold text-white mt-1">78%</p>
                                        </div>
                                        <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-lg p-3">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-[#1A2333]/50 rounded-lg p-4 group-hover:bg-[#1A2333]/70 transition duration-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-400">Materi Populer</p>
                                            <p class="text-2xl font-bold text-white mt-1">Anti-Phishing</p>
                                        </div>
                                        <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-lg p-3">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="group relative col-span-1 md:col-span-2 lg:col-span-3">
                    <div class="absolute -inset-1">
                        <div class="w-full h-full mx-auto opacity-20 blur-lg filter group-hover:opacity-30 transition duration-200 bg-gradient-to-r from-blue-600 to-blue-500"></div>
                    </div>
                    <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-white mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Aktivitas Terbaru
                            </h3>
                            <div class="space-y-4">
                                @php
                                    $latestModule = \App\Models\Module::latest()->first();
                                    $latestQuiz = \App\Models\Quiz::latest()->first();
                                @endphp
                                @if($latestModule)
                                <div class="bg-[#1A2333]/50 rounded-lg p-4 group-hover:bg-[#1A2333]/70 transition duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg p-3">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-white">Modul baru ditambahkan</p>
                                            <p class="text-sm text-gray-400 mt-1">Modul "{{ $latestModule->title }}" telah ditambahkan ke sistem</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $latestModule->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($latestQuiz)
                                <div class="bg-[#1A2333]/50 rounded-lg p-4 group-hover:bg-[#1A2333]/70 transition duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="bg-gradient-to-r from-yellow-600 to-yellow-700 rounded-lg p-3">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-white">Kuis baru dibuat</p>
                                            <p class="text-sm text-gray-400 mt-1">Kuis "{{ $latestQuiz->title }}" telah dibuat</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $latestQuiz->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin> 