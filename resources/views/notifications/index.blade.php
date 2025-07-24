@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-white">{{ __('Notifications') }}</h2>
                    <p class="text-sm text-gray-400">{{ __('Your recent notifications') }}</p>
                </div>
                @if($notifications->isNotEmpty())
                <form method="POST" action="{{ route('notifications.markAllAsRead') }}" class="flex">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="text-sm text-blue-400 hover:text-blue-300">
                        {{ __('Mark all as read') }}
                    </button>
                </form>
                @endif
            </div>

            @if($notifications->isEmpty())
                <div class="text-center py-8">
                    <div class="text-gray-400">
                        <i class="fas fa-bell-slash text-4xl mb-4"></i>
                        <p class="text-lg">{{ __('No notifications yet') }}</p>
                        <p class="text-sm text-gray-500">{{ __('When you get notifications, they will appear here') }}</p>
                    </div>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($notifications as $notification)
                        <div class="flex items-start gap-4 p-4 {{ $notification->read ? 'bg-gray-800/30' : 'bg-gray-800/50' }} backdrop-blur-sm border {{ $notification->read ? 'border-gray-700/30' : 'border-gray-700/50' }} rounded-lg">
                            <div class="flex-shrink-0">
                                @if($notification->type === 'materials')
                                    <i class="fas fa-book text-blue-400"></i>
                                @elseif($notification->type === 'quizzes')
                                    <i class="fas fa-question-circle text-green-400"></i>
                                @else
                                    <i class="fas fa-bell text-yellow-400"></i>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <p class="text-white">{{ $notification->message }}</p>
                                <p class="text-sm text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                            @if(!$notification->read)
                                <div class="flex-shrink-0">
                                    <form method="POST" action="{{ route('notifications.markAsRead', $notification) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-sm text-blue-400 hover:text-blue-300">
                                            {{ __('Mark as read') }}
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 