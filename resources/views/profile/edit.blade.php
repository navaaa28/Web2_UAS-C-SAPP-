@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Page Header -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-user-shield text-blue-400 mr-3"></i>
                    Profile Settings
                </h2>
                <p class="text-gray-400 mt-2">Manage your account settings and security preferences</p>
            </div>

            <!-- Profile Information -->
            <div class="p-6 bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-lg bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mr-4">
                        <i class="fas fa-user text-blue-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Profile Information</h3>
                        <p class="text-sm text-gray-400">Update your account's profile information</p>
                    </div>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Update -->
            <div class="p-6 bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-lg bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mr-4">
                        <i class="fas fa-key text-blue-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Update Password</h3>
                        <p class="text-sm text-gray-400">Ensure your account is using a long, random password</p>
                    </div>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Two Factor Authentication -->
            <div class="p-6 bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-lg bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mr-4">
                        <i class="fas fa-shield-alt text-blue-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Two Factor Authentication</h3>
                        <p class="text-sm text-gray-400">Add additional security to your account</p>
                    </div>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.two-factor-auth-form')
                </div>
            </div>

            <!-- Notification Preferences -->
            <div class="p-6 bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-lg bg-blue-600/20 flex items-center justify-center border border-blue-500/30 mr-4">
                        <i class="fas fa-bell text-blue-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Notification Preferences</h3>
                        <p class="text-sm text-gray-400">Manage how you receive notifications</p>
                    </div>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.notification-preferences-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-6 bg-gray-800/50 backdrop-blur-sm border border-gray-700/50 rounded-xl shadow-lg">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-lg bg-red-600/20 flex items-center justify-center border border-red-500/30 mr-4">
                        <i class="fas fa-trash-alt text-red-400 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Delete Account</h3>
                        <p class="text-sm text-gray-400">Permanently delete your account and all data</p>
                    </div>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
