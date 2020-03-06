<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo('App\user');
    }
    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
