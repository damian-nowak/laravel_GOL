<?php

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
    return view('start');
});

Route::get('/start/{type}','GameOfLifeController@start');
Route::post('/next/{id}','GameOfLifeController@next');
Route::post('/prev/{id}','GameOfLifeController@prev');
