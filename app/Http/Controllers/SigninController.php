<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use App\Mail\ForgetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;
use Carbon\Carbon;
use App\Area;

class SigninController extends Controller
{
   public function signin(Request $request)
   {  
       if($request->isMethod('POST'))
      {     
        $validate=$request->validate([
        'email'=>'required|email',
        'password'=>'required',
        'role_id'=>'required',
        ]);
          $credentials = $request->only('email', 'password','role_id');
          //dd($credentials);
          $email=$validate['email'];
          $password=$validate['password'];
          $role=$validate['role_id'];
          if(Auth::attempt(['email' => $email, 'password' => $password,'role_id'=>$role,'email_verified'=>1])){
             if($role==1)
             {   
                 DB::table('users')->where('email',$email)->update(['login_status'=>1]);
    
                 return \redirect('customer/index')->with('success','login successfully!!');
             }elseif($role==2)
             {    DB::table('users')->where('email',$email)->update(['login_status'=>1]);
                 return \redirect('customer/shop')->with('success','login successfully!!');
             }
             else{
                
                 DB::table('users')->where('email',$email)->update(['login_status'=>1]);
                 return \redirect('admin/index')->with('success','login successfully!!');
             }
              
            }
       
          else{
              return \redirect('/signin')->with('error','Invalid credentials or activate your account');
          }
      }
       else
       {
           return view('signin');
       }
   }
   public function logout()
   {   
       $email=Auth::user()->email;
       DB::table('users')->where('email',$email)->update(['login_status'=>0]);
       Auth::logout();
       return \redirect('/')->with('success','You have been logged out');
   }
   public function signup(Request $request)
   {   
    if($request->isMethod('POST'))
    {
       $validateData=$request->validate([
         'name'=>'required|string|min:3|max:255',
         'email'=>'required|string|unique:users|email',
         'password'=>'required|string|min:8',
         'phone'=>'required|min:11|string',
         'address'=>'required',
         'role_id'=>'required',
         'area_id'=>'required',
       ]);
       $user=new User();
       $user->name=$validateData['name'];
       $user->email=$validateData['email'];
       $user->password=Hash::make($validateData['password']);
       $user->phone=$validateData['phone'];
       $user->address=$validateData['address'];
       $user->email_verification_token=Str::random(40);
       $user->role_id=$validateData['role_id'];
       $user->area_id=$validateData['area_id'];
       $user->save();
      Mail::to($user->email)->send(new VerificationEmail($user));
      
       return redirect('/signin')->with('success','Registration success we have send an email please verify it!!');

    }else{
        $areas=Area::all();
         return view('signup',compact('areas'));
    }
      
   }
   public function verifyEmail(Request $request,$token=null)
   {
    if($token===null)
    {
          return \redirect('/signin')->with('error','Invalid token');
    }
    $user=User::where('email_verification_token',$token)->first();
     if($user===null)
     {
          return \redirect('/signin')->with('error','Invalid token');
     }
     //$user = DB::table('users')->where('name', 'John')->first();
     //dd($user);  
    //  $result=$user->update([
    //      'email_verified'=>1,
    //      'email_verified_at'=> Carbon::now()->toDateTimeString(),
    //      'email_verification_token'=>'',
    //  ]);
    // $user=User::where('email_verified',1)->first();
     //dd($result);
     DB::table('users')->where('email_verification_token',$token)
     ->update(['email_verified'=>1,'email_verification_token'=>'','email_verified_at'=>Carbon::now()->toDateTimeString()]);
     return \redirect('/signin')->with('success','Your Account has been Activated Login now,enjoy shopping!!!');
   }
   public function forget_password(Request $request)
   {   
    if($request->isMethod('POST'))
    {
        $data=$request->validate([
        'email'=>'required|email|string',
        ]);
        $user=User::where('email',$data['email'])->first();
        if(!$user)
        {
            return redirect('/signin')->with('error','You are not a registered User!!');
        }
         Mail::to($user->email)->send(new ForgetPassword($user));
         return redirect('/')->with('success','Please check your Email!!!');

    }
      else{
           return view('forget_password');
      }
   }
    public function create_password(Request $request,$id)
   {  
    
    if($request->isMethod('POST'))
    {
        $data=$request->validate([
        'password'=>'required|min:8',
        'confirm_password'=>'required|min:8',
      
        ]);
        $user_check=User::where('id',$id)->first();
        if(!$user_check)
        {
             return \redirect()->back()->with('error','Invali route!');
        }
        if($data['password']!=$data['confirm_password'])
        {
          return \redirect()->back()->with('error','Password Does not Match!');
        }
      DB::table('users')->where('id',$id)->update([
          'password'=>bcrypt($data['password'])]);
          return redirect('/signin')->with('success','Password Updated!!!');

    }
      else{
          $user=User::where('id',$id)->first();
           return view('create_password',compact('user'));
      }
   }
}
