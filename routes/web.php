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

Route::resource('zohoaccounts','ZohoAccountsController');
Route::get('/generateAccessToken', 'ZohoAccountsController@generateAccessToken');
Route::get('/syncZohoAccounts', 'ZohoAccountsController@syncZohoAccounts');
Route::get('/truncateZohoAccounts', 'ZohoAccountsController@truncateZohoAccounts');

Route::resource('quotation','QuotationController');
Route::post('productdetails','QuotationController@productdetails');
Route::post('customerdetails','QuotationController@customerdetails');
Route::get('denyograph','QuotationController@denyograph');
Route::get('denyograph1','QuotationController@denyograph1');
Route::get('googlechartdenyo','QuotationController@googlechartdenyo');

Route::resource('emailverification','EmailVerficationController');


Route::resource('gcalendar', 'gCalendarController');
Route::get('oauth', ['as' => 'oauthCallback', 'uses' => 'gCalendarController@oauth']);

Route::resource('possales','PossalesController');
Route::get('productdetails','PossalesController@productdetails');
Route::get('eachproductdetails','PossalesController@eachproductdetails');
Route::post('possalesstore','PossalesController@possalesstore');

Route::resource('vision', 'VisionController');




