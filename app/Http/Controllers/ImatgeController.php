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
            $tempDestinationPath = 'img/' . Auth::user()->name . '/temporals';
            $destinationPath = 'img/' . Auth::user()->name . '/fotografies';
            $fileName = $request->input('path');
            rename($tempDestinationPath."/".$fileName,$destinationPath."/".$fileName);
            $fotografia = new Fotografia();
            $fotografia->path = $destinationPath . '/' . $fileName;
            $fotografia->nom = $request->input('titol');
            $fotografia->user_id = Auth::user()->id;
            $fotografia->latitud = $request->input('latitud');
            $fotografia->longitud = $request->input('longitud');
            $fotografia->save();
            return redirect('usuari/profile/' . Auth::user()->name);
    }


    public function personalizar() {
        $fotos = array();
        $directory = "imgMaps";
        $dirint = dir($directory);
        while (($archivo = $dirint->read()) !== false) {
            $fotos[$archivo] = $directory . "/" . $archivo;
        }
        
        $dirint->close();
        array_splice($fotos, 0, 1);
        array_splice($fotos, count($fotos) - 1, 1);
        return view('maps')->with('mapas',$fotos);
    }

}
