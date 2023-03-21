<?php

use App\Http\Controllers\BlogController;
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

// Route::get('/', function () {
//     return view('front.pages.example');
// });

Route::view('/', 'front.pages.home')->name('home');

Route::get('/article/{any}', [BlogController::class, 'readPost'])->name('read-post');
Route::get('/category/{any}', [BlogController::class, 'categoryPost'])->name('category-post');
Route::get('/post/tag/{any}', [BlogController::class, 'tagPost'])->name('tag-post');
Route::get('/search', [BlogController::class, 'searchBlog'])->name('search-post');
