<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Simulation;
use App\Models\User;

class SimulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();
        if (!$admin) {
            $this->command->warn('No admin user found. Please run CreateAdminUserSeeder first.');
            return;
        }

        $simulations = [
            [
                'title' => 'Simulasi Phishing Email',
                'description' => 'Identifikasi email phishing dan hindari jebakan penipuan.',
                'scenario' => 'Anda menerima email dari bank yang meminta Anda mengklik link dan memasukkan data pribadi.',
                'steps' => [
                    [
                        'question' => 'Periksa alamat email pengirim.',
                        'options' => [
                            'noreply@bank.com',
                            'bank@gmail.com',
                            'admin@bank.com',
                            'support@bank.com'
                        ],
                        'correct_answer' => 1
                    ],
                    [
                        'question' => 'Analisa isi email dan cari tanda-tanda mencurigakan.',
                        'options' => [
                            'Ada permintaan data pribadi',
                            'Bahasa formal dan tanpa typo',
                            'Logo bank terlihat jelas',
                            'Email tidak mengandung link apapun'
                        ],
                        'correct_answer' => 0
                    ],
                    [
                        'question' => 'Putuskan apakah akan mengklik link atau melaporkan email tersebut.',
                        'options' => [
                            'Klik link dan isi data',
                            'Abaikan email',
                            'Laporkan email ke tim IT',
                            'Balas email untuk konfirmasi'
                        ],
                        'correct_answer' => 2
                    ],
                ],
                'type' => 'phishing',
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Simulasi Malware Attachment',
                'description' => 'Deteksi lampiran berbahaya pada email kerja.',
                'scenario' => 'Anda menerima email dengan lampiran invoice dari pengirim tidak dikenal.',
                'steps' => [
                    [
                        'question' => 'Periksa ekstensi file lampiran.',
                        'options' => [
                            '.pdf',
                            '.exe',
                            '.docx',
                            '.xlsx'
                        ],
                        'correct_answer' => 1
                    ],
                    [
                        'question' => 'Apa yang harus dilakukan sebelum membuka lampiran?',
                        'options' => [
                            'Langsung buka',
                            'Scan dengan antivirus',
                            'Kirim ke teman',
                            'Upload ke cloud'
                        ],
                        'correct_answer' => 1
                    ],
                    [
                        'question' => 'Bagaimana jika lampiran mencurigakan?',
                        'options' => [
                            'Hapus lampiran',
                            'Tetap buka',
                            'Forward ke semua kontak',
                            'Abaikan saja'
                        ],
                        'correct_answer' => 0
                    ],
                ],
                'type' => 'malware',
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Simulasi Keamanan Password',
                'description' => 'Uji kekuatan password dan praktik terbaik dalam membuat password.',
                'scenario' => 'Anda diminta membuat password baru untuk akun perusahaan.',
                'steps' => [
                    [
                        'question' => 'Berapa minimal panjang password yang aman?',
                        'options' => [
                            '6 karakter',
                            '8 karakter',
                            '12 karakter',
                            '16 karakter'
                        ],
                        'correct_answer' => 2
                    ],
                    [
                        'question' => 'Mana kombinasi password yang paling kuat?',
                        'options' => [
                            'password123',
                            'QwErTy!2024',
                            'namasaya2024',
                            '12345678'
                        ],
                        'correct_answer' => 1
                    ],
                    [
                        'question' => 'Apa yang TIDAK boleh digunakan dalam password?',
                        'options' => [
                            'Nama sendiri',
                            'Kombinasi huruf, angka, simbol',
                            'Kata acak',
                            'Karakter spesial'
                        ],
                        'correct_answer' => 0
                    ],
                ],
                'type' => 'password_security',
                'is_published' => true,
                'created_by' => $admin->id,
            ],
        ];

        foreach ($simulations as $sim) {
            $steps = $sim['steps'];
            $options = array_map(function($step) { return $step['options']; }, $steps);
            $correct_answers = array_map(function($step) { return $step['correct_answer']; }, $steps);
            $sim['steps'] = array_map(function($step) { return $step['question']; }, $steps);
            $sim['options'] = $options;
            $sim['correct_answers'] = $correct_answers;
            Simulation::create($sim);
        }
    }
} 