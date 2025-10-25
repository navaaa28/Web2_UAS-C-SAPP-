<!-- Header Component -->
@if(View::hasSection('fullwidth'))
<header class="sticky top-0 z-50 bg-transparent border-transparent">
@else
<header class="sticky top-0 z-50 border-b" :class="{ 'bg-gray-800/50 border-gray-700/50': darkMode, 'bg-white/50 border-gray-200/50': !darkMode }">
@endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-12 sm:h-16">
            <!-- Logo and Brand -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <img src="{{ asset('storage/images/LOGO.png') }}" alt="C-SAPP Logo" class="h-6 sm:h-8 w-auto mr-3">
                    <span class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">C-SAPP</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium
                        {{ request()->routeIs('dashboard') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('materials.index') }}" class="px-3 py-2 rounded-md text-sm font-medium
                        {{ request()->routeIs('materials*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                        <i class="fas fa-book-open mr-2"></i>Materi
                    </a>
                    <a href="{{ route('quizzes') }}" class="px-3 py-2 rounded-md text-sm font-medium
                        {{ request()->routeIs('quizzes*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                        <i class="fas fa-tasks mr-2"></i>Kuis
                    </a>
                    <a href="{{ route('forum.index') }}" class="px-3 py-2 rounded-md text-sm font-medium
                        {{ request()->routeIs('forum*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                        <i class="fas fa-comments mr-2"></i>Forum
                    </a>
                    <a href="{{ route('certificates.index') }}" class="px-3 py-2 rounded-md text-sm font-medium
                        {{ request()->routeIs('certificates*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                        <i class="fas fa-certificate mr-2"></i>Sertifikat
                    </a>
                    <a href="{{ route('reports') }}" class="px-3 py-2 rounded-md text-sm font-medium
                        {{ request()->routeIs('reports*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                        <i class="fas fa-bug mr-2"></i>Laporan
                    </a>
                    @if(Auth::check() && !Auth::user()->is_admin)
                    <a href="{{ route('simulations.index') }}" class="px-3 py-2 rounded-md text-sm font-medium
                        {{ request()->routeIs('simulations*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                        <i class="fas fa-shield-alt mr-2"></i>Simulasi
                    </a>
                    @endif
                @endauth
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Notifications -->
                    <div class="relative mr-4">
                        <a href="{{ route('notifications.index') }}" class="relative inline-flex items-center p-2 text-sm font-medium text-gray-300 rounded-full hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                            <span class="sr-only">View notifications</span>
                            <i class="fas fa-bell"></i>
                            @php
                                $unreadCount = auth()->user()->notifications()->where('read', false)->count();
                            @endphp
                            @if($unreadCount > 0)
                                <div class="absolute top-0 right-0 -mt-1 -mr-1 px-2 py-0.5 text-xs font-bold text-white bg-red-500 rounded-full">
                                    {{ $unreadCount }}
                                </div>
                            @endif
                        </a>
                    </div>

                    <!-- Theme Toggle -->
                    <button @click="darkMode = !darkMode" class="p-2 rounded-md" :class="{ 'text-gray-400 hover:text-white hover:bg-gray-700/30': darkMode, 'text-gray-500 hover:text-gray-900 hover:bg-gray-100': !darkMode }">
                        <i class="fas" :class="{ 'fa-sun text-yellow-500': !darkMode, 'fa-moon text-blue-400': darkMode }"></i>
                    </button>

                    <!-- User Menu -->
                    <div class="relative ml-3" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="hidden md:block text-left">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name ?? 'Agent' }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Security Agent</div>
                                </div>
                                <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400"></i>
                            </button>
                        </div>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800/95 border border-gray-200 dark:border-gray-700/50">
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white">
                                    <i class="fas fa-user mr-2"></i>Profile
                                </a>
                                <a href="{{ route('materials.index') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white">
                                    <i class="fas fa-book-reader mr-2"></i>Pembelajaran
                                </a>
                                <a href="{{ route('quizzes') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white">
                                    <i class="fas fa-tasks mr-2"></i>Kuis
                                </a>
                                <a href="{{ route('reports') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white">
                                    <i class="fas fa-bug mr-2"></i>Laporan
                                </a>
                                <div class="border-t border-gray-200 dark:border-gray-700/50 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}" data-logout>
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Login/Register Links -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 dark:bg-blue-600/20 dark:text-blue-400 dark:border dark:border-blue-500/30 dark:hover:bg-blue-600/30">
                            Register
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" aria-label="Open menu" class="mobile-menu-btn p-2 rounded-md w-10 h-10 inline-flex items-center justify-center text-gray-500 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700/30">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @auth
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium
                    {{ request()->routeIs('dashboard') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                <a href="{{ route('certificates.index') }}" class="block px-3 py-2 rounded-md text-base font-medium
                    {{ request()->routeIs('certificates*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                    <i class="fas fa-certificate mr-2"></i>Sertifikat
                </a>
                @if(Auth::check() && !Auth::user()->is_admin)
                <a href="{{ route('simulations.index') }}" class="block px-3 py-2 rounded-md text-base font-medium
                    {{ request()->routeIs('simulations*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                    <i class="fas fa-shield-alt mr-2"></i>Simulasi
                </a>
                @endif
                <a href="{{ route('materials.index') }}" class="block px-3 py-2 rounded-md text-base font-medium
                    {{ request()->routeIs('materials*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                    <i class="fas fa-book-open mr-2"></i>Materi
                </a>
                <a href="{{ route('quizzes') }}" class="block px-3 py-2 rounded-md text-base font-medium
                    {{ request()->routeIs('quizzes*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                    <i class="fas fa-tasks mr-2"></i>Kuis
                </a>
                <a href="{{ route('forum.index') }}" class="block px-3 py-2 rounded-md text-base font-medium
                    {{ request()->routeIs('forum*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                    <i class="fas fa-comments mr-2"></i>Forum
                </a>
                <a href="{{ route('reports') }}" class="block px-3 py-2 rounded-md text-base font-medium
                    {{ request()->routeIs('reports*') ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white' }}">
                    <i class="fas fa-bug mr-2"></i>Laporan
                </a>
            @endauth
        </div>

        @auth
            <!-- Mobile User Menu -->
            <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700/50">
                <div class="flex items-center px-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-900 dark:text-white">{{ auth()->user()->name ?? 'Agent' }}</div>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white">
                        <i class="fas fa-user mr-2"></i>Profile
                    </a>
                    <a href="{{ route('materials.index') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white">
                        <i class="fas fa-book-reader mr-2"></i>Pembelajaran
                    </a>
                    <a href="{{ route('quizzes') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white">
                        <i class="fas fa-tasks mr-2"></i>Kuis
                    </a>
                    <a href="{{ route('reports') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white">
                        <i class="fas fa-bug mr-2"></i>Laporan
                    </a>
                    <form method="POST" action="{{ route('logout') }}" data-logout>
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-base font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/30 dark:hover:text-white">
                            <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Mobile Login/Register Links -->
            <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700/50">
                <div class="space-y-1">
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-medium text-blue-600 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-600/20">
                        <i class="fas fa-user-plus mr-2"></i>Register
                    </a>
                </div>
            </div>
        @endauth
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuButton = document.querySelector('.mobile-menu-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
});
</script> 