@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">{{ $module->title }}</h1>
            <p class="text-gray-400">Hasil Kuis Pembelajaran</p>
        </div>
        
        <!-- Score Card -->
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-8 mb-8 border border-gray-700/50">
            <div class="text-center">
                <h2 class="text-2xl font-semibold text-white mb-4">Nilai Anda</h2>
                <div class="relative inline-block">
                    <div class="w-40 h-40 rounded-full bg-gray-700/30 flex items-center justify-center border border-gray-600/30 mb-4 mx-auto">
                        <div class="text-5xl font-bold {{ $score >= 70 ? 'text-green-400' : 'text-red-400' }}">
                            {{ $score }}%
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 w-12 h-12 rounded-full {{ $score >= 70 ? 'bg-green-600/20 text-green-400 border-green-500/30' : 'bg-red-600/20 text-red-400 border-red-500/30' }} flex items-center justify-center border">
                        @if($score >= 70)
                            <i class="fas fa-check text-xl"></i>
                        @else
                            <i class="fas fa-times text-xl"></i>
                        @endif
                    </div>
                </div>
                <div class="flex items-center justify-center space-x-2 text-gray-300">
                    <i class="fas fa-check-circle {{ $score >= 70 ? 'text-green-400' : 'text-red-400' }}"></i>
                    <span>Jawaban Benar: {{ $correctAnswers }} dari {{ $totalQuestions }} Pertanyaan</span>
                </div>
            </div>
        </div>
        
        <!-- Results Detail -->
        <div class="space-y-6">
            <h2 class="text-xl font-semibold text-white mb-4">Detail Jawaban</h2>
            
            @foreach($results as $index => $result)
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700/50 hover:border-blue-500/30 transition-all duration-300">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            @if($result['is_correct'])
                                <div class="w-10 h-10 rounded-full bg-green-600/20 flex items-center justify-center border border-green-500/30">
                                    <i class="fas fa-check text-green-400"></i>
                                </div>
                            @else
                                <div class="w-10 h-10 rounded-full bg-red-600/20 flex items-center justify-center border border-red-500/30">
                                    <i class="fas fa-times text-red-400"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="ml-4 flex-1">
                            <h3 class="text-lg font-semibold text-white mb-3">
                                {{ $index + 1 }}. {{ $result['question'] }}
                            </h3>
                            
                            <div class="space-y-2 mb-4">
                                @foreach(['a', 'b', 'c', 'd'] as $option)
                                    <div class="flex items-center p-2 rounded-lg {{ $result['correct_answer'] === $option ? 'bg-green-600/10 border border-green-500/30' : ($result['user_answer'] === $option && !$result['is_correct'] ? 'bg-red-600/10 border border-red-500/30' : 'hover:bg-gray-700/30') }}">
                                        <div class="w-8 h-8 rounded-lg bg-gray-700/30 flex items-center justify-center text-center mr-3 border border-gray-600/30">
                                            {{ strtoupper($option) }}
                                        </div>
                                        <div class="flex-1 {{ $result['correct_answer'] === $option ? 'text-green-400 font-medium' : ($result['user_answer'] === $option && !$result['is_correct'] ? 'text-red-400 line-through' : 'text-gray-300') }}">
                                            {{ $result['options'][$option] }}
                                        </div>
                                        @if($result['correct_answer'] === $option)
                                            <div class="ml-2 text-green-400">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        @elseif($result['user_answer'] === $option && !$result['is_correct'])
                                            <div class="ml-2 text-red-400">
                                                <i class="fas fa-times-circle"></i>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            
                            @if($result['explanation'])
                                <div class="mt-4 p-4 bg-gray-700/30 rounded-lg border border-gray-600/30">
                                    <h4 class="font-semibold text-white mb-2 flex items-center">
                                        <i class="fas fa-lightbulb text-yellow-400 mr-2"></i>
                                        Penjelasan:
                                    </h4>
                                    <p class="text-gray-300">{{ $result['explanation'] }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Navigation Buttons -->
        <div class="mt-8 flex justify-between items-center pt-6 border-t border-gray-700/50">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-700/30 text-gray-300 rounded-lg hover:bg-gray-700/50 transition-colors border border-gray-600/30">
                <i class="fas fa-home mr-2"></i>
                Kembali ke Dashboard
            </a>
            <a href="{{ route('materials.module', $module) }}" class="inline-flex items-center px-4 py-2 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition-colors border border-blue-500/30">
                <i class="fas fa-arrow-right mr-2"></i>
                Lanjut ke Materi Berikutnya
            </a>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set dark theme by default for cybersecurity theme
    document.body.classList.add('dark-theme');
    localStorage.setItem('theme', 'dark');
});
</script>
@endpush
@endsection 