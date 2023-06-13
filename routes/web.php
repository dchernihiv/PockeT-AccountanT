<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\FinanceDataController;


Route::view('/', 'web.home')->name('home');


/**
 * Routs registration
 */

Route::prefix('user-registration')->middleware('guest')->group(function () {

    Route::get('/', [RegistrationController::class, 'index'])->name('registr');

    Route::post('/', [RegistrationController::class, 'registration']);
});


/**
 * Routs login
 */

Route::prefix('user-login')->group( function () {

    Route::get('/', [LoginController::class, 'index'])->name('login');

    Route::post('/', [LoginController::class, 'login']);
});


Route::get('user-logout', [LoginController::class, 'logout'])->name('logout');


/**
 * Routs confirm email
 */

Route::prefix('verify')->middleware('auth')->group( function () {

    Route::view('/email', 'auth.confirm')->name('verification.notice');

    Route::get('/email/{id}/{hash}', [LoginController::class, 'confirm'])->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', [LoginController::class, 'send'])
        ->name('verification.send');
});


/**
 * Routs web
 */

Route::name('web.')->middleware(['auth', 'verified'])->group( function () {

    Route::view('/category', 'web.app')->name('category');

    Route::view('/category/transaction', 'web.category.transaction')->name('transaction');

    Route::post('/category/transaction', [FinanceDataController::class, 'create']);

    Route::view('/create/report', 'web.report.form-report')->name('report');

    Route::view('table/modify','web.category.modify')->name('modify');

    Route::post('table/modify', [FinanceDataController::class, 'index']);

    Route::post('/record/destroy', [FinanceDataController::class, 'destroy']);


   
});


/* Routs render lists */

Route::post('/show/items', [WebController::class, 'showItems']);

Route::post('/create/titles', [WebController::class, 'createNewTitles']);