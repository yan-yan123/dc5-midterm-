<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
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
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/verification/{user}/{token}', [AuthController::class, 'verification']);



Route::get('/logs',[SiteController::class, 'index'])->name('logs');
Route::get('/logs', [SiteController::class, 'logs']);




Route::group(['prefix' => '/'], function(){

Route::get('/', [SiteController::class, 'landing'])->name('landing');
Route::get('home', [PostController::class, 'all'])->name('home');
Route::get('categories/{category}',  [PostController::class, 'byCategory'])->name('categories');
Route::get('authors/{author}',  [PostController::class, 'byAuthor']);
Route::get('authors',  [UserController::class, 'index'])->name('authors');

    Route::group(['prefix' => 'user', 'middleware' => ['auth', 'verified']], function(){
        Route::get('create-post',  [PostController::class, 'create'])->name('create-post');
        Route::post('create-post',  [PostController::class, 'store']);
    });
});





