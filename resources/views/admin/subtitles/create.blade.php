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
                            <h2 class="text-2xl font-bold text-white">Tambah Sub Judul</h2>
                            <p class="mt-1 text-gray-400">Buat sub judul baru untuk modul {{ $module->title }}</p>
                        </div>
                        <a href="{{ route('admin.modules.subtitles.index', $module) }}" class="group relative inline-flex items-center">
                            <div class="absolute -inset-1 opacity-0 group-hover:opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                            <span class="relative inline-flex items-center px-4 py-2 bg-[#1A2333]/50 text-blue-500 border border-blue-500/20 rounded-lg hover:bg-[#1A2333]/70 transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="relative">
                <div class="absolute -inset-1">
                    <div class="w-full h-full mx-auto opacity-20 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500"></div>
                </div>
                <div class="relative bg-[#1A2333]/30 backdrop-blur-sm rounded-xl border border-gray-800 p-6">
                    <form action="{{ route('admin.modules.subtitles.store', $module) }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300">Judul</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan judul sub judul">
                            </div>
                            @error('title')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-300">Deskripsi</label>
                            <div class="mt-1">
                                <textarea name="description" id="description" rows="4" class="block w-full border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan deskripsi sub judul">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Order -->
                        <div>
                            <label for="order" class="block text-sm font-medium text-gray-300">Urutan</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </div>
                                <input type="number" name="order" id="order" value="{{ old('order') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan urutan sub judul">
                            </div>
                            @error('order')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Status</label>
                            <div class="mt-2 space-y-4">
                                <div class="flex items-center">
                                    <input type="radio" name="is_published" id="draft" value="0" {{ old('is_published') == '0' ? 'checked' : '' }} class="h-4 w-4 text-blue-500 border-gray-700 focus:ring-blue-500 bg-[#1A2333]/50">
                                    <label for="draft" class="ml-3 block text-sm font-medium text-gray-300">
                                        Draft
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="is_published" id="published" value="1" {{ old('is_published') == '1' ? 'checked' : '' }} class="h-4 w-4 text-blue-500 border-gray-700 focus:ring-blue-500 bg-[#1A2333]/50">
                                    <label for="published" class="ml-3 block text-sm font-medium text-gray-300">
                                        Publikasikan
                                    </label>
                                </div>
                            </div>
                            @error('is_published')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="group relative inline-flex items-center">
                                <div class="absolute -inset-1 opacity-0 group-hover:opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                                <span class="relative inline-flex items-center px-6 py-2 bg-[#1A2333]/50 text-blue-500 border border-blue-500/20 rounded-lg hover:bg-[#1A2333]/70 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Sub Judul
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Add auto-expanding textarea
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
            // Trigger on load
            textarea.dispatchEvent(new Event('input'));
        });
    </script>
    @endpush
</x-admin> 