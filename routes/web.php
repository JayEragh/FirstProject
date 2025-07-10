<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Auth::routes();

// Home route after login
Route::get('/home', function () {
    return redirect()->route('documents.index');
})->name('home');

// Document routes (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::resource('documents', DocumentController::class);
    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    
    // User profile routes
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
});

// Admin routes (requires admin middleware)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
    
    // Email routes
    Route::get('/emails', [EmailController::class, 'index'])->name('emails.index');
    Route::post('/emails/send', [EmailController::class, 'sendRecentDocuments'])->name('emails.send');
    Route::post('/emails/send/{user}', [EmailController::class, 'sendToUser'])->name('emails.send.user');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
