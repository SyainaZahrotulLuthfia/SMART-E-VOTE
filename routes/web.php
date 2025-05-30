<?php

use App\Http\Controllers\Admin\BoxController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoteController;
use App\Http\Controllers\HomeController;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
})->name('welcome');

// auth.login

//Route bawaan spatie / laravel permission
Auth::routes([
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

//Route dashboard bawaan spatie
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Group Route prefix admin
Route::prefix('admin')->group(function () {
    //Group Route middleware role admin
    Route::group(['middleware' => ['auth','role:admin']], function () {
         //Group Route yang hanya bisa diakses oleh role admin ketika login
        Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.dashboard');


        //route resource classroom
        Route::resource('classrooms', ClassroomController::class);
        Route::get('classrooms/{classroom_id}/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('classroom.create_user');
        Route::post('classrooms/import', [ClassroomController::class, 'import'])->name('classrooms.import');


        //route resource users
        Route::resource('users', UserController::class);
        Route::post('users/import', [UserController::class, 'import'])->name('users.import');

        //route resource votes
        Route::resource('votes', VoteController::class);
        Route::get('votes/{vote_id}/create', [App\Http\Controllers\Admin\CandidateController::class, 'create'])->name('vote.create_candidate');
        Route::get('votes/{vote_id}/report', [App\Http\Controllers\Admin\VoteController::class, 'report'])->name('votes.report');
        Route::get('votes/{vote_id}/success', [App\Http\Controllers\Admin\VoteController::class, 'success'])->name('votes.success');
        Route::get('votes/{vote_id}/pending', [App\Http\Controllers\Admin\VoteController::class, 'pending'])->name('votes.pending');

        //route resource candidate
        Route::resource('candidates', CandidateController::class);
        //route resource box
        Route::resource('boxes', BoxController::class);
    });
});



//Group Route prefix student
Route::prefix('student')->group(function () {
    //Group Route middleware role student
    Route::group(['middleware' => ['auth','role:student']], function () {
            //Group Route yang hanya bisa diakses oleh role student ketika login
            Route::get('dashboard', [App\Http\Controllers\StudentController::class, 'student'])->name('student.dashboard');
            Route::get('/candidates/{id}', [App\Http\Controllers\StudentController::class, 'candidates'])->name('student.candidates.index');
            Route::get('/candidates/{id}/show', [App\Http\Controllers\StudentController::class, 'showCandidate'])->name('student.candidates.show');


            // Route untuk menyimpan suara ke BoxController
            Route::post('/boxes/store', [BoxController::class, 'store'])->name('boxes.store');
    });
});
