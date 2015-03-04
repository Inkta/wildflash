<?php

namespace App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Illuminate\Database\Eloquent\Model;
/**
 * Description of Fotografia
 *
 * @author victor
 */
class Fotografia extends Model {

    protected $table = 'fotografies';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comentaris() {
        return $this->hasMany('App\Comentari');
    }

}
