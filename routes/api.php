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

// Auth
Route::group(['prefix' => 'v1/auth', 'namespace' => 'Api\V1'], function () {
    Route::post('login', 'AuthController@login')->name('api.v1.auth.login');
    Route::post('logout', 'AuthController@logout')->name('api.v1.auth.logout');
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1', 'middleware' => ['jwt.verify']], function () {
    Route::apiResource('kategori', 'KategoriController')->names('api.v1.kategori');
    Route::apiResource('satuan', 'SatuanController')->names('api.v1.satuan');
});
