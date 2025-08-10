<?php

use App\Http\Controllers\EducationQualificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobRoleController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('backend.index');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.index');
    })->name('admin.dashboard')->middleware('verified');


    //education qualification
    Route::prefix('education')->name('education.')->controller(EducationQualificationController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{education}', 'update')->name('update');
        Route::delete('/delete/{education}', 'delete')->name('delete');

    });
    //job role
    Route::prefix('job-role')->name('jobRole.')->controller(JobRoleController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{jobRole}', 'update')->name('update');
        Route::delete('/delete/{jobRole}', 'delete')->name('delete');


    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
