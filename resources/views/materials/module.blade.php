@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-gray-900">
    @if (session('success'))
    <div class="fixed top-4 right-4 z-50">
        <div class="bg-green-600/20 backdrop-blur-sm text-green-400 p-4 rounded-lg shadow-lg border border-green-500/30" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-gray-800 to-gray-900 dark:from-gray-900 dark:to-gray-950 shadow-lg h-screen sticky top-0 overflow-y-auto hidden md:block border-r border-gray-700/50">
            <div class="p-4 border-b border-gray-700/50">
                <h2 class="text-lg font-semibold text-white">Daftar Materi</h2>
            </div>
            <nav class="p-4">
                <!-- Module Title -->
                <div class="mb-2">
                    <a href="#" onclick="showModuleContent(event)" 
                       class="block w-full p-2 rounded-lg transition-colors bg-blue-600/20 text-blue-400 border border-blue-500/30">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-gray-700/30 flex items-center justify-center mr-3 border border-gray-600/30">
                                @if($module->isCompletedByUser())
                                    <i class="fas fa-check text-green-400"></i>
                                @else
                                    <i class="fas fa-book text-gray-400"></i>
                                @endif
                            </div>
                            <span>{{ $module->title }}</span>
                        </div>
                    </a>
                </div>

                <!-- Subtitles List -->
                @if($module->subtitles && $module->subtitles->count() > 0)
                    <ul class="space-y-1 ml-11">
                        @foreach($module->subtitles as $subtitle)
                            @if($subtitle->is_published)
                                <li>
                                    <a href="#subtitle-{{ $subtitle->id }}" 
                                       class="block py-1 px-3 text-sm rounded-lg transition-colors text-gray-300 hover:text-blue-400 hover:bg-gray-700/30">
                                        {{ $subtitle->title }}
                        </a>
                    </li>
                            @endif
                    @endforeach
                </ul>
                @endif
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 min-h-screen">
            <!-- Top Navigation -->
            <div class="bg-gray-800/50 backdrop-blur-sm shadow-lg sticky top-0 z-10 border-b border-gray-700/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center">
                            <button type="button" class="md:hidden p-2 rounded-md text-gray-400 hover:text-gray-300 hover:bg-gray-700/50 transition-colors">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="ml-2 md:ml-0">
                                <h1 class="text-xl font-semibold text-white">Menu</h1>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            @if(!$module->isCompletedByUser())
                                <form action="{{ route('materials.complete', $module) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600/20 text-green-400 rounded-lg hover:bg-green-600/30 transition-colors border border-green-500/30">
                                        <i class="fas fa-check mr-2"></i>
                                        Tandai Selesai
                                    </button>
                                </form>
                            @else
                                <span class="inline-flex items-center px-4 py-2 bg-green-600/20 text-green-400 rounded-lg border border-green-500/30">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Sudah Selesai
                                </span>
                            @endif

                            @if($module->has_quiz)
                                <a href="{{ route('quizzes.show', $module->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition-colors border border-blue-500/30">
                                    <i class="fas fa-tasks mr-2"></i>
                                    Mulai Kuis
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-lg border border-gray-700/50">
                    <div class="p-6">
                        <!-- Navigation Buttons -->
                        <div class="flex items-center justify-between mb-6">
                            @if($previousModule)
                                <a href="{{ route('materials.module', $previousModule) }}" class="inline-flex items-center px-4 py-2 bg-green-600/20 text-green-400 rounded-lg hover:bg-green-600/30 transition-colors border border-green-500/30">
                                    <i class="fas fa-chevron-left mr-2"></i>
                                    Previous
                                </a>
                            @else
                                <div></div>
                            @endif
                            @if($nextModule)
                                <a href="{{ route('materials.module', $nextModule) }}" class="inline-flex items-center px-4 py-2 bg-green-600/20 text-green-400 rounded-lg hover:bg-green-600/30 transition-colors border border-green-500/30">
                                    Next
                                    <i class="fas fa-chevron-right ml-2"></i>
                                </a>
                            @endif
                        </div>

                        <!-- Dynamic Content Area -->
                        <div id="main-content">
                            <!-- Module Content (shown by default) -->
                            <div id="module-content">
                                <h1 class="text-3xl font-bold text-white mb-4">{{ $module->title }}</h1>
                                @if($module->subtitle)
                                    <h2 class="text-xl text-gray-300 mb-6">{{ $module->subtitle }}</h2>
                                @endif
                                <div class="prose prose-invert max-w-none text-gray-300">
                                    {!! nl2br(e($module->description)) !!}
                                </div>
                                @if($module->content)
                                    <div class="mt-6 prose prose-invert max-w-none">
                                        {!! $module->content !!}
                                    </div>
                                @endif
                            </div>

                            <!-- Subtitles Content (hidden by default) -->
                            @if($module->subtitles && $module->subtitles->count() > 0)
                                @foreach($module->subtitles as $subtitle)
                                    @if($subtitle->is_published)
                                        <div id="subtitle-{{ $subtitle->id }}" class="subtitle-content hidden">
                                            <h1 class="text-3xl font-bold text-white mb-4">{{ $subtitle->title }}</h1>
                                            <div class="prose prose-invert max-w-none text-gray-300">
                                                {!! nl2br(e($subtitle->description)) !!}
                                            </div>
                                            @if($subtitle->youtube_url)
                                            <div class="mt-8">
                                                <h3 class="text-lg font-semibold text-white mb-4">Video Pembelajaran</h3>
                                                <div class="bg-gray-700/30 backdrop-blur-sm rounded-lg p-4 border border-gray-600/30">
                                                    <x-youtube-player :url="$subtitle->youtube_url" />
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>

                        @if($module->youtube_url)
                            <div class="mt-8" id="module-video">
                                <h3 class="text-lg font-semibold text-white mb-4">Video Pembelajaran</h3>
                                <div class="bg-gray-700/30 backdrop-blur-sm rounded-lg p-4 border border-gray-600/30">
                                    <x-youtube-player :url="$module->youtube_url" />
                                </div>
                            </div>
                        @endif
                    </div>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set dark theme by default
    document.body.classList.add('dark-theme');
    localStorage.setItem('theme', 'dark');

    // Mobile sidebar toggle
    const sidebarButton = document.querySelector('button[type="button"]');
    const sidebar = document.querySelector('.w-64');
    
    sidebarButton.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });

    // Handle subtitle navigation
    const moduleContent = document.getElementById('module-content');
    const moduleVideo = document.getElementById('module-video');
    const subtitleLinks = document.querySelectorAll('a[href^="#subtitle-"]');
    const subtitleContents = document.querySelectorAll('.subtitle-content');

    subtitleLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            
            // Hide module content and all subtitle contents
            moduleContent.classList.add('hidden');
            subtitleContents.forEach(content => {
                content.classList.add('hidden');
            });
            // Hide video
            if (moduleVideo) moduleVideo.classList.add('hidden');

            // Show only the clicked subtitle content
            const targetContent = document.getElementById(targetId);
            if (targetContent) {
                targetContent.classList.remove('hidden');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            // Update active state in sidebar
            subtitleLinks.forEach(link => {
                link.classList.remove('text-blue-400', 'bg-gray-700/30');
                link.classList.add('text-gray-300');
            });
            this.classList.remove('text-gray-300');
            this.classList.add('text-blue-400', 'bg-gray-700/30');
        });
    });
});

// Function to show module content
function showModuleContent(event) {
    event.preventDefault();
    const moduleContent = document.getElementById('module-content');
    const moduleVideo = document.getElementById('module-video');
    const subtitleLinks = document.querySelectorAll('a[href^="#subtitle-"]');
    // Hide all subtitle contents
    document.querySelectorAll('.subtitle-content').forEach(content => {
        content.classList.add('hidden');
    });
    // Show module content
    moduleContent.classList.remove('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });
    // Show video
    if (moduleVideo) moduleVideo.classList.remove('hidden');
    // Reset active states in sidebar
    subtitleLinks.forEach(link => {
        link.classList.remove('text-blue-400', 'bg-gray-700/30');
        link.classList.add('text-gray-300');
    });
}

// Time tracking code...
let startTime = Date.now();
let timeSpentInterval;
let isTracking = true;

function updateTimeSpent() {
    if (!isTracking) return;
    
    const currentTime = Date.now();
    const timeSpent = Math.floor((currentTime - startTime) / 1000);
    
    if (timeSpent % 60 === 0) {
        fetch('{{ route("materials.track-time", $module) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ time_spent: 60 })
        });
    }
}

timeSpentInterval = setInterval(updateTimeSpent, 1000);

document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
        isTracking = false;
        clearInterval(timeSpentInterval);
    } else {
        isTracking = true;
        startTime = Date.now();
        timeSpentInterval = setInterval(updateTimeSpent, 1000);
    }
});

window.addEventListener('beforeunload', function() {
    if (isTracking) {
        const finalTime = Math.floor((Date.now() - startTime) / 1000);
        navigator.sendBeacon(
            '{{ route("materials.track-time", $module) }}',
            JSON.stringify({
                time_spent: finalTime,
                _token: '{{ csrf_token() }}'
            })
        );
    }
});
</script>
@endpush 
@endsection 