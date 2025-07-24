@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-gray-900">
    <!-- Main Content -->
    <div class="flex-1 overflow-auto bg-gradient-to-br from-gray-900 to-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Topic Card -->
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-lg overflow-hidden border border-gray-700/50 mb-8">
                <div class="p-6 border-b border-gray-700/50">
                    <div class="flex items-center justify-between">
            <div>
                            <h1 class="text-2xl font-bold text-white mb-2">{{ $topic->title }}</h1>
                            <div class="flex flex-wrap gap-4 text-sm text-gray-400">
                                <span class="flex items-center">
                                    <i class="fas fa-user-shield mr-1.5 text-blue-400"></i>
                        {{ $topic->user->name }}
                    </span>
                                <span class="flex items-center">
                                    <i class="fas fa-clock mr-1.5 text-blue-400"></i>
                        {{ $topic->created_at->diffForHumans() }}
                    </span>
                                <span class="flex items-center">
                                    <i class="fas fa-comments mr-1.5 text-blue-400"></i>
                        {{ $topic->replies_count }} balasan
                    </span>
                                <span class="flex items-center">
                                    <i class="fas fa-eye mr-1.5 text-blue-400"></i>
                        {{ $topic->views }} dilihat
                    </span>
                </div>
            </div>
                        <a href="{{ route('forum.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700/50 hover:bg-gray-600/50 text-gray-200 font-medium rounded-md transition-all duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Forum
            </a>
    </div>
</div>

                <div class="p-6">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold">
                {{ strtoupper(substr($topic->user->name, 0, 1)) }}
            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-gray-200 space-y-4 leading-relaxed">
                    {!! nl2br(e($topic->content)) !!}
                            </div>
                </div>
            </div>
        </div>
    </div>

            <!-- Replies Section -->
    @if($replies->count() > 0)
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-lg overflow-hidden border border-gray-700/50 mb-8">
                    <div class="p-6 border-b border-gray-700/50">
                        <h3 class="text-xl font-bold text-white">Balasan ({{ $replies->count() }})</h3>
                    </div>
        
                    <div class="divide-y divide-gray-700/50">
            @foreach($replies as $reply)
                            <div class="p-6">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center space-x-4 text-sm text-gray-400">
                                                <span class="flex items-center">
                                                    <i class="fas fa-user-shield mr-1.5 text-blue-400"></i>
                                    {{ $reply->user->name }}
                                </span>
                                                <span class="flex items-center">
                                                    <i class="fas fa-clock mr-1.5 text-blue-400"></i>
                                    {{ $reply->created_at->diffForHumans() }}
                                </span>
                                            </div>
                                @if($reply->is_solution)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900/50 text-green-200 border border-green-700/50">
                                                    <i class="fas fa-check mr-1"></i>
                                        Solusi
                                    </span>
                                @endif
                            </div>
                                        <div class="text-gray-200 space-y-4 leading-relaxed">
                                {!! nl2br(e($reply->content)) !!}
                            </div>
                            @if(!$reply->is_solution && auth()->id() === $topic->user_id)
                                            <div class="mt-4">
                                                <form action="{{ route('forum.mark-solution', $reply) }}" method="POST" class="inline-block">
                                        @csrf
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-500 hover:to-green-600 text-white font-medium rounded-md transition-all duration-200 shadow-lg hover:shadow-green-500/25">
                                                        <i class="fas fa-check mr-2"></i>
                                                        Tandai sebagai Solusi
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
                    </div>
        </div>
    @endif

            <!-- Reply Form -->
    @if(!$topic->is_locked)
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-lg overflow-hidden border border-gray-700/50">
                    <div class="p-6 border-b border-gray-700/50">
                        <h3 class="text-xl font-bold text-white">Tambah Balasan</h3>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('forum.reply', $topic) }}" method="POST" class="space-y-6">
                @csrf
                            <div>
                <textarea 
                    name="content" 
                    rows="4" 
                                    class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-md text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    placeholder="Tulis balasan Anda di sini..."
                    required
                ></textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-medium rounded-md transition-all duration-200 shadow-lg hover:shadow-blue-500/25">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Kirim Balasan
                    </button>
                </div>
            </form>
                    </div>
        </div>
    @endif
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
    // Set dark theme by default for cybersecurity theme
    document.body.classList.add('dark-theme');
    localStorage.setItem('theme', 'dark');

    // Theme toggle buttons
    document.getElementById('light-theme').addEventListener('click', function() {
        document.body.classList.remove('dark-theme');
        localStorage.setItem('theme', 'light');
    });

    document.getElementById('dark-theme').addEventListener('click', function() {
        document.body.classList.add('dark-theme');
        localStorage.setItem('theme', 'dark');
    });
});
</script>
@endpush
@endsection 