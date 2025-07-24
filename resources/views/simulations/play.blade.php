@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-white">{{ $simulation->title }}</h1>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-400">Langkah:</span>
                    <div class="flex space-x-1">
                        @foreach($simulation->steps as $index => $step)
                            <div id="step-indicator-{{ $index }}" class="w-6 h-6 rounded-full bg-gray-700/50 flex items-center justify-center text-xs text-gray-300 border border-gray-600/30">
                                {{ $index + 1 }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <p class="text-gray-400 mt-2">{{ $simulation->description }}</p>
        </div>

        <form method="POST" action="{{ route('simulations.submit', $simulation) }}" class="space-y-6">
            @csrf
            <input type="hidden" name="simulation_id" value="{{ $simulation->id }}">

            @foreach($simulation->steps as $index => $step)
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-6 border border-gray-700/50 hover:border-blue-500/30 transition-all duration-300" id="step-{{ $index }}">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-xl font-semibold text-white">Langkah {{ $index + 1 }}</h3>
                        <div class="w-8 h-8 rounded-lg bg-blue-600/20 flex items-center justify-center border border-blue-500/30">
                            <i class="fas fa-shield-alt text-blue-400"></i>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <p class="text-gray-300">{{ $step }}</p>

                        <div class="space-y-2">
                            @foreach($simulation->options[$index] as $optIdx => $option)
                            <label class="flex items-center space-x-3 p-3 rounded-lg border border-gray-700/50 hover:border-blue-500/30 transition-colors cursor-pointer">
                                <input type="radio" name="answers[{{ $index }}]" value="{{ $optIdx }}" class="form-radio text-blue-500" required>
                                <span class="text-gray-300">{{ $option }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <i class="fas fa-check mr-2"></i>
                    Selesai
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set dark theme by default for cybersecurity theme
    document.body.classList.add('dark-theme');
    localStorage.setItem('theme', 'dark');
    
    // Track answered steps
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    const stepIndicators = {};
    
    // Initialize step indicators
    @foreach($simulation->steps as $index => $step)
        stepIndicators[{{ $index }}] = document.getElementById('step-indicator-{{ $index }}');
    @endforeach
    
    // Update indicators when a step is answered
    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            const stepIndex = this.getAttribute('name').match(/\[(\d+)\]/)[1];
            if (stepIndicators[stepIndex]) {
                stepIndicators[stepIndex].classList.remove('bg-gray-700/50', 'text-gray-300');
                stepIndicators[stepIndex].classList.add('bg-green-600/20', 'text-green-400', 'border-green-500/30');
            }
        });
    });
    
    // Highlight current step when scrolling
    const stepElements = document.querySelectorAll('[id^="step-"]');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const stepId = entry.target.id;
                const stepIndex = stepId.split('-')[1];
                stepIndicators[stepIndex].classList.add('ring-2', 'ring-blue-500');
            } else {
                const stepId = entry.target.id;
                const stepIndex = stepId.split('-')[1];
                stepIndicators[stepIndex].classList.remove('ring-2', 'ring-blue-500');
            }
        });
    }, { threshold: 0.5 });
    
    stepElements.forEach(step => {
        observer.observe(step);
    });
});
</script>
@endpush
@endsection 