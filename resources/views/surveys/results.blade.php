@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-white">Hasil Survei</h1>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-400">Total Responden:</span>
                    <span class="text-sm text-gray-300">{{ $responseCount }}</span>
                </div>
            </div>
            <p class="text-gray-400 mt-2">{{ $survey->title }}</p>
        </div>

        <!-- Statistics Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700/50">
                <h3 class="text-lg font-semibold text-white mb-2">Total Responden</h3>
                <p class="text-3xl font-bold text-blue-400">{{ $responseCount }}</p>
            </div>
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700/50">
                <h3 class="text-lg font-semibold text-white mb-2">Rata-rata Nilai</h3>
                <p class="text-3xl font-bold text-green-400">{{ number_format($averageResponse, 1) }}</p>
            </div>
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700/50">
                <h3 class="text-lg font-semibold text-white mb-2">Status</h3>
                <p class="text-3xl font-bold text-yellow-400">{{ $survey->is_published ? 'Aktif' : 'Nonaktif' }}</p>
            </div>
        </div>

        <!-- Distribution Section -->
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700/50 mb-8">
            <h3 class="text-xl font-semibold text-white mb-4">Distribusi Jawaban</h3>
            <div class="space-y-4">
                @foreach($responseDistribution as $distribution)
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-400">{{ $distribution->answers }}</span>
                            <span class="text-sm text-gray-400">{{ $distribution->count }} responden</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ($distribution->count / $responseCount) * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Responses Section -->
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700/50">
            <h3 class="text-xl font-semibold text-white mb-4">Daftar Responden</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-400 border-b border-gray-700">
                            <th class="pb-3">Responden</th>
                            <th class="pb-3">Tanggal</th>
                            <th class="pb-3">Jawaban</th>
                            <th class="pb-3">Feedback</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        @foreach($responses as $response)
                            <tr class="border-b border-gray-700/50">
                                <td class="py-3">
                                    {{ $response->user ? $response->user->name : 'Anonim' }}
                                </td>
                                <td class="py-3">
                                    {{ $response->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="py-3">
                                    <div class="space-y-1">
                                        @foreach($response->answers as $index => $answer)
                                            <div class="text-sm">
                                                <span class="text-gray-400">P{{ $index + 1 }}:</span>
                                                {{ $answer }}
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="py-3">
                                    {{ $response->feedback ?: '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 