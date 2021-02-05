<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function socialaccounts()
    {
        return $this->hasMany('App\SocialAccount');
    }

    public function meals() {
        return $this->hasMany('App\Meal');
    }

    public function mealScheduling() {
        return $this->hasMany('App\MealScheduling');
    }

    public function mealsByWeekdayAndSchedule($weekdayId, $scheduleId) {
        return $this->mealScheduling()->where([
            ['weekday_id', '=', $weekdayId],
            ['schedule_id', '=', $scheduleId]
        ])->pluck('meal_id');
    }

    public function weekdays() {
        return $this->weekdaySchedules()->selectRaw('weekday_id')->groupBy('weekday_id')->pluck('weekday_id');
    }

    public function schedules() {
        return $this->weekdaySchedules()->selectRaw('schedule_id')->groupBy('schedule_id')->pluck('schedule_id');
    }

    public function mealsIds() {
        return $this->meals()->selectRaw('id')->groupBy('id')->pluck('id');
    }

    public function weekdaySchedules() {
        return $this->hasMany('App\WeekdaySchedule');
    }

    public function categories()
    {
        return $this->hasMany('App\UserCategory');
    }

    public function days() {
        return $this->hasMany('App\Day');
    }

    public function alreadyEaten() {
        return $this->hasMany('App\AlreadyEaten');
    }

    public function alreadyEatenIds() {
        return $this->alreadyEaten()->pluck('meal_id');
    }
}
