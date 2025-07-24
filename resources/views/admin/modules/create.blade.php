@extends('layouts.app')

@section('content')
<x-admin>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="relative mb-8">
                <div class="absolute -inset-1">
                    <div class="w-full h-full mx-auto opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
                </div>
                <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-white">Tambah Modul Baru</h2>
                            <p class="mt-1 text-gray-400">Buat modul pembelajaran baru</p>
                        </div>
                        <a href="{{ route('admin.modules.index') }}" class="group relative inline-flex items-center">
                            <div class="absolute -inset-1 opacity-0 group-hover:opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <span class="relative inline-flex items-center px-4 py-2 bg-[#1A2333]/50 text-blue-500 border border-blue-500/20 rounded-lg hover:bg-[#1A2333]/70 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="relative">
                <div class="absolute -inset-1">
                    <div class="w-full h-full mx-auto opacity-20 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
                </div>
                <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 p-6">
                    <form action="{{ route('admin.modules.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300">Judul Modul</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan judul modul">
                            </div>
                            @error('title')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-300">Deskripsi</label>
                            <div class="mt-1">
                                <textarea name="description" id="description" rows="4" class="block w-full border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan deskripsi modul">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-300">Konten</label>
                            <div class="mt-1">
                                <textarea name="content" id="content" rows="6" class="block w-full border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan konten modul">{{ old('content') }}</textarea>
                            </div>
                            @error('content')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- YouTube URL -->
                        <div>
                            <label for="youtube_url" class="block text-sm font-medium text-gray-300">URL YouTube</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan URL video YouTube">
                            </div>
                            @error('youtube_url')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Status</label>
                            <div class="mt-2 space-y-4">
                                <div class="flex items-center">
                                    <input type="radio" name="is_published" id="draft" value="0" {{ old('is_published') == '0' ? 'checked' : '' }} class="h-4 w-4 text-blue-500 border-gray-700 focus:ring-blue-500 bg-[#1A2333]/50">
                                    <label for="draft" class="ml-3 block text-sm font-medium text-gray-300">
                                        Draft
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="is_published" id="published" value="1" {{ old('is_published') == '1' ? 'checked' : '' }} class="h-4 w-4 text-blue-500 border-gray-700 focus:ring-blue-500 bg-[#1A2333]/50">
                                    <label for="published" class="ml-3 block text-sm font-medium text-gray-300">
                                        Publikasikan
                                    </label>
                                </div>
                            </div>
                            @error('is_published')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="group relative inline-flex items-center">
                                <div class="absolute -inset-1 opacity-0 group-hover:opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                                <span class="relative inline-flex items-center px-6 py-2 bg-[#1A2333]/50 text-blue-500 border border-blue-500/20 rounded-lg hover:bg-[#1A2333]/70 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Modul
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>

@push('scripts')
<script>
    // Add visual feedback when form is submitted
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menyimpan...
        `;
    });

    // Add auto-expanding textarea
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        // Trigger on load
        textarea.dispatchEvent(new Event('input'));
    });

    // Function to extract YouTube video ID
    function getYouTubeVideoId(url) {
        if (!url) return null;
        
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
        const match = url.match(regExp);
        
        return (match && match[2].length === 11) ? match[2] : null;
    }

    // Function to update video preview
    function updateVideoPreview(url) {
        const videoId = getYouTubeVideoId(url);
        const previewDiv = document.getElementById('video-preview');
        const embedIframe = document.getElementById('youtube-embed');
        
        if (videoId) {
            embedIframe.src = `https://www.youtube.com/embed/${videoId}`;
            previewDiv.classList.remove('hidden');
        } else {
            previewDiv.classList.add('hidden');
            embedIframe.src = '';
        }
    }

    // Initialize video preview if URL exists
    const youtubeUrl = document.getElementById('youtube_url').value;
    if (youtubeUrl) {
        updateVideoPreview(youtubeUrl);
    }
</script>
@endpush
@endsection 