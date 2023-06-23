<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\BulletinBoardController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->as('api.v1.')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('users', UserController::class)->except(['show', 'update', 'destroy'])->names('users');
    Route::get('users/{email}', [UserController::class, 'show'])->name('users.show');
    Route::match(['put', 'patch'], 'users/{email}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{email}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::middleware('auth:sanctum')->group(function () {
        Route::resource('bulletin-boards', BulletinBoardController::class)->names('bulletin-board');

        Route::resource('bulletin-boards/{bulletinBoard}/posts', PostController::class)->except(['update', 'destroy'])->names('posts');
        Route::match(['put', 'patch'], 'bulletin-boards/{bulletinBoard}/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('bulletin-boards/{bulletinBoard}/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

        Route::resource('bulletin-boards/{bulletinBoard}/posts/{post}/comments', CommentController::class)
            ->except(['destroy'])
            ->names('comments');
        Route::delete('bulletin-boards/{bulletinBoard}/posts/{post}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });
});
