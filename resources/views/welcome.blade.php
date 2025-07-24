@extends('layouts.app')


@section('content')
<div class="min-h-screen bg-[#0A0F1C] text-white font-sans">
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-[#0f172a] via-[#1e293b] to-[#0f172a] py-28 text-white">
    <div class="absolute -top-20 -left-40 w-[600px] h-[600px] bg-blue-500 opacity-30 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute -bottom-20 -right-40 w-[600px] h-[600px] bg-purple-700 opacity-30 rounded-full blur-3xl animate-pulse"></div>
    <div class="container mx-auto px-6 lg:px-16 relative z-10 flex flex-col-reverse lg:flex-row items-center justify-between gap-12">
        <!-- Text Section -->
        <div class="lg:w-1/2" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight tracking-tight text-white">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-teal-400">
                    Belajar Cyber Security
                </span><br>
                Bersama Kami
            </h1>
            <p class="mt-6 text-lg text-gray-300 leading-relaxed">
                Belajar Lebih mudah Cepat dan Tepat dengan Web buatan kita.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center gap-4">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
                     Join Slurr
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <a href="{{ route('register') }}"
                    class="inline-flex items-center gap-2 text-sm text-blue-400 hover:underline mt-2 sm:mt-0">
                    Pelajari Lebih Lanjut disini Slurr
                </a>
            </div>
        </div>

        <!-- Image Section -->
        <div class="lg:w-1/2 relative" data-aos="fade-left">
            <div class="relative rounded-xl overflow-hidden shadow-xl ring-1 ring-blue-900/10">
                <img src="storage/images/hack.jpeg"
                    alt="Cyber Security Training" class="w-full h-[400px] lg:h-[500px] object-cover rounded-xl">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-purple-900 opacity-20 mix-blend-multiply"></div>
            </div>
        </div>
    </div>
</section>


    <!-- What You Learn Section -->
    <section class="py-24 bg-gradient-to-b from-[#0E1527] to-[#0B1120] relative overflow-hidden">
    <!-- Efek latar blur -->
    <div class="absolute -top-20 -left-40 w-[500px] h-[500px] bg-blue-500 opacity-20 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute -bottom-20 -right-40 w-[500px] h-[500px] bg-purple-600 opacity-20 rounded-full blur-3xl animate-pulse"></div>

    <div class="container mx-auto px-6 lg:px-20 text-center relative z-10" data-aos="fade-up">
        <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-teal-400 to-blue-400">
                Apa yang Akan Kamu Pelajari?
            </span>
        </h2>
        <p class="mt-4 text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed">
            Kami menyusun materi pelatihan dari dasar hingga lanjutan agar kamu siap menghadapi dunia nyata dalam keamanan siber.
        </p>

        <!-- Grid Box Materi -->
        <div class="mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
            @foreach([
                ['title' => 'Dasar Keamanan Siber', 'desc' => 'Pahami konsep dasar, prinsip keamanan, jenis serangan, dan pencegahannya.'],
                ['title' => 'Jaringan & Protokol', 'desc' => 'Pelajari TCP/IP, model OSI, sniffing, spoofing, dan pemindaian port.'],
                ['title' => 'Penetration Testing', 'desc' => 'Praktek langsung melakukan pengujian kerentanan dengan tools nyata.'],
                ['title' => 'Keamanan Aplikasi Web', 'desc' => 'Exploitasi XSS, SQLi, CSRF dan bagaimana mengamankan aplikasi.'],
                ['title' => 'Linux & Forensik', 'desc' => 'Menggunakan sistem Linux untuk digital forensic dan log analysis.'],
                ['title' => 'Persiapan Sertifikasi', 'desc' => 'Bersiap menghadapi ujian sertifikasi seperti CEH, CompTIA Security+.']
            ] as $item)
                <div class="p-6 bg-[#121C2D] rounded-2xl border border-blue-800 shadow-md hover:shadow-blue-500/30 transition duration-300 hover:scale-[1.02]" data-aos="zoom-in">
                    <h3 class="text-xl font-bold mb-3 text-blue-400">{{ $item['title'] }}</h3>
                    <p class="text-gray-300">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>


    <!-- Testimonial Section -->
    <section class="py-24 bg-gradient-to-b from-[#0B1120] to-[#0E1527] relative overflow-hidden">
    <!-- Efek latar blur -->
    <div class="absolute -top-24 -left-32 w-[400px] h-[400px] bg-blue-700 opacity-20 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute -bottom-24 -right-32 w-[400px] h-[400px] bg-teal-500 opacity-20 rounded-full blur-3xl animate-pulse"></div>

    <div class="container mx-auto px-6 lg:px-20 relative z-10 text-center" data-aos="fade-up">
        <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-400 via-blue-400 to-purple-400">
                Apa Kata Kita?
            </span>
        </h2>
        <p class="text-gray-400 max-w-2xl mx-auto mb-12">
            Pengalaman dari Para Mahasiswa Donatur Kampus nihh!!.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
            @foreach([
                [
                    'name' => 'ir.Dany J.S.Kom.M A,SC', 
                    'text' => 'Dany Anjay Mabar, Propesional, Eebeeewww.', 
                    'job' => 'Author',
                    'photo' => 'storage/images/dany.jpg'
                ],
                [
                    'name' => 'Dimas J', 
                    'text' => 'Yang Sudah Boleh Pulang.', 
                    'job' => 'Animator',
                    'photo' => 'images/testimonials/dimas.jpg'
                ],
                [
                    'name' => 'Rival J', 
                    'text' => 'Hidup Seperti Ade.', 
                    'job' => 'Aligator',
                    'photo' => 'images/testimonials/rival.jpg'
                ],
                [
                    'name' => 'GinGin J', 
                    'text' => 'Belajar Tidak Perlu, Uang Nomor Satu.', 
                    'job' => 'Afiliator',
                    'photo' => 'images/testimonials/gingin.jpg'
                ],
            ] as $review)
                <div class="bg-[#121C2D] p-6 rounded-2xl border border-blue-800 shadow-xl hover:shadow-blue-500/30 transition duration-300 hover:scale-[1.02]" data-aos="zoom-in">
                    <p class="text-gray-300 italic mb-4 leading-relaxed">
                        “{{ $review['text'] }}”
                    </p>
                    <div class="flex items-center mt-6">
                        <div class="h-12 w-12 rounded-full overflow-hidden flex-shrink-0 bg-blue-600 text-white font-semibold flex items-center justify-center">
                            <img 
                                src="{{ asset($review['photo']) }}" 
                                alt="{{ $review['name'] }}" 
                                class="w-full h-full object-cover"
                                onerror="this.style.display='none'; this.parentElement.innerText='{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($review['name'], 0, 2)) }}';"
                            >
                        </div>
                        <div class="ml-4">
                            <p class="text-white font-semibold text-sm">{{ $review['name'] }}</p>
                            <p class="text-xs text-gray-400">{{ $review['job'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

</div>
    </div>
    </div>

    </div>
@endsection
