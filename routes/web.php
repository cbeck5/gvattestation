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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'AttestationController@send');

//Route::get('/', 'AttestationController@orderPdf');


Route::get('/pdf', ['as' => 'order.pdf', 'uses' => 'AttestationController@orderPdf']);
