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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/status', 'App\Http\Controllers\Api\ProdutoController@status'); //APAGAR


Route::namespace('App\Http\Controllers\Api')->group( function() {

    Route::post('/produtos/add', 'ProdutoController@add');

    Route::get('/produtos/list', 'ProdutoController@list');

    Route::get('/produtos/{id}', 'ProdutoController@listById');

    Route::put('/produtos/{id}', 'ProdutoController@update');

    Route::delete('/produtos/{id}', 'ProdutoController@delete');

});
