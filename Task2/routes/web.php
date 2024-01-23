<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Models\PostComments;
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

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/register', [PageController::class, 'register'])->name('register');
Route::get('email_verified/{param}', [PageController::class, 'email_verified'])->name('email_verified');

Route::post('/register', [PostController::class, 'register_save'])->name('register_save');
Route::post('/login', [PostController::class, 'login_user'])->name('login_user');
Route::post('/create_post', [PostController::class, 'create_post'])->name('create_post')->middleware('auth');
Route::post('/update_post', [PostController::class, 'update_post'])->name('update_post')->middleware('auth');

Route::get('/postDetail/{param}', [PageController::class, 'postDetail'])->name('post_detail');
Route::get('/create_post', [PageController::class, 'create_post'])->name('create_post')->middleware('auth');
Route::get('/edit_post/{param}', [PageController::class, 'edit_post'])->name('edit_post')->middleware('auth');


Route::post('/postComment', [PostController::class, 'commentSave'])->name('commentSave')->middleware('auth');
Route::post('/editComment', [PostController::class, 'editComment'])->name('editComment')->middleware('auth');
Route::post('/deleteComment', [PostController::class, 'commentDelete'])->name('commentDelete')->middleware('auth');
Route::post('/deletePost', [PostController::class, 'delete_post'])->name('deletePost')->middleware('auth');


Route::get('/search', [PageController::class, 'search'])->name('search');
