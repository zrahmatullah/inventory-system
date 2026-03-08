<?php

use App\Core\Http\Controllers\MenuController;
use App\Core\Http\Controllers\ModuleController;
use App\Http\Controllers\AuthController;
use App\Core\Http\Controllers\UserMenuController;

use Illuminate\Support\Facades\Route;

Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class,'me']);

    Route::post('/logout',[AuthController::class,'logout']);

});

Route::prefix('modules')->group(function () {

    Route::get('/', [ModuleController::class,'index']);
    Route::get('/{id}', [ModuleController::class,'show']);

    Route::post('/', [ModuleController::class,'store']);
    Route::put('/{id}', [ModuleController::class,'update']);

    Route::delete('/{id}', [ModuleController::class,'destroy']);

});

Route::prefix('menus')->group(function () {

    Route::get('/', [MenuController::class,'index']);
    Route::get('/{id}', [MenuController::class,'show']);

    Route::post('/', [MenuController::class,'store']);
    Route::put('/{id}', [MenuController::class,'update']);

    Route::delete('/{id}', [MenuController::class,'destroy']);

});

Route::prefix('user-menus')->group(function () {

    Route::get('/', [UserMenuController::class,'index']);

    Route::get('/user/{id}', [UserMenuController::class,'userMenus']);

    Route::get('/{id}', [UserMenuController::class,'show']);

    Route::post('/', [UserMenuController::class,'store']);

    Route::put('/{id}', [UserMenuController::class,'update']);

    Route::delete('/{id}', [UserMenuController::class,'destroy']);

});