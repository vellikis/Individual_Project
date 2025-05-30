<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProjectsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [ContactController::class, 'index'])
     ->name('contact.index');

Route::post('/contact/send', [ContactController::class, 'send'])
     ->name('contact.send');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('users', UsersController::class);
    Route::resource('projects', ProjectsController::class);
    Route::get('/projects/{project}', [ProjectsController::class, 'show'])->name('projects.show');
    Route::view('/contact', 'contact')->name('contact.index');
    Route::view('/faq', 'faq')->name('faq.index');
});
