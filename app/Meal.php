<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'category_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function scheduling() {
        return $this->hasMany('App\MealScheduling');
    }
}
