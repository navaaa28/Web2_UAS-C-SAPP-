@extends('layouts.app')

@section('content')
<div class="flex min-h-0 bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-gray-900">
    <!-- Main Content -->
    <div class="flex-1 overflow-auto bg-gradient-to-br from-gray-900 to-gray-800 min-h-0">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-lg overflow-hidden border border-gray-700/50">
                <div class="p-6 border-b border-gray-700/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-white mb-2">{{ __('Buat Topik Baru') }}</h1>
                            <p class="text-gray-400">Mulai diskusi baru dengan komunitas</p>
                        </div>
                        <a href="{{ route('forum.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700/50 hover:bg-gray-600/50 text-gray-200 font-medium rounded-md transition-all duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Forum
                        </a>
    </div>
</div>

                <div class="p-6">
                    <form action="{{ route('forum.store') }}" method="POST" class="space-y-6">
            @csrf
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-200 mb-2">Judul Topik</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                                class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('title') border-red-500 @enderror" 
                    placeholder="Masukkan judul topik yang menarik..."
                    value="{{ old('title') }}"
                    required
                >
                @error('title')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-200 mb-2">Konten</label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="8" 
                                class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('content') border-red-500 @enderror"
                    placeholder="Jelaskan topik Anda secara detail..."
                    required
                >{{ old('content') }}</textarea>
                @error('content')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-4 border-t border-gray-700/50">
                            <button type="button" onclick="history.back()" class="inline-flex items-center w-full sm:w-auto justify-center px-4 py-2 bg-gray-700/50 hover:bg-gray-600/50 text-gray-200 font-medium rounded-md transition-all duration-200">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                </button>
                            <button type="submit" class="inline-flex items-center w-full sm:w-auto justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-medium rounded-md transition-all duration-200 shadow-lg hover:shadow-blue-500/25">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Buat Topik
                </button>
            </div>
        </form>
                </div>
            </div>
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
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
        // theme controlled globally via layouts/app.blade.php (Alpine + localStorage). Removed forced dark-theme.

    // Theme toggle buttons
    document.getElementById('light-theme')?.addEventListener('click', function() {
            // rely on global theme toggle instead of removing specific class
        localStorage.setItem('theme', 'light');
    });

    document.getElementById('dark-theme')?.addEventListener('click', function() {
            // local dark-theme toggle replaced by global toggle in header. No-op here.
        localStorage.setItem('theme', 'dark');
    });
});
</script>
@endpush
@endsection 