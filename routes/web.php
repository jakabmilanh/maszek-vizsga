<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home#contact', [HomeController::class, 'indexkapcsolat'])->name('home#kapcsolat');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/profile', [JobController::class, 'store'])->name('jobs.store');
    Route::put('/jobs/{jobs}', [JobController::class, 'update'])->name('jobs.edit');
    Route::delete('/jobs', [JobController::class, 'destroy'])->name('jobs.destroy');

});

require __DIR__.'/auth.php';
