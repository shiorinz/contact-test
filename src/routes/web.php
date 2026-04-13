<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/back', [ContactController::class, 'back']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

Route::get('/register', function () {return view('auth.register');})->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {return view('auth.login');})->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/search', [AdminController::class, 'search']);
    Route::get('/reset', [AdminController::class, 'reset']);
    Route::get('/export', [AdminController::class, 'export']);
    Route::delete('/delete/{id}', [AdminController::class, 'destroy']);
});