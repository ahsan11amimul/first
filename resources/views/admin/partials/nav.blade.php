
<style>
    .notification{
        width: 400px;
        background: #FFFFFF;
        height: auto;
        margin-top: 10px;
        margin-right: 15px;
      
    }
    .notification a{
        color:#ef4532;
        text-decoration: none;
        padding: 5px;
        margin-bottom: 2px;  
        margin-right:4px;
        padding-right: 5px;
        border-bottom: 1px groove orangered;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
 
  <div class="container py-2">
    
 {{--  <img src="{{asset('test-image/admin.jpg')}}" alt="" style="width:50px;" class="rounded-circle">--}}
  <a class="navbar-brand" href="{{url('/admin/index')}}"> ADMIN DASHBOARD</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
   
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
  <form class="form-inline my-3 my-lg-0" action="{{route('admin.search')}}" method="GET">
       <div class="input-group">
        <input type="text" class="form-control search-input" placeholder="Search.." size="75" name="query">
        <div class="input-group-append">
            <button class="btn btn-outline-warning" type="submit" ><i class="fas fa-search"></i></button>
        </div>
        </div>
    </form>
    <ul class="navbar-nav ml-auto">
        
      <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/contact')}}"><i class="fas fa-envelope fa-lg text-warning"></i></a></a>
      </li>
       <!-- Dropdown -->
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="JavaScript:Void(0);" id="navbardrop" data-toggle="dropdown">
       <i class="fas fa-bell fa-lg text-warning"></i><span class="badge badge-danger">
          {{Auth::user()->unreadNotifications->count()}}
        </span>
      </a>
      <div class="dropdown-menu notification">
        @foreach (Auth::user()->unreadNotifications as $item)
      <a class="dropdown-item" href="{{$item ? url($item->data['link']):'#'}}">{{$item->data['message']}}</a>
        {{$item->markAsRead()}}
        @endforeach
       </div>
    </li>
      <li class="nav-item">
      <a class="nav-link" href="{{url('/admin/contact')}}"><i class="fas fa-comments fa-lg text-warning"></i></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logout"><i class="fas fa-sign-in-alt fa-lg text-warning"></i></a>
      </li>
     
    </ul>
    
  </div>
</div>
</nav>



  