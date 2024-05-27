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
use App\Http\Middleware\EmployeeMiddleware; // Import the missing class
use App\Http\Middleware\AdminMiddleware; // Import the missing class

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

// Routes for employees
Route::middleware([EmployeeMiddleware::class])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::post('/logout', 'App\Http\Controllers\EmployeeController@logout')->name('logout');
});

// Routes for admins
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get("/index", AdminLogin::class)->name('index');
    Route::resource("/employees", EmployeeController::class);
    Route::post('/logout', [AdminLogout::class, 'logout'])->name('logout');
});