<?php

namespace App;


use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
	use HasApiTokens,Notifiable;
	
	protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password','role'
    ]; 
}
