<?php
use App\Http\Controllers\{AuthController, DashboardController, UserController, ReviewController};
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));
Route::get('/login', [AuthController::class, 'form'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analisis', [ReviewController::class, 'index'])->name('analysis');
    Route::post('/analisis', [ReviewController::class, 'store'])->name('analysis.store');
    Route::get('/analisis/{review}/status', [ReviewController::class, 'status'])->name('analysis.status');
    Route::resource('pengguna', UserController::class)->except(['show'])->parameters(['pengguna' => 'user']);
});
