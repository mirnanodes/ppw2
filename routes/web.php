<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SendEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', fn () => redirect()->route('jobs.index'))->name('dashboard');

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');

    Route::get('/send-email', [SendEmailController::class, 'index'])->name('send-email.index');
    Route::post('/send-email', [SendEmailController::class, 'store'])->name('send-email.store');

    Route::middleware('isAdmin')->group(function (): void {
        Route::get('/admin/jobs', [JobController::class, 'adminIndex'])->name('admin.jobs.index');
        Route::get('/admin/jobs/create', [JobController::class, 'create'])->name('admin.jobs.create');
        Route::post('/admin/jobs', [JobController::class, 'store'])->name('admin.jobs.store');
        Route::get('/admin/jobs/{job}/edit', [JobController::class, 'edit'])->name('admin.jobs.edit');
        Route::put('/admin/jobs/{job}', [JobController::class, 'update'])->name('admin.jobs.update');
        Route::delete('/admin/jobs/{job}', [JobController::class, 'destroy'])->name('admin.jobs.destroy');

        Route::get('/admin/applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::put('/admin/applications/{id}', [ApplicationController::class, 'update'])->name('applications.update');
    });
});

require __DIR__.'/auth.php';
