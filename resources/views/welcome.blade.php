@extends('layouts.app')


@section('fullwidth')
<div class="min-h-screen font-sans bg-gray-100 text-gray-900 dark:bg-[#0A0F1C] dark:text-white">
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-white text-gray-900 dark:bg-gradient-to-br dark:from-[#0f172a] dark:via-[#1e293b] dark:to-[#0f172a] py-28">
    <!-- Decorative blobs: hidden on small screens to avoid overflow -->
    <div class="hidden sm:block absolute -top-12 -left-6 sm:-left-24 w-40 h-40 sm:w-[420px] sm:h-[420px] bg-blue-500 opacity-18 rounded-full blur-3xl" aria-hidden="true"></div>
    <div class="hidden sm:block absolute -bottom-12 -right-6 sm:-right-24 w-40 h-40 sm:w-[420px] sm:h-[420px] bg-purple-700 opacity-18 rounded-full blur-3xl" aria-hidden="true"></div>
    <div class="absolute inset-x-0 -bottom-6 h-16 bg-gradient-to-t from-white/70 to-transparent dark:from-[#0B1120]/80 dark:to-transparent pointer-events-none" aria-hidden="true"></div>
    <div class="container mx-auto px-6 lg:px-16 relative z-10 flex flex-col-reverse lg:flex-row items-center justify-between gap-12">
        <!-- Text Section -->
        <div class="lg:w-1/2" data-aos="fade-up">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight tracking-tight text-gray-900 dark:text-white">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-teal-400">
                    Belajar Cyber Security
                </span><br>
                Bersama Kami
            </h1>
            <p class="mt-6 text-lg text-gray-700 leading-relaxed dark:text-gray-300">
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
                    alt="Cyber Security Training" class="w-full h-56 md:h-96 lg:h-[500px] object-cover rounded-xl">
                <div class="absolute inset-0 bg-transparent dark:bg-gradient-to-r dark:from-blue-900 dark:to-purple-900 dark:opacity-20 mix-blend-multiply"></div>
            </div>
        </div>
    </div>
</section>


    <!-- What You Learn Section -->
    <section class="py-24 bg-white dark:bg-gradient-to-b dark:from-[#0E1527] dark:to-[#0B1120] relative overflow-hidden">
    <!-- Efek latar blur -->
    <div class="hidden sm:block absolute -top-16 -left-12 sm:-left-28 w-36 h-36 sm:w-[360px] sm:h-[360px] bg-blue-400 opacity-14 rounded-full blur-3xl" aria-hidden="true"></div>
    <div class="hidden sm:block absolute -bottom-16 -right-12 sm:-right-28 w-36 h-36 sm:w-[360px] sm:h-[360px] bg-purple-500 opacity-14 rounded-full blur-3xl" aria-hidden="true"></div>
    <div class="absolute inset-x-0 -bottom-6 h-16 bg-gradient-to-t from-white/80 to-transparent dark:from-[#0E1527]/80 dark:to-transparent pointer-events-none"></div>

    <div class="container mx-auto px-6 lg:px-20 text-center relative z-10" data-aos="fade-up">
    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 via-teal-400 to-blue-400">
                Apa yang Akan Kamu Pelajari?
            </span>
        </h2>
        <p class="mt-4 text-lg text-gray-700 dark:text-gray-300 max-w-2xl mx-auto leading-relaxed">
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
                <div class="p-6 bg-white dark:bg-[#121C2D] rounded-2xl border border-blue-200 dark:border-blue-800 shadow-md hover:shadow-blue-500/30 transition duration-300 hover:scale-[1.02]" data-aos="zoom-in">
                    <h3 class="text-xl font-bold mb-3 text-blue-400">{{ $item['title'] }}</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>


    <!-- Testimonial Section -->
    <section class="py-24 bg-white dark:bg-gradient-to-b dark:from-[#0B1120] dark:to-[#0E1527] relative overflow-hidden">
    <!-- Efek latar blur -->
    <div class="hidden sm:block absolute -top-20 -left-12 sm:-left-28 w-32 h-32 sm:w-[340px] sm:h-[340px] bg-blue-600 opacity-12 rounded-full blur-3xl" aria-hidden="true"></div>
    <div class="hidden sm:block absolute -bottom-20 -right-12 sm:-right-28 w-32 h-32 sm:w-[340px] sm:h-[340px] bg-teal-400 opacity-12 rounded-full blur-3xl" aria-hidden="true"></div>
    <div class="absolute inset-x-0 -bottom-6 h-16 bg-gradient-to-t from-white/85 to-transparent dark:from-[#0B1120]/85 dark:to-transparent pointer-events-none"></div>

    <div class="container mx-auto px-6 lg:px-20 relative z-10 text-center" data-aos="fade-up">
    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-teal-400">
                Apa Kata Kita?
            </span>
        </h2>
        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-12">
            Pengalaman dari Para Mahasiswa Donatur Kampus nihh!!.
        </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-left items-stretch">
            @foreach([
                [
                    'name' => 'Bruce Schneier',
                    'text' => 'Security is not a product, but a process.',
                    'job' => 'Security Technologist & Author',
                    'photo' => 'storage/images/testimonials/bruce.jpg'
                ],
                [
                    'name' => 'Katie Moussouris',
                    'text' => 'Coordinated vulnerability disclosure and well-run bug bounty programs help organizations find and fix real-world risks.',
                    'job' => 'Vulnerability Disclosure Expert',
                    'photo' => 'storage/images/testimonials/katie.jpg'
                ],
                [
                    'name' => 'Mikko Hyppönen',
                    'text' => 'Timely patching and visibility into threats are among the most effective defenses against large-scale malware outbreaks.',
                    'job' => 'Chief Research Officer, WithSecure',
                    'photo' => 'storage/images/testimonials/mikko.jpg'
                ],
                [
                    'name' => 'Tanya Janca',
                    'text' => 'Shift security left: integrate secure coding and threat modelling early in the development lifecycle.',
                    'job' => 'Founder, We Hack Purple',
                    'photo' => 'storage/images/testimonials/tanya.jpg'
                ],
            ] as $review)
                <div class="bg-white dark:bg-[#0F1724] p-6 rounded-2xl border border-blue-100 dark:border-blue-800 shadow-md hover:shadow-lg transition duration-300 hover:scale-[1.01] flex flex-col justify-between" data-aos="zoom-in">
                    <p class="text-gray-500 dark:text-gray-300 italic mb-6 leading-relaxed grow">
                        “{{ $review['text'] }}”
                    </p>
                    <div class="flex items-center mt-6">
                        <div class="h-12 w-12 rounded-full overflow-hidden flex-shrink-0 bg-blue-600 text-white font-semibold flex items-center justify-center relative">
                            <img 
                                src="{{ asset($review['photo']) }}" 
                                alt="{{ $review['name'] }}" 
                                class="w-full h-full object-cover"
                                onerror="this.style.display='none'; this.parentElement.querySelector('.initials').style.display='flex';"
                            >
                            <div class="initials absolute inset-0 hidden items-center justify-center text-white text-sm font-semibold">
                                {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($review['name'], 0, 2)) }}
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-900 dark:text-white font-semibold text-sm">{{ $review['name'] }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $review['job'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

</div>
@endsection
