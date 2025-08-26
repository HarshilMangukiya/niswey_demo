<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\XmlImportController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('contacts.index');
    });

    Route::resource('contacts', ContactController::class);
    Route::get('/contacts-data', [ContactController::class, 'data'])->name('contacts.data');
    Route::post('/import', [XmlImportController::class, 'import'])->name('contacts.import.store');
});
