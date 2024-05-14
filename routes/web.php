<?php

use App\Livewire\AdminLogin;
use App\Livewire\AdminLogout;
use Illuminate\Support\Facades\Route;
use App\Livewire\Register;
use App\Livewire\Login;
use App\Livewire\Dashboard;
use App\Livewire\Logout;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;

// Public routes

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/employees');
    }
    return redirect('/login');
});

// Guest routes
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
    Route::get('/login/admin', AdminLogin::class)->name('adminlogin');
});

// Authenticated routes
Route::group(['middleware' => 'auth'], function () {
    // Route::get('/index', [EmployeeController::class, 'index'])->name('index');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::resource("/employees", EmployeeController::class);
    Route::get("/index", AdminLogin::class)->name('index');
    // Route::post('/logout', Logout::class)->name('logout');
    Route::post('/logout', 'App\Http\Controllers\EmployeeController@logout')->name('logout');
    Route::post('/logout', [AdminLogout::class, 'logout'])->name('logout');
});