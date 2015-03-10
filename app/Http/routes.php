<?php

use App\User;
use App\Fotografia;
use App\Comentari;
use Jenssegers\Agent\Facades\Agent;

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::group(['before' => 'auth'], function() {

    //Route::get('usuari/{nom}', 'HomeController@profile');

    Route::post('upload', 'HomeController@upload');

    Route::get('usuari', function() {
        if (Agent::isMobile()) {
            return redirect('news');
        } else {
            return redirect('usuari/profile/' . Auth::user()->name);
        }
    });
    
    Route::post('usuari', function() {
        
        $result = \DB::table('users')
                        ->where('name', Request::only('profile'))->first();
        if ($result == null)
            return redirect()->back();

        return redirect('usuari/profile/' . $result->name);
    });

    Route::get('usuari/profile/{nom}', function($nom) {
        if (!Session::has('usuari'))
            Session::put('usuari', Auth::user());

        if (!Agent::isMobile()) {
            $validar = true;
        } else {
            $validar = false;
        }
        $result = User::where('name', $nom)->first();
        if ($result != null) {
        $user = Auth::user();
        $friend = DB::table('friends_users')->where('user_id', $user->id)->where('friend_id', $result->id)->first();

        $bool = ($friend != null) ? true : false;

        return view('home')->with('perfil', $result)->with('usuariProfile', $user)->with('mobil', $validar)->with('bool', $bool);
        } else {
            return redirect()->back();
        }
    });

    Route::controller('dashboard', 'DashboardController');

    Route::get('usuari/profile/json/{nom}', function($nom) {
        $user = User::where('name', $nom)->first();
        $json = $user->createJson($user);
        return response($json)->header('Content-Type', 'application/json');
    });

    Route::get('news/json/{id}', function($id) {
        $fotografia = Fotografia::find($id);
        $json = $fotografia->createJson($fotografia);
        return response($json)->header('Content-Type', 'application/json');
    });

    Route::get('usuari/profile/{nom}/maps', 'ImatgeController@personalizar');

    Route::get('guardarmapa/{nom}', function($nom) {
        $pos = strrpos($nom, ".");
        $nom = substr($nom, 0, $pos);
        $user = Auth::user();
        $user->mapa = $nom;
        $user->save();
        return redirect('usuari/profile/' . $user->name);
    });

    Route::get('usuari/profile/imatge/{id}', function($id) {
        $foto = Fotografia::find($id);
        return view('showImagePC')->with('foto', $foto);
    });

    Route::post('comments/{id}', function($id) {
        $comentari = new Comentari();
        $comentari->comentari = Request::input('comentari');
        $comentari->user_id = Auth::user()->id;
        $comentari->fotografia_id = $id;
        $comentari->save();
        return redirect()->back();
    });

    
    Route::post('cancelar', function() {
        $name = Request::input('path');
        $tempDestinationPath = 'img/' . Auth::user()->name . '/temporals';
        unlink($tempDestinationPath."/".$name);
        return redirect('usuari/profile/' . Auth::user()->name);
    });
    
    Route::get('news/', function() {

        $photos_friends = array();
        $id = Auth::user()->id;
        $friends = Auth::user()->friends;


        foreach ($friends as $friend) {
            array_push($photos_friends, $friend->id);
        }

        $photos = Fotografia::whereIn('user_id', $photos_friends)->orderBy('created_at', 'DESC')->paginate(10);
        $likes = DB::table('likes_photos')->where('user_id', $id)->lists('fotografia_id');
        $photos->setPath('news');

        if (Agent::isMobile()) {
            return view('newsMob')->with('fotos', $photos)->with('likes', $likes);
        } else {
            return view('newsPC')->with('fotos', $photos)->with('likes', $likes);
        }
    });

    Route::get('like/{id}', array('uses' => 'DashboardController@getAddLike'));
    
    Route::post('imatge', 'ImatgeController@getAddPhoto');
    
    Route::post('uploadImage',function() {
            $destinationPath = 'img/' . Auth::user()->name . '/temporals';
            $extension = Request::file('image')->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            Request::file('image')->move($destinationPath, $fileName);
        return view('upload')->with('imatge',Request::file('image'))->with('path',$fileName);
    });
 
});


Route::controllers([

    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


