<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'employee_id', 'designation', 'doj', 'photo', 'password',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
