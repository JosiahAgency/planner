<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/create_account', [UserController::class, 'createAccount']);

Route::post('/authenticate', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/createTask', [TaskController::class, 'createTask']);
