<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/register', [App\Http\Controllers\AuthController::class, 'registerView'])->name('register-view');
Route::get('/login', [App\Http\Controllers\AuthController::class, 'loginView'])->name('login-view');

Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update.task');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'postUpdate'])->name('update.post');
    Route::get('/historique', [App\Http\Controllers\HomeController::class, 'history'])->name('history');
    Route::get('/commits/{id}', [App\Http\Controllers\HomeController::class, 'commit'])->name('commit');
    Route::get('/add', [App\Http\Controllers\HomeController::class, 'addTask'])->name('add.taskM');
    Route::get('/completed/{id}', [App\Http\Controllers\HomeController::class, 'completed'])->name('completed.task');
    Route::get('/incomplete/{id}', [App\Http\Controllers\HomeController::class, 'incomplete'])->name('incomplete.task');
    Route::get('/close-day', [App\Http\Controllers\HomeController::class, 'closeDay'])->name('closeDay');
    Route::get('/filter/day', [App\Http\Controllers\HomeController::class, 'filterDay'])->name('task_by_day');

});
