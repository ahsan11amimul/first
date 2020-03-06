<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   protected $guarded=[];
   
   public function order()
   {
       return $this->hasOne('App\Order');
   }
   public static function totalItem()
   {
       $cart=Cart::where('session_id',Session('session_id'))->get();
       $i=0;
       foreach($cart as $item)
       {
           $i+=$item->quantity;
       }
       return $i;
   }
    public static function totalPrice()
   {
       $cart=Cart::where('session_id',Session('session_id'))->get();
       $total=0;
       foreach($cart as $item)
       {
           $total+=($item->quantity*$item->price);
       }
       return $total;
   }
   public static function cartsItem()
   {
       $carts=Cart::where('session_id',Session('session_id'))->get();
      
       return $carts;
   }
}
