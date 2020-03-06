<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Events\MyEvent;

class MessageController extends Controller
{
    
     //message
    public function index()
    {   
       // $users=User::where('id','!=',Auth::user()->id)->get();
       $users=DB::select("select users.id,users.name,users.email,count(is_read) as unread
       from users LEFT JOIN messages ON users.id=messages.sender_id and is_read=0 and 
       messages.reciever_id=" .Auth::user()->id." where users.id !=".Auth::user()->id." group by users.id,users.name,users.email");
       

        //dd($users);
        return view('message.index',compact('users'));
    }
    public function getmessage($user_id)
    {
     $my_id=Auth::user()->id;
    
    Message::where(['sender_id'=>$user_id,'reciever_id'=>$my_id])->update(['is_read'=>1]);
     $messages=Message::where(function($query) use($user_id,$my_id){
         $query->where('sender_id',$my_id)->where('reciever_id',$user_id);
     })->orWhere(function($query) use($user_id,$my_id){
         $query->where('sender_id',$user_id)->where('reciever_id',$my_id);
     })->get();
     return view('message.result',compact('messages'));
    
    }
    public function sentmessage(Request $request)
    {
        $sender_id=Auth::user()->id;   
        
        $reciever_id=$request->reciever_id;
          
        $user_message=$request->message;
       
        $messages=new Message();
        $messages->sender_id=$sender_id;
        $messages->reciever_id=$reciever_id;
        $messages->message=$user_message;
        $messages->is_read=0;
        $messages->save();
       
        $data=['from'=> $sender_id,'to'=>$reciever_id];
        event(new MyEvent($data));
        //return view('message.index');
        
        
    }
}
