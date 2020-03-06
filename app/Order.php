<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Order extends Model
{
   protected $guarded=[];
   public function user()
   {
       return $this->belongsTo('App\User');
   }
   public function orderItems()
   {
    return $this->hasMany('App\OrderItem');
        
   }
   public function payment()
   {
     return $this->hasOne('App\Payment');
   }
     public static function totalItem()
   {
       $orders=Order::where('user_id',Auth::user()->id)->get();
    
       return $orders->count();
   }
     public static function totalCost()
   {
       $orders=Order::where('status',1)->get();
       $total=0;
       foreach($orders as $item)
       {
         $total+=$item->total;
       }
    
       return $total;
   }

    public function scopeWhereDateBetween($query,$fieldName,$fromDate,$todate)
    {
        return $query->whereDate($fieldName,'>=',$fromDate)->whereDate($fieldName,'<=',$todate);
    }
}
