<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealScheduling extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'meal_id', 'weekday_id', 'schedule_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function meal() {
        return $this->belongsTo('App\Meal');
    }

    public function weekday() {
        return $this->belongsTo('App\Weekday');
    }

    public function schedule() {
        return $this->belongsTo('App\Schedule');
    }
}
