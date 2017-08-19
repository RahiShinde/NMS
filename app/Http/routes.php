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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notes', array('before' => 'auth', 'uses' => 'NotesController@index'));

Route::get('notes/show/{id?}', array('before' => 'auth', 'uses' => 'NotesController@show','as'=>'notes.show'));

Route::post('/notes', array('before' => 'auth', 'uses' => 'NotesController@store'));

Route::delete('notes/delete/{id?}', array('before' => 'auth', 'uses' => 'NotesController@destroy','as'=>'notes.destroy'));

Route::post('notes/update/{id?}', array('before' => 'auth', 'uses' => 'NotesController@update','as'=>'notes.update'));

Route::auth();

Route::get('/home', 'HomeController@index');
