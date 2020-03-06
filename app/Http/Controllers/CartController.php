<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Category;
use App\Wishlist;


class CartController extends Controller
{   
   
    public function add_cart(Request $request)
    {
     
       if($request->isMethod('POST'))
       {   
           if(empty($request->session()->get('session_id')))
           {
           $session_id=Str::random(40);
           //dd($session_id);
           $request->session()->put('session_id', $session_id);
           }
           $session_id=$request->session()->get('session_id');
           $data=$request->validate([
             'product_id'=>'required'
           ]);
           $id=$data['product_id'];
           //dd($id);
           $product=Product::findOrFail($id);
          // dd($product);
           $cart=Cart::where(['product_id'=>$id,'session_id'=>$session_id])->get();
           if($cart->count()>0)
           {
            
            Cart::where(['product_id'=>$id,'session_id'=>$session_id])->increment('quantity');
           return \redirect()->back()->with('success','Product alraedy in your  Shopping Cart!!');
          
            
           }else{
                   DB::table('carts')->insert(['session_id'=>$session_id,'product_id'=>$id,
           'name'=>$product->name,'quantity'=>1,'price'=>$product->price]);
           return \redirect()->back()->with('success','Product added to Shopping Cart!!');
           }
         
     
        }
      
    }
    
    public function delete_cart(Request $request,$id)
    {
      $session_id=$request->session()->get('session_id');
     
      DB::table('carts')->where('id',$id)->delete();
      echo 'success';
    
    return \redirect()->back()->with('success',' Items Deleted SuccessFully!!');

    }
      public function increment_cart(Request $request,$id)    
    {
      $session_id=$request->session()->get('session_id');
      
      Cart::where(['id'=>$id,'session_id'=>$session_id])->increment('quantity');
      //echo 'success';
    
    return \redirect()->back()->with('success',' One Item Added SuccessFully!!');

    }
    public function clear_cart(Request $request)
    {
       $session_id=$request->session()->get('session_id');
       DB::table('carts')->where('session_id',$session_id)->delete();
       return redirect()->back()->with('success','Your Cart is empty');
    
    }
     public function decrement_cart(Request $request,$id)
    {
      $session_id=$request->session()->get('session_id');
      $id=$request['id'];
      $cart=Cart::where(['id'=>$id,'session_id'=>$session_id])->first();
      if($cart->quantity <=1)
      {
        $cart->delete();
      }else{
        Cart::where(['id'=>$id,'session_id'=>$session_id])->decrement('quantity');
      }
     // echo 'success';
    return \redirect()->back()->with('success',' One Item Removed SuccessFully!!');

    }
    // public function cart_items(Request $request)
    // {
      
    //   $session_id=$request->session()->get('session_id');
    //   $carts=Cart::where('session_id',$session_id)->get();
    //   $items=0;
       
    //    foreach($carts as $item)
    //    {
    //        $items+=$item->quantity;
    //    }
    //    echo $items;
    // }
    //  public function cart_total(Request $request)
    // {
      
    //   $session_id=$request->session()->get('session_id');
    //   $carts=Cart::where('session_id',$session_id)->get();
    //   $total=0;
       
    //    foreach($carts as $item)
    //    {
    //        $total+=($item->quantity*$item->price);
    //    }
    //    echo $total;
    // }
    //wishlist
      public function add_wishlist(Request $request)
    {
     
       if($request->isMethod('POST'))
       {   
           if(empty($request->session()->get('session_id')))
           {
           $session_id=Str::random(40);
           //dd($session_id);
           $request->session()->put('session_id', $session_id);
           }
           $session_id=$request->session()->get('session_id');
           $data=$request-> validate([
             'product_id'=>'required'
           ]);
           $product_id=$data['product_id'];
           $product=Product::findOrFail($product_id);
           $wishlist=Wishlist::where(['product_id'=>$product_id,'session_id'=>$session_id])->get();
           if($wishlist->count()>0)
           {
            return \redirect()->back()->with('success','Product alraedy in your Wishlist!!');
            }else{
             if(Auth::check())
             {
             DB::table('wishlists')->insert(['session_id'=>$session_id,'product_id'=>$product_id,
           'name'=>$product->name,'user_id'=>Auth::user()->id]);
           return \redirect()->back()->with('success','Product added to wishlist!!');

             }else{
              DB::table('wishlists')->insert(['session_id'=>$session_id,'product_id'=>$product_id,
           'name'=>$product->name,'user_id'=>0]);
           return \redirect()->back()->with('success','Product added to wishlist!!');
             }
                  
           }
         
     
        }
      
    }
    public function delete_item(Request $request,$id)
    {
      $session_id=$request->session()->get('session_id');
      DB::table('wishlists')->where('id',$id)->delete();
    
    return \redirect()->back()->with('success',' Items Deleted SuccessFully!!');

    }

}
