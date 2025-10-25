@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 text-gray-900 dark:bg-gradient-to-br dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $survey->title }}</h1>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Pertanyaan:</span>
                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ count($survey->questions) }}</span>
                </div>
            </div>
            <p class="text-gray-700 dark:text-gray-300 mt-2">{{ $survey->description }}</p>
            <p class="text-gray-700 dark:text-gray-300 mt-1">Tujuan: {{ $survey->purpose }}</p>
        </div>

        @if($hasResponded)
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-sm border border-yellow-200 mb-6" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>Anda sudah mengisi survei ini sebelumnya.</span>
                </div>
            </div>
        @else
            <form method="POST" action="{{ route('surveys.submit', $survey) }}" class="space-y-6">
                @csrf

                @foreach($survey->questions as $index => $question)
                    <div class="bg-white/80 dark:bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-200 dark:border-gray-700/50 hover:border-blue-500/30 transition-all duration-300">
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Pertanyaan {{ $index + 1 }}</h3>
                            <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-600/20 flex items-center justify-center border border-blue-200 dark:border-blue-500/30">
                                <i class="fas fa-question text-blue-500 dark:text-blue-200"></i>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <p class="text-gray-700 dark:text-gray-300">{{ $question }}</p>

                            <div class="space-y-2">
                                @foreach($survey->options as $option)
                                    <label class="flex items-center space-x-3 p-3 rounded-lg border border-gray-200 dark:border-gray-700/50 hover:border-blue-500/30 transition-colors cursor-pointer">
                                        <input type="radio" name="answers[{{ $index }}]" value="{{ $option['value'] }}" class="form-radio text-blue-500" required>
                                        <span class="text-gray-700 dark:text-gray-300">{{ $option['text'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="bg-white/80 dark:bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-200 dark:border-gray-700/50">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Feedback Tambahan</h3>
                    <textarea name="feedback" rows="4" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-900 placeholder-gray-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-200 dark:bg-gray-700/50 dark:border-gray-600 dark:text-gray-200" placeholder="Berikan feedback tambahan (opsional)"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Survei
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection 