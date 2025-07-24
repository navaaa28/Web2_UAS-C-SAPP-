<x-admin>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Tambah Survei Baru</h1>
                        <p class="mt-2 text-gray-400">Buat survei keamanan siber baru</p>
                    </div>
                    <a href="{{ route('admin.surveys.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg border border-gray-700/50 overflow-hidden">
                <form action="{{ route('admin.surveys.store') }}" method="POST" class="p-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300">Judul Survei</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500" value="{{ old('title') }}" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-300">Deskripsi</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Purpose -->
                        <div>
                            <label for="purpose" class="block text-sm font-medium text-gray-300">Tujuan Survei</label>
                            <textarea name="purpose" id="purpose" rows="2" class="mt-1 block w-full rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500">{{ old('purpose') }}</textarea>
                            @error('purpose')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Questions -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Pertanyaan Survei</label>
                            <div id="questions-container" class="space-y-4">
                                <div class="flex items-center gap-4">
                                    <input type="text" name="questions[]" class="flex-1 rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan pertanyaan" required>
                                    <button type="button" class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700" onclick="addQuestion()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            @error('questions')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Options -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Opsi Jawaban</label>
                            <div id="options-container" class="space-y-4">
                                <div class="flex items-center gap-4">
                                    <input type="text" name="options[0][value]" class="w-24 rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Nilai" required>
                                    <input type="text" name="options[0][text]" class="flex-1 rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Teks Opsi" required>
                                    <button type="button" class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700" onclick="addOption()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            @error('options')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="flex space-x-6">
                            <!-- Published Status -->
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="rounded bg-gray-700/50 border-gray-600 text-blue-500 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-300">Publikasikan survei ini</span>
                                </label>
                            </div>

                            <!-- Anonymous Status -->
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : '' }} class="rounded bg-gray-700/50 border-gray-600 text-blue-500 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-300">Survei anonim</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Survei
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let questionCount = 1;
        let optionCount = 1;

        function addQuestion() {
            const container = document.getElementById('questions-container');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-4';
            div.innerHTML = `
                <input type="text" name="questions[]" class="flex-1 rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan pertanyaan" required>
                <button type="button" class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700" onclick="this.parentElement.remove()">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(div);
            questionCount++;
        }

        function addOption() {
            const container = document.getElementById('options-container');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-4';
            div.innerHTML = `
                <input type="text" name="options[${optionCount}][value]" class="w-24 rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Nilai" required>
                <input type="text" name="options[${optionCount}][text]" class="flex-1 rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Teks Opsi" required>
                <button type="button" class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700" onclick="this.parentElement.remove()">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(div);
            optionCount++;
        }
    </script>
    @endpush
</x-admin> 