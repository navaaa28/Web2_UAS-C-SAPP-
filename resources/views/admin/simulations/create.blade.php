<x-admin>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Tambah Simulasi Baru</h1>
                        <p class="mt-2 text-gray-400">Buat simulasi keamanan siber baru</p>
                    </div>
                    <a href="{{ route('admin.simulations.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg border border-gray-700/50 overflow-hidden">
                <form action="{{ route('admin.simulations.store') }}" method="POST" class="p-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300">Judul Simulasi</label>
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

                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-300">Tipe Simulasi</label>
                            <select name="type" id="type" class="mt-1 block w-full rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500">
                                <option value="phishing" {{ old('type') == 'phishing' ? 'selected' : '' }}>Phishing</option>
                                <option value="malware" {{ old('type') == 'malware' ? 'selected' : '' }}>Malware</option>
                                <option value="password" {{ old('type') == 'password' ? 'selected' : '' }}>Password Security</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Steps -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Langkah-langkah Simulasi</label>
                            <div id="steps-container" class="space-y-4">
                                <div class="flex items-center gap-4">
                                    <input type="text" name="steps[]" class="flex-1 rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan langkah simulasi" required>
                                    <button type="button" class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700" onclick="addStep()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            @error('steps')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Correct Answers -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Jawaban Benar</label>
                            <div id="answers-container" class="space-y-4">
                                <div class="flex items-center gap-4">
                                    <input type="text" name="correct_answers[]" class="flex-1 rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan jawaban benar" required>
                                    <button type="button" class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700" onclick="addAnswer()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            @error('correct_answers')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Published Status -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="rounded bg-gray-700/50 border-gray-600 text-blue-500 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-300">Publikasikan simulasi ini</span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Simulasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function addStep() {
            const container = document.getElementById('steps-container');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-4';
            div.innerHTML = `
                <input type="text" name="steps[]" class="flex-1 rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan langkah simulasi" required>
                <button type="button" class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700" onclick="this.parentElement.remove()">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(div);
        }

        function addAnswer() {
            const container = document.getElementById('answers-container');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-4';
            div.innerHTML = `
                <input type="text" name="correct_answers[]" class="flex-1 rounded-md bg-gray-700/50 border border-gray-600 text-white focus:border-blue-500 focus:ring-blue-500" placeholder="Masukkan jawaban benar" required>
                <button type="button" class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700" onclick="this.parentElement.remove()">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(div);
        }
    </script>
    @endpush
</x-admin> 