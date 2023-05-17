<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BulletinBoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;

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

Route::get('/', function ()
{
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class)->names('users');

Route::resource('bulletin-board', BulletinBoardController::class)->names('bulletin-board');

Route::resource('bulletin-boards/{bulletinBoard}/posts/{post}/comments', CommentController::class)->names('comments');

Route::resource('bulletin-boards/{bulletinBoard}/posts', PostController::class)->names('posts');

Route::view('/register/success', 'auth.register-success')->name('register.success');
















// Route::group([
//     'as' => 'users.',
//     'prefix' => 'users',
// ], function() {
//     Route::get('/', [UserController::class, 'index'])->name('index');
//     Route::get('/create', [UserController::class, 'create'])->name('create');
//     Route::post('/', [UserController::class, 'store'])->name('store');
//     Route::get('/{user}', [UserController::class, 'show'])->name('show');
//     Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
//     Route::put('/{user}', [UserController::class, 'update'])->name('update');
//     Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
// });
// Route::group([
//     'as' => 'bulletin-board.',
//     'prefix' => 'bulletin-board',
// ], function () {
//     Route::get('/', [BulletinBoardController::class, 'index'])->name('index');
//     Route::get('/create', [BulletinBoardController::class, 'create'])->name('create');
//     Route::get('/edit/{id}', [BulletinBoardController::class, 'edit'])->name('edit');
//     Route::get('/show/{id}', [BulletinBoardController::class, 'show'])->name('show');
// });
// Route::group([
//     'as' => 'posts.',
//     'prefix' => 'bulletin-boards/{bulletinBoard}/posts',
// ], function() {
//     Route::get('/', [PostController::class, 'index'])->name('index');
//     Route::get('/create', [PostController::class, 'create'])->name('create');
//     Route::get('/{post}', [PostController::class, 'show'])->name('show');
//     Route::post('/', [PostController::class, 'store'])->name('store');
// });
