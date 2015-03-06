<?php

use App\User;

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
        if (!Agent::isMobile()) {
            $validar = true;
        } else {
            $validar = false;
        }

        

        
        $result = User::where('name', $nom)->first();

        $user = Auth::user();

       
        return view('home')->with('perfil', $result)->with('usuariProfile', $user)->with('mobil', $validar);
    });

    Route::controller('dashboard', 'DashboardController');

    Route::get('usuari/json/{nom}', function($nom) {
        $user = User::where('name', $nom)->first();
        $json = $user->createJson($user);
        return response($json)->header('Content-Type', 'application/json');
    });
    
    Route::get('usuari/profile/{nom}/maps','ImatgeController@personalizar');
    
    Route::get('guardarmapa/{nom}',function($nom) {
        $pos = strrpos($nom,".");
        $nom = substr($nom,0,$pos);
        $user = Auth::user();
        $user->mapa = $nom;
        $user->save();
        return redirect('usuari/profile/' . $user->name);
    });
    
});





Route::controllers([

    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::post('imatge', 'ImatgeController@getAddPhoto');
