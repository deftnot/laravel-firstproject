<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

/** Public routes * */
Route::get('/', 'HomeController@index');
Route::get('/login', "HomeController@index");
Route::get('/register', 'HomeController@registerForm');


Route::get('/logout', function() {
            Auth::logout();
            return Redirect::to('/');
        });

Route::group(
        array('before' => 'csrf'), function() {
            Route::post('/register', 'HomeController@register');
            Route::post('/login', 'HomeController@doLogin');
        }
);

/** End Public Routes * */
/* * * User Routes  * */
Route::group(['before' => 'auth'], function() {
            Route::get('usuario', 'UsuarioController@index');
            Route::get('usuario/perfiles', 'UsuarioController@perfiles');
            Route::post('usuario/sendFoto', 'UsuarioController@uploadFoto');
            Route::group(['before' => 'ajax|csrf'], function() {
                        Route::post('usuario/informacion', 'UsuarioController@savePersonal');
                        Route::post('usuario/perfiles', 'UsuarioController@addPerfiles');
                    });
        });

/** End User Routes * */
/** Recursos Routes * */
Route::group(['before' => 'ajax'], function() {
            Route::post('ciudades', 'RecursosController@ciudades');
        });
/** End Recursos Routes * */
