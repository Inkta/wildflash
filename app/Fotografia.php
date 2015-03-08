<?php

namespace App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Illuminate\Database\Eloquent\Model;
use App\Fotografia;
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
    
    public function likes() {
        return $this->hasMany('App\User','likes_photos','user_id','fotografia_id');
    }
    
    public function createJson(Fotografia $fotografia) {
        $comments = $fotografia->comentaris;
        foreach($comments as $comment) {
            $comment->user_id = $comment->user;
        }
        $json = json_encode($comments);
        return $json;
        
    }

}
