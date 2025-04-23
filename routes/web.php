<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\FileController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home#contact', [HomeController::class, 'index'])->name('home#kapcsolat');

Route::get('/jobs/show/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');

Route::get('/profile/{user}', [ProfileController::class, 'show'])
    ->name('profile.show');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/profile', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/edit/{id}', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/update/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
    Route::put('/jobs/{job}/close', [JobController::class, 'close'])->name('jobs.close');


    Route::get('/jobs/{job}/apply', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/application/thank-you', [ApplicationController::class, 'thankYou'])->name('applications.thankyou');
    Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{application}/cancel', [ApplicationController::class, 'cancel'])->name('applications.cancel');

    Route::get('/reviews/create/{job}/{user}', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/jobs/{job}/reviews/{user}', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/download/{filename}', [FileController::class, 'download'])->name('download');



});

require __DIR__.'/auth.php';
