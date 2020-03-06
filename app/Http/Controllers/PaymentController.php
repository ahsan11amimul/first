<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\User;
use App\Order;
use App\Account;
use App\Notifications\SendTrx;
use App\Notifications\ConfirmTrx;
use App\Notifications\ProductConfirmed;
use App\Notifications\AccountUpdate;
use App\Product;

use App\Payment;


class PaymentController extends Controller
{
   public function payment(Request $request)
   {
       $data=$request->validate([
           'to'=>'required',
           'from'=>'required',
           'amount'=>'required',
          
           'user_id'=>'required',
           'pin'=>'required|numeric:4'
       ]);
      
       $check_account=Account::where('account_number',$data['from'])->first();
       if(!$check_account)
       {
           return \redirect()->back()->with('error','Invalid Bkash number');
       }
       if($check_account->pin != $data['pin'])
       {
           return \redirect()->back()->with('error','Invalid Pin number');
       }
       if($check_account->balance < $data['amount'])
       {
            return \redirect()->back()->with('error',' Insufficient Balance Please Recharge!!');
       }
      $payment=new Payment();
      $payment->from=$data['from'];
      $payment->to=$data['to'];
      $payment->amount=$data['amount'];
      $payment->trx= mt_rand();
     
      $payment->save();  
      $user=User::where('id',$data['user_id'])->first(); 
    
      Notification::send($user,new SendTrx($payment));
      //sender update
      $old_balance=Account::where('account_number',$data['from'])->value('balance');
      $new_balance=$old_balance-$data['amount'];
      $check_account->update(['balance'=>$new_balance]);
    
      Notification::send($user,new AccountUpdate($check_account));
    
    //   //reciever Account
    //   $old_balance=Account::where('account_number',$data['to'])->value('balance');
    //   $new_blanace=$old_balance+$data['amount'];
    //   $check_account->update(['balance'=>$new_blanace]);
    //   $user=User::where('id',$data['user_id']);
    //   Notification::send($user,new AccountUpdata($check_account));
    //   Notification::send($user,new SendTrx($payment));
     return \redirect()->back()->with('success',' Amount Removed '.$payment->amount.' -Tk your Transaction id is '.$payment->trx);
   }
   public function check_trx(Request $request)
   {
       $data=$request->validate([
           'trx'=>'required',
           'to'=>'required',
       ]);  
     
       $check_payment=Payment::where(['trx'=>$data['trx'],'to'=>$data['to']])->first();
       if($check_payment)
       {
           return \redirect()->back()->with('success','Valid Transaction Id amount Recieved '.$check_payment->amount.' Tk from '.$check_payment->from.' Thank you!!');
       }else{
            return \redirect()->back()->with('error',' Invalid Transaction  Id !!');
       }
       
   }
   public function online_payment(Request $request)
   {    
         $request->validate([ 
            'trx'=>'required|numeric',
            'product_id'=>'required',
        ]);
        $data=$request->all();
        $check_trx=Payment::where(['trx'=>$data['trx'],'is_read'=>0])->first();
        if(!$check_trx)
        {
            return \redirect()->back()->with('error','Invalid Transaction id!');
        }
        $product=Product::where('id',$data['product_id'])->first();
        //dd($product);
        $product->update(['status'=>1]);
        $user_id=$product->user_id;
        //dd($user_id);
        $farmer=User::where('id',$user_id)->first();
        $farmer_account=Account::where('user_id',$user_id)->first();
        //dd($farmer_account);
        $old=Account::where('user_id',$user_id)->value('balance');
        //dd($old);
        $paid=($product->price*$product->quantity)+$old;
       // dd($paid);
        $farmer_account->update(['balance'=>$paid]);
        //dd($farmer_account);
        DB::table('payments')->where(['trx'=>$data['trx']])->update(['is_read'=>1]);
        Notification::send($farmer, new ProductConfirmed($product));
        Notification::send($farmer, new ConfirmTrx($check_trx));
        
        // $admin_account=Account::where('account_number','01721544957')->first();
        // $old=Account::where('account_number','01721544957')->value('balance');
        // //dd($old);
        // $paid=($product->price*$product->quantity);
        // $new=$old-$paid;
        // //dd($new);
        // $admin_account->update(['balance'=>$new]);
        // //dd($new);
        // $admin=User::where('role_id',11)->first();
        // //dd($admin_account);
        // Notification::send($admin, new AccountUpdate($admin_account));

        return redirect('admin/view_product')->with('success','Product Is buyed Successfully!!');
   }
   public function customer_payment(Request $request)
   {
     $user_id=Auth::user()->id;
     $orders=Order::where('user_id',$user_id)->get();
   if($orders->count()>0)
   {
       return view('customer.customer_payment',compact('orders'));
   }else{
       return \redirect()->back()->with('error',' You did not complete any orders Yet!');
   }
     
   }
   public function payment_report(Request $request)
   {
     $payments=Payment::all();
     return view('admin.payment_report',compact('payments'));
   }
}
