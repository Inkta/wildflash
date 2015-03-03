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

Route::get('usuari/{nom}',function($nom) {
    var_dump($nom);
    die();
    return $nom;
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::post('hola', function() {
    $data = Request::all();
    var_dump($data);
});

Route::post('upload', 'HomeController@upload');


Route::get('general', function() {
    $fotografies = DB::table('fotografies')->orderBy('created_at', 'desc')->get();
    return view('general')->with('fotografies',$fotografies);
});


Route::get('general/{id}',function($id) {
    $fotografia = DB::table('fotografies')->where('id',$id)->first();
    $autor = DB::table('users')->where('id',$fotografia->user_id)->first();
    $comentaris = DB::table('comentaris')->orderBy('created_at', 'desc')->where('fotografia_id',$id)->get();
    $comentaristes = array();
    for ($i =0; $i < count($comentaris); $i++) {
        $comentarista = DB::table('users')->where('id',$comentaris[$i]->user_id)->first();
        array_push($comentaristes,$comentarista);
    }
    
    return view('Imatge')->with(array('fotografia'=>$fotografia,'Autor'=>$autor->name,'comentaris'=>$comentaris,'comentaristes'=>$comentaristes));
});