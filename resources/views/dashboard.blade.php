@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gradient-to-br dark:from-gray-900 dark:to-gray-800">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Welcome Section -->
        <div class="bg-white dark:bg-gradient-to-r dark:from-blue-600 dark:to-blue-800 rounded-lg shadow-xl p-6 sm:p-8 mb-8 backdrop-blur-sm border border-blue-200 dark:border-blue-500/20">
                <div class="flex items-center justify-between">
                    <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
                    <p class="text-blue-800 dark:text-blue-100 text-lg mb-6">Lanjutkan pembelajaran keamanan siber Anda</p>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('materials.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-100 dark:bg-white/10 backdrop-blur-sm text-blue-900 dark:text-white rounded-lg hover:bg-blue-200 dark:hover:bg-white/20 transition-colors duration-150 border border-blue-200 dark:border-white/20">
                            <i class="fas fa-book-open mr-2"></i>
                                Lihat Semua Materi
                            </a>
                        <a href="{{ route('quizzes') }}" class="inline-flex items-center px-6 py-3 bg-blue-100 dark:bg-white/10 backdrop-blur-sm text-blue-900 dark:text-white rounded-lg hover:bg-blue-200 dark:hover:bg-white/20 transition-colors duration-150 border border-blue-200 dark:border-white/20">
                            <i class="fas fa-tasks mr-2"></i>
                                Mulai Kuis
                            </a>
                        </div>
                    </div>
                <div class="hidden lg:block">
                    <div class="bg-blue-100 dark:bg-white/10 backdrop-blur-sm rounded-full p-6 border border-blue-200 dark:border-white/20">
                        <i class="fas fa-shield-alt text-5xl text-blue-900 dark:text-white"></i>
                    </div>
                    </div>
                </div>
            </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Modul Pelatihan Section -->
                <div class="bg-white dark:bg-[#1A2333]/40 backdrop-blur-xl border border-blue-200 dark:border-blue-800/40 rounded-2xl shadow-lg overflow-hidden">
    <!-- Header -->
    <div class="p-6 border-b border-blue-100 dark:border-blue-700/30 flex items-center justify-between">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Modul Pelatihan Interaktif</h3>
        <a href="{{ route('materials.index') }}" class="text-sm text-blue-700 dark:text-blue-400 hover:text-blue-600 dark:hover:text-blue-300 transition duration-200">Lihat Semua</a>
    </div>

    <!-- Module List -->
    <div class="p-6 space-y-4">
        @forelse($modules as $module)
            <div class="group bg-white dark:bg-[#0F172A]/60 backdrop-blur-lg rounded-xl p-5 border border-blue-100 dark:border-blue-800/20 hover:border-blue-400 dark:hover:border-blue-500/40 transition duration-200">
                <div class="flex items-start space-x-4">
                    <!-- Icon -->
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-600/20 flex items-center justify-center border border-blue-200 dark:border-blue-500/30 shadow-inner">
                        <i class="fas fa-book-reader text-blue-700 dark:text-blue-400 text-xl"></i>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition duration-200">
                            {{ $module->title }}
                        </h4>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($module->description, 100) }}</p>

                        <!-- Progress Bar -->
                        <div class="mt-3 flex items-center">
                            <div class="flex-1 bg-gray-200 dark:bg-gray-600/40 h-2 rounded-full">
                                <div class="bg-blue-500 h-2 rounded-full transition-all duration-300" style="width: {{ $module->isCompletedByUser() ? '100' : '0' }}%"></div>
                            </div>
                            <span class="ml-3 text-sm text-gray-700 dark:text-gray-300">
                                {{ $module->isCompletedByUser() ? '100' : '0' }}%
                            </span>
                        </div>
                    </div>

                    <!-- Action -->
                    <a href="{{ route('materials.module', $module) }}"
                       class="ml-4 px-4 py-2 rounded-lg text-sm bg-blue-100 dark:bg-blue-600/20 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-500/30 hover:bg-blue-200 dark:hover:bg-blue-600/40 hover:text-blue-900 dark:hover:text-white transition-all duration-200">
                        {{ $module->isCompletedByUser() ? 'Baca Ulang' : 'Mulai' }}
                    </a>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="text-center py-10">
                <div class="w-16 h-16 mx-auto bg-blue-100 dark:bg-blue-700/20 rounded-full flex items-center justify-center border border-blue-200 dark:border-blue-500/30">
                    <i class="fas fa-book text-blue-300 text-2xl"></i>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Belum ada modul</h3>
                <p class="text-gray-600 dark:text-gray-400">Modul pembelajaran akan segera tersedia.</p>
            </div>
        @endforelse
    </div>
</div>

                <!-- Evaluasi Kesadaran Section -->
                <div class="bg-white dark:bg-[#1A2333]/40 backdrop-blur-xl rounded-2xl shadow-lg border border-blue-200 dark:border-blue-800/30 overflow-hidden">
    <!-- Header -->
    <div class="p-6 border-b border-blue-100 dark:border-blue-800/20">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Evaluasi Kesadaran</h3>
    </div>

    <div class="p-6 space-y-6">
        <!-- Assessment Score -->
        <div class="bg-white dark:bg-[#0F172A]/60 backdrop-blur-lg rounded-xl p-6 border border-blue-100 dark:border-blue-700/30">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Hasil Asesmen Terakhir</h4>
                <a href="{{ route('quizzes') }}" class="text-sm text-blue-700 dark:text-blue-400 hover:text-blue-600 dark:hover:text-blue-300 transition duration-200">Lihat Detail</a>
            </div>

            <div class="flex items-center space-x-6">
                <div class="relative">
                    <svg class="w-24 h-24">
                        <circle class="text-gray-200 dark:text-gray-700/30" stroke-width="8" stroke="currentColor" fill="transparent" r="42" cx="48" cy="48"/>
                        <circle class="text-blue-500" stroke-width="8" stroke="currentColor" fill="transparent" r="42" cx="48" cy="48"
                            stroke-dasharray="264" stroke-dashoffset="{{ 264 - ($assessmentData['score'] / 100 * 264) }}"/>
                    </svg>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $assessmentData['score'] }}%
                    </div>
                </div>
                <div>
                    <p class="text-gray-700 dark:text-gray-300">Skor Keseluruhan</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        @if($assessmentData['completed_at'])
                            Diperbarui {{ $assessmentData['completed_at'] }}
                        @else
                            Belum ada asesmen
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Recommendations -->
        <div class="bg-white dark:bg-[#0F172A]/60 backdrop-blur-lg rounded-xl p-6 border border-blue-100 dark:border-blue-700/30">
            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Rekomendasi Pembelajaran</h4>
            <div class="space-y-4">
                @foreach($assessmentData['recommendations'] as $recommendation)
                    <div class="group flex items-start space-x-4 p-4 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-800/10 transition duration-200 border border-blue-100 dark:border-blue-600/20">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg {{ $recommendation['type'] === 'video' ? 'bg-blue-100 dark:bg-blue-600/20 border-blue-200 dark:border-blue-500/30' : 'bg-green-100 dark:bg-green-600/20 border-green-200 dark:border-green-500/30' }} backdrop-blur-sm flex items-center justify-center border">
                                <i class="fas {{ $recommendation['icon'] }} {{ $recommendation['type'] === 'video' ? 'text-blue-700 dark:text-blue-400' : 'text-green-700 dark:text-green-400' }}"></i>
                            </div>
                        </div>

                        <div class="flex-1">
                            <a href="{{ $recommendation['link'] }}" class="text-gray-900 dark:text-white text-base font-medium group-hover:text-blue-700 dark:group-hover:text-blue-400 transition duration-200">
                                {{ $recommendation['title'] }}
                            </a>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $recommendation['description'] }}</p>
                            <div class="mt-2">
                                <span class="inline-flex items-center text-xs {{ $recommendation['type'] === 'video' ? 'text-blue-700 dark:text-blue-400' : 'text-green-700 dark:text-green-400' }}">
                                    <i class="fas {{ $recommendation['type'] === 'video' ? 'fa-play' : 'fa-book' }} mr-1"></i>
                                    {{ $recommendation['type'] === 'video' ? 'Video Pembelajaran' : 'Materi Bacaan' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex-shrink-0">
                            <a href="{{ $recommendation['link'] }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-600/20 text-blue-700 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-600/30 transition duration-200 border border-blue-200 dark:border-blue-500/30">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

                <!-- Progress Tracking Section -->
                <div class="bg-white dark:bg-[#1A2333]/40 backdrop-blur-xl rounded-2xl shadow-lg border border-blue-200 dark:border-blue-800/30 overflow-hidden">
    <!-- Header -->
    <div class="p-6 border-b border-blue-100 dark:border-blue-700/30">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Pelacakan Kemajuan</h3>
    </div>

    <div class="p-6 space-y-6">
        <!-- Progress Chart -->
        <div class="bg-white dark:bg-[#0F172A]/60 backdrop-blur-lg rounded-xl p-6 border border-blue-100 dark:border-blue-700/30">
            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Overview Progress</h4>
            <div class="h-64">
                <canvas id="progressChart"></canvas>
            </div>
        </div>

        <!-- Learning Statistics -->
        <div class="bg-white dark:bg-[#0F172A]/60 backdrop-blur-lg rounded-xl p-6 border border-blue-100 dark:border-blue-700/30">
            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Statistik Pembelajaran</h4>
            <div class="space-y-6">
                <!-- Module Progress -->
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-700 dark:text-gray-300">Modul Selesai</span>
                        <span class="text-gray-900 dark:text-white font-semibold">{{ $completedModules }}/{{ $totalModules }}</span>
                    </div>
                    <div class="bg-gray-200 dark:bg-gray-700/50 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full transition-all duration-500" style="width: {{ $moduleCompletionRate }}%"></div>
                    </div>
                </div>

                <!-- Quiz Progress -->
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-700 dark:text-gray-300">Kuis Diselesaikan</span>
                        <span class="text-gray-900 dark:text-white font-semibold">{{ $completedQuizzes }}/{{ $totalQuizModules }}</span>
                    </div>
                    <div class="bg-gray-200 dark:bg-gray-700/50 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full transition-all duration-500" style="width: {{ $quizCompletionRate }}%"></div>
                    </div>
                </div>

                <!-- Time Spent -->
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-700 dark:text-gray-300">Waktu Belajar</span>
                        <span class="text-gray-900 dark:text-white font-semibold">{{ $totalLearningTime }} jam</span>
                    </div>
                    <div class="bg-gray-200 dark:bg-gray-700/50 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full transition-all duration-500" style="width: {{ min(($totalLearningTime / 100) * 100, 100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Achievements -->
        <div class="bg-white dark:bg-[#0F172A]/60 backdrop-blur-lg rounded-xl p-6 border border-blue-100 dark:border-blue-700/30">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-lg font-medium text-gray-900 dark:text-white">Pencapaian</h4>
                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $unlockedAchievements }}/{{ $totalAchievements }} Lencana</span>
            </div>

            <div class="grid grid-cols-4 gap-4">
                @foreach($achievements as $achievement)
                    <div class="relative group">
                        <div class="{{ $achievement['unlocked'] ? 'bg-blue-100 dark:bg-blue-600/20 border-blue-200 dark:border-blue-500/30' : 'bg-gray-200 dark:bg-gray-600/20 border-gray-200 dark:border-gray-500/30' }} rounded-lg p-4 flex items-center justify-center transition-all duration-200 border backdrop-blur-sm group-hover:border-blue-400 dark:group-hover:border-blue-400/40">
                            <i class="fas {{ $achievement['icon'] }} {{ $achievement['unlocked'] ? 'text-blue-700 dark:text-blue-400' : 'text-gray-600 dark:text-gray-400' }} text-2xl transition-colors"></i>
                        </div>
                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 p-2 bg-white dark:bg-[#0F172A] text-gray-900 dark:text-white text-xs rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-normal border border-blue-100 dark:border-blue-700/20 w-48 z-10">
                            <div class="font-medium mb-1">{{ $achievement['title'] }}</div>
                            <div class="text-gray-600 dark:text-gray-400">{{ $achievement['description'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

            <!-- Latest Quizzes Section -->
            <div class="bg-white dark:bg-[#1A2333]/40 backdrop-blur-xl rounded-2xl shadow-lg overflow-hidden border border-blue-200 dark:border-blue-800/30">
    <!-- Header -->
    <div class="p-6 border-b border-blue-100 dark:border-blue-700/30">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Kuis Terbaru</h3>
            <a href="{{ route('quizzes') }}" class="text-sm text-blue-700 dark:text-blue-400 hover:text-blue-600 dark:hover:text-blue-300 transition-colors">Lihat Semua</a>
        </div>
    </div>

    <!-- Content -->
    <div class="p-6 space-y-4">
        @forelse($latestQuizzes as $quiz)
            <div class="group bg-white dark:bg-[#0F172A]/60 backdrop-blur-lg rounded-lg p-4 hover:bg-blue-100 dark:hover:bg-[#1C2A3F] transition-all duration-200 border border-blue-100 dark:border-blue-700/30">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-600/20 backdrop-blur-sm flex items-center justify-center border border-blue-200 dark:border-blue-500/30">
                            <i class="fas fa-question-circle text-blue-700 dark:text-blue-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white group-hover:text-blue-700 dark:group-hover:text-blue-400 transition-colors">{{ $quiz->module->title }}</h4>
                        <p class="mt-1 text-gray-600 dark:text-gray-400">{{ Str::limit($quiz->question, 100) }}</p>
                    </div>
                    <a href="{{ route('quizzes.show', $quiz->module_id) }}" class="inline-flex items-center px-4 py-2 bg-blue-100 dark:bg-blue-600/20 text-blue-700 dark:text-blue-400 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-600/30 transition-colors border border-blue-200 dark:border-blue-500/30">
                        Mulai
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center py-8">
                <div class="w-16 h-16 mx-auto rounded-full bg-gray-200 dark:bg-gray-700/50 flex items-center justify-center mb-4">
                    <i class="fas fa-question-circle text-gray-600 dark:text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Belum ada kuis</h3>
                <p class="text-gray-600 dark:text-gray-400">Kuis akan tersedia setelah Anda menyelesaikan modul pembelajaran.</p>
            </div>
        @endforelse

        <!-- Notifications -->
        <div class="mt-8 pt-6 border-t border-blue-100 dark:border-blue-700/30">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-lg font-medium text-gray-900 dark:text-white">Notifikasi & Pengingat</h4>
                <button class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition-colors">
                    <i class="fas fa-cog"></i>
                </button>
            </div>

            <div class="space-y-4">
                <!-- Notification 1 -->
                <div class="group bg-yellow-100 dark:bg-yellow-600/10 backdrop-blur-lg rounded-lg p-4 hover:bg-yellow-200 dark:hover:bg-yellow-600/20 transition-all duration-200 border border-yellow-200 dark:border-yellow-500/30">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg bg-yellow-200 dark:bg-yellow-600/20 flex items-center justify-center border border-yellow-300 dark:border-yellow-500/30">
                                <i class="fas fa-exclamation-triangle text-yellow-700 dark:text-yellow-400"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h5 class="text-gray-900 dark:text-white group-hover:text-yellow-700 dark:group-hover:text-yellow-400 transition-colors">Ancaman Baru Terdeteksi</h5>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">Varian phishing baru menargetkan pengguna media sosial. Pelajari cara melindungi diri Anda.</p>
                            <a href="#" class="inline-block mt-2 text-yellow-700 dark:text-yellow-400 hover:text-yellow-600 dark:hover:text-yellow-300 transition-colors text-sm">Baca selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Notification 2 -->
                <div class="group bg-blue-100 dark:bg-blue-600/10 backdrop-blur-lg rounded-lg p-4 hover:bg-blue-200 dark:hover:bg-blue-600/20 transition-all duration-200 border border-blue-200 dark:border-blue-500/30">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-lg bg-blue-200 dark:bg-blue-600/20 flex items-center justify-center border border-blue-300 dark:border-blue-500/30">
                                <i class="fas fa-book text-blue-700 dark:text-blue-400"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h5 class="text-gray-900 dark:text-white group-hover:text-blue-700 dark:group-hover:text-blue-400 transition-colors">Materi Baru Tersedia</h5>
                            <p class="mt-1 text-gray-600 dark:text-gray-400">Modul baru tentang keamanan cloud computing telah ditambahkan ke kurikulum Anda.</p>
                            <a href="#" class="inline-block mt-2 text-blue-700 dark:text-blue-400 hover:text-blue-600 dark:hover:text-blue-300 transition-colors text-sm">Mulai belajar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="{{ asset('css/forum.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Progress Chart
            const ctx = document.getElementById('progressChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($progressOverview['labels']),
                    datasets: [
                        {
                            label: 'Modul Selesai',
                            data: @json($progressOverview['moduleData']),
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Kuis Selesai',
                            data: @json($progressOverview['quizData']),
                            borderColor: '#10B981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                        color: '#fff'
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                            ticks: {
                        color: '#9CA3AF'
                            }
                        },
                        x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                            ticks: {
                        color: '#9CA3AF'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
@endsection
