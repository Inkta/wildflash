<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class DashboardController extends Controller {

    public function getAddFriend($id) {

        //$user = \DB::table('users')->where('id',$id)->first();

        $user = User::find($id);


        Auth::user()->addFriend($user);

        return redirect()->back();
    }

    public function getRemoveFriend($id) {
        $user = User::find($id);
        Auth::user()->removeFriend($user);
        return redirect()->back();
    }

    public function getIndex() {
        $not_friends = User::where('id', '!=', Auth::user()->id);
        if (Auth::user()->friends->count()) {
            $not_friends->whereNotIn('id', Auth::user()->friends->modelKeys());
        }
        $not_friends = $not_friends->get();
        
  

        return view('dashboard.index')->with('not_friends', $not_friends);
    }

}
