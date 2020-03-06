<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded=[];
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
     public function orderItem()
    {
        return $this->belongsTo('App\OrderItem');
    }
    public function wishlist()
    {
        return $this->belongsTo('App\Wishlist');
    }

public static function totalPrice()
   {
       $products=Product::where(['status'=>1,'is_verified'=>1])->get();
       $total=0;
       foreach($products as $item)
       {
         $total+=($item->price*$item->quantity);
       }
    
       return $total;
   }
    
}
