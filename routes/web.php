<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $taskList = Tasks::where('owner_id', Auth::id())->get();
    $completed = Tasks::where('owner_id', Auth::id())->where('status', 1)->count();
    $pending = Tasks::where('owner_id', Auth::id())->where('status', 0)->count();
    return view('welcome', compact('taskList', 'completed', 'pending'));
});

Route::get('/test', function () {
    $taskList = Tasks::where('owner_id', Auth::id())->get();
    $completed = Tasks::where('owner_id', Auth::id())->where('status', 1)->count();
    $pending = Tasks::where('owner_id', Auth::id())->where('status', 0)->count();
    return view('layouts.app', compact('taskList', 'completed', 'pending'));
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
