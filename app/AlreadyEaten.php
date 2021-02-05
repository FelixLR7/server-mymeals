<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlreadyEaten extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'meal_id'
    ];
}
