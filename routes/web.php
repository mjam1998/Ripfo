<?php

use App\Http\Controllers\ArticleController;
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
    Route::post('/article/edit/{article}',[WriterController::class,'articleEdit'])->name('writer.article.edit');
    Route::get('/articles/create/step-1', [ArticleController::class, 'createStep1'])->name('writer.article.create.step-1');
    Route::post('/articles/create/step-1', [ArticleController::class, 'storeStep1'])->name('writer.article.store.step-1');
    Route::get('/articles/{article}/step-1', [ArticleController::class, 'editStep1'])->name('writer.article.edit.step-1')->middleware('step:2');
    Route::put('/articles/{article}/step-1', [ArticleController::class, 'updateStep1'])->name('writer.article.update.step-1')->middleware('step:2');

    Route::get('/articles/{article}/step-2', [ArticleController::class, 'createStep2'])->name('writer.article.create.step-2')->middleware('step:2');
    Route::post('/articles/{article}/step-2', [ArticleController::class, 'storeStep2'])->name('writer.article.store.step-2')->middleware('step:2');

    Route::get('/articles/{article}/step-3', [ArticleController::class, 'createStep3'])->name('writer.article.create.step-3')->middleware('step:2');
    Route::post('/articles/{article}/step-3', [ArticleController::class, 'storeStep3'])->name('writer.article.store.step-3')->middleware('step:3');

    Route::get('/articles/{article}/step-4', [ArticleController::class, 'createStep4'])->name('writer.article.create.step-4')->middleware('step:4');
    Route::post('/articles/{article}/step-4', [ArticleController::class, 'storeStep4'])->name('writer.article.store.step-4')->middleware('step:4');

    Route::get('/articles/{article}/step-5', [ArticleController::class, 'createStep5'])->name('writer.article.create.step-5')->middleware('step:5');
    Route::post('/articles/{article}/step-5', [ArticleController::class, 'storeStep5'])->name('writer.article.store.step-5')->middleware('step:5');

    Route::get('/articles/{article}/step-6', [ArticleController::class, 'createStep6'])->name('writer.article.create.step-6')->middleware('step:6');
    Route::post('/articles/{article}/step-6', [ArticleController::class, 'storeStep6'])->name('writer.article.store.step-6')->middleware('step:6');

    Route::get('/articles/{article}/step-7', [ArticleController::class, 'createStep7'])->name('writer.article.create.step-7')->middleware('step:7');
    Route::post('/articles/{article}/step-7', [ArticleController::class, 'storeStep7'])->name('writer.article.store.step-7')->middleware('step:7');

    Route::patch('articles/{article}/writers/{user}/sort', [ArticleController::class, 'updateWriterSort'])
        ->name('writer.article.writer.sort')->middleware('step:2');
    Route::delete('articles/{article}/writers/{user}/delete', [ArticleController::class, 'deleteWriterArticle'])
        ->name('writer.article.writer.delete')->middleware('step:2');


    Route::get('/logout',[WriterController::class,'logout'])->name('writer.logout');


});
