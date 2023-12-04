<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BulletinBoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Test\TestController;

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

Auth::routes(['verify' => true]);

Route::get('/home', [WelcomeController::class, 'index'])->name('home');

Route::get('/laravel', function ()
{
    return view('laravel');
});

Route::resource('users', UserController::class)->names('users');

Route::view('/register/success', 'auth.register-success')->name('register.success');

Route::resource('bulletin-boards', BulletinBoardController::class)->names('bulletin-boards');

Route::resource('bulletin-boards/{bulletinBoard}/posts', PostController::class)->names('posts');

Route::get('bulletin-boards/{bulletinBoard}/posts-export', [PostController::class, 'export'])->name('posts.export');

Route::resource('bulletin-boards/{bulletinBoard}/posts/{post}/comments', CommentController::class)
    ->except('destroy')
    ->names('comments');
Route::delete('bulletin-boards/{bulletinBoard}/posts/{post}/comments/{comment}', [CommentController::class, 'destroy']);

Route::group([
    'prefix' => 'test',
    'as' => 'test.'
], function () {

    Route::get('select', [TestController::class, 'select'])
        ->name('select');

    Route::get('sortable', [TestController::class, 'sortable'])
        ->name('sortable');

});
