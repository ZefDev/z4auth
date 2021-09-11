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

Route::get('/', [App\Http\Controllers\HomeController::class, 'indexWelcome']);

Route::get('login/{provider}', [App\Http\Controllers\SocialController::class, 'redirect']);
Route::get('login/{provider}/callback', [App\Http\Controllers\SocialController::class, 'Callback']);
Route::get('login/{provider}/callback', [App\Http\Controllers\SocialController::class, 'Callback']);
Route::get('login/twitter/callback', [App\Http\Controllers\SocialController::class, 'TwitterCallback']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', App\Http\Controllers\UserController::class);
Route::put('/usersList/delete', [App\Http\Controllers\UserController::class, 'destroyList'])->name('users.delete');
Route::put('/usersList/unblock', [App\Http\Controllers\UserController::class, 'unblock'])->name('users.unblock');
Route::put('/usersList/block', [App\Http\Controllers\UserController::class, 'block'])->name('users.block');
