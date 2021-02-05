<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'date', 'meal_id', 'schedule_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
