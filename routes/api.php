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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('register',[App\Http\Controllers\API\RegisterController::class, 'register']);
Route::post('store',[App\Http\Controllers\API\Cursos_Controller::class, 'store']);
Route::post('login',[App\Http\Controllers\API\RegisterController::class, 'login']);


Route::middleware('auth:api')
    ->post('logout',[App\Http\Controllers\API\RegisterController::class, 'logout']);
Route::middleware('auth:api')
    ->get('user', [App\Http\Controllers\API\RegisterController::class, 'user']);

Route::middleware('auth:api')
    ->put('user', [App\Http\Controllers\API\RegisterController::class, 'userUpdate']);

