@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('certificates.index') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Sertifikat
            </a>
        </div>

        <div class="bg-gray-800/50 backdrop-blur-sm rounded-lg shadow-lg border border-gray-700/50">
            <div class="p-8">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-blue-600/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4 border border-blue-500/30">
                        <i class="fas fa-certificate text-blue-400 text-3xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">Sertifikat Penyelesaian</h1>
                    <p class="text-gray-400">Diberikan kepada peserta yang telah menyelesaikan modul dan kuis dengan baik</p>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-white mb-2">Informasi Sertifikat</h3>
                            <div class="space-y-3">
                                <p class="text-gray-400">
                                    <span class="font-medium">Nomor Sertifikat:</span><br>
                                    {{ $certificate->certificate_number }}
                                </p>
                                <p class="text-gray-400">
                                    <span class="font-medium">Judul Modul:</span><br>
                                    {{ $certificate->title }}
                                </p>
                                <p class="text-gray-400">
                                    <span class="font-medium">Tanggal Terbit:</span><br>
                                    {{ $certificate->issued_at->locale('id')->isoFormat('D MMMM YYYY') }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-white mb-2">Informasi Peserta</h3>
                            <div class="space-y-3">
                                <p class="text-gray-400">
                                    <span class="font-medium">Nama:</span><br>
                                    {{ $certificate->user->name }}
                                </p>
                                <p class="text-gray-400">
                                    <span class="font-medium">Email:</span><br>
                                    {{ $certificate->user->email }}
                                </p>
                                <p class="text-gray-400">
                                    <span class="font-medium">Skor Akhir:</span><br>
                                    {{ $certificate->score }}%
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-700/50">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('certificates.download', $certificate) }}" 
                               class="inline-flex items-center px-6 py-3 bg-green-600/20 text-green-400 rounded-lg hover:bg-green-600/30 transition-colors border border-green-500/30">
                                <i class="fas fa-download mr-2"></i>
                                Download Sertifikat (PDF)
                            </a>
                            <button onclick="window.print()" 
                                    class="inline-flex items-center px-6 py-3 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition-colors border border-blue-500/30">
                                <i class="fas fa-print mr-2"></i>
                                Cetak Sertifikat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 