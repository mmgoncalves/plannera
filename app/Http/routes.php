<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {return view('produto'); });

Route::group(['prefix' => 'prod'], function(){
    Route::post('add', 'ProdutoController@add');

    Route::get('all', 'ProdutoController@all');

    Route::get('validaCodigo/{cod}', 'ProdutoController@validaCodigo');

    Route::get('estatistica/{num}', 'ProdutoController@estatistica');
});
