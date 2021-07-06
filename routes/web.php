<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tag/{id}',[App\Http\Controllers\ProductController::class, 'category'])->name('tag');




Route::middleware('auth')->group(function (){
    Route::get('/',[\App\Http\Controllers\ProductController::class, 'index'])->name('posts.show');
    Route::get('create', [\App\Http\Controllers\ProductController::class, 'create'])->name('create');
    Route::get('/posts/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('post.show');
    Route::post('posts/savepost', [\App\Http\Controllers\ProductController::class, 'store'])->name('post.save');
    Route::get('posts/{id}/edit', [\App\Http\Controllers\ProductController::class, 'edit'])->name('post.edit');
    Route::put('posts/{id}/update', [\App\Http\Controllers\ProductController::class, 'update'])->name('post.update');
    Route::delete('posts/{id}/delete', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('post.delete');
    Route::get('/liked',[App\Http\Controllers\ProductController::class, 'favourited'])->name('liked');
    Route::get('/posts/{product}/like', [\App\Http\Controllers\ProductController::class, 'addtofavourite'])->name('like');
});
