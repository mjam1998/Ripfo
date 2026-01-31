<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/',[FrontController::class,'index'])->name('home');
Route::get('/login',[FrontController::class,'login'])->name('login');
Route::get('/register',[FrontController::class,'register'])->name('register');
