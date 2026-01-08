<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController; // <--- Import AuthController
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PublicController;

// ==========================
// AREA PUBLIK (Bisa Diakses Siapa Saja)
// ==========================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/panduan', [HomeController::class, 'guide'])->name('guide');

// Rute Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Absen Mandiri (QR Code mengarah kesini)
Route::get('/absen', [PublicController::class, 'showCheckIn'])->name('public.checkin');
Route::post('/absen', [PublicController::class, 'processCheckIn'])->name('public.checkin.process');

// ==========================
// AREA PRIVATE (Harus Login Dulu)
// ==========================
// Kita bungkus semua route admin dengan middleware 'auth'
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Member
    Route::resource('members', MemberController::class);
    
    // Kasir
    Route::get('/kasir', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/kasir', [TransactionController::class, 'store'])->name('transactions.store');
    
    // Laporan
    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');

    Route::resource('users', UserController::class);

    // Route khusus perpanjang member
    Route::post('/members/{id}/renew', [MemberController::class, 'renew'])->name('members.renew');

    Route::resource('expenses', ExpenseController::class)->only(['index', 'store', 'destroy']);


    // GALERI
    Route::resource('galleries', \App\Http\Controllers\AdminGalleryController::class);

    // PANDUAN
    Route::get('/exercises', [\App\Http\Controllers\AdminExerciseController::class, 'index'])->name('exercises.index');
    Route::post('/exercises/category', [\App\Http\Controllers\AdminExerciseController::class, 'storeCategory'])->name('exercises.category.store');
    Route::delete('/exercises/category/{bodyPart}', [\App\Http\Controllers\AdminExerciseController::class, 'destroyCategory'])->name('exercises.category.destroy');
    Route::post('/exercises', [\App\Http\Controllers\AdminExerciseController::class, 'storeExercise'])->name('exercises.store');
    Route::delete('/exercises/{exercise}', [\App\Http\Controllers\AdminExerciseController::class, 'destroyExercise'])->name('exercises.destroy');
    // Route Cetak Absensi
    Route::get('/attendances/print', [AttendanceController::class, 'printRecap'])->name('attendances.print');

    Route::resource('attendances', AttendanceController::class)->only(['index', 'store', 'destroy']);
});