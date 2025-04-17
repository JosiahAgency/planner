<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'dashboard'])->name('home');

Route::get('/login', [UserController::class, 'loginView'])->name('login');

Route::get('/register', [UserController::class, 'registerView'])->name('register');

Route::post('/create_account', [UserController::class, 'createAccount']);

Route::post('/authenticate', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/createTask', [TaskController::class, 'createTask']);

Route::post('/completedTaskStatus', [TaskController::class, 'statusCompleted'])->name('completed');


