<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
     public function  products()
     {
         return $this->hasMany('App\Product');
     }
     public function role()
     {
         return $this->belongsTo('App\Role');
        
     }
     public function accounts()
     {
        return $this->hasMany(Account::class);
     }
     public function orders()
     {
        return $this->hasMany('App\Order');
     }
      public function wishlist()
      {
          return $this->hasOne('App\Wishlist');
      }
      public function messages()
     {
        return $this->hasMany('App\Message');
     }
     public function area()
     {
         return $this->belongsTo('App\Area');
     }
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
}
