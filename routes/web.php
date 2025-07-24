<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\Admin\SubtitleController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\NotificationPreferenceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\Admin\SimulationController as AdminSimulationController;
use App\Http\Controllers\Admin\SurveyController as AdminSurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 2FA Routes - moved outside auth middleware
Route::get('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');
Route::post('/2fa/verify', [TwoFactorController::class, 'verifyCode'])->name('2fa.verify');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/module/{module}', [MaterialController::class, 'showModule'])->name('materials.module');
    Route::post('/materials/module/{module}/complete', [MaterialController::class, 'completeModule'])->name('materials.complete');
    Route::post('/materials/{module}/track-time', [MaterialController::class, 'trackTime'])->name('materials.track-time');
    
    // Quiz routes - fixed order
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes');
    Route::get('/quizzes/result', [QuizController::class, 'result'])->name('quizzes.result');
    Route::post('/quizzes/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
    
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Forum Routes
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{topic}', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/forum/{topic}/reply', [ForumController::class, 'reply'])->name('forum.reply');
    Route::post('/forum/replies/{reply}/mark-solution', [ForumController::class, 'markAsSolution'])->name('forum.mark-solution');

    // Certificate routes
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/{certificate}', [CertificateController::class, 'show'])->name('certificates.show');
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');

    // Other 2FA Routes
    Route::get('/2fa', [TwoFactorController::class, 'index'])->name('2fa.index');
    Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
    Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');

    // Notification Preferences
    Route::patch('/profile/notifications', [NotificationPreferenceController::class, 'update'])
        ->name('profile.notifications.update');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.markAsRead');
    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.markAllAsRead');

    // Simulation Routes
    Route::get('/simulations', [SimulationController::class, 'index'])->name('simulations.index');
    Route::get('/simulations/{simulation}', [SimulationController::class, 'show'])->name('simulations.show');
    Route::get('/simulations/{simulation}/start', [SimulationController::class, 'start'])->name('simulations.start');
    Route::post('/simulations/{simulation}/submit', [SimulationController::class, 'submit'])->name('simulations.submit');
    Route::get('/simulations/results/{result}', [SimulationController::class, 'result'])->name('simulations.result');

    // Survey Routes
    Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');
    Route::get('/surveys/{survey}', [SurveyController::class, 'show'])->name('surveys.show');
    Route::post('/surveys/{survey}/submit', [SurveyController::class, 'submit'])->name('surveys.submit');
    Route::get('/surveys/{survey}/results', [SurveyController::class, 'results'])->name('surveys.results');
});

// Custom middleware untuk user biasa (bukan admin)
Route::middleware(['auth', 'verified', 'user'])->group(function () {
    Route::get('/simulations', [SimulationController::class, 'index'])->name('simulations.index');
    Route::get('/simulations/{simulation}', [SimulationController::class, 'show'])->name('simulations.show');
    Route::get('/simulations/{simulation}/start', [SimulationController::class, 'start'])->name('simulations.start');
    Route::post('/simulations/{simulation}/submit', [SimulationController::class, 'submit'])->name('simulations.submit');
});

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/materials', [MaterialController::class, 'adminIndex'])->name('materials');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    
    // Module routes
    Route::resource('modules', ModuleController::class);
    Route::resource('modules.subtitles', SubtitleController::class);
    
    // Quiz routes
    Route::resource('quizzes', AdminQuizController::class);
    
    // Simulation routes
    Route::resource('simulations', AdminSimulationController::class);
    
    // Survey routes
    Route::resource('surveys', AdminSurveyController::class);
});

require __DIR__.'/auth.php';
