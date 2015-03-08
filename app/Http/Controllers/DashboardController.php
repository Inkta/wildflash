<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Fotografia;

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

    public function getAddLike($id_photo) {

        $user = Auth::user();
        $fotografia = Fotografia::find($id_photo);

        if ($fotografia->user_id != $user->id) {
            $consulta = \DB::table('likes_photos')->where('user_id', $user->id)->where('fotografia_id', $fotografia->id)->get();

            if ($consulta == null) {
                \DB::table('likes_photos')->insert(['user_id' => $user->id, 'fotografia_id' => $fotografia->id]);
                $fotografia->puntuacio = $fotografia->puntuacio + 1;
                $fotografia->save();
                
            } else {
                \DB::table('likes_photos')->where('user_id', $user->id)->where('fotografia_id', $fotografia->id)->delete();
                $fotografia->puntuacio = $fotografia->puntuacio - 1;
                $fotografia->save();
            }
        }
        
        return redirect()->back();
    }

}
