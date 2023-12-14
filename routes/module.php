<?php

// use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\ModuleController;
// use App\Http\Controllers\ModuleController as ControllersModuleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'd',
    'as' => 'modules.',
    // 'middleware' => 'auth'
], function () {
    Route::get('/view', [ModuleController::class, 'index'])->name('index');
    Route::get('/home', [ModuleController::class, 'home'])->name('home');

    // // did
    // Route::get('/did', [ControllersModuleController::class, 'index']);

    /**
     * 기기 로그인 화면
     */
    // Route::get('{device_type}', [ModuleController::class, 'login'])->name('login');
    Route::get('/pos', [ModuleController::class, 'login'])->name('login');

    // /**
    //  * 기기 로그인
    //  */
    // Route::post('login', [ModuleController::class, 'store'])->name('store');

    // /**
    //  * 기기 선택 화면
    //  */
    // Route::get('{device_type}/device', [ModuleController::class, 'device'])->name('device');

    // /**
    //  * 기기 선택
    //  */
    // Route::post('select', [ModuleController::class, 'select'])->name('select');

});

Route::group([
    'prefix' => 'v',
    // 'middleware' => 'auth'
], function () {
    // 모듈 기기 화면 출력
    Route::get('/did/{vuePage?}', [ModuleController::class, 'show'])->where('vuePage', '[\/\w\.-]*');

    /**
     * 기기 화면
     */
    Route::get('{deviceType}/{vue_page?}', [ModuleController::class, 'moduleHome'])->where('vue_page', '[\/\w\.-]*');
});
