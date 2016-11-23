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
Route::group(['prefix' => 'api'], function(){
    Route::group(['prefix' => 'notes'],function(){
        Route::get('','NotesController@getAll');
        Route::get('/{id}','NotesController@get');
        Route::post('','NotesController@create');
        Route::put('/{id}','NotesController@update');
        Route::delete('/{id}','NotesController@delete');
    });
    Route::group(['prefix' => 'groups'],function(){
        Route::get('','GroupsController@getAll');
        Route::get('/{id}','GroupsController@get');
        Route::post('','GroupsController@create');
        Route::put('/{id}','GroupsController@update');
        Route::delete('/{id}','GroupsController@delete');
        Route::get('/{id}/notes','GroupsController@getNotes');
    });
    Route::group(['prefix' => 'auth'],function(){
        Route::post('/login','UserController@login');
        Route::post('/register','UserController@register');
    });

    Route::group(['prefix' => 'user'], function(){
        Route::get('/{id}/notes', 'UserController@getNotes');
        Route::get('/{id}/groups', 'UserController@getGroups');
    });
});
