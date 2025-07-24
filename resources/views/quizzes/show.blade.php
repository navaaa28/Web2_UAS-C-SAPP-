@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-white">{{ $module->title }}</h1>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-400">Pertanyaan:</span>
                    <div class="flex space-x-1">
                        @foreach($questions as $index => $q)
                            <div id="question-indicator-{{ $index }}" class="w-6 h-6 rounded-full bg-gray-700/50 flex items-center justify-center text-xs text-gray-300 border border-gray-600/30">
                                {{ $index + 1 }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <p class="text-gray-400 mt-2">Jawab semua pertanyaan untuk menyelesaikan kuis ini</p>
        </div>
            
            @if(session('error'))
            <div class="bg-red-600/20 backdrop-blur-sm text-red-400 p-4 rounded-lg shadow-lg border border-red-500/30 mb-6" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
                </div>
            @endif
            
        <form action="{{ route('quizzes.submit') }}" method="POST" class="space-y-6" id="quiz-form">
                @csrf
                <input type="hidden" name="module_id" value="{{ $module->id }}">

                @foreach($questions as $index => $question)
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700/50 hover:border-blue-500/30 transition-all duration-300" id="question-{{ $index }}">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-xl font-semibold text-white">{{ $index + 1 }}. {{ $question->question }}</h3>
                        <div class="w-8 h-8 rounded-lg bg-blue-600/20 flex items-center justify-center border border-blue-500/30">
                            <i class="fas fa-question text-blue-400"></i>
                        </div>
                    </div>
                    
                        <div class="space-y-3">
                        <label class="flex items-center p-3 rounded-lg hover:bg-gray-700/30 transition-colors cursor-pointer group">
                            <input type="radio" name="q{{ $question->id }}" value="a" class="form-radio text-blue-600 bg-gray-700 border-gray-600 focus:ring-blue-500" required data-question="{{ $index }}">
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">{{ $question->option_a }}</span>
                            </label>
                        <label class="flex items-center p-3 rounded-lg hover:bg-gray-700/30 transition-colors cursor-pointer group">
                            <input type="radio" name="q{{ $question->id }}" value="b" class="form-radio text-blue-600 bg-gray-700 border-gray-600 focus:ring-blue-500" data-question="{{ $index }}">
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">{{ $question->option_b }}</span>
                            </label>
                        <label class="flex items-center p-3 rounded-lg hover:bg-gray-700/30 transition-colors cursor-pointer group">
                            <input type="radio" name="q{{ $question->id }}" value="c" class="form-radio text-blue-600 bg-gray-700 border-gray-600 focus:ring-blue-500" data-question="{{ $index }}">
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">{{ $question->option_c }}</span>
                            </label>
                        <label class="flex items-center p-3 rounded-lg hover:bg-gray-700/30 transition-colors cursor-pointer group">
                            <input type="radio" name="q{{ $question->id }}" value="d" class="form-radio text-blue-600 bg-gray-700 border-gray-600 focus:ring-blue-500" data-question="{{ $index }}">
                            <span class="ml-3 text-gray-300 group-hover:text-white transition-colors">{{ $question->option_d }}</span>
                            </label>
                        </div>
                    </div>
                @endforeach

            <div class="flex justify-between items-center pt-6">
                <a href="{{ route('materials.index') }}" class="inline-flex items-center text-gray-400 hover:text-blue-400 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Materi
                </a>
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition-colors border border-blue-500/30">
                    <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Jawaban
                    </button>
                </div>
            </form>
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
    
    // Track answered questions
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    const questionIndicators = {};
    
    // Initialize question indicators
    @foreach($questions as $index => $question)
        questionIndicators[{{ $index }}] = document.getElementById('question-indicator-{{ $index }}');
    @endforeach
    
    // Update indicators when a question is answered
    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            const questionIndex = this.getAttribute('data-question');
            if (questionIndicators[questionIndex]) {
                questionIndicators[questionIndex].classList.remove('bg-gray-700/50', 'text-gray-300');
                questionIndicators[questionIndex].classList.add('bg-green-600/20', 'text-green-400', 'border-green-500/30');
            }
        });
    });
    
    // Highlight current question when scrolling
    const questionElements = document.querySelectorAll('[id^="question-"]');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const questionId = entry.target.id;
                const questionIndex = questionId.split('-')[1];
                questionIndicators[questionIndex].classList.add('ring-2', 'ring-blue-500');
            } else {
                const questionId = entry.target.id;
                const questionIndex = questionId.split('-')[1];
                questionIndicators[questionIndex].classList.remove('ring-2', 'ring-blue-500');
            }
        });
    }, { threshold: 0.5 });
    
    questionElements.forEach(question => {
        observer.observe(question);
    });
});
</script>
@endpush
@endsection 