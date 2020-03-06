<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Product;



class CategoryController extends Controller
{
public function add_category(Request $request)
    {
        if($request->isMethod('POST'))
        {
           $validateData=$request->validate([
         'name'=>'required|unique:categories|alpha|max:255',
         'description'=>'required|string|max:255',
        
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
           $category=new Category();
           $category->name=$validateData['name'];
           $category->description=$validateData['description'];
       
           $category->image=$fileNameToStore;
           $category->save();
           return \redirect('admin/view_category')->with('success','category Added SuccessFully!');
            

        }
        }
        else
        {
            return view('admin.categories.add_category');
        }
    }

public function edit_category(Request $request,$id)
    {
        if($request->isMethod('POST'))
        {
        $validateData=$request->validate([
         'name'=>'required|alpha|max:255',
         'description'=>'required|string|max:255',
       
         'image'=>'',
         ]);
        //dd($validateData);
        $data=$request->all();
        if($request->hasFile('image'))
        {
           $fileNameExt=$request->file('image');
           $filename=pathinfo($fileNameExt,PATHINFO_FILENAME);
           $extension=$request->file('image')->extension();
           $fileNameToStore=$filename.'_'.time().'.'.$extension;
           //dd($fileNameToStore);
           $path=$request->file('image')->storeAs('public/uploads',$fileNameToStore);
           //dd($path);
           
         }
         else
         {
          $fileNameToStore=$data['old_image'];
         }
         Category::where(['id'=>$id])->update(['name'=>$validateData['name'],'description'=>$validateData['description'],'image'=>$fileNameToStore]);
         return \redirect('admin/view_category')->with('success','Updated Successfully!!');
        }
        else
        {
            $category=Category::find($id);
            return view('admin.categories.edit_category',compact('category'));
        }
    }
    public function view_category()
    {
       $categories=Category::all();
       return view('admin.categories.view_category',compact('categories'));
    }
    public function delete_category(Request $request,$id){
     Category::where(['id'=>$id])->delete();
     return \back()->with('success','Deleted Successfully!!!');
   }
    public function single_category(Request $request,$id){
    $category= Category::where(['id'=>$id])->first();
     return view('admin.categories.single_category',compact('category'));
   }
}
