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
                            <h2 class="text-2xl font-bold text-white">Daftar Modul</h2>
                            <p class="mt-1 text-gray-400">Kelola semua modul pembelajaran</p>
                        </div>
                        <a href="{{ route('admin.modules.create') }}" class="group relative inline-flex items-center">
                            <div class="absolute -inset-1 opacity-0 group-hover:opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <span class="relative inline-flex items-center px-4 py-2 bg-[#1A2333]/50 text-blue-500 border border-blue-500/20 rounded-lg hover:bg-[#1A2333]/70 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            Tambah Modul
                            </span>
                        </a>
                    </div>
                </div>
                    </div>

            <!-- Table Section -->
            <div class="relative">
                <div class="absolute -inset-1">
                    <div class="w-full h-full mx-auto opacity-20 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
                </div>
                <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-800">
                            <thead class="bg-[#1A2333]/50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Judul</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Deskripsi</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                                @foreach($modules as $module)
                                <tr class="hover:bg-[#1A2333]/50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-white">{{ $module->title }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-300">{{ Str::limit($module->description, 100) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($module->is_published)
                                            <div class="relative inline-flex">
                                                <div class="absolute -inset-1">
                                                    <div class="w-full h-full mx-auto opacity-30 blur-lg filter bg-gradient-to-r from-green-600 to-green-500"></div>
                                                </div>
                                                <span class="relative px-3 py-1 text-xs font-medium rounded-lg bg-green-500/10 text-green-400 border border-green-500/20">
                                                    Dipublikasi
                                                </span>
                                            </div>
                                        @else
                                            <div class="relative inline-flex">
                                                <div class="absolute -inset-1">
                                                    <div class="w-full h-full mx-auto opacity-30 blur-lg filter bg-gradient-to-r from-yellow-600 to-yellow-500"></div>
                                                </div>
                                                <span class="relative px-3 py-1 text-xs font-medium rounded-lg bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">
                                                    Draft
                                        </span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                        <div x-data="{ open: false }" @click.away="open = false" class="relative inline-block text-left">
                                            <button @click="open = !open" type="button" class="group relative inline-flex items-center">
                                                <div class="absolute -inset-1 opacity-0 group-hover:opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                                                <span class="relative text-blue-500 hover:text-blue-400 transition-colors duration-200">
                                                    Aksi
                                                    <svg class="inline-block w-4 h-4 ml-1 transition-transform duration-200 transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </span>
                                            </button>
                                            <div x-show="open" 
                                                 x-transition:enter="transition ease-out duration-100"
                                                 x-transition:enter-start="transform opacity-0 scale-95"
                                                 x-transition:enter-end="transform opacity-100 scale-100"
                                                 x-transition:leave="transition ease-in duration-75"
                                                 x-transition:leave-start="transform opacity-100 scale-100"
                                                 x-transition:leave-end="transform opacity-0 scale-95"
                                                 class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-[#1A2333] ring-1 ring-black ring-opacity-5 z-50"
                                                 style="display: none;">
                                                <div class="py-1" role="menu" aria-orientation="vertical">
                                                    <a href="{{ route('admin.modules.edit', $module->id) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1A2333]/50 hover:text-white" role="menuitem">
                                                        Edit Modul
                                                    </a>
                                                    <a href="{{ route('admin.modules.subtitles.index', $module) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1A2333]/50 hover:text-white" role="menuitem">
                                                        Kelola Sub Judul
                                                    </a>
                                                    <a href="{{ route('admin.modules.subtitles.create', $module) }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#1A2333]/50 hover:text-white" role="menuitem">
                                                        Tambah Sub Judul
                                                    </a>
                                                    <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" class="block">
                                            @csrf
                                            @method('DELETE')
                                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-[#1A2333]/50 hover:text-red-400" role="menuitem" onclick="return confirm('Apakah Anda yakin ingin menghapus modul ini?')">
                                                            Hapus Modul
                                                        </button>
                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-gray-800">
                        {{ $modules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin> 

@push('scripts')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush

@push('styles')
<style>
    /* Ensure dropdown is visible above other elements */
    [id^="module-dropdown-"] {
        z-index: 50;
    }
    
    /* Add transition for smooth appearance */
    [id^="module-dropdown-"] {
        transition: opacity 0.2s ease-in-out;
    }
    
    /* Ensure dropdown is properly positioned */
    .relative.inline-block {
        position: relative;
    }
</style>
@endpush 