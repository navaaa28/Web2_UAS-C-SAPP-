@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white">Survei Keamanan Siber</h1>
            <p class="mt-2 text-gray-400">Bantu kami meningkatkan kualitas pelatihan keamanan siber</p>
        </div>

        @if(session('success'))
            <div class="bg-green-600/20 backdrop-blur-sm text-green-400 p-4 rounded-lg shadow-lg border border-green-500/30 mb-6" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-600/20 backdrop-blur-sm text-red-400 p-4 rounded-lg shadow-lg border border-red-500/30 mb-6" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($surveys as $survey)
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700/50 hover:border-blue-500/30 transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-white">{{ $survey->title }}</h3>
                            <p class="text-gray-400 mt-1">{{ $survey->description }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-blue-600/20 flex items-center justify-center border border-blue-500/30">
                            <i class="fas fa-poll text-blue-400"></i>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-4">
                        <div class="flex items-center text-sm text-gray-400">
                            <i class="fas fa-list-ol mr-2 text-blue-400"></i>
                            <span>{{ count($survey->questions) }} Pertanyaan</span>
                        </div>
                        
                        @if(isset($userResponses[$survey->id]))
                            <div class="bg-gray-700/30 rounded-lg p-4 border border-gray-600/30">
                                <div class="flex items-center text-sm text-gray-400">
                                    <i class="fas fa-check-circle mr-2 text-green-400"></i>
                                    <span>Anda telah mengisi survei ini</span>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('surveys.show', $survey) }}" 
                               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-pencil-alt mr-2"></i>
                                Isi Survei
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 