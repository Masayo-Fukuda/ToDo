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

Route::get('/tasks',[TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create',[TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks/store',[TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{id}/edit',[TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{id}/update',[TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{id}',[TaskController::class, 'destroy'])->name('tasks.destroy');

Route::post('/tasks/search',[TaskController::class, 'search'])->name('tasks.search');

Route::resource('tasks.comments', CommentController::class)->shallow();
// Route::get('/comments/create/{task_id}',[CommentController::class, 'create'])->name('comments.create');
// Route::post('/comments/store',[CommentController::class, 'store'])->name('comments.store');
// Route::get('/comments/{id}', [CommentController::class, 'index'])->name('comments.index');

Route::post('/bookmark', [BookmarkController::class, 'store'])->name('bookmark.store');
Route::delete('/bookmark/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');

Route::get('/my_page/{id}', [MyPageController::class, 'show'])->name('my_page.show');