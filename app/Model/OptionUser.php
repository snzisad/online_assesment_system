<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OptionUser extends Model

{

    protected $table = 'option_users';
    
    //
    protected $fillable = [
        'employee_id', 'question_id', 'option_id', 'mark',
    ];

    // protected $with = [
    //     'question', 
    //     'checked_option',
    // ];

    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }

    public function question()
    {
        return $this->hasOne(Question::class, 'id', 'question_id');
    }

    public function checked_option()
    {
        return $this->hasOne(Option::class, 'id', 'option_id');
    }

}
