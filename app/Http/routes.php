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
//Rutas para notas.
Route::get('notes/all','NotesController@getAll');
Route::get('notes/{id}','NotesController@get');
Route::post('notes/new','NotesController@create');
Route::post('notes/{id}/edit','NotesController@update');
Route::post('notes/{id}/delete','NotesController@delete');
