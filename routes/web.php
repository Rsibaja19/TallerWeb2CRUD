<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectHasStudentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', [HomeController::class, 'index'])->name('welcome')->middleware('guest');

Route::get('user/home', [HomeController::class, 'index'])->name('home');

// rutas de administrador
Route::group(['middleware' => ['is_admin']], function () {
    Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::resource('admin/student', StudentController::class);
    Route::resource('admin/teacher', TeacherController::class);
    Route::resource('admin/subject', SubjectController::class);
    Route::resource('admin/classes', SubjectHasStudentController::class);
});


Route::get('login', function() {
    return redirect('auth/signin');
});

Route::get('auth/signin', [LoginController::class, 'show'])->name('login.show');
Route::post('auth/signin', [LoginController::class, 'login'])->name('login.perform');

Route::resource('auth/signup', RegisterController::class)->middleware('guest');

Route::get('auth/logout', [LogoutController::class, 'logout'])->name('logout.perform');

