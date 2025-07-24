@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Sertifikat Saya</h1>
        <p class="text-gray-400">Daftar sertifikat yang telah Anda peroleh setelah menyelesaikan modul dan kuis.</p>
    </div>

    @if($certificates->isEmpty())
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg p-8 text-center border border-gray-700/50">
            <div class="w-16 h-16 bg-gray-700/30 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-certificate text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-xl font-medium text-white mb-2">Belum Ada Sertifikat</h3>
            <p class="text-gray-400 mb-4">Anda belum memiliki sertifikat. Selesaikan modul dan kuis untuk mendapatkan sertifikat.</p>
            <a href="{{ route('materials.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition-colors border border-blue-500/30">
                <i class="fas fa-book mr-2"></i>
                Mulai Belajar
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($certificates as $certificate)
                <div class="group bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-lg border border-gray-700/50 hover:border-blue-500/50 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 rounded-lg bg-blue-600/20 backdrop-blur-sm flex items-center justify-center border border-blue-500/30 mr-4">
                                        <i class="fas fa-certificate text-blue-400 text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-white group-hover:text-blue-400 transition-colors">{{ $certificate->title }}</h3>
                                </div>
                                <div class="space-y-2">
                                    <p class="text-gray-400">
                                        <span class="font-medium">Nomor Sertifikat:</span><br>
                                        {{ $certificate->certificate_number }}
                                    </p>
                                    <p class="text-gray-400">
                                        <span class="font-medium">Skor:</span><br>
                                        {{ $certificate->score }}%
                                    </p>
                                    <p class="text-gray-400">
                                        <span class="font-medium">Tanggal Terbit:</span><br>
                                        {{ $certificate->issued_at->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <a href="{{ route('certificates.show', $certificate) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition-colors border border-blue-500/30">
                                <i class="fas fa-eye mr-2"></i>
                                Lihat
                            </a>
                            <a href="{{ route('certificates.download', $certificate) }}" 
                               class="inline-flex items-center px-4 py-2 bg-green-600/20 text-green-400 rounded-lg hover:bg-green-600/30 transition-colors border border-green-500/30">
                                <i class="fas fa-download mr-2"></i>
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 