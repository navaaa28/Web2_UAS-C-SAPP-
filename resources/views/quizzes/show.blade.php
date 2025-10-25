@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 text-gray-900 dark:bg-gradient-to-br dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $module->title }}</h1>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Pertanyaan:</span>
                            <div class="flex space-x-1 overflow-x-auto">
                            @foreach($questions as $index => $q)
                                <div id="question-indicator-{{ $index }}" class="flex-shrink-0 w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600">
                                    {{ $index + 1 }}
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Jawab semua pertanyaan untuk menyelesaikan kuis ini</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded-lg shadow-sm border border-red-200 mb-6" role="alert">
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
                <div class="bg-white/80 dark:bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-200 dark:border-gray-700/50 hover:border-blue-500/30 transition-all duration-300" id="question-{{ $index }}">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $index + 1 }}. {{ $question->question }}</h3>
                        <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-600/20 flex items-center justify-center border border-blue-200 dark:border-blue-500/30">
                            <i class="fas fa-question text-blue-500 dark:text-blue-200"></i>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-center p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/30 transition-colors cursor-pointer group">
                            <input type="radio" name="q{{ $question->id }}" value="a" class="form-radio text-blue-600 bg-white border-gray-300 focus:ring-blue-500" required data-question="{{ $index }}">
                            <span class="ml-3 text-gray-800 dark:text-gray-200 group-hover:text-gray-900 transition-colors">{{ $question->option_a }}</span>
                        </label>
                        <label class="flex items-center p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/30 transition-colors cursor-pointer group">
                            <input type="radio" name="q{{ $question->id }}" value="b" class="form-radio text-blue-600 bg-white border-gray-300 focus:ring-blue-500" data-question="{{ $index }}">
                            <span class="ml-3 text-gray-800 dark:text-gray-200 group-hover:text-gray-900 transition-colors">{{ $question->option_b }}</span>
                        </label>
                        <label class="flex items-center p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/30 transition-colors cursor-pointer group">
                            <input type="radio" name="q{{ $question->id }}" value="c" class="form-radio text-blue-600 bg-white border-gray-300 focus:ring-blue-500" data-question="{{ $index }}">
                            <span class="ml-3 text-gray-800 dark:text-gray-200 group-hover:text-gray-900 transition-colors">{{ $question->option_c }}</span>
                        </label>
                        <label class="flex items-center p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700/30 transition-colors cursor-pointer group">
                            <input type="radio" name="q{{ $question->id }}" value="d" class="form-radio text-blue-600 bg-white border-gray-300 focus:ring-blue-500" data-question="{{ $index }}">
                            <span class="ml-3 text-gray-800 dark:text-gray-200 group-hover:text-gray-900 transition-colors">{{ $question->option_d }}</span>
                        </label>
                    </div>
                </div>
            @endforeach

            <div class="flex flex-col sm:flex-row sm:justify-between items-stretch sm:items-center gap-3 pt-6">
                <a href="{{ route('materials.index') }}" class="inline-flex items-center w-full sm:w-auto justify-center text-gray-600 hover:text-blue-500 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Materi
                </a>
                <button type="submit" class="inline-flex items-center w-full sm:w-auto justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors border border-transparent">
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
    // theme controlled globally via layouts/app.blade.php (Alpine + localStorage). Removed forced dark-theme.
    
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