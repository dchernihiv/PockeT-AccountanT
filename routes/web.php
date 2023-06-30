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

Route::name('verification.')->middleware('auth')->group( function () {

    Route::view('/email', 'auth.confirm')->name('notice');

    Route::get('/email/{id}/{hash}', [LoginController::class, 'confirm'])->middleware('signed')->name('verify');

    Route::get('/email/verification-notification', [LoginController::class, 'send'])->name('send');

});


/**
 * Routs reset password
 */

Route::name('password.')->middleware('guest')->group(function() {

    Route::view('/forgot-password', 'auth.forgot-password')->name('request');

    Route::post('/forgot-password', [LoginController::class, 'sendResetPassword'])->name('email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('reset');

    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('update');

});


/**
 * Routs web
 */

Route::name('web.')->middleware(['auth', 'verified'])->group( function () {

    Route::view('/category', 'web.app')->name('category');

    Route::view('/category/transaction', 'web.category.transaction')->name('transaction');

    Route::post('/category/transaction', [FinanceDataController::class, 'create']);

    Route::view('table/modify','web.category.modify')->name('modify');

    Route::post('table/modify', [FinanceDataController::class, 'index']);

    Route::post('/record/destroy', [FinanceDataController::class, 'destroy']);

    Route::post('/record/update', [FinanceDataController::class, 'update']);

    Route::view('/form/report', 'web.report.form-report')->name('form-report');

    Route::post('/create/report', [WebController::class, 'sendDataForChart'])->name('reports');

});


/**
 * Routs render lists
 */

Route::post('/show/items', [WebController::class, 'showItems']);

Route::post('/create/titles', [WebController::class, 'createNewTitles']);