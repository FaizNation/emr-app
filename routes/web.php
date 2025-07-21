<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\ComprehensiveDataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Schools Management
    Route::resource('schools', SchoolController::class);
    
    // Students Management
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/schools/{school}/students', [StudentController::class, 'schoolStudents'])->name('students.school');
    Route::get('/schools/{school}/students/export/excel', [StudentController::class, 'exportExcel'])->name('students.export.excel');
    Route::get('/schools/{school}/students/export/pdf', [StudentController::class, 'exportPdf'])->name('students.export.pdf');
    Route::get('/schools/{school}/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/schools/{school}/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/schools/{school}/students/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/schools/{school}/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/schools/{school}/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/schools/{school}/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    
    // Screenings Management
    Route::get('/screenings', [ScreeningController::class, 'index'])->name('screenings.index');
    Route::get('/schools/{school}/screenings', [ScreeningController::class, 'schoolScreenings'])->name('screenings.school');
    Route::get('/schools/{school}/screenings/create', [ScreeningController::class, 'create'])->name('screenings.create');
    Route::post('/schools/{school}/screenings', [ScreeningController::class, 'store'])->name('screenings.store');
    Route::get('/schools/{school}/screenings/{screening}', [ScreeningController::class, 'show'])->name('screenings.show');
    Route::get('/schools/{school}/screenings/{screening}/edit', [ScreeningController::class, 'edit'])->name('screenings.edit');
    Route::put('/schools/{school}/screenings/{screening}', [ScreeningController::class, 'update'])->name('screenings.update');
    Route::delete('/schools/{school}/screenings/{screening}', [ScreeningController::class, 'destroy'])->name('screenings.destroy');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Comprehensive Data routes
    Route::get('/comprehensive', [ComprehensiveDataController::class, 'index'])->name('comprehensive.index');
    Route::get('/comprehensive/search', [ComprehensiveDataController::class, 'search'])->name('comprehensive.search');
    Route::get('/comprehensive/export/excel', [ComprehensiveDataController::class, 'exportExcel'])->name('comprehensive.export.excel');
    Route::get('/comprehensive/export/pdf', [ComprehensiveDataController::class, 'exportPdf'])->name('comprehensive.export.pdf');
});

Route::middleware(['auth'])->group(function () {
    // Screening routes
    Route::get('/screenings', [ScreeningController::class, 'index'])->name('screenings.index');
    Route::get('/screenings/{school}', [ScreeningController::class, 'school'])->name('screenings.school');
    Route::get('/screenings/{school}/create', [ScreeningController::class, 'create'])->name('screenings.create');
    Route::post('/screenings/{school}', [ScreeningController::class, 'store'])->name('screenings.store');
    Route::get('/screenings/{school}/{screening}', [ScreeningController::class, 'show'])->name('screenings.show');
    Route::get('/screenings/{school}/{screening}/edit', [ScreeningController::class, 'edit'])->name('screenings.edit');
    Route::get('/screenings/{school}/export/excel', [ScreeningController::class, 'exportExcel'])->name('screenings.export.excel');
    Route::get('/screenings/{school}/export/pdf', [ScreeningController::class, 'exportPdf'])->name('screenings.export.pdf');
    Route::put('/screenings/{school}/{screening}', [ScreeningController::class, 'update'])->name('screenings.update');
    Route::delete('/screenings/{school}/{screening}', [ScreeningController::class, 'destroy'])->name('screenings.destroy');
});

require __DIR__.'/auth.php';
