<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VideoAnswer extends Model
{
    //
    protected $fillable = [
        'employee_id', 'question_id', 'video'
    ];
    
    // protected $with = [
    //     'question',
    // ];

    
    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }

    public function question()
    {
        return $this->hasOne(VideoQuestion::class, 'id', 'question_id');
    }


}
