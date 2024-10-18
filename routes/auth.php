<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegister;

use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::middleware('guest')->group(function () {
  
// Login and Register routes
Route::get('/login', [LoginRegister::class, 'Login'])->name('LoginScreen');
Route::post('/login', [LoginRegister::class, 'User_login'])->name('Login.store');
Route::get('/register', [LoginRegister::class, 'Register'])->name('RegisterScreen');
Route::post('/register', [LoginRegister::class, 'Registerstore'])->name('Register.store');

});

