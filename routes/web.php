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
})->middleware('guest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['namespace' => 'Dashboard', 'middleware' => ['auth']], function () {
    // Kategori
    Route::match(['get', 'post'], 'kategori/datatable', 'KategoriController@datatable')->name('kategori.datatable');
    Route::match(['get', 'post'], 'kategori/select2', 'KategoriController@select2')->name('kategori.select2');
    Route::apiResource('kategori', 'KategoriController');

    // Satuan
    Route::match(['get', 'post'], 'satuan/datatable', 'SatuanController@datatable')->name('satuan.datatable');
    Route::match(['get', 'post'], 'satuan/select2', 'SatuanController@select2')->name('satuan.select2');
    Route::apiResource('satuan', 'SatuanController');

    // Suplier
    Route::match(['get', 'post'], 'suplier/datatable', 'SuplierController@datatable')->name('suplier.datatable');
    Route::apiResource('suplier', 'SuplierController');

    // Produk
    Route::match(['get', 'post'], 'produk/datatable', 'ProdukController@datatable')->name('produk.datatable');
    Route::apiResource('produk', 'ProdukController');
});

require __DIR__.'/auth.php';
