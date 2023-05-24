<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->as('api.v1.')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::resource('users', UserController::class)->names('users');
        Route::resource('bulletin-boards', BulletinBoardController::class)->names('bulletin-board');
        Route::resource('bulletin-boards/{bulletinBoard}/posts', PostController::class)->names('posts');
        Route::resource('bulletin-boards/{bulletinBoard}/posts/{post}/comments', CommentController::class)
            ->except('destroy')
            ->names('comments');
        Route::delete('/bulletin-boards/{bulletinBoard}/posts/{post}/comments/{comment}', [CommentController::class, 'destroy']);
    });
});
