<?php

use App\Http\Controllers\LoginRegister;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.Login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginRegister::class, 'Dashboard'])->name('DashboardScreen');
    Route::post('/logout', [LoginRegister::class, 'Logout']) ->name('logout');
});






require __DIR__.'/auth.php';
