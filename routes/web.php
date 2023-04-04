<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\MasterDataModelController;
use App\Http\Controllers\KasirController;

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
})->name('welcome');

Route::controller(loginController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::get('/logout', 'logout')->name('logout');
});

Route::group([
    'prefix' => 'masterData',
    'as' => 'masterData.',
    'controller' => MasterDataModelController::class,
],function () {
    Route::get('/index', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::post('/update/{id}', 'update')->name('update');
    Route::get('/destroy/{id}', 'destroy')->name('destroy');
    Route::get('/edit', 'edit')->name('edit');
});

Route::group([
    'prefix' => 'kasir',
    'as' => 'kasir.',
    'controller' => KasirController::class,
],function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::get('/show', 'show')->name('show');
    Route::post('/store', 'store')->name('store');
    Route::post('/update/{id}', 'update')->name('update');
    Route::get('/bayar/{id}', 'bayar')->name('bayar');
    Route::get('/laporan', 'laporan')->name('laporan');
    Route::get('/destroy/{id}', 'destroy')->name('destroy');
    Route::get('/edit', 'edit')->name('edit');
});
