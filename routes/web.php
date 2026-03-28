<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SessionController as AdminSession;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Trainee\DashboardController as TraineeDashboard;
use App\Http\Controllers\Trainee\SessionViewController;
use App\Http\Controllers\Trainer\DashboardController as TrainerDashboard;
use App\Http\Controllers\Trainer\MaterialController;
use Illuminate\Support\Facades\Route;

// ─── Public Routes ─────────────────────────────────────────
Route::get('/reset-admin-password', function () {
    $user           = \App\Models\User::find(1);
    $user->password = bcrypt('Admin1234!');
    $user->save();
    return 'Password in DB: ' . $user->fresh()->password;
});

Route::get('/', fn() => view('welcome'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── ADMIN Routes ──────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Users (admin + trainer + trainee)
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');

    // Training Sessions
    Route::resource('sessions', AdminSession::class);

    // Material approval for admin
    Route::patch('sessions/{session}/materials/{material}/approve', [AdminSession::class, 'approveMaterial'])->name('sessions.materials.approve');
    Route::patch('sessions/{session}/materials/{material}/reject', [AdminSession::class, 'rejectMaterial'])->name('sessions.materials.reject');

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    Route::get('reports/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::delete('reports/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
});

// ─── TRAINER Routes ────────────────────────────────────────
Route::prefix('trainer')->name('trainer.')->middleware(['auth', 'role:trainer'])->group(function () {
    Route::get('/dashboard', [TrainerDashboard::class, 'index'])->name('dashboard');

    // Materials upload / delete inside assigned sessions
    Route::get('sessions/{session}/materials', [MaterialController::class, 'index'])->name('sessions.materials');
    Route::post('sessions/{session}/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::delete('sessions/{session}/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');
});

// ─── Settings Routes (All roles) ──────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
});

// ─── TRAINEE Routes ────────────────────────────────────────
Route::prefix('trainee')->name('trainee.')->middleware(['auth', 'role:trainee'])->group(function () {
    Route::get('/dashboard', [TraineeDashboard::class, 'index'])->name('dashboard');
    Route::get('sessions', [SessionViewController::class, 'index'])->name('sessions.index');
    Route::get('sessions/{session}', [SessionViewController::class, 'show'])->name('sessions.show');
    Route::get('sessions/{session}/materials/{material}/download', [SessionViewController::class, 'download'])->name('materials.download');
    Route::post('sessions/{session}/enroll', [SessionViewController::class, 'enroll'])->name('sessions.enroll');
});
