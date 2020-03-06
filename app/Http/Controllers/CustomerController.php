<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Notifications\AccountUpdate;
use App\Notifications\ProductAdded;
use App\Notifications\ProductVerify;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Product;
use App\Area;
use App\Account;
use App\Message;
use Pusher\Pusher;


class CustomerController extends Controller
{   
   
    public function index()
    {   $products=Product::where('status',1)->get();
        $categories=Category::all();
        return view('customer.index',compact('categories','products'));
    }
    //view category details
    public function details(Request $request,$id)
    {
       $category=Category::findOrFail($id);
       $categories=Category::all();
       if($category===null || $category->products->count()<1) 
       {
           return \redirect('customer/index')->with('warning','No products found under this category');
       }
       else{
           return view('customer.details',\compact('category','categories'));
       }
    }
      public function search(Request $request)
   {
      $data= $request->validate([
         'query'=>'required|min:2|max:30|string',
       ]);
      
       $query=$data['query'];  
      
       $categories=Category::all();
       $products=Product::where([['name','like',"%$query%"],['status',1]])
       ->orWhere([['description','like',"%$query%"],['status',1]])->get();
       //dd($products);
       if(!$products)
       {
          $category=Category::where('name','like',"%$query%")->first();
           if($category)
           {
                 $products=Product::where([['category_id',$category->id],['status',1]])->get();
           }else{
               return redirect()->back()->with('error','Not Found anything');
           }
       }
      
      return view('customer.search',compact('products','categories'));
   }
    //view single product
    public function product(Request $request,$id)
    {
        $product=Product::findOrFail($id);
        $category=$product->category_id;
        $similars=Product::where('category_id',$category)->get();
      
        $categories=Category::all();
        return view('customer.product',\compact('product','similars','categories'));
    }
    //farmer 
    public function shop()
    {   
        $products=Product::where('user_id',Auth::user()->id)->get(); 
        $users=User::all();
        return view('customer.shop.index',compact('users','products'));
    } 
     public function add_product(Request $request)
    {
        if($request->isMethod('POST'))
        {
        $validateData=$request->validate([
         'name'=>'required|unique:products|string|min:3|max:255',
         'user_id'=>'required',
         'category_id'=>'required|numeric',
         'description'=>'required|string|max:255|min:6',
         'price'=>'required|numeric|max:5000|gt:0',
         'quantity'=>'required|numeric|gt:0|lt:500',
        
         'unit'=>'required|max:10|min:2',
         'image'=>'required|file|image',
        
        ]);
        //dd($validateData);
        if($request->hasFile('image'))
        {
           $fileNameExt=$request->file('image');
           $filename=pathinfo($fileNameExt,PATHINFO_FILENAME);
           $extension=$request->file('image')->extension();
           $fileNameToStore=$filename.'_'.time().'.'.$extension;
           //dd($fileNameToStore);
           $path=$request->file('image')->storeAs('public/uploads',$fileNameToStore);
           //dd($path);
         
           $products=new Product();
           $products->name=$validateData['name'];
           $products->user_id=$validateData['user_id'];
           $products->category_id=$validateData['category_id'];
           $products->description=$validateData['description'];
           $products->price=$validateData['price'];
        
           $products->quantity=$validateData['quantity'];
           
           $products->is_verified=0;
           $products->unit=$validateData['unit'];
           $products->image=$fileNameToStore;
           $products->save();
           $user=User::where('role_id',11)->first();
           Notification::send($user, new ProductAdded($products));
           return \redirect('customer/view_product')->with('success','Product added,please give your account, you can create an account from profile page!');
        }   

        }
        else{
            $categories=Category::all();
            return view('customer.shop.add_product',compact('categories'));
        }
    } 
    public function verify(Request $request,$id)
    {
        $product=Product::findOrFail($id);
        //dd($product);
        if($product->status==0)
        {
            return redirect()->back()->with('error','Product need Admin verification fisrt Thank you !!');
        }
        $product->update(['is_verified'=>1]);
        $user=User::where('role_id',11)->first();
        Notification::send($user, new ProductVerify($product));
        return \redirect()->back()->with('success','Product Is successfully Submitted!!');
    }
     public function view_product()
    {
       $products=Product::where('user_id',Auth::user()->id)->get();
    
       return view('customer.shop.view_product',compact('products'));
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
            $categories=Category::all();
            $areas=Area::all();
            return view('customer.shop.profile',compact('user','categories','areas'))->with('success','Wellcome  here you can manage your profile ');
        }
    }
    public function view_message(Request $request)
    {
           $messages=DB::select("select * from messages where reciever_id=".Auth::user()->id." and product_id != 0");
            return view('customer.shop.view_message',compact('messages'));
    }
    public function edit_product(Request $request,$id)
    {
        if($request->isMethod("POST"))  
        {
            $data=$request->validate([
             'quantity'=>'required|numeric|gt:0|lt:500',
             'price'=>'required|numeric|gt:0|max:5000',
            ]);
            if($data['quantity']<3 || $data['quantity']>50)
            {
                return redirect()->back()->with('error','Please check your quantity');
            }
            //product
            $old_quantity=Product::where('id',$id)->value('quantity');
            $price=$data['price']*$data['quantity']; 
            $new_quantity=$old_quantity+$data['quantity'];
            DB::table('products')->where('id',$id)->update(['quantity'=>$new_quantity,'status'=>0,'is_verified'=>0,'old_quantity'=>$old_quantity]);
            //user
            // $user_account=Account::where('user_id',Auth::user()->id)->first();
            // $old_balance=$user_account->balance;
            // $new_balance=$old_balance+$price;
           
            // DB::table('accounts')->where('user_id',Auth::user()->id)->update(['balance'=>$new_balance]);
            // $user=User::where('id',Auth::user()->id)->first();
            // Notification::send($user, new AccountUpdate($user_account));

            // //admin
            // $admin_account=Account::where('account_number','01721544957')->first();
            // $old_balance=$admin_account->balance;
            // $new_balance=$old_balance-$price;
            // DB::table('accounts')->where('account_number','01721544957')->update(['balance'=>$new_balance]);
            // $user=User::where('role_id',11)->first();
          
            // Notification::send($user, new AccountUpdate($admin_account));
          
            $product=Product::where('id',$id)->first();
            $user=User::where('role_id',11)->first();
            Notification::send($user, new ProductAdded($product)); 
            DB::table('messages')->where('product_id',$id)->delete();
            //dd($product);
            return redirect('customer/shop')->with('success','Product added successfully Thanks!!');


        }else{
            $product=Product::where('id',$id)->first();
            return view('customer.shop.edit_product',compact('product'));
        }
    }
    public function confirm_product(Request $request)
    {
          if($request->isMethod('POST'))
        {
            $data=$request->validate([
             'sender_id'=>'required',
             'reciever_id'=>'required',
             'message'=>'required',
             'product_id'=>'required',
            ]);
          
            $message=new Message();
            $message->sender_id=$data['sender_id'];
            $message->reciever_id=$data['reciever_id'];
            $message->message=$data['message'];
            $message->product_id=$data['product_id'];
            $message->is_read=0;
            $message->save();
            $user=User::where('id',$data['reciever_id'])->first();
            Notification::send($user, new ProductAdded($message));
            return \redirect()->back()->with('success','Your message has been submitted');

        }
    }
    public function shop_search(Request $request)
    {
           $data= $request->validate([
         'query'=>'required|min:2|max:30|string',
       ]);
      
       $query=$data['query'];  
      
       
       $product=Product::where([['name','like',"%$query%"],['user_id',Auth::user()->id]])
       ->orWhere([['description','like',"%$query%"],['user_id',Auth::user()->id]])->first();
     
       if(!$product)
       {
           $category=Category::where('name','like',"%$query%")->first();
           if($category)
           {
              $product=Product::where([['category_id',$category->id],['user_id',Auth::user()->id]])->first();  
           }else{
               return redirect()->back()->with('error','Nothing found');
           }
          
       }
      
      return view('customer.shop.search',compact('product'));

    }
      public function farmer_settings(Request $request,$id)
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
            $categories=Category::all();
            $areas=Area::all();
            return view('customer.settings',compact('user','categories','areas'))->with('success','Wellcome  here you can manage your profile ');
        }
    }
    //end farmer
   
    //customer settings
    public function settings(Request $request,$id)
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
            $categories=Category::all();
            $areas=Area::all();
            return view('customer.settings',compact('user','categories','areas'))->with('success','Wellcome  here you can manage your profile ');
        }
    }
    public function update_password(Request $request)
    {
        $validate_data=$request->validate([
                'current_password'=>'required|min:6|alpha_num',
                'new_password'=>'required|min:6|alpha_num',
             ]);
                    $data=$request->all();
                    //dd($data);
                    $check_password=User::where(['email'=> Auth::user()->email,'id'=>$data['id']])->first();
                    $current_password=$data['current_password'];
           if(Hash::check($current_password,$check_password->password))
           {
             $password=bcrypt($data['new_password']);
            User::where(['id'=>$data['id']])->update(['password'=>$password]);
            Auth::logout();
            return redirect('/signin')->with('success','password changed login again!!');
            
           }else
            {
                return redirect()->back()->with('error','Error occured during update because Invalid password');
            }
    }
    public function show_account(Request $request)
    {     
          $data=$request->validate([
         'account_number'=>'required|string:11',
         'pin'=>'required|digits:4',
         'id'=>'required'
          ]);
           $account=Account::where(['account_number'=>$data['account_number'],'pin'=>$data['pin'],'user_id'=>$data['id']])->first();
            //dd($account);
           if(!$account)
           {
               return \redirect()->back()->with('error','Invalid Account Number');
           }
           $balance=$account->balance;
           return redirect()->back()->with('success',' Dear '.$account->user->name.' Your Current balance is'.$balance.' Thank you!');
    }
    public function create_account(Request $request)
    {     
        $data=$request->validate([
         'account_number'=>'required|digits:11|unique:accounts',
         'balance'=>'required|numeric',
         'pin'=>'required|digits:4',
         'id'=>'required'
          ]);
         $new_balance=$data['balance'];
           if($new_balance >= 20000 || $new_balance<=500)
           {
                return \redirect()->back()->with('error','Please give correct Input!!!');
           }
           $check_user=Account::where('user_id',$data['id'])->get();
           //dd($check_user);
           if($check_user->count() >0)
           { 
               return \redirect()->back()->with('error','Dear user You Already  have an account!!');
         
           }else{ 
             $account=new Account();
           $account->account_number=$data['account_number'];
           $account->balance=$data['balance'];
           $account->pin=$data['pin'];
           $account->user_id=$data['id'];
           $account->save();
           return \redirect()->back()->with('success',' New bKash Account Created Successfully Enjoy Shopping !!');  
                 
           }
        
          
          
    }
    public function delete_account(Request $request,$id)
    {
       User::where('id',$id)->delete();
       return redirect('/')->with('success','Your account is Deleted!!!');
    }

   

}
