<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/test-db', [App\Http\Controllers\TestController::class, 'testConnection']);

Route::prefix('users')->group(function () {
    Route::get('', [App\Http\Controllers\IndexController::class, 'showTable']);
    Route::post('/add',  [App\Http\Controllers\IndexController::class, 'addUser']);
    Route::get('{id}/edit', [App\Http\Controllers\IndexController::class, 'editUser']);
    Route::put('{id}/update', [App\Http\Controllers\IndexController::class, 'addUser']);;
    Route::delete('{id}/delete', [App\Http\Controllers\IndexController::class, 'adddelete']);;
});
