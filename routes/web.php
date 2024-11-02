<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\AssignSubjectsController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\StudentAssignController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiptController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});


Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');



// user management all routes

Route::prefix('users')->group(function () {
    Route::get('/view', [UserController::class, 'userView'])->name('user.view');
    Route::get('/add', [UserController::class, 'addUser'])->name('users.add');
    Route::post('/store', [UserController::class, 'storeUser'])->name('users.store');
    Route::get('/edit/{id}', [UserController::class, 'editUser'])->name('users.edit');
    Route::post('/update/{id}', [UserController::class, 'updateUser'])->name('users.update');
    Route::delete('/delete/{id}', [UserController::class, 'deleteUser'])->name('users.delete');
});


// Route::resource('profiles', ProfileController::class);
Route::prefix('profile')->group(function () {
    Route::get('/view', [ProfileController::class, 'index'])->name('profile.view');
    Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/store', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/password/view', [ProfileController::class, 'viewPassword'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('update.password');
});


Route::prefix('setups')->group(function () {
    Route::get('student/class/view', [StudentClassController::class, 'viewStudent'])->name('studentClass.view');
    Route::get('student/class/add', [StudentClassController::class, 'addStudentClass'])->name('student.add');
    Route::post('student/class/store', [StudentClassController::class, 'storeStudentClass'])->name('student.store');
    Route::get('student/class/edit/{id}', [StudentClassController::class, 'editStudentClass'])->name('student.edit');
    Route::post('student/class/update/{id}', [StudentClassController::class, 'updateStudentClass'])->name('student.update');
    Route::delete('student/class/delete/{id}', [StudentClassController::class, 'deleteStudentClass'])->name('student.delete');

    // for year, group, shift route
    Route::resource('year', StudentYearController::class)->except('show');
    Route::resource('group', StudentGroupController::class)->except('show');
    Route::resource('shift', StudentShiptController::class)->except('show');
    Route::resource('fee/category', FeeCategoryController::class)->except('show');
    Route::resource('fee/category/amount', FeeAmountController::class)->except('destroy');
    Route::resource('exam/type', ExamTypeController::class)->except('show');
    Route::resource('school/subject', SchoolSubjectController::class)->except('show');
    Route::resource('assign-subject', AssignSubjectsController::class)->except('destroy');
});

