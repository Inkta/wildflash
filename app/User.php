<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Fotografia;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function fotografies() {
        return $this->hasMany('App\Fotografia');
    }

    public function friends() {
        return $this->belongsToMany('App\User', 'friends_users', 'user_id', 'friend_id');
    }
    
    public function likes() {
        return $this->belongsToMany('App\Fotografia','likes_photos','user_id','fotografia_id');
    }

    public function addFriend(User $user) {
        
        $this->friends()->attach($user->id);
    }
    
    public function addLike(Fotografia $fotografia) {
        $this->fotografies()->attach($fotografia->id);
    }

    public function removeFriend(User $user) {
        $this->friends()->detach($user->id);
    }
    
    public function createJson(User $user) {
        $fotos = $user->fotografies;
        
        $json_fotos = json_encode($fotos);
        
        
        
        return $json_fotos;
        
    }

}
