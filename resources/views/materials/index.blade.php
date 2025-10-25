@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 text-gray-900 dark:bg-gradient-to-br dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
    <div class="bg-white/5 dark:bg-gray-900/60 rounded-lg shadow-xl p-6 sm:p-8 mb-8 backdrop-blur-sm border border-blue-100/10 dark:border-gray-700/50">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Materi Pembelajaran</h1>
                    <p class="text-gray-600 dark:text-gray-300 text-lg">Tingkatkan keahlian keamanan siber Anda melalui modul-modul interaktif</p>
                </div>
                <div class="hidden lg:block">
                    <div class="bg-white/10 backdrop-blur-sm rounded-full p-6 border border-white/20">
                        <i class="fas fa-graduation-cap text-5xl text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Overview -->
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-lg p-6 mb-8 border border-gray-700/50">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-700/30 backdrop-blur-sm rounded-lg p-4 border border-gray-600/30">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-blue-600/20 backdrop-blur-sm flex items-center justify-center border border-blue-500/30">
                                <i class="fas fa-book-reader text-blue-400 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-400 text-sm">Modul Selesai</p>
                                <h4 class="text-2xl font-bold text-white">{{ $completedModulesCount ?? '0' }}/{{ $totalModulesCount ?? '0' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-700/30 backdrop-blur-sm rounded-lg p-4 border border-gray-600/30">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-green-600/20 backdrop-blur-sm flex items-center justify-center border border-green-500/30">
                                <i class="fas fa-tasks text-green-400 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-400 text-sm">Kuis Selesai</p>
                                <h4 class="text-2xl font-bold text-white">{{ $completedQuizzesCount ?? '0' }}/{{ $totalQuizzesCount ?? '0' }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-700/30 backdrop-blur-sm rounded-lg p-4 border border-gray-600/30">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg bg-purple-600/20 backdrop-blur-sm flex items-center justify-center border border-purple-500/30">
                                <i class="fas fa-clock text-purple-400 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-400 text-sm">Total Waktu Belajar</p>
                                <h4 class="text-2xl font-bold text-white">{{ $totalLearningTime ?? '0' }} jam</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <!-- Materials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" style="grid-auto-rows: 1fr;">
            @forelse($modules as $module)
            <div class="group bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-lg border border-gray-700/50 hover:border-blue-500/50 transition-all duration-300 flex flex-col h-full overflow-hidden">
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 rounded-lg bg-blue-600/20 backdrop-blur-sm flex items-center justify-center border border-blue-500/30 mr-4">
                                        <i class="fas fa-book text-blue-400 text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white group-hover:text-blue-400 transition-colors">{{ $module->title }}</h3>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 mb-4 line-clamp-2">{{ $module->description }}</p>
                            </div>
                            @if($module->isCompletedByUser())
                                <div class="flex-shrink-0 ml-4">
                                    <div class="w-8 h-8 rounded-full bg-green-600/20 backdrop-blur-sm flex items-center justify-center border border-green-500/30">
                                        <i class="fas fa-check text-green-400"></i>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            @if($module->has_quiz)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-600/20 text-blue-400 border border-blue-500/30">
                                    <i class="fas fa-tasks mr-2"></i>
                                    Kuis
                                </span>
                            @endif
                            <span class="text-sm text-gray-400">
                                {{ $module->created_at->locale('id')->diffForHumans() }}
                            </span>
                        </div>
                        <a href="{{ route('materials.module', $module) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition-colors border border-blue-500/30">
                            {{ $module->isCompletedByUser() ? 'Baca Ulang' : 'Mulai' }}
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    @if($module->isCompletedByUser())
                        <div class="mt-4 pt-4 border-t border-gray-700/50">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400">Diselesaikan:</span>
                                <span class="text-gray-300">{{ $module->userProgress->completed_at->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="px-6 py-4 bg-gray-700/30 backdrop-blur-sm rounded-b-lg border-t border-gray-700/50 min-h-[64px]">
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center text-gray-400">
                            <i class="fas fa-clock mr-2"></i>
                            @php
                                // Protect against null userProgress and non-numeric values
                                $timeSpent = 0;
                                if (!empty($module->userProgress) && isset($module->userProgress->time_spent)) {
                                    $timeSpent = (int) $module->userProgress->time_spent;
                                }

                                // Display logic:
                                // - If no progress record: 'Belum Dibaca'
                                // - If progress exists but not completed and time_spent > 0: 'Sedang Dibaca: ...'
                                // - If completed: show concise time + 'belajar'
                                if (empty($module->userProgress)) {
                                    $display = 'Belum Dibaca';
                                } else {
                                    $hours = intdiv($timeSpent, 3600);
                                    $minutes = intdiv($timeSpent % 3600, 60);
                                    $seconds = $timeSpent % 60;

                                    $parts = [];
                                    if ($hours > 0) {
                                        $parts[] = $hours . ' jam';
                                    }
                                    if ($minutes > 0) {
                                        $parts[] = $minutes . ' menit';
                                    }
                                    if ($seconds > 0) {
                                        $parts[] = $seconds . ' detik';
                                    }

                                    $timeLabel = empty($parts) ? '0 detik' : implode(' ', $parts);

                                    if (!$module->isCompletedByUser()) {
                                        // Not completed but has progress => show 'Sedang Dibaca' if time > 0
                                        if ($timeSpent > 0) {
                                            $display = 'Sedang Dibaca: ' . $timeLabel;
                                        } else {
                                            $display = 'Belum Dibaca';
                                        }
                                    } else {
                                        // Completed -> show time + ' belajar'
                                        $display = $timeLabel . ' belajar';
                                    }
                                }
                            @endphp
                            {{ $display }}
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3">
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-lg p-12 text-center border border-gray-700/50">
                    <div class="w-16 h-16 mx-auto rounded-full bg-blue-600/20 backdrop-blur-sm flex items-center justify-center border border-blue-500/30 mb-4">
                        <i class="fas fa-book-reader text-blue-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-medium text-white mb-2">Belum ada modul</h3>
                    <p class="text-gray-400">
                        Modul pembelajaran akan segera tersedia.
                    </p>
                </div>
            </div>
            @endforelse
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
<!-- theme is controlled globally via layouts/app.blade.php (Alpine + localStorage). Removed forced dark-theme script. -->
@endpush
@endsection 