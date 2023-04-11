<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\MyPageController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('tasks', TaskController::class);

Route::resource('tasks.comments', CommentController::class)->shallow();

Route::post('/bookmark', [BookmarkController::class, 'store'])->name('bookmark.store');
Route::delete('/bookmark/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');

Route::get('/my_page/{id}', [MyPageController::class, 'show'])->name('my_page.show');