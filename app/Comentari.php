<?php

namespace App;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
/**
 * Description of Comentari
 *
 * @author victor
 */
class Comentari extends Eloquent {

    protected $table = 'comentaris';

    public function fotografia() {
        return $this->belongsTo('Fotografia');
    }

    public function user() {
        return $this->belongsTo('User');
    }

}
