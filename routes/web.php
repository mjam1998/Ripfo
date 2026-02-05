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
    Route::get('/user/information',[WriterController::class,'userInformation'])->name('writer.user.information');
    Route::post('/user/information/update',[WriterController::class,'userInformationUpdate'])->name('writer.user.information.update');
    Route::get('/jurors/search',[WriterController::class,'jurorsSearch'])->name('writer.jurors.search');
    Route::get('/writers/search', [WriterController::class, 'searchWriters'])->name('writers.search');
    Route::get('/keywords/search', [WriterController::class, 'search'])->name('keywords.search');
    Route::get('/article/detail/{code}',[WriterController::class,'articleDetail'])->name('writer.article.detail');
    Route::post('/article/cancel/{code}',[WriterController::class,'articleCancel'])->name('writer.article.cancel');
    Route::get('/articles/{status}',[WriterController::class,'articles'])->name('writer.articles');
    Route::get('/article/download/primary/{code}',[WriterController::class,'articleDownload'])->name('writer.article.download');
    Route::get('/article/download/secondary/{code}',[WriterController::class,'articleDownloadSecond'])->name('writer.article.download.second');
    Route::get('/article/download/juror/{code}',[WriterController::class,'articleDownloadJuror'])->name('writer.article.download.juror');

    Route::get('/logout',[WriterController::class,'logout'])->name('writer.logout');


});
