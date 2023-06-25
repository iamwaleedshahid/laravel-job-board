<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;

Route::get('/', [JobController::class, 'index']);

Route::middleware('auth')->group(function () {
Route::get('/jobs/create', [JobController::class, 'create']);
Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
Route::get('/jobs/manage', [JobController::class, 'manage']);
Route::put('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy']);
Route::post('users/logout', [UserController::class, 'logout']);
});

Route::resource('jobs', JobController::class)->only(['store', 'show']);

Route::middleware('guest')->group(function () {
Route::get('users/register', [UserController::class, 'create']);
Route::post('users/register', [UserController::class, 'store']);
Route::get('users/login', [UserController::class, 'login'])->name('login');
Route::post('users/login', [UserController::class, 'authenticate']);
});