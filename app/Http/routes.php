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
//
//Las siguientes rutas se definen como pruebas para verificar
// el acceso a las distintas clases

/* Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
    return view('login');
});

Route::get('home', function () {
    return view('home');
});

*/

Route::get('login', 'Auth\AuthController@getLogin');
//Cuando se hace login y se entra al sistema post
Route::post('login', ['as' =>'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);


Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

/* ya estan parametrizadas en el AuthController (personalizado) */
