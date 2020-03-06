<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AccountUpdate;
use App\Notifications\ProductConfirmed;
use Carbon\Carbon;

use App\Area;
use App\User;
use App\Category;
use App\Product;
use App\Order;
use App\Account;
use App\OrderItem;
use App\Notifications\OrderConfirmed;

class AreaController extends Controller
{
    public function view_area(Request $request)
    {
        $areas=Area::all();
       
        return view('admin.view_area',compact('areas'));
    }
    public function add_area(Request $request)
    {
        if($request->isMethod('POST'))
        { 
            $data=$request->validate([  
            'name'=>'required|string|min:3',
            'delivery_charge'=>'required|numeric',
        ]);
        $area=new Area();
        $area->name=$data['name'];
        $area->delivery_charge=$data['delivery_charge'];
        $area->save();
        return \redirect('admin/view_area')->with('success','New Area Added Successfully!!!');

        }
        else{
            return view('admin.add_area');
        }
    }
     public function edit_area(Request $request,$id)
    {
        if($request->isMethod('POST'))
        { 
            $data=$request->validate([
            'name'=>'required|string|min:3',
            'delivery_charge'=>'required|numeric',
        ]);
        $area=Area::where('id',$id)->first();
        $area->update(['name'=>$data['name'],'delivery_charge'=>$data['delivery_charge']]);
        return \redirect('admin/view_area')->with('success',' Area Updated Successfully!!!');

        }
        else{
            $area=Area::where('id',$id)->first();
            return view('admin.edit_area',compact('area'));
        }
    }
    public function add_delivery(Request $request,$id)
    {
       if($request->isMethod('POST'))
       {
           //dd($request->all());
        $validateData=$request->validate([
         'name'=>'required|string|min:3|max:255',
         'email'=>'required|string|unique:users|email',
         'password'=>'required|string|min:8',
         'phone'=>'required|min:11|string',
         'address'=>'required',
       
        
       ]);
      
      
       $user=new User();
       $user->name=$validateData['name'];
       $user->email=$validateData['email'];
       $user->password=Hash::make($validateData['password']);
       $user->phone=$validateData['phone'];
       $user->address=$validateData['address'];
     
       $user->role_id=3;
       $user->area_id=$id;
       $user->email_verified=1;
       $user->email_verification_token='';
       $user->email_verified_at=Carbon::now()->toDateTimeString();
       $user->save();
      // Mail::to($user->email)->send(new VerificationEmail($user));
      return redirect('admin/view_area')->with('success','Delivery boy Added Successfuly!!');
       }else{
           return view('admin.add_delivery',compact('id'));
       }
    }
    public function delete_delivery(Request $request,$id)
    {
        $user=User::where(['area_id'=>$id,'role_id'=>3])->first();
        if(!$user)
        {
              return \redirect('admin/view_area')->with('error','area have no delivery boy!!');
        }

        $user->delete();
        return \redirect('admin/view_area')->with('success','Delivery Removed Successfully!!');
    }
}
