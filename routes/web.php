<?php

use App\Http\Controllers\EdificioController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rotas de UserController
Route::get('/', [UserController::class, 'index'])->name('home.index');
Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
Route::get('/home/settings', [UserController::class, 'settings'])->name('home.settings');
Route::get('/welcome', [UserController::class, 'welcome'])->name('home.welcome');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/store-user', [UserController::class, 'store'])->name('user-store');
Route::get('/users/listusers', [UserController::class, 'listusers'])->name('users.listusers');
Route::get('show-user/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/edit-users/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/update-user/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('users.destroy');


// Rotas de EdificioController
Route::get('/edificios/search', [EdificioController::class, 'search'])->name('edificios.search');
Route::get('/edificios/create', [EdificioController::class, 'create'])->name('edificios.create');
Route::post('/store-edificio', [EdificioController::class, 'store'])->name('edificio-store');
Route::get('/edificios/listedificios', [EdificioController::class, 'listedificios'])->name('edificios.listedificios'); 
Route::get('show-edificio/{edificio}', [EdificioController::class, 'show'])->name('edificios.show'); 
Route::get('/edit-edificio/{edificio}', [EdificioController::class, 'edit'])->name('edificios.edit'); 
Route::put('/update-edificio/{edificio}', [EdificioController::class, 'update'])->name('edificios.update');
Route::delete('/destroy-edificio/{edificio}', [EdificioController::class, 'destroy'])->name('edificios.destroy');

