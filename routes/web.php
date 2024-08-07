<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\StudentProgramController;
use App\Http\Controllers\Student\ResourseController;


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
Route::post('/updateStatus', [UserController::class, 'updateStatus'])->name('updateStatus');

// Protected routes that require athentication
Route::group(['middleware' => ['auth']], function () {

    Route::get('/user', [UserController::class, 'index'])->name('admin.dashboard');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');

    Route::resource('programs', ProgramController::class)->names('programs');
    Route::resource('courses', CourseController::class)->names('courses');
    Route::get('courses/create/{program}', [CourseController::class, 'create'])->name('courses.create');
    Route::resource('chapters', ChapterController::class)->names('chapters');
    Route::get('chapters/create/{course}', [ChapterController::class, 'create'])->name('chapters.create');

    Route::get('/student', [ProfileController::class, 'index'])->name('student.dashboard');
    Route::get('/student/{id}/edit', [ProfileController::class, 'edit'])->name('student.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('/student/programs', StudentProgramController::class)->names('student.programs');
    Route::get('/phases/{id}', [StudentProgramController::class, 'showPhases'])->name('phases.show');
    Route::get('/courses/{courseId}/chapters', [StudentProgramController::class, 'getChapters']);
    Route::post('/chapters/{chapter}/complete', [StudentProgramController::class, 'complete'])->name('chapters.complete');
    Route::get('/courses/{course}/chapters/{chapter}/next', [StudentProgramController::class, 'next'])->name('chapters.next');
    Route::get('/courses/{courseId}/chapters/{chapterId}/next', [StudentProgramController::class, 'getNextChapter']);
    Route::post('/student/logout', [StudentProgramController::class, 'logout'])->name('student.logout');
    Route::get('/resource', [ResourseController::class, 'index'])->name('student.resource');
    Route::get('/resource/{resourceId}/', [ResourseController::class, 'show'])->name('resource.show');
    Route::get('/student/search', [ResourseController::class, 'search'])->name('student.search');
    Route::get('/phase/{id}', [ResourseController::class, 'showPhase'])->name('phase.show');
    Route::get('/progress', [ResourseController::class, 'getProgress'])->name('progress.get');
    Route::get('/course/{courseId}/chapter', [StudentProgramController::class, 'getChaptersNew'])->name('courses.chapters');

});