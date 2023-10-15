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

Route::prefix('users')->group(function () {
    Route::get('/all', [App\Http\Controllers\Api\UserController::class, 'showTable']);
    Route::post('/add', [App\Http\Controllers\Api\UserController::class, 'addUser']);
    Route::put('{id}/update', [App\Http\Controllers\Api\UserController::class, 'updateUser']);
    Route::delete('{id}/delete', [App\Http\Controllers\Api\UserController::class, 'deleteUser']);
});



