<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Survey;
use App\Models\User;
use Carbon\Carbon;

class SurveySeeder extends Seeder
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

        // Create Surveys
        $surveys = [
            [
                'title' => 'Evaluasi Kesadaran Keamanan Siber',
                'description' => 'Survei ini bertujuan untuk menilai tingkat kesadaran Anda terhadap keamanan siber',
                'purpose' => 'Mengidentifikasi area yang perlu ditingkatkan dalam kesadaran keamanan siber',
                'questions' => [
                    'Seberapa sering Anda mengubah kata sandi?',
                    'Apakah Anda menggunakan kata sandi yang berbeda untuk setiap akun?',
                    'Seberapa sering Anda memeriksa email mencurigakan?',
                    'Apakah Anda menggunakan autentikasi dua faktor?',
                    'Seberapa sering Anda memperbarui perangkat lunak?'
                ],
                'options' => [
                    ['value' => 'a', 'text' => 'Sangat Sering'],
                    ['value' => 'b', 'text' => 'Sering'],
                    ['value' => 'c', 'text' => 'Kadang-kadang'],
                    ['value' => 'd', 'text' => 'Jarang'],
                    ['value' => 'e', 'text' => 'Tidak Pernah']
                ],
                'is_published' => true,
                'is_anonymous' => false,
                'created_by' => $admin->id
            ],
            [
                'title' => 'Evaluasi Pelatihan Keamanan Siber',
                'description' => 'Survei ini bertujuan untuk menilai efektivitas pelatihan keamanan siber',
                'purpose' => 'Meningkatkan kualitas pelatihan keamanan siber',
                'questions' => [
                    'Seberapa bermanfaat materi pelatihan?',
                    'Seberapa jelas penjelasan materi?',
                    'Seberapa interaktif sesi pelatihan?',
                    'Seberapa relevan contoh kasus yang diberikan?',
                    'Seberapa baik fasilitator menjelaskan materi?'
                ],
                'options' => [
                    ['value' => 'a', 'text' => 'Sangat Baik'],
                    ['value' => 'b', 'text' => 'Baik'],
                    ['value' => 'c', 'text' => 'Cukup'],
                    ['value' => 'd', 'text' => 'Kurang'],
                    ['value' => 'e', 'text' => 'Sangat Kurang']
                ],
                'is_published' => true,
                'is_anonymous' => true,
                'created_by' => $admin->id
            ]
        ];

        foreach ($surveys as $surveyData) {
            Survey::create($surveyData);
        }
    }
} 