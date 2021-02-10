<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    protected $fillable = [
        'question_id', 'title', 'mark',
    ];


    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'option_users','option_id','employee_id')/*->withPivot('')*/;
    }
}
