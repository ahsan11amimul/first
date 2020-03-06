<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Product;
use App\Cart;
use App\Contact;
use App\Area;

class IndexController extends Controller
{
   public function index()  
   {
       $categories=Category::all();
       $products=Product::where(['status'=>1,'is_verified'=>1])->get();
       //$carts=Cart::all();
       return view ('index',\compact('categories','products'));
   }
   public function product(Request $request,$id)
   {  
     
       $product=Product::findOrFail($id);
     
       if($product===null)
       {
           return redirect('/');
       }else{ 
           $categories=Category::all();
           $category=$product->category_id;
           $similar=Product::where('category_id',$category)->get();
           return view('product',compact('product','similar','categories'));
       }
   }
    public function category(Request $request,$id)
   {
       $category=Category::findOrFail($id);
       $categories=Category::all();
       if($category===null || $category->products->count()<1) 
       {
           return \redirect('/')->with('warning','No products found under this category');
       }
       else{
           return view('category',\compact('category','categories'));
       }
   }
   public function search(Request $request)
   {
      $data= $request->validate([
         'query'=>'required|min:2|max:30|string',
       ]);
      
       $query=$data['query'];
      
       $categories=Category::all();
       $products=Product::where([['name','like',"%$query%"],['status',1],['is_verified',1]])
       ->orWhere([['description','like',"%$query%"],['status',1],['is_verified',1]])->get();
      // dd($products);
       if(!$products)
       {
           $category=Category::where('name','like',"%$query%")->first();
           if($category)
           {
                 $products=Product::where([['category_id',$category->id],['status',1],['is_verified',1]])->get();
           }else{
               return redirect()->back()->with('error','Not Found anything');
           }
         
       }
        
      return view('search',compact('products','categories'));
   }
   public function contact(Request $request)
   { 
    if($request->isMethod('POST'))
    {
       $data= $request->validate([
           'name'=>'required|string|min:3|max:60',
           'email'=>'required|email|string',
           'message'=>'required|string|min:6'
       ]);
       $contact=new Contact();
       $contact->name=$data['name'];
       $contact->email=$data['email'];
       $contact->message=$data['message'];
       $contact->save();
       $user=User::where('role_id',11)->first();
        Mail::to($user->email)->send(new ContactForm($contact));
       return redirect()->back()->with('success','Your Message has been submitted Thanks From Admin!!');
    }else{
     
       return view('contact');
    }
       
   }
   public function shipping(Request $request)
   {
       $areas=Area::all();
       return view('shipping',compact('areas'));
   }
}
