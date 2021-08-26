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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['namespace' => 'Dashboard', 'middleware' => ['auth']], function () {
    // Kaegori
    Route::apiResource('kategori', 'KategoriController');
    Route::match(['get', 'post'], 'kategori/datatable', 'KategoriController@datatable')->name('kategori.datatable');

    Route::apiResource('satuan', 'SatuanController');
    Route::match(['get', 'post'], 'satuan/datatable', 'SatuanController@datatable')->name('satuan.datatable');
});

require __DIR__.'/auth.php';
