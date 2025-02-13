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



Route::get('/productshell', [\App\Http\Controllers\API\ProductShellController::class, 'index']);
Route::get('/category', [\App\Http\Controllers\API\ProductShellController::class, 'cate']);

Route::post('/productgroup', [\App\Http\Controllers\API\ProductShellController::class, 'group']);
Route::post('/productgroupsave', [\App\Http\Controllers\API\ProductShellController::class, 'productgroupsave']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
