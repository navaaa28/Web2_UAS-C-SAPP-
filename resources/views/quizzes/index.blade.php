@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-gray-900">
<div class="min-h-screen bg-gray-100 text-gray-900 dark:bg-gradient-to-br dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Kuis Pembelajaran</h1>
            <p class="text-gray-400">Uji pemahaman Anda tentang materi pembelajaran</p>
        </div>
        
        <!-- Quizzes Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($modules as $module)
                @if($module->quizzes()->count() > 0)
                <div class="bg-white/80 dark:bg-[#0F172A]/60 backdrop-blur-sm rounded-lg p-6 border border-gray-100 dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-[#0F172A]/50 transition-all duration-300 group">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white group-hover:text-blue-400 transition-colors">{{ $module->title }}</h3>
                        <div class="w-10 h-10 rounded-lg bg-blue-600/20 flex items-center justify-center border border-blue-500/30">
                            <i class="fas fa-tasks text-blue-400"></i>
                        </div>
                    </div>
                    
                    <p class="text-gray-700 dark:text-gray-300 mb-6">{{ $module->description }}</p>
                    
                    <div class="flex flex-col space-y-4">
                        <div class="flex items-center text-sm text-gray-400">
                            <i class="fas fa-question-circle mr-2 text-blue-400"></i>
                            <span>{{ $module->quizzes()->count() }} Pertanyaan</span>
                        </div>
                        
                        @if(isset($userResults[$module->id]))
                            <div class="bg-gray-700/30 rounded-lg p-4 border border-gray-600/30">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-300">Nilai Akhir</span>
                                    <span class="text-lg font-bold {{ $userResults[$module->id]->score >= 70 ? 'text-green-400' : 'text-red-400' }}">
                                        {{ $userResults[$module->id]->score }}%
                                    </span>
                                </div>
                                <div class="flex items-center text-sm text-gray-400">
                                    <i class="fas fa-check-circle mr-2 {{ $userResults[$module->id]->score >= 70 ? 'text-green-400' : 'text-red-400' }}"></i>
                                    <span>{{ $userResults[$module->id]->correct_answers }}/{{ $userResults[$module->id]->total_questions }} Jawaban Benar</span>
                                </div>
                            </div>
                            
                            <a href="{{ route('quizzes.show', $module->id) }}" 
                               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition-colors border border-blue-500/30">
                                <i class="fas fa-redo mr-2"></i>
                                Coba Lagi
                            </a>
                        @else
                            @if($module->isCompletedByUser())
                                <a href="{{ route('quizzes.show', $module->id) }}" 
                                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition-colors border border-blue-500/30">
                                    <i class="fas fa-play mr-2"></i>
                                    Mulai Kuis
                                </a>
                            @else
                                <div class="bg-gray-700/30 rounded-lg p-4 border border-gray-600/30">
                                    <div class="flex items-center text-sm text-gray-400">
                                        <i class="fas fa-lock mr-2"></i>
                                        <span>Selesaikan modul terlebih dahulu untuk membuka kuis</span>
                                    </div>
                                </div>
                                <a href="{{ route('materials.module', $module->id) }}" 
                                   class="inline-flex items-center justify-center px-4 py-2 bg-green-600/20 text-green-400 rounded-lg hover:bg-green-600/30 transition-colors border border-green-500/30">
                                    <i class="fas fa-book-reader mr-2"></i>
                                    Baca Modul
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
                @endif
            @empty
                <div class="col-span-3">
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-12 text-center border border-gray-700/50">
                        <div class="w-16 h-16 rounded-full bg-gray-700/30 flex items-center justify-center mx-auto mb-4 border border-gray-600/30">
                            <i class="fas fa-book text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-400 text-lg">Belum ada kuis yang tersedia.</p>
                        <p class="text-gray-500 text-sm mt-2">Kuis akan tersedia setelah materi pembelajaran selesai.</p>
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