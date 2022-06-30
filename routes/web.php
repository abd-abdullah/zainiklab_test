<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => 'admin'], function(){
        Route::resource('students', App\Http\Controllers\StudentController::class);
        Route::resource('courses', App\Http\Controllers\CourseController::class);
        Route::post('courses/{course}/assign-student', [App\Http\Controllers\CourseController::class, 'assignStudent'])->name('assign_student');
    });
    
    Route::get('profile/{student}', [App\Http\Controllers\StudentController::class, 'view'])->name('student_profile');
});
