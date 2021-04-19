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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::apiResource('books', 'BookController')->except('update');

//Route::get('/books', 'BookController@index')->name('listar');
//Route::get('/books/{book}', 'BookController@show')->name('ver detalle');
//Route::post('/books', 'BookController@store')->name('crear');
//Route::post('/books/{book}', 'BookController@destroy')->name('eliminar');