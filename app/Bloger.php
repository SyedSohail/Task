<?php

namespace App;


use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Bloger extends Authenticatable
{
	use HasApiTokens,Notifiable;
	
	protected $guard = 'bloger';

	protected $fillable = [
         'email', 'password','role'
    ]; 

    public function Blog()
    {
        return $this->hasMany('App\Blog');
    }
}
