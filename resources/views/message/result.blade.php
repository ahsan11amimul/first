@extends('message.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')
 <div class="message-wrapper">
                <ul class="messages">
                    @foreach ($messages as $item)
                        
                   
                <li class="message clearfix">
                <div class="{{$item->sender_id==Auth::id()?'sent':'recieved'}}">
                <p>{{$item->message}}</p>
                <p class="date">{{ date("l jS \of F Y h:i:s A",strtotime($item->created_at))}}</p>
                    </div>
                </li>
                @endforeach
                </ul>
            </div>
            <div class="input-text">
              
                <input type="text" name="message" id="" class="submit">
               
            </div>

@endsection  

