<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'login'])->name('auth.login');
Route::get('logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::post('check-login', [LoginController::class, 'checkLogin'])->name('auth.login.submit');

Route::get('register', [LoginController::class, 'register'])->name('auth.register');
Route::post('register-post', [LoginController::class, 'registerPost'])->name('auth.register.submit');


Route::middleware(['is_admin'])->group(function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::post('list', [UserController::class, 'list'])->name('user.list');
});
