@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-white">Hasil Simulasi</h1>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-400">Selesai:</span>
                    <span class="text-sm text-gray-300">{{ $result->completed_at->diffForHumans() }}</span>
                </div>
            </div>
            <p class="text-gray-400 mt-2">{{ $result->simulation->title }}</p>
        </div>

        <!-- Score Section -->
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700/50 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-white">Nilai Akhir</h3>
                    <p class="text-gray-400 mt-1">Berdasarkan jawaban Anda</p>
                </div>
                <div class="text-4xl font-bold {{ $result->score >= 70 ? 'text-green-400' : 'text-red-400' }}">
                    {{ $result->score }}%
                </div>
            </div>
        </div>

        <!-- Feedback Section -->
        <div class="space-y-6">
            <h3 class="text-xl font-semibold text-white">Umpan Balik</h3>
            
            @foreach(json_decode($result->feedback) as $index => $feedback)
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border {{ $feedback->is_correct ? 'border-green-500/30' : 'border-red-500/30' }}">
                    <div class="flex items-start justify-between mb-4">
                        <h4 class="text-lg font-medium text-white">Langkah {{ $index + 1 }}</h4>
                        <div class="w-8 h-8 rounded-lg {{ $feedback->is_correct ? 'bg-green-600/20' : 'bg-red-600/20' }} flex items-center justify-center border {{ $feedback->is_correct ? 'border-green-500/30' : 'border-red-500/30' }}">
                            <i class="fas {{ $feedback->is_correct ? 'fa-check' : 'fa-times' }} {{ $feedback->is_correct ? 'text-green-400' : 'text-red-400' }}"></i>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <p class="text-gray-300">{{ $feedback->step }}</p>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-400">Jawaban Anda:</p>
                                <p class="text-gray-300">{{ $feedback->user_answer }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Jawaban Benar:</p>
                                <p class="text-gray-300">{{ $feedback->correct_answer }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between mt-8">
            <a href="{{ route('simulations.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-700 text-base font-medium rounded-lg text-gray-300 bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar
            </a>
            <a href="{{ route('simulations.start', $result->simulation) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <i class="fas fa-redo mr-2"></i>
                Coba Lagi
            </a>
        </div>
    </div>
</div>
@endsection 