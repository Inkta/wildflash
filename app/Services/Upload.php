<?php namespace App\Services;

use Validator;
use Illuminate\Contracts\Auth\ValidateImage as Upload;

class Image implements Upload {

    public function validator(array $data) {
        return Validator::make($data, [
                    'image' => 'required|image'
        ]);
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

