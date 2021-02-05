<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeekdaySchedule extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'weekday_id', 'schedule_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function weekday() {
        return $this->belongsTo('App\Weekday');
    }

    public function schedule() {
        return $this->belongsTo('App\Schedule');
    }
}
