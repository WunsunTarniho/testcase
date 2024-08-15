<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\SelectItemController;
use App\Http\Controllers\StockIssueController;
use App\Http\Controllers\StockIssueDetailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth'], function(){
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/me', [UserController::class, 'me']);
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::get('/v1/selectOption', SelectItemController::class)->middleware('auth:api');

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1/item'], function(){
    Route::get('/list', [ItemController::class, 'index']);
    Route::get('/{id}', [ItemController::class, 'show']);
    Route::post('', [ItemController::class, 'store']);
    Route::put('/save', [ItemController::class, 'update']);
    Route::delete('/delete', [ItemController::class, 'destroy']);
});

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1/stockissue'], function(){
    Route::get('/list', [StockIssueController::class, 'index']);
    Route::post('', [StockIssueController::class, 'store']);
    Route::get('/detail', [StockIssueDetailController::class, 'index']);
    Route::get('/{id}', [StockIssueController::class, 'show']);
    Route::put('/save', [StockIssueController::class, 'update']);
    Route::delete('/delete', [StockIssueController::class, 'destroy']);

    Route::post('/detail', [StockIssueDetailController::class, 'store']);
    Route::put('/detail', [StockIssueDetailController::class, 'update']);
    Route::delete('/detail/{id}', [StockIssueDetailController::class, 'destroy']);
});