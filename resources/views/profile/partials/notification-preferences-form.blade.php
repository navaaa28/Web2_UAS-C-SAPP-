<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Notification Preferences') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Manage how and when you receive notifications.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.notifications.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-4">
            <!-- Email Notifications -->
            <div>
                <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ __('Email Notifications') }}
                </h3>
                
                <div class="space-y-4">
                    <!-- Learning Progress -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="progress" name="notifications[progress]" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ auth()->user()->notificationPreference?->progress_updates ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3">
                            <label for="progress" class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('Learning Progress Updates') }}</label>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Receive weekly updates about your learning progress.') }}</p>
                        </div>
                    </div>

                    <!-- New Materials -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="materials" name="notifications[materials]" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ auth()->user()->notificationPreference?->new_materials ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3">
                            <label for="materials" class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('New Learning Materials') }}</label>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Get notified when new learning materials are available.') }}</p>
                        </div>
                    </div>

                    <!-- Quiz Reminders -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="quizzes" name="notifications[quizzes]" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ auth()->user()->notificationPreference?->quiz_reminders ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3">
                            <label for="quizzes" class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('Quiz Reminders') }}</label>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Receive reminders about upcoming and pending quizzes.') }}</p>
                        </div>
                    </div>

                    <!-- Security Alerts -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="security" name="notifications[security]" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ auth()->user()->notificationPreference?->security_alerts ? 'checked' : '' }}>
                        </div>
                        <div class="ml-3">
                            <label for="security" class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('Security Alerts') }}</label>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Get important security notifications about your account.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification Frequency -->
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-4">
                    {{ __('Notification Frequency') }}
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-center">
                        <input id="frequency-realtime" name="frequency" type="radio" value="realtime" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ auth()->user()->notificationPreference?->frequency === 'realtime' ? 'checked' : '' }}>
                        <label for="frequency-realtime" class="ml-3 block text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Real-time') }}
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input id="frequency-daily" name="frequency" type="radio" value="daily" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ !auth()->user()->notificationPreference || auth()->user()->notificationPreference?->frequency === 'daily' ? 'checked' : '' }}>
                        <label for="frequency-daily" class="ml-3 block text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Daily digest') }}
                        </label>
                    </div>
                    <div class="flex items-center">
                        <input id="frequency-weekly" name="frequency" type="radio" value="weekly" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" {{ auth()->user()->notificationPreference?->frequency === 'weekly' ? 'checked' : '' }}>
                        <label for="frequency-weekly" class="ml-3 block text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Weekly digest') }}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>

            @if (session('status') === 'notifications-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section> 