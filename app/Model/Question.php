<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'title',
    ];

    protected $with = [
        'options',
    ];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
