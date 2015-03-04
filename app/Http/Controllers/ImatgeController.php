<?php

namespace App\Http\Controllers;

use App\Fotografia;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Comentari;

class ImatgeController extends Controller {

    public function getAddPhoto(Request $request) {
        
        if ($request->file('image')->isValid()) {
            $destinationPath = 'img/' . Auth::user()->name . '/fotografies';
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = rand(11111, 99999) . '.' . $extension;
            $request->file('image')->move($destinationPath, $fileName);
            $fotografia = new Fotografia();
            $fotografia->path = $destinationPath;
            $fotografia->nom = "titol proba";
            $fotografia->user_id = Auth::user()->id;
            $fotografia->latitud = $request->input('latitud');
            $fotografia->longitud = $request->input('longitud');
            $fotografia->save();
            return redirect()->back();
        }
    }

}
