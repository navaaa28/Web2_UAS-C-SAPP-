<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\ModuleProgress;
use App\Models\QuizResult;
use App\Models\User;
use Carbon\Carbon;

class ModuleAndQuizSeeder extends Seeder
{
    public function run()
    {
        // Get or create admin user
        $admin = User::where('email', 'admin@example.com')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]);
        }

        // Create Modules
        $modules = [
            [
                'title' => 'Pengenalan Keamanan Siber',
                'description' => 'Memahami dasar-dasar keamanan siber dan pentingnya dalam dunia digital',
                'content' => 'Konten lengkap tentang pengenalan keamanan siber...',
                'order' => 1,
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Keamanan Jaringan Dasar',
                'description' => 'Mempelajari konsep dasar keamanan jaringan dan implementasinya',
                'content' => 'Konten lengkap tentang keamanan jaringan...',
                'order' => 2,
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Kriptografi Dasar',
                'description' => 'Pengenalan tentang kriptografi dan penggunaannya dalam keamanan data',
                'content' => 'Konten lengkap tentang kriptografi...',
                'order' => 3,
                'is_published' => true,
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Keamanan Aplikasi Web',
                'description' => 'Memahami kerentanan dan cara mengamankan aplikasi web',
                'content' => 'Konten lengkap tentang keamanan aplikasi web...',
                'order' => 4,
                'is_published' => true,
                'created_by' => $admin->id,
            ],
        ];

        $createdModules = [];
        foreach ($modules as $moduleData) {
            $createdModules[] = Module::create($moduleData);
        }

        // Create Quizzes
        $quizzes = [
            [
                'title' => 'Quiz Pengenalan Keamanan Siber',
                'module_id' => $createdModules[0]->id,
                'question' => 'Apa yang dimaksud dengan Keamanan Siber?',
                'option_a' => 'Melindungi data dari virus',
                'option_b' => 'Praktik melindungi sistem, jaringan, dan program dari ancaman digital',
                'option_c' => 'Menginstall antivirus',
                'option_d' => 'Membuat password yang kuat',
                'correct_answer' => 'b',
                'explanation' => 'Keamanan siber adalah praktik melindungi sistem, jaringan, dan program dari ancaman digital.',
            ],
            [
                'title' => 'Quiz Keamanan Jaringan',
                'module_id' => $createdModules[1]->id,
                'question' => 'Apa fungsi utama firewall?',
                'option_a' => 'Mempercepat koneksi internet',
                'option_b' => 'Memblokir semua koneksi',
                'option_c' => 'Memantau dan mengontrol lalu lintas jaringan',
                'option_d' => 'Mengenkripsi data',
                'correct_answer' => 'c',
                'explanation' => 'Firewall berfungsi untuk memantau dan mengontrol lalu lintas jaringan masuk dan keluar.',
            ],
            [
                'title' => 'Quiz Kriptografi',
                'module_id' => $createdModules[2]->id,
                'question' => 'Apa itu enkripsi?',
                'option_a' => 'Proses mengamankan data dengan mengubahnya menjadi kode',
                'option_b' => 'Proses menghapus data',
                'option_c' => 'Proses membackup data',
                'option_d' => 'Proses mentransfer data',
                'correct_answer' => 'a',
                'explanation' => 'Enkripsi adalah proses mengubah data menjadi format yang tidak dapat dibaca tanpa kunci dekripsi.',
            ],
            [
                'title' => 'Quiz Keamanan Web',
                'module_id' => $createdModules[3]->id,
                'question' => 'Apa itu SQL Injection?',
                'option_a' => 'Teknik optimasi database',
                'option_b' => 'Metode backup database',
                'option_c' => 'Serangan yang memanfaatkan celah keamanan di input SQL',
                'option_d' => 'Tool untuk manajemen database',
                'correct_answer' => 'c',
                'explanation' => 'SQL Injection adalah teknik serangan yang memanfaatkan celah keamanan pada input SQL untuk mengakses atau memanipulasi database.',
            ],
        ];

        foreach ($quizzes as $quizData) {
            Quiz::create($quizData);
        }

        // Create progress for current user
        $users = User::where('is_admin', false)->get();
        foreach ($users as $user) {
            // Module Progress
            ModuleProgress::create([
                'user_id' => $user->id,
                'module_id' => $createdModules[0]->id,
                'is_completed' => true,
                'completed_at' => Carbon::now()->subDays(5),
            ]);

            ModuleProgress::create([
                'user_id' => $user->id,
                'module_id' => $createdModules[1]->id,
                'is_completed' => true,
                'completed_at' => Carbon::now()->subDays(3),
            ]);

            // Quiz Results - hanya satu hasil per modul
            QuizResult::create([
                'user_id' => $user->id,
                'module_id' => $createdModules[0]->id,
                'score' => 90,
                'correct_answers' => 9,
                'total_questions' => 10,
                'completed_at' => Carbon::now()->subDays(1),
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ]);

            QuizResult::create([
                'user_id' => $user->id,
                'module_id' => $createdModules[1]->id,
                'score' => 85,
                'correct_answers' => 9,
                'total_questions' => 10,
                'completed_at' => Carbon::now()->subHours(1),
                'created_at' => Carbon::now()->subHours(1),
                'updated_at' => Carbon::now()->subHours(1),
            ]);
        }
    }
} 