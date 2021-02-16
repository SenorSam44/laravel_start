<?php

use App\Http\Controllers\PostController;
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

//Route::get('/post/getPosts', [PostController::class, 'index'])->name('post.index');
//Route::get('/post', [PostController::class, 'index'])->name('post.index');
//Route::post('/post', [PostController::class, 'add'])->name('post.add');
//Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
//Route::post('/edit/{id}', [PostController::class, 'update'])->name('post.update');
//Route::get('/delete/{id}', [PostController::class, 'delete'])->name('post.delete');

Route::get('/post/getPosts', [PostController::class, 'getPosts']);
Route::resource('post', PostController::class);

