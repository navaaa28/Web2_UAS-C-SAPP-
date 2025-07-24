@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-lg overflow-hidden border border-gray-700/50">

            {{-- Header --}}
            <div class="p-6 border-b border-gray-700/50">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h1 class="text-2xl font-bold text-white">Security Community</h1>
                    <a href="{{ route('forum.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-medium rounded-md transition-all duration-200 shadow-lg hover:shadow-blue-500/25">
                        <i class="fas fa-plus-circle mr-2"></i>
                        New Discussion
                    </a>
                </div>
            </div>

            {{-- Filters --}}
            <div class="p-6 border-b border-gray-700/50">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-600 rounded-md leading-5 bg-gray-700/50 text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Search secure topics...">
                    </div>
                    <select class="block w-full sm:w-48 pl-3 pr-10 py-2 text-base border border-gray-600 rounded-md leading-5 bg-gray-700/50 text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="recent">Latest Activity</option>
                        <option value="popular">Most Discussed</option>
                        <option value="solved">Resolved Issues</option>
                    </select>
                </div>
            </div>

            {{-- Content --}}
            @if($topics->isEmpty())
                <div class="p-12 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-900/30 mb-4">
                        <i class="fas fa-shield-alt text-3xl text-blue-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-200 mb-2">No security discussions yet</h3>
                    <p class="text-gray-400 mb-6">Start the first discussion and help build our security community</p>
                    <a href="{{ route('forum.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-medium rounded-md transition-all duration-200 shadow-lg hover:shadow-blue-500/25">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Create First Discussion
                    </a>
                </div>
            @else
                <div class="divide-y divide-gray-700/50">
                    @foreach($topics as $topic)
                        <div class="p-6 hover:bg-gray-700/30 transition-colors">
                            <div class="flex">
                                {{-- Votes UI (dummy) --}}
                                <div class="flex-shrink-0 mr-4">
                                    <div class="flex flex-col items-center">
                                        <button class="text-gray-400 hover:text-blue-400 transition-colors">
                                            <i class="fas fa-chevron-up text-lg"></i>
                                        </button>
                                        <span class="text-sm font-medium text-gray-300">{{ random_int(0, 99) }}</span>
                                        <button class="text-gray-400 hover:text-blue-400 transition-colors">
                                            <i class="fas fa-chevron-down text-lg"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- Topic Info --}}
                                <div class="flex-1">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">
                                        <a href="{{ route('forum.show', $topic) }}" class="text-lg font-medium text-gray-200 hover:text-blue-400 transition-colors">
                                            {{ $topic->title }}
                                        </a>
                                        <div class="flex flex-wrap gap-2">
                                            @if($topic->is_pinned)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-900/50 text-red-200 border border-red-700/50">
                                                    <i class="fas fa-thumbtack mr-1"></i> Critical
                                                </span>
                                            @endif
                                            @if($topic->is_locked)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-900/50 text-yellow-200 border border-yellow-700/50">
                                                    <i class="fas fa-lock mr-1"></i> Restricted
                                                </span>
                                            @endif
                                            @if($topic->replies->where('is_solution', true)->count() > 0)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-900/50 text-green-200 border border-green-700/50">
                                                    <i class="fas fa-check-circle mr-1"></i> Resolved
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Meta --}}
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
                                            {{ $topic->replies_count }} replies
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-eye mr-1.5 text-blue-400"></i>
                                            {{ $topic->views }} views
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 border-t border-gray-700/50">
                    {{ $topics->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.body.classList.add('dark-theme');
    localStorage.setItem('theme', 'dark');
});
</script>
@endpush
@endsection
