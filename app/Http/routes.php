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

Route::get('/', 'WelcomeController@index');


Route::get('home', 'HomeController@index');

Route::group(['before' => 'auth'], function() {

    Route::get('usuari/{nom}', 'HomeController@profile');

    Route::post('upload', 'HomeController@upload');

    Route::post('usuari', function() {

        $result = \DB::table('users')
                        ->where('name', Request::only('profile'))->first();
        return redirect('usuari/profile/' . $result->name);
    });

    Route::get('usuari/profile/{nom}', function($nom) {
        if (Agent::isMobile()) {
            $validar = true;
        } else {
            $validar = false;
        }

        $result = \DB::table('users')
                        ->where('name', $nom)->first();
        $user = Auth::user();
        $fotografies = DB::table('fotografies')->where('user_id',Auth::user()->id)->get();
        return view('home')->with('perfil', $result)->with('usuariProfile', $user)->with('mobil', $validar)
                ->with('fotografies',$fotografies);
    });

    Route::controller('dashboard', 'DashboardController');
});


Route::controllers([

    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::post('imatge', 'ImatgeController@getAddPhoto');
