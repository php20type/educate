<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::get('/register-step1', [RegisterController::class, 'showStep1'])->name('register.step1');
Route::post('/register-step1', [RegisterController::class, 'postStep1'])->name('register.postStep1');
Route::get('/register-step2', [RegisterController::class, 'showStep2'])->name('register.step2');
Route::post('/register-step2', [RegisterController::class, 'postStep2'])->name('register.postStep2');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/send-otp', [RegisterController::class, 'sendOTP'])->name('send.otp');

// Protected routes that require thentication
Route::group(['middleware' => ['auth']], function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.profile.index');
    Route::get('/student', [UserController::class, 'index'])->name('student.profile.index');

});