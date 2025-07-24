@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-10 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2 tracking-tight">Laporan Progres Belajar</h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">Pantau perkembangan belajar Anda, lihat riwayat asesmen, dan dapatkan rekomendasi materi untuk meningkatkan pemahaman Anda.</p>
        </div>
        <div class="bg-gray-800/80 shadow-xl sm:rounded-2xl p-8">
            <!-- Progress Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
                <!-- Modules Progress -->
                <div class="bg-gradient-to-br from-blue-700/60 to-blue-900/60 rounded-2xl p-6 flex flex-col items-center shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-600/30 p-3 rounded-full mr-3">
                            <i class="fas fa-book-open text-2xl text-blue-300"></i>
                        </div>
                        <span class="text-lg font-semibold text-white">Progres Modul</span>
                    </div>
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="text-3xl font-bold text-white">{{ $progressData['modules_completed'] }}</span>
                        <span class="text-xl text-gray-400">/ {{ $progressData['total_modules'] }}</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-4 mb-2">
                        <div class="bg-blue-500 h-4 rounded-full transition-all duration-500" style="width: {{ ($progressData['modules_completed'] / max(1, $progressData['total_modules'])) * 100 }}%"></div>
                    </div>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium mt-2 {{ $progressData['modules_completed'] == $progressData['total_modules'] && $progressData['total_modules'] > 0 ? 'bg-green-600/30 text-green-400' : 'bg-yellow-600/30 text-yellow-300' }}">
                        {{ $progressData['modules_completed'] == $progressData['total_modules'] && $progressData['total_modules'] > 0 ? 'Selesai' : 'Belum Selesai' }}
                    </span>
                </div>
                <!-- Quizzes Progress -->
                <div class="bg-gradient-to-br from-green-700/60 to-green-900/60 rounded-2xl p-6 flex flex-col items-center shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-600/30 p-3 rounded-full mr-3">
                            <i class="fas fa-tasks text-2xl text-green-300"></i>
                        </div>
                        <span class="text-lg font-semibold text-white">Progres Kuis</span>
                    </div>
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="text-3xl font-bold text-white">{{ $progressData['quizzes_completed'] }}</span>
                        <span class="text-xl text-gray-400">/ {{ $progressData['total_quizzes'] }}</span>
                    </div>
                    <div class="w-full bg-gray-700 rounded-full h-4 mb-2">
                        <div class="bg-green-500 h-4 rounded-full transition-all duration-500" style="width: {{ ($progressData['quizzes_completed'] / max(1, $progressData['total_quizzes'])) * 100 }}%"></div>
                    </div>
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium mt-2 {{ $progressData['quizzes_completed'] == $progressData['total_quizzes'] && $progressData['total_quizzes'] > 0 ? 'bg-green-600/30 text-green-400' : 'bg-yellow-600/30 text-yellow-300' }}">
                        {{ $progressData['quizzes_completed'] == $progressData['total_quizzes'] && $progressData['total_quizzes'] > 0 ? 'Selesai' : 'Belum Selesai' }}
                    </span>
                </div>
                <!-- Average Score -->
                <div class="bg-gradient-to-br from-purple-700/60 to-purple-900/60 rounded-2xl p-6 flex flex-col items-center shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="bg-purple-600/30 p-3 rounded-full mr-3">
                            <i class="fas fa-star text-2xl text-purple-300"></i>
                        </div>
                        <span class="text-lg font-semibold text-white">Rata-rata Skor</span>
                    </div>
                    <div class="flex items-center justify-center mb-2">
                        <div class="w-24 h-24 bg-purple-700/40 rounded-full flex items-center justify-center text-white text-3xl font-extrabold border-4 border-purple-500 shadow-inner">
                            {{ $progressData['average_score'] }}<span class="text-xl font-bold">%</span>
                        </div>
                    </div>
                    <p class="text-center text-sm text-gray-300 mt-2">
                        Asesmen terakhir: <span class="font-medium text-white">{{ $progressData['last_assessment_date'] }}</span>
                    </p>
                </div>
            </div>
            <!-- Assessment History Graph -->
            <div class="bg-gray-700/80 rounded-2xl p-8 mb-10 shadow-lg">
                <div class="flex items-center mb-4">
                    <i class="fas fa-chart-line text-blue-400 text-2xl mr-3"></i>
                    <h3 class="text-xl font-bold text-white">Riwayat Asesmen</h3>
                </div>
                <p class="text-gray-400 mb-4">Lihat perkembangan skor asesmen Anda selama 6 bulan terakhir.</p>
                @if(count($assessmentHistory['labels']) > 0)
                    <div class="h-72">
                        <canvas id="assessmentChart"></canvas>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center h-64 text-gray-400">
                        <i class="fas fa-info-circle text-4xl mb-4"></i>
                        <p>Belum ada riwayat asesmen</p>
                    </div>
                @endif
            </div>
            <!-- Material Recommendations -->
            <div class="bg-gray-700/80 rounded-2xl p-8">
                <div class="flex items-center mb-4">
                    <i class="fas fa-lightbulb text-yellow-300 text-2xl mr-3"></i>
                    <h3 class="text-xl font-bold text-white">Rekomendasi Materi</h3>
                </div>
                <p class="text-gray-400 mb-4">Materi berikut direkomendasikan untuk Anda selesaikan agar progres belajar semakin optimal.</p>
                @if(count($recommendations) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($recommendations as $recommendation)
                        <div class="bg-gradient-to-br from-blue-800/60 to-blue-900/60 rounded-xl p-6 flex flex-col justify-between shadow-md hover:shadow-xl transition-shadow">
                            <div class="flex items-center mb-3">
                                <div class="bg-blue-600/30 p-2 rounded-full mr-3">
                                    <i class="fas fa-book text-lg text-blue-300"></i>
                                </div>
                                <h4 class="font-semibold text-white text-lg">{{ $recommendation['title'] }}</h4>
                            </div>
                            <p class="text-gray-300 text-sm mb-4">{{ $recommendation['description'] }}</p>
                            <div class="flex items-center mb-2">
                                <div class="w-24 bg-gray-600 rounded-full h-2 mr-3">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $recommendation['progress'] }}%"></div>
                                </div>
                                <span class="text-xs text-gray-300">{{ $recommendation['progress'] }}%</span>
                            </div>
                            <a href="{{ route('materials.module', ['module' => $loop->index+1]) }}" class="mt-2 inline-block px-4 py-2 bg-blue-600/80 text-white rounded-lg font-semibold text-sm hover:bg-blue-700/90 transition-colors shadow">
                                Lihat Materi
                            </a>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-400">
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
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($assessmentHistory['labels']),
                datasets: [{
                    label: 'Skor Asesmen',
                    data: @json($assessmentHistory['scores']),
                    borderColor: 'rgb(37, 99, 235)',
                    backgroundColor: 'rgba(37, 99, 235, 0.2)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: 'rgb(37, 99, 235)',
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
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#fff',
                            font: { size: 14 }
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#fff',
                            font: { size: 14 }
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#fff',
                            font: { size: 16 }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#222',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#2563eb',
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