<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery'); 
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/panduan', [HomeController::class, 'guide'])->name('guide');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Rute CRUD Member (Otomatis bikin index, create, store, destroy, dll)
    Route::resource('members', MemberController::class);
    // Di dalam Route::prefix('admin')->group(...)

    Route::get('/kasir', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/kasir', [TransactionController::class, 'store'])->name('transactions.store');

    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
});