<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\WriterController;
use Illuminate\Support\Facades\Route;

Route::get('/',[FrontController::class,'index'])->name('home');
Route::get('/login',[FrontController::class,'login'])->name('login');
Route::post('/login/submit',[FrontController::class,'loginSubmit'])->name('login.submit');
Route::get('/register',[FrontController::class,'register'])->name('register');
Route::post('/register/send',[FrontController::class,'registerSend'])->name('register.send');
Route::post('/register/submit',[FrontController::class,'registerSubmit'])->name('register.submit');
Route::get('/register/submit/show',[FrontController::class,'registerSubmitShow'])->name('register.submit.show');
Route::get('/forget/password',[FrontController::class,'forgetPassword'])->name('forget.password');
Route::post('/forget/password/send',[FrontController::class,'forgetPasswordSend'])->name('forget.password.send');
Route::get('/reset/password/show',[FrontController::class,'resetPasswordShow'])->name('reset.password.show');
Route::post('/reset/password',[FrontController::class,'resetPassword'])->name('reset.password');

Route::prefix('/panel')->middleware(['auth', 'role:writer|juror'])->group(function () {

    Route::get('/',[WriterController::class,'index'])->name('writer.index');
    Route::get('/article',[WriterController::class,'article'])->name('writer.article');
    Route::post('/article/store',[WriterController::class,'articleStore'])->name('writer.article.store');
});
