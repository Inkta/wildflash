<?php

namespace App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fotografia
 *
 * @author victor
 */
class Fotografia extends Eloquent {

    protected $table = 'fotografies';

    public function user() {
        return $this->belongsTo('User');
    }

    public function comentaris() {
        return $this->hasMany('Comentari');
    }

}
