<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EducationQualificationController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobRoleController;
use App\Http\Controllers\LeadAssignController;
use App\Http\Controllers\LeadController;
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

    //lead
    Route::prefix('lead')->name('lead.')->controller(LeadController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{lead}', 'update')->name('update');

        Route::get('/show/{lead}', 'show')->name('show');

        Route::get('/active/{lead}', 'active')->name('active');
        Route::get('/inactive/{lead}', 'inactive')->name('inactive');
    });

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

    //employee
    Route::prefix('employee')->name('employee.')->controller(EmployeeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{employee}', 'update')->name('update');
        Route::delete('/delete/{employee}', 'delete')->name('delete');

        Route::get('/show/{employee}', 'show')->name('show');

        Route::get('/active/{employee}', 'active')->name('active');
        Route::get('/inactive/{employee}', 'inactive')->name('inactive');
    });

    //department
    Route::prefix('department')->name('department.')->controller(DepartmentController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{department}', 'update')->name('update');
        Route::delete('/delete/{department}', 'delete')->name('delete');
    });
    //designation
    Route::prefix('designation')->name('designation.')->controller(DesignationController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{designation}', 'update')->name('update');
        Route::delete('/delete/{designation}', 'delete')->name('delete');
    });
 //lead assign
    Route::prefix('lead-assign')->name('lead-assign.')->controller(LeadAssignController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{leadassign}', 'delete')->name('delete');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
