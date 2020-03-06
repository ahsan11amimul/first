<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Mail\ReplyContact;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AccountUpdate;
use App\Notifications\ProductConfirmed;
use Illuminate\Http\Request;
use App\Area;
use App\User;
use App\Category;
use App\Product;
use App\Order;
use App\Account;
use App\OrderItem;
use App\Notifications\OrderConfirmed;
use App\Notifications\OrderCancelled;
use App\Notifications\OrderDelay;
use App\Notifications\NeedProduct;
use App\Message;
use App\Contact;

class AdminController extends Controller
{
    public function index()   
    {   
        $users=User::all();
        $buyer=User::where('role_id',1)->get();
        $seller=User::where('role_id',2)->get();
        //$delivery_boy=User::where('role_id',3)->get();
        $orders=Order::all();
        $new_products=Product::where('is_verified',0)->get();
        $products=Product::where('status',1)->get();
        $low_products=Product::where([['quantity','<=',5],['status','=',1],['is_verified','=',1]])->get();
      
        return view('admin.index',compact('users','buyer','seller','orders','new_products','products','low_products'));
    }
    public function search(Request $request)
    {
     $data=$request->validate([
       'query'=>'required',
     ]);
     $days=$data['query'];
    $orders = Order::whereDateBetween('created_at',(new Carbon)->subDays($days)->toDateString(),(new Carbon)->now()->toDateString() )->get();
   // dd($orders);
   return view('admin.admin_search',compact('orders'));
    }
   
    public function new_order() 
    {
        $orders=Order::where('status',0)->get();
       // dd($orders);
        return view('admin.new_order',compact('orders'));
    }
    public function settings(Request $request)
    {    
     if($request->isMethod('POST'))
        {
            $validate_data=$request->validate([
                'current_password'=>'required|min:6|alpha_num',
                'new_password'=>'required|min:6|alpha_num',
             ]);
                    $data=$request->all();
                    $check_password=User::where(['email'=> Auth::user()->email])->first();
                    $current_password=$data['current_password'];
           if(Hash::check($current_password,$check_password->password))
           {
             $password=bcrypt($data['new_password']);
            User::where(['role_id'=>11])->update(['password'=>$password]);
            Auth::logout();
            return redirect('/signin')->with('success','Updated SuccessFully!!');
           }else
            {
                return redirect('admin/settings')->with('error','Error During Update!!');
            }
        }else
        {
            return view('admin.settings');
        }
       
    }
     public function profile(Request $request,$id)
    {
        if($request->isMethod("POST"))
        {   
         
           $data= $request->validate([
                'name'=>'required|string|min:3|max:50',
                'email'=>'required|string|email',
                'phone'=>'required|numeric:11',
                'address'=>'required|min:20|string',
                'area'=>'required'
             ]);
             DB::table('users')->where('id',$id)
             ->update(['name'=>$data['name'],'email'=>$data['email'],
             'phone'=>$data['phone'],'address'=>$data['address'],'area_id'=>$data['area']]);
             return redirect()->back()->with('success','Your chnages saved!!');
           }else{
            $user=User::where('id',$id)->first();
          
            $areas=Area::all();
            return view('admin.profile',compact('user','areas'))->with('success','Wellcome  here you can manage your profile ');
        }
    }
    public function show_customer(Request $request)
    {  
      $users=User::all();
      $orders=Order::all();
      $new_products=Product::where('status',0)->get();
      //dd($users);
      return view('admin.customers.show_customer',compact('users','orders','new_products'));
    }
    public function view_order(Request $request,$id)
    {
        $order=Order::where('id',$id)->first();
        $area_id=User::where('id',$order->user_id)->value('area_id');
        $delivery_boy=User::where(['area_id'=>$area_id,'role_id'=>3])->first();
       // dd($order);
        return view('admin.view_order',compact('order','delivery_boy'));
    }
    public function update_order(Request $request,$id)
    {
        $order=Order::where('id',$id)->first();
        //$admin=
       
        foreach($order->orderItems as $item)
        {   
            $old_quantity=DB::table('products')->where('id',$item->product_id)->value('quantity');
            if($old_quantity<=$item->quantity)
            {
                 $user=User::where('id',$order->user_id)->first();
                 Notification::send($user, new OrderDelay($order));
                return redirect('admin/view_product')->with('error',$item->name.' is out of Stock please add');
            }
            DB::table('products')->where('id',$item->product_id)
            ->update(['quantity'=>($old_quantity - $item->quantity)]);
        }
        if($order->payment_method==='CahOn')
        {
            $old_balance=Account::where('account_number','01721544957')->value('balance');
            $new_balance=$old_balance + $order->total;
            DB::table('accounts')->where('account_number','01721544957')->update(['balance'=>$new_balance]);
        }else{
              $old_balance=Account::where('account_number','01721544957')->value('balance');
            $new_balance=$old_balance+$order->total;
            DB::table('accounts')->where('account_number','01721544957')->update(['balance'=>$new_balance]);
            //send notification to admin
             $account=Account::where('account_number','01721544957')->first();
             $user=User::where('role_id',11)->first();

            Notification::send($user, new AccountUpdate($account));
            // $old=Account::where('user_id',$order->user_id)->value('balance');
            // $new=$old - $order->total;
            // DB::table('accounts')->where('user_id',$order->user_id)->update(['balance'=>$new]);
            // //send notification to user
            //  $account=Account::where('user_id',$order->user_id)->first();
            //  $user=User::where('id',$order->user_id)->first();
            // Notification::send($user, new AccountUpdate($account));
          }
        $order->update(['status'=>1,'approved_by'=>Auth::user()->name]);
        $user=User::where('id',$order->user_id)->first();
        Notification::send($user, new OrderConfirmed($order));
        return \redirect('admin/index')->with('success','Order Confirmed successfully!!!');
    }
    public function delete_order(Request $request,$id)
    {
        $order=Order::find($id);
       // dd($order);
        $user=User::where('id',$order->user_id)->first();
          //dd($user);
        Notification::send($user, new OrderCancelled($order));
        $order->delete();
        return redirect('admin/index')->with('success','Order cancelled successfully!!!');
    }
    //report section
    public function sales_report()  
    {
        //$order_items=OrderItem::get();
        //dd($order_items);
        //$orders=DB::table('orders')->simplePaginate(15);
        $orders=Order::where('status',1)->simplePaginate(10);
        
        //dd($orders);
        return view('admin.sales_report',compact('orders'));
    }
    public function products_report()  
    {
        $products=Product::where('status',1)->get();
        return view('admin.products_report',compact('products'));

    }
     public function cost_report()  
    {
        $products=Product::where('status',1)->get();
        return view('admin.cost_report',compact('products'));

    }
    public function new_products()
    {
        $products=Product::where(['is_verified'=>0,'status'=>0])->get();
        return view('admin.new_products',compact('products'));
    }
 public function buy_product(Request $request,$id)
    {
        $product=Product::where('id',$id)->first(); 
        return view('admin.buy_product',compact('product'));
    //     $product->update(['status'=>1]);
    //     $user_id=$product->user_id;
    //     //dd($user_id);
    //     $farmer=User::where('id',$user_id)->first();
    //     $farmer_account=Account::where('user_id',$user_id)->first();
    //     //dd($farmer_account);
    //     $old=Account::where('user_id',$user_id)->value('balance');
    //     //dd($old);
    //     $paid=($product->price*$product->quantity)+$old;
    //    // dd($paid);
    //     $farmer_account->update(['balance'=>$paid]);
    //     //dd($farmer_account);
    //     Notification::send($farmer, new ProductConfirmed($product));
    //     Notification::send($farmer, new AccountUpdate($farmer_account));
        
    //     $admin_account=Account::where('account_number','01721544957')->first();
    //     $old=Account::where('account_number','01721544957')->value('balance');
    //     //dd($old);
    //     $paid=($product->price*$product->quantity);
    //     $new=$old-$paid;
    //     //dd($new);
    //     $admin_account->update(['balance'=>$new]);
    //     //dd($new);
    //     $admin=User::where('role_id',11)->first();
    //     //dd($admin_account);
    //     Notification::send($admin, new AccountUpdate($admin_account));

    //     return redirect()->back()->with('success','Product Confirmation send to Farmer!!');
    }
    public function single_customer(Request $request,$id)
    {
        $user=User::findOrFail($id);
        return view('admin.single_customer',compact('user'));  
    }
    public function low_products(Request $request)
    {
           $low_products=Product::where([['quantity','<=',5],['status','=',1],['is_verified','=',1]])->get();
           return view('admin.low_products',\compact('low_products'));
    }
    public function need_product(Request $request)
    {  
      
        if($request->isMethod('POST'))
        {
            $data=$request->validate([
             'sender_id'=>'required',
             'reciever_id'=>'required',
             'message'=>'required',
             'product_id'=>'required'
            ]);
            DB::table('products')->where('id',$data['product_id'])->update(['status'=>0]);
            $message=new Message();
            $message->sender_id=$data['sender_id'];
            $message->reciever_id=$data['reciever_id'];
            $message->message=$data['message'];
            $message->is_read=0;   
            $message->product_id=$data['product_id'];
            $message->save();
            $user=User::where('id',$data['reciever_id'])->first();
            Notification::send($user, new NeedProduct($message));
            return \redirect()->back()->with('success','Your message has been submitted');

        }

    }
     public function view_message(Request $request)
    {       $messages=DB::select("select * from messages where reciever_id=".Auth::user()->id." and product_id != 0");
            // dd($messages);
            // $messages=Message::where(['reciever_id'=>Auth::user()->id,'product_id','!=','0'])->get();
            return view('admin.view_message',compact('messages'));
    }
   public function contact(Request $request)
   {
       $contacts=Contact::all();
       return view ('admin.contact',compact('contacts'));
   }
   public function contact_delete(Request $request,$id)
   {
       DB::table('contacts')->where('id',$id)->delete();
       return redirect()->back()->with('success','Contact message deleted successfully!!');
   }
   public function contact_reply(Request $request)
   {
       $data=$request->all();
       
       //$user=User::where('role_id',11)->first();
       Mail::to($data['email'])->send(new ReplyContact($data));
       return redirect()->back()->with('success','Message sent Successfully!!');

   }
}
