@extends('message.layouts.master')
@section('title')
    Live Chat
@endsection
@section('content')
<div class="container-fluid">  
    <div class="row">
        <div class="col-md-3">
            <div class="user-wrapper">
                <ul class="users">  
                    @foreach ($users as $item)
                <li class="user" id="{{$item->id}}">
                    @if ($item->unread)
                    <span class="pending">{{$item->unread}}</span>
                    @endif
                    <div class="media">
                      <div class="media-left">
                      <i class="fas fa-user-circle fa-2x text-info"></i>
                       </div>
                        <div class="media-body">
                        <p class="name">{{$item->name}}</p>
                        <p class="email">{{$item->email}}</p>
                        </div>
                    </div>
                </li>   
                    @endforeach
                
              
                </ul>
            </div>
        </div>
        <div class="col-md-8" id="messages">
           

        </div>
    </div>
</div>

<button onclick="goBack()" class="btn btn-outline-warning w-100">Go Back</button>

<script>
function goBack() {
  window.history.back();
}
</script>

@endsection    
  

    





