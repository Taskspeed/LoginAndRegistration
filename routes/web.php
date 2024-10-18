<?php

use App\Http\Controllers\LoginRegister;

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('auth.Login');
// });

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginRegister::class, 'Dashboard'])->name('DashboardScreen');
    Route::post('/logout', [LoginRegister::class, 'Logout']) ->name('logout');
});



// Guest middleware to prevent authenticated users from accessing login and register pages
Route::middleware('guest')->group(function () {

    // Login and Register routes
    Route::get('/login', [LoginRegister::class, 'Login'])->name('LoginScreen');
    Route::post('/login', [LoginRegister::class, 'User_login'])->name('Login.store');
    Route::get('/register', [LoginRegister::class, 'Register'])->name('RegisterScreen');
    Route::post('/register', [LoginRegister::class, 'Registerstore'])->name('Register.store');
});

// Route for the homepage that shows the login view
Route::get('/', function () {
    return redirect()->route('LoginScreen');
});



// require __DIR__.'/auth.php';
