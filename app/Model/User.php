<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'employee_id', 'designation', 'doj', 'photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function options(){
        return $this->belongsToMany(Option::class,'option_user','employee_id','option_id')/*->withPivot('')*/;
    }

    public function getDojReadableAttribute(){
        $durationReadable = Carbon::parse($this->doj)->diffForHumans();
        $duration = str_replace('ago','', $durationReadable);

        return $duration;
    }
}
