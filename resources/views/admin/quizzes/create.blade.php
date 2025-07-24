@extends('layouts.app')

@section('content')
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
                            <h2 class="text-2xl font-bold text-white">Tambah Kuis Baru</h2>
                            <p class="mt-1 text-gray-400">Buat kuis pembelajaran baru</p>
                        </div>
                        <a href="{{ route('admin.quizzes.index') }}" class="group relative inline-flex items-center">
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
                    <form action="{{ route('admin.quizzes.store') }}" method="POST" class="space-y-6" id="quizForm">
                    @csrf

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300">Judul Kuis</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan judul kuis" required>
                            </div>
                            @error('title')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Module -->
                        <div>
                            <label for="module_id" class="block text-sm font-medium text-gray-300">Modul</label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <select name="module_id" id="module_id" class="block w-full pl-10 pr-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Pilih Modul</option>
                            @foreach($modules as $module)
                                <option value="{{ $module->id }}" {{ old('module_id') == $module->id ? 'selected' : '' }}>
                                    {{ $module->title }}
                                </option>
                            @endforeach
                        </select>
                            </div>
                        @error('module_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Status</label>
                            <div class="mt-2 space-y-4">
                                <div class="flex items-center">
                                    <input type="radio" name="is_published" id="draft" value="0" {{ old('is_published', '0') == '0' ? 'checked' : '' }} class="h-4 w-4 text-blue-500 border-gray-700 focus:ring-blue-500 bg-[#1A2333]/50" required>
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

                        <!-- Questions Section -->
                        <div class="space-y-6" id="questions-container">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-white">Pertanyaan Kuis</h3>
                                <button type="button" onclick="addQuestion()" class="group relative inline-flex items-center">
                                    <div class="absolute -inset-1 opacity-0 group-hover:opacity-30 blur-lg filter bg-gradient-to-r from-green-600 to-green-500 transition-opacity duration-200"></div>
                                    <span class="relative inline-flex items-center px-4 py-2 bg-[#1A2333]/50 text-green-500 border border-green-500/20 rounded-lg hover:bg-[#1A2333]/70 transition-colors duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                        Tambah Pertanyaan
                                    </span>
                                </button>
                            </div>
                                </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="group relative inline-flex items-center">
                                <div class="absolute -inset-1 opacity-0 group-hover:opacity-30 blur-lg filter bg-gradient-to-r from-blue-600 to-blue-500 transition-opacity duration-200"></div>
                                <span class="relative inline-flex items-center px-6 py-2 bg-[#1A2333]/50 text-blue-500 border border-blue-500/20 rounded-lg hover:bg-[#1A2333]/70 transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Kuis
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
        let questionIndex = 0;

        const questionTemplate = `
            <div class="question-item relative bg-[#1A2333]/50 rounded-lg border border-gray-700 p-6 mb-6">
                <button type="button" onclick="removeQuestion(this)" class="absolute top-4 right-4 text-red-500 hover:text-red-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Question Text -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Pertanyaan</label>
                    <input type="text" name="questions[INDEX][question]" class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan pertanyaan" required>
                                </div>

                <!-- Options -->
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-gray-300">Pilihan Jawaban</label>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div class="flex items-center">
                                <input type="radio" name="questions[INDEX][correct_answer]" value="a" class="h-4 w-4 text-blue-500 border-gray-700 focus:ring-blue-500 bg-[#1A2333]/50" required>
                                <input type="text" name="questions[INDEX][option_a]" class="ml-2 flex-1 px-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Opsi A" required>
                            </div>
                        </div>
                                <div>
                            <div class="flex items-center">
                                <input type="radio" name="questions[INDEX][correct_answer]" value="b" class="h-4 w-4 text-blue-500 border-gray-700 focus:ring-blue-500 bg-[#1A2333]/50">
                                <input type="text" name="questions[INDEX][option_b]" class="ml-2 flex-1 px-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Opsi B" required>
                            </div>
                                </div>
                        <div>
                            <div class="flex items-center">
                                <input type="radio" name="questions[INDEX][correct_answer]" value="c" class="h-4 w-4 text-blue-500 border-gray-700 focus:ring-blue-500 bg-[#1A2333]/50">
                                <input type="text" name="questions[INDEX][option_c]" class="ml-2 flex-1 px-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Opsi C" required>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center">
                                <input type="radio" name="questions[INDEX][correct_answer]" value="d" class="h-4 w-4 text-blue-500 border-gray-700 focus:ring-blue-500 bg-[#1A2333]/50">
                                <input type="text" name="questions[INDEX][option_d]" class="ml-2 flex-1 px-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Opsi D" required>
                            </div>
                        </div>
                    </div>
            </div>

                <!-- Explanation -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Penjelasan Jawaban</label>
                    <textarea name="questions[INDEX][explanation]" rows="2" class="w-full px-3 py-2 border border-gray-700 rounded-lg bg-[#1A2333]/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan penjelasan jawaban yang benar"></textarea>
        </div>
    </div>
        `;

        function addQuestion() {
            const container = document.getElementById('questions-container');
            const newQuestion = document.createElement('div');
            newQuestion.innerHTML = questionTemplate.replace(/INDEX/g, questionIndex);
            container.appendChild(newQuestion);
            questionIndex++;
        }

        function removeQuestion(button) {
            const questionItem = button.closest('.question-item');
            const questions = document.querySelectorAll('.question-item');
            
            if (questions.length > 1) {
                if (confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')) {
                    questionItem.remove();
                }
            } else {
                alert('Kuis harus memiliki minimal 1 pertanyaan!');
            }
        }

        // Form validation before submit
        document.getElementById('quizForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const title = document.getElementById('title').value.trim();
            const moduleId = document.getElementById('module_id').value;
            const questions = document.querySelectorAll('.question-item');

            // Validate title
            if (!title) {
                alert('Judul kuis harus diisi!');
                return;
            }

            // Validate module selection
            if (!moduleId) {
                alert('Modul harus dipilih!');
                return;
            }

            // Validate questions
            if (questions.length === 0) {
                alert('Kuis harus memiliki minimal 1 pertanyaan!');
                return;
            }

            // Check if each question has all required fields filled
            let isValid = true;
            questions.forEach((question, index) => {
                const questionText = question.querySelector('input[name^="questions"][name$="[question]"]').value.trim();
                const optionA = question.querySelector('input[name$="[option_a]"]').value.trim();
                const optionB = question.querySelector('input[name$="[option_b]"]').value.trim();
                const optionC = question.querySelector('input[name$="[option_c]"]').value.trim();
                const optionD = question.querySelector('input[name$="[option_d]"]').value.trim();
                const correctAnswer = question.querySelector('input[name$="[correct_answer]"]:checked');

                if (!questionText || !optionA || !optionB || !optionC || !optionD) {
                    alert(`Pertanyaan #${index + 1}: Semua field harus diisi!`);
                    isValid = false;
                    return;
                }

                if (!correctAnswer) {
                    alert(`Pertanyaan #${index + 1}: Pilih jawaban yang benar!`);
                    isValid = false;
                    return;
                }
            });

            if (isValid) {
                this.submit(); // Submit the form if all validations pass
            }
        });

        // Add first question by default
        document.addEventListener('DOMContentLoaded', function() {
            addQuestion();
        });
    </script>
    @endpush
</x-admin>
@endsection 