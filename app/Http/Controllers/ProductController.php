<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Product;

class ProductController extends Controller
{
   public function view_product()
    {
       $products=Product::all();
       return view('admin.products.view_product',compact('products'));
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
         'image'=>'required|file|image'
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
         
           $products->status=1;
           $products->unit=$validateData['unit'];
           $products->image=$fileNameToStore;
           $products->save();
           return \redirect('admin/view_product')->with('success','Product Added SuccessFully!');
        }

        }
        else{
            $categories=Category::all();
            return view('admin.products.add_product',compact('categories'));
        }
    }
    public function edit_product(Request $request,$id)
    {
        if($request->isMethod('POST'))
        {
            $validateData=$request->validate([
         'name'=>'required|string|min:3|max:255',
         'category_id'=>'required|numeric',
         'description'=>'required|string|max:255|min:6',
         'price'=>'required|numeric|max:5000|gt:0',
         'quantity'=>'required|numeric|gt:0|lt:500',
       
         'unit'=>'required|max:10|min:2',
        // 'image'=>'required|file|image'
        
        ]); 
        $data=$request->all();
       
        if($request->hasFile('image'))
        {
           $fileNameExt=$request->file('image');
           $filename=pathinfo($fileNameExt,PATHINFO_FILENAME);
           $extension=$request->file('image')->extension();
           $fileNameToStore=$filename.'_'.time().'.'.$extension;
          // dd($fileNameToStore);
           $path=$request->file('image')->storeAs('public/uploads',$fileNameToStore);
        }
        else
        {
            $fileNameToStore=$data['old_image'];
        }
      
     
     
      Product::where(['id'=>$id])->update(['name'=>$data['name'],'category_id'=>$data['category_id'],'description'=>$data['description'],
      'price'=>$data['price'],'quantity'=>$data['quantity'],'unit'=>$data['unit'],'image'=>$fileNameToStore]);
      return \redirect('admin/view_product')->with('success','Updated Successfully!!');

        }else{
            $product=Product::where(['id'=>$id])->first();
            return view('admin.products.edit_product',compact('product'));
        }
    }
    public function delete_product(Request $request,$id){
    Product::where(['id'=>$id])->delete();
    return \back()->with('success','Deleted SuccessFully');
    }
    public function single_product(Request $request,$id)
    {
        if($request->isMethod('POST'))
        {
             $validateData=$request->validate([
         'name'=>'required|string|min:3|max:255',
         'category_id'=>'required|numeric',
         'description'=>'required|string|max:255|min:6',
         'price'=>'required|numeric|max:5000|gt:0',
         'quantity'=>'required|numeric|gt:0|lt:500',
       
         'unit'=>'required|max:10|min:2',
        // 'image'=>'required|file|image'
        
        ]); 
        
        $data=$request->all();
       
        if($request->hasFile('image'))
        {
           $fileNameExt=$request->file('image');
           $filename=pathinfo($fileNameExt,PATHINFO_FILENAME);
           $extension=$request->file('image')->extension();
           $fileNameToStore=$filename.'_'.time().'.'.$extension;
          // dd($fileNameToStore);
           $path=$request->file('image')->storeAs('public/uploads',$fileNameToStore);
        }
        else
        {
            $fileNameToStore=$data['old_image'];  
        }
      
        $status=$data['status'];
        $user_id=$data['user_id'];
      
        //dd($status);
        if($status==1)
        {
        Product::where(['id'=>$id])->update(['name'=>$data['name'],'category_id'=>$data['category_id'],'description'=>$data['description'],
      'price'=>$data['price'],'quantity'=>$data['quantity'],'unit'=>$data['unit'],'image'=>$fileNameToStore,'status'=>0]);
      return \redirect('admin/view_product')->with('success','Product Goes offline Successfully!!');
        }
    else{
       Product::where(['id'=>$id])->update(['name'=>$data['name'],'category_id'=>$data['category_id'],'description'=>$data['description'],
      'price'=>$data['price'],'quantity'=>$data['quantity'],'unit'=>$data['unit'],'image'=>$fileNameToStore,'status'=>1]);
      return \redirect('admin/view_product')->with('success','Product Goes online Successfully!!');

        }
     
      

        }else{
             $product=Product::find($id);
             return view('admin.products.single_product',compact('product'));
        }

    
    }
}
