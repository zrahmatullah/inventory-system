<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelompokUserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMenuController;
use Illuminate\Support\Facades\Route;


Route::post('/login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class,'me']);

    Route::post('/logout',[AuthController::class,'logout']);

    Route::get('/sidebar',[SidebarController::class,'index']);


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

    Route::prefix('kelompok-users')->group(function(){

        Route::get('/',[KelompokUserController::class,'index']);

        Route::get('/{id}',[KelompokUserController::class,'show']);

        Route::post('/',[KelompokUserController::class,'store']);

        Route::put('/{id}',[KelompokUserController::class,'update']);

        Route::delete('/{id}',[KelompokUserController::class,'destroy']);

    });

    Route::prefix('users')->group(function(){

        Route::get('/',[UserController::class,'index']);

        Route::get('/{id}',[UserController::class,'show']);

        Route::post('/',[UserController::class,'store']);

        Route::put('/{id}',[UserController::class,'update']);

        Route::delete('/{id}',[UserController::class,'destroy']);

    });

});