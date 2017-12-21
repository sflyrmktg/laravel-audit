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

Route::resource('records', 'RecordController');
Route::post('records/partialupdate', array('as' => 'records.partialupdate', 'uses' => 'RecordController@partialUpdate'));
Route::post('records/clone', array('as' => 'records.clone', 'uses' => 'RecordController@clone'));

Route::resource('methods','MethodController');
Route::resource('methods/{method}/records','RecordController@indexMethod');

Route::resource('concepts','ConceptController');
Route::resource('concepts/{concept}/records','RecordController@indexConcept');
