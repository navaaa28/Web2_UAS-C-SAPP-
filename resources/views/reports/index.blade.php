@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100 text-gray-900 min-h-screen dark:bg-gradient-to-br dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-10 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-2 tracking-tight">Laporan Progres Belajar</h1>
            <p class="text-gray-700 dark:text-gray-300 text-lg max-w-2xl mx-auto">Pantau perkembangan belajar Anda, lihat riwayat asesmen, dan dapatkan rekomendasi materi untuk meningkatkan pemahaman Anda.</p>
        </div>
        <div class="bg-white/80 shadow-xl sm:rounded-2xl p-8 dark:bg-gray-800/80">
            <!-- Progress Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                <!-- Modules Progress -->
                <div class="bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-700/60 dark:to-blue-900/60 rounded-2xl p-6 flex flex-col items-center shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100/60 dark:bg-blue-600/30 p-3 rounded-full mr-3">
                            <i class="fas fa-book-open text-2xl text-blue-600"></i>
                        </div>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">Progres Modul</span>
                    </div>
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $progressData['modules_completed'] }}</span>
                        <span class="text-xl text-gray-600 dark:text-gray-300">/ {{ $progressData['total_modules'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 mb-2">
                        <div class="bg-blue-500 h-4 rounded-full transition-all duration-500" style="width: {{ ($progressData['modules_completed'] / max(1, $progressData['total_modules'])) * 100 }}%"></div>
                    </div>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium mt-2 {{ $progressData['modules_completed'] == $progressData['total_modules'] && $progressData['total_modules'] > 0 ? 'bg-green-100 text-green-800 dark:bg-green-600/30 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-600/30 dark:text-yellow-300' }}">
                        {{ $progressData['modules_completed'] == $progressData['total_modules'] && $progressData['total_modules'] > 0 ? 'Selesai' : 'Belum Selesai' }}
                    </span>
                </div>
                <!-- Quizzes Progress -->
                <div class="bg-gradient-to-br from-green-100 to-green-200 dark:from-green-700/60 dark:to-green-900/60 rounded-2xl p-6 flex flex-col items-center shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100/60 dark:bg-green-600/30 p-3 rounded-full mr-3">
                            <i class="fas fa-tasks text-2xl text-green-600"></i>
                        </div>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">Progres Kuis</span>
                    </div>
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $progressData['quizzes_completed'] }}</span>
                        <span class="text-xl text-gray-600 dark:text-gray-300">/ {{ $progressData['total_quizzes'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 mb-2">
                        <div class="bg-green-500 h-4 rounded-full transition-all duration-500" style="width: {{ ($progressData['quizzes_completed'] / max(1, $progressData['total_quizzes'])) * 100 }}%"></div>
                    </div>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium mt-2 {{ $progressData['quizzes_completed'] == $progressData['total_quizzes'] && $progressData['total_quizzes'] > 0 ? 'bg-green-100 text-green-800 dark:bg-green-600/30 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-600/30 dark:text-yellow-300' }}">
                        {{ $progressData['quizzes_completed'] == $progressData['total_quizzes'] && $progressData['total_quizzes'] > 0 ? 'Selesai' : 'Belum Selesai' }}
                    </span>
                </div>
                <!-- Average Score -->
                <div class="bg-gradient-to-br from-purple-100 to-purple-200 dark:from-purple-700/60 dark:to-purple-900/60 rounded-2xl p-6 flex flex-col items-center shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="bg-purple-100/60 dark:bg-purple-600/30 p-3 rounded-full mr-3">
                            <i class="fas fa-star text-2xl text-purple-600"></i>
                        </div>
                        <span class="text-lg font-semibold text-gray-900 dark:text-white">Rata-rata Skor</span>
                    </div>
                    <div class="flex items-center justify-center mb-2">
                        <div class="w-24 h-24 bg-purple-100/60 dark:bg-purple-700/40 rounded-full flex items-center justify-center text-gray-900 dark:text-white text-3xl font-extrabold border-4 border-purple-200 dark:border-purple-500 shadow-inner">
                            {{ $progressData['average_score'] }}<span class="text-xl font-bold">%</span>
                        </div>
                    </div>
                    <p class="text-center text-sm text-gray-600 dark:text-gray-300 mt-2">
                        Asesmen terakhir: <span class="font-medium text-gray-900 dark:text-white">{{ $progressData['last_assessment_date'] }}</span>
                    </p>
                </div>
            </div>
            <!-- Assessment History Graph -->
            <div class="bg-white/80 dark:bg-gray-700/80 rounded-2xl p-8 mb-10 shadow-lg">
                <div class="flex items-center mb-4">
                    <i class="fas fa-chart-line text-blue-500 dark:text-blue-300 text-2xl mr-3"></i>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Riwayat Asesmen</h3>
                </div>
                <p class="text-gray-700 dark:text-gray-300 mb-4">Lihat perkembangan skor asesmen Anda selama 6 bulan terakhir.</p>
                @if(count($assessmentHistory['labels']) > 0)
                    <div class="h-72">
                        <canvas id="assessmentChart"></canvas>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center h-64 text-gray-600 dark:text-gray-300">
                        <i class="fas fa-info-circle text-4xl mb-4"></i>
                        <p>Belum ada riwayat asesmen</p>
                    </div>
                @endif
            </div>
            <!-- Material Recommendations -->
            <div class="bg-white/80 dark:bg-gray-700/80 rounded-2xl p-8">
                <div class="flex items-center mb-4">
                    <i class="fas fa-lightbulb text-yellow-500 dark:text-yellow-300 text-2xl mr-3"></i>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Rekomendasi Materi</h3>
                </div>
                <p class="text-gray-700 dark:text-gray-300 mb-4">Materi berikut direkomendasikan untuk Anda selesaikan agar progres belajar semakin optimal.</p>
                @if(count($recommendations) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($recommendations as $recommendation)
                        <div class="bg-white/80 dark:bg-gradient-to-br dark:from-blue-800/60 dark:to-blue-900/60 rounded-xl p-6 flex flex-col justify-between shadow-md hover:shadow-xl transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="bg-blue-100 dark:bg-blue-600/30 p-2 rounded-full mr-3">
                                    <i class="fas fa-book text-lg text-blue-600 dark:text-blue-300"></i>
                                </div>
                                <h4 class="font-semibold text-gray-900 dark:text-white text-lg">{{ $recommendation['title'] }}</h4>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-4">{{ $recommendation['description'] }}</p>
                            <div class="flex items-center mb-2">
                                <div class="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2 mr-3">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $recommendation['progress'] }}%"></div>
                                </div>
                                <span class="text-xs text-gray-700 dark:text-gray-300">{{ $recommendation['progress'] }}%</span>
                            </div>
                            <a href="{{ route('materials.module', ['module' => $loop->index+1]) }}" class="mt-2 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold text-sm hover:bg-blue-700 transition-colors shadow">
                                Lihat Materi
                            </a>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-600 dark:text-gray-300">
                        <i class="fas fa-check-circle text-3xl mb-2"></i>
                        <p>Belum ada rekomendasi materi</p>
                        <p class="text-sm mt-2">Selesaikan beberapa modul untuk mendapatkan rekomendasi</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(count($assessmentHistory['labels']) > 0)
        const ctx = document.getElementById('assessmentChart').getContext('2d');
        // pick colors that adapt to light/dark using computed styles
        const rootStyles = getComputedStyle(document.documentElement);
        const textColor = rootStyles.getPropertyValue('--app-text-color') || '#111827';
        const gridColor = rootStyles.getPropertyValue('--app-grid-color') || 'rgba(0,0,0,0.08)';
        const accent = rootStyles.getPropertyValue('--app-accent') || 'rgb(37, 99, 235)';
        const accentBg = rootStyles.getPropertyValue('--app-accent-bg') || 'rgba(37, 99, 235, 0.12)';

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($assessmentHistory['labels']),
                datasets: [{
                    label: 'Skor Asesmen',
                    data: @json($assessmentHistory['scores']),
                    borderColor: accent.trim(),
                    backgroundColor: accentBg.trim(),
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: accent.trim(),
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            color: gridColor.trim()
                        },
                        ticks: {
                            color: textColor.trim(),
                            font: { size: 14 }
                        }
                    },
                    x: {
                        grid: {
                            color: gridColor.trim()
                        },
                        ticks: {
                            color: textColor.trim(),
                            font: { size: 14 }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: textColor.trim(),
                            font: { size: 16 }
                        }
                    },
                    tooltip: {
                        backgroundColor: textColor.trim() === '#111827' ? '#fff' : '#111827',
                        titleColor: textColor.trim() === '#111827' ? '#111827' : '#fff',
                        bodyColor: textColor.trim() === '#111827' ? '#111827' : '#fff',
                        borderColor: accent.trim(),
                        borderWidth: 1
                    }
                }
            }
        });
        @endif
    });
</script>
@endpush
@endsection 