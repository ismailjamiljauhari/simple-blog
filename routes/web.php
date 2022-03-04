<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Author\PostController as AuthorPostController;
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

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/post/{slug}', [PostController::class, 'detailPost'])->name('post.detail');

Auth::routes([
    'register' => false
]);

Route::get('logout', [LoginController::class, 'logout']);

Route::prefix('author')->middleware(['auth'])->group(function () {
    Route::resource('/posts', AuthorPostController::class);
    Route::get('/posts/data/json', [AuthorPostController::class, 'getDatatable'])->name('posts.data');
});
