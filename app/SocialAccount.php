<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider_id', 'token',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
