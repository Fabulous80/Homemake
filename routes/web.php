<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\HomeController;
use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();

Route::get('/email',function(){
    return new NewUserWelcomeMail();
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/post/{post}', [HomeController::class, 'show']);

Route::post('follow/{user}',[FollowsController::class, 'store']);

Route::get('/p', [PostsController::class, 'index']);
Route::get('/p/create', [PostsController::class, 'create']);
Route::post('/p', [PostsController::class, 'store']);
Route::get('/p/{post}', [PostsController::class, 'show']);
Route::get('/p/{post}/edit', [PostsController::class, 'edit']);
Route::patch('/p/{post}', [PostsController::class, 'update']);
Route::delete('/p/{post}', [PostsController::class, 'destroy']);

Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');