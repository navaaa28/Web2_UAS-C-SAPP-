<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Two Factor Authentication') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add additional security to your account using two factor authentication.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        <div class="space-y-4">
            <!-- Enable/Disable 2FA -->
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Two Factor Authentication Status') }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        @if(auth()->user()->google2fa_enabled)
                            {{ __('2FA is currently enabled for your account.') }}
                        @else
                            {{ __('2FA is currently disabled for your account.') }}
                        @endif
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    @if(auth()->user()->google2fa_enabled)
                        <button 
                            type="button"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-2fa-disable')"
                            class="text-sm text-red-600 dark:text-red-400 hover:text-red-500 font-medium">
                            {{ __('Disable 2FA') }}
                        </button>
                    @else
                        <a href="{{ route('2fa.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 font-medium">
                            {{ __('Enable 2FA') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Authentication App -->
            <div class="rounded-lg bg-gray-50 dark:bg-gray-700 p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Authentication App') }}
                        </h3>
                        <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            <p>
                                {{ __('Use an authentication app like Google Authenticator, Microsoft Authenticator, or Authy to get two factor authentication codes.') }}
                            </p>
                        </div>
                        @if(!auth()->user()->google2fa_enabled)
                            <div class="mt-4">
                                <a href="{{ route('2fa.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 font-medium">
                                    {{ __('Set up Authentication App') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if (session('status') === '2fa-enabled')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 dark:text-green-400"
            >{{ __('2FA has been enabled successfully.') }}</p>
        @endif

        @if (session('status') === '2fa-disabled')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 dark:text-green-400"
            >{{ __('2FA has been disabled successfully.') }}</p>
        @endif
    </div>

    <!-- Disable 2FA Confirmation Modal -->
    <x-modal name="confirm-2fa-disable" :show="$errors->disable2FA->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('2fa.disable') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to disable two factor authentication?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Please enter your password to confirm you would like to disable two factor authentication.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->disable2FA->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Disable 2FA') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section> 