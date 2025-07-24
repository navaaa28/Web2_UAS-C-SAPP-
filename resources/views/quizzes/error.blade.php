@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="text-center">
                <!-- Error Icon -->
                <div class="mb-8">
                    <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M24 4C12.95 4 4 12.95 4 24s8.95 20 20 20 20-8.95 20-20S35.05 4 24 4zm0 36c-8.84 0-16-7.16-16-16S15.16 8 24 8s16 7.16 16 16-7.16 16-16 16zm-1-28h2v12h-2zm0 16h2v2h-2z"></path>
                    </svg>
                </div>

                <!-- Error Message -->
                <h2 class="text-2xl font-bold text-gray-200 mb-4">
                    {{ $message }}
                </h2>

                <!-- Error Description -->
                <p class="text-gray-400 mb-8">
                    {{ $description }}
                </p>

                <!-- Action Button -->
                <a href="{{ $action_link }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ $action_text }}
                    <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>

                <!-- Back Link -->
                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-400 hover:text-gray-300">
                        Kembali ke Dashboard
                        <span aria-hidden="true"> &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 