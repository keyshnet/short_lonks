<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Auth::routes();

Route::middleware(['role:admin', 'auth'])->prefix('/administrator')->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('admin');
    Route::resource('links', \App\Http\Controllers\LinkController::class);
    Route::resource('user', \App\Http\Controllers\UserController::class);
});

Route::get('{code}', [\App\Http\Controllers\HomeController::class, 'shortLink']);
