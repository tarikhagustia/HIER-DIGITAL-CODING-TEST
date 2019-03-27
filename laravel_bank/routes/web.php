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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/topup', 'TopupController@index')->name('topup');
    Route::post('/topup', 'TopupController@store')->name('topup');

    Route::get('/withdrawal', 'WithdrawalController@index')->name('withdrawal');
    Route::post('/withdrawal', 'WithdrawalController@store')->name('withdrawal');

    Route::get('/transfer', 'TransferController@index')->name('transfer');
    Route::post('/transfer', 'TransferController@store')->name('transfer');

    Route::get('/reports/mutation', 'MutationController@report')->name('report.mutation');
});
