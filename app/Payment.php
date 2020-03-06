<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
    public function order()
    {
       return $this->belongsTo('App\Order');
    }
     public static function totalCost()
   {
       $payments=Payment::where('from','01721544957')->get();
       $total=0;
       foreach($payments as $item)
       {
         $total+=$item->amount;
       }
    
       return $total;
   }
}
