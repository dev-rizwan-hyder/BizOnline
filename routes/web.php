<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;



Route::middleware(['guest'])->group(function () {
    Route::get('login', action: [AuthController::class, 'test'])->name('login');
Route::post(uri: 'login', action: [AuthController::class,'login'])->name('login');

// Show the form
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');

// Handle form submission
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/', function () {
    return view('welcome');
});

});

Route::middleware(['auth'])->group(function () {
    Route::get('test', [ContactController::class, 'test'])->name('test');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

});
