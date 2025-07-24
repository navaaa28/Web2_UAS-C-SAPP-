<footer class="bg-[#0B1120] border-t border-blue-800/40 text-gray-300 relative z-10">
    <div class="max-w-7xl mx-auto py-16 px-6 lg:px-20">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            
            <!-- About -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-bold text-blue-400 mb-4">Tentang <span class="text-white">C-SAPP</span></h3>
                <p class="text-gray-400 mb-4 leading-relaxed">
                    C-SAPP adalah aplikasi web buatan Kelompok 5 untuk menyelesaikan Ujian Akhir Semester Pemrograman Web 2. Kami berharap aplikasi ini bermanfaat sebagai sumber belajar keamanan siber.
                </p>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="p-2 bg-blue-600/10 hover:bg-blue-600/30 rounded-full transition">
                        <i class="fab fa-twitter text-xl text-blue-400"></i>
                    </a>
                    <a href="#" class="p-2 bg-blue-600/10 hover:bg-blue-600/30 rounded-full transition">
                        <i class="fab fa-linkedin text-xl text-blue-400"></i>
                    </a>
                    <a href="#" class="p-2 bg-blue-600/10 hover:bg-blue-600/30 rounded-full transition">
                        <i class="fab fa-github text-xl text-blue-400"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold text-blue-400 mb-4">Navigasi Cepat</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="hover:text-blue-400 transition">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('materials.index') }}" class="hover:text-blue-400 transition">Training Materials</a>
                    </li>
                    <li>
                        <a href="{{ route('forum.index') }}" class="hover:text-blue-400 transition">Community Forum</a>
                    </li>
                    <li>
                        <a href="{{ route('reports') }}" class="hover:text-blue-400 transition">Laporan</a>
                    </li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-lg font-bold text-blue-400 mb-4">Kontak Kita</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-blue-400"></i>
                        <span>supportkita@gmail.com</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone text-blue-400"></i>
                        <span>+62 812-3456-7890</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-map-marker-alt text-blue-400"></i>
                        <span>Bandung, Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-12 pt-8 border-t border-blue-800/30 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} <span class="text-blue-400 font-semibold">C-SAPP</span>. Ini Copyright WM slurr.
            </p>
            <div class="flex space-x-4 mt-4 md:mt-0 text-sm">
                <a href="#" class="hover:text-blue-400 transition">Privacy Policy</a>
                <a href="#" class="hover:text-blue-400 transition">Terms of Service</a>
                <a href="#" class="hover:text-blue-400 transition">Security Guidelines</a>
            </div>
        </div>
    </div>
</footer>
