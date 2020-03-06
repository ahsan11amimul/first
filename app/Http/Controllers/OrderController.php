<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Product;
use App\Cart;
use App\Category;
use App\User;
use App\Order;
use App\Account;
use App\Notifications\newOrder;
use App\Notifications\AccountUpdate;
use App\Area;
use App\OrderItem;
use App\Wishlist;
use App\Payment;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {   if(Cart::totalPrice()<=0)
        {
         return redirect('customer/index')->with('success','please purchased first');
        }
        $user_id=Auth::user()->id;
        $user=Auth::user()->where('id',$user_id)->first();
        $areas=Area::all();
        return view('customer.checkout',compact('user','areas'));

    }
    public function updateAdress(Request $request)
    {
         $validateData=$request->validate([
          'name'=>'required|min:3|max:60|string',
          'email'=>'required|email|string',
          'phone'=>'required|min:11|string',
          'address'=>'required|min:5',
          'area'=>'required',
        ]);
    DB::table('users')->where('id',$request->user_id)->update([
           'name'=>$validateData['name'],
           'email'=>$validateData['email'],
           'phone'=>$validateData['phone'],
           'address'=>$validateData['address'],
           'area_id'=>$validateData['area'],
       ]);
       return \redirect('customer\summary');
      
     
    }
    public function summary()
    {   
         if(Cart::totalPrice()<=0)
        {
         return  redirect('customer/index')->with('success','please purchased first');
        }
        
        $user_id=Auth::user()->id;
        $user=Auth::user()->where('id',$user_id)->first();
        $area_id=$user->area_id;
        $delivery_boy=User::where(['area_id'=>$area_id,'role_id'=>3])->first();
        
        return view('customer.summary',compact('user','delivery_boy'));
    }
    public function orderStore(Request $request)
    {
        $data=$request->all();
     
        $order=new Order();
        $order->user_id=$data['user_id'];
        $order->total=$data['total'];
        $order->delivered_by=$data['delivered_by'];
        $order->save();
        
        $order_id=$order->id;
        
          foreach(Cart::cartsItem() as $item)
        {
         $orderItem=new OrderItem();
         $orderItem->order_id=$order_id;
         $orderItem->product_id=$item->product_id;
         $orderItem->name=$item->name;
         $orderItem->quantity=$item->quantity;
         $orderItem->price=$item->price;
         $orderItem->total=$item->quantity*$item->price;
         $orderItem->save();
        }
        Wishlist::where(['user_id'=>0,'session_id'=>Session('session_id')])->delete();
        Cart::where('session_id',Session('session_id'))->delete();
        $request->session()->forget('session_id');
        $users=User::where('role_id',11)->get();
        
        Notification::send($users,new newOrder($order));
       //$users->notify(new newOrder($order));
      
        return redirect('customer/index')->with('success','Order placed successfully we will reach you shortly!');

    }
      public function onlinePayment(Request $request)
    {   
        $request->validate([
            'trx'=>'required|numeric'
        ]);
        $data=$request->all();
        $check_trx=Payment::where(['trx'=>$data['trx'],'is_read'=>0])->first();
        if(!$check_trx)
        {
            return \redirect()->back()->with('error','Invalid Transaction id!');
        }
        $order=new Order();
        $order->user_id=$data['user_id'];
        $order->total=$data['total'];
        $order->payment_method='bKash';
        $order->trx=$data['trx'];
         DB::table('payments')->where(['trx'=>$data['trx']])->update(['is_read'=>1]);
        // $verify_account=Account::where(['account_number'=>$data['account_number'],'user_id'=>$data['user_id']])->first();

        //    if(!$verify_account)
        //    {
        //        return \redirect()->back()->with('error','Invalid Account Number');
        //    }
        //    $balance=$verify_account->balance;
        //    if($balance<=$order->total)
        //    {
        //         return \redirect()->back()->with('error','Insufficient Balance please Recharge!!!');
        //    }
       
        $order->delivered_by=$data['delivered_by'];
        $order->save();
        $order_id=$order->id;   
        
          foreach(Cart::cartsItem() as $item)
        {
         $orderItem=new OrderItem();
         $orderItem->order_id=$order_id;
         $orderItem->product_id=$item->product_id;
         $orderItem->name=$item->name;
         $orderItem->quantity=$item->quantity;
         $orderItem->price=$item->price;
         $orderItem->total=$item->quantity*$item->price;
         $orderItem->save();
        } 
        Wishlist::where(['user_id'=>0,'session_id'=>Session('session_id')])->delete();
        Cart::where('session_id',Session('session_id'))->delete();
        $request->session()->forget('session_id');
       
       
        $users=User::where('role_id',11)->get();
        Notification::send($users,new newOrder($order));
    //     $old=Account::where('user_id',$order->user_id)->value('balance');
    //     //dd($old);
    //     $new=$old - $order->total;
    //    // dd($new);
    //     DB::table('accounts')->where('user_id',$order->user_id)->update(['balance'=>$new]);
    //         //send notification to user
    //    $account=Account::where('user_id',$order->user_id)->first();
    //    //dd($account);
    //    $user=User::where('id',$order->user_id)->first();
    //    Notification::send($user, new AccountUpdate($account));
       return redirect('customer/index')->with('success','Order placed Successfully we will reach you shortly!');

    }
    public function cancelOrder(Request $request) 
    {
        Cart::where('session_id',Session('session_id'))->delete();
        $request->session()->forget('session_id');
        Wishlist::where(['user_id'=>0,'session_id'=>Session('session_id')])->delete();
        return redirect('customer/index')->with('error','Your Order has been Cancelled!!!');
    }
    public function order_summary(Request $request,$id)
    {   
        $order_check=Order::where('user_id',$id)->latest()->first();
        $area_id=User::where('id',$id)->value('area_id');
        $delivery_boy=User::where(['area_id'=>$area_id,'role_id'=>3])->first();
       
       // dd($delivery_boy->name);
      
        if(!$order_check)
        {
            return redirect()->back()->with('error','you have nothing to show!!!');
        }
        return view('customer.order_summary',compact('order_check','delivery_boy'));
    }
    public function order_status(Request $request,$id)
    {   
        $order_check=Order::where(['id'=>$id,'user_id'=>Auth::user()->id])->first();

        
       
       // dd($delivery_boy->name);
      
        if(!$order_check)
        {
            return redirect()->back()->with('error','you have nothing to show!!!');
        }
        return view('customer.order_status',compact('order_check'));
    }
     public function order_history(Request $request,$id)
    {   
        $orders=Order::where('user_id',$id)->get();
       
      
        if(!$orders)
        {
            return redirect()->back()->with('error','you have nothing to show!!!');
        }
        return view('customer.order_history',compact('orders'));
    }
   


}
       
     
       
    
