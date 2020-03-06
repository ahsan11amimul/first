<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
     public function products()
    {
        return $this->hasMany('App\Product');
    } 
      public static function totalItem()
   {
       if(Auth::check()){
        $wishlist=Wishlist::where('user_id',Auth::user()->id)
       ->orWhere('session_id',Session('session_id'))->get();
       }else{
             $wishlist=Wishlist::where('session_id',Session('session_id'))->get();
       }
     
       $i=0;
       foreach($wishlist as $item)
       {
           $i++;
       }
       return $i;
   }
 
   public static function wishItem()
   {
       if(Auth::check()){
            $wishlist=Wishlist::where('user_id',Auth::user()->id)
       ->orWhere('session_id',Session('session_id'))->get();
       }else{
            $wishlist=Wishlist::where('session_id',Session('session_id'))->get();
       }
     
      
       return $wishlist;
   }
}
