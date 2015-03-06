<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\User;
use Session;

class HomeController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    protected $upload;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {
        if (Auth::check()) {
            return redirect('usuari/'.Auth::user()->name);
        }
            
        return view('home');
    }
    
    public function profile() {
        
    
        Session::put('usuari',Auth::user());
        return view('home');
    }

    public function upload(Request $request) {
       
        $rules = array('image' => 'required|mimes:jpeg,jpg,png,jpg');
        
        $file = array('image' => $request->file('imatge'));

        $validator = Validator::make($file, $rules);
        
        if ($validator->fails()) { 
            return redirect('home')->withInput()->withErrors($validator);
        } else {
            
            if ($request->file('imatge')->isValid()) {
                $destinationPath = 'img/' . Auth::user()->name . '/imgProfile';
                $extension = $request->file('imatge')->getClientOriginalExtension();
                $fileName = rand(11111, 99999) . '.' . $extension;
                $user = User::where('id', Auth::user()->id)->first();
                $user->fotografiaPerfil = $destinationPath . "/" . $fileName;
                $user->save();
                $request->file('imatge')->move($destinationPath, $fileName);
                return redirect('usuari/profile/'.Auth::user()->name);
            }
        }
    }

}
