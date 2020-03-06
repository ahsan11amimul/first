<style>
    .notification{
        width: 400px;
        background: #FFFFFF;
        height: 250px;
      
    }
    .notification a{
        color:black;
        text-decoration: none;
        padding:5px;  
        border-bottom: 1px solid black;
    }
</style>


<div class="container-fluid">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background: #FDD670;">
            <span class="mr-3 sidebar_btn" onclick="openSidebar()"><i class="fa fa-bars fa-lg"></i></span>
    <a class="navbar-brand" href="{{url('customer/index')}}">
            <img src="{{asset('test-image/brand.png')}}" alt="" class="rounded-circle">
                 OrganicStore</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form action="{{route('customer.search')}}" method="GET" class="form-inline  my-lg-0">
                    <div class="input-group my-3">
                        <input type="text" class="form-control" placeholder="Search For Products (eg:alu, piyaz, eggs, etc..)"
                    name="query" id="query" value="{{request()->input('query')}}" size="63">
                        <div class="input-group-append">
                            <button class="btn btn-outline-warning" type="submit" name="search_btn"><i class="fas fa-search text-white"></i></button>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item  dropdown">
                                <a href="#" class="nav-link  dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-bell fa-lg text-danger"></i>
                                <span class="badge badge-info">{{Auth::user()->unreadNotifications->count()}}</span>
                                </a>
                                <div class="dropdown-menu notification">
                                   @foreach (Auth::user()->unreadNotifications as $item)
                                   <a class="dropdown-item"  href="{{$item ? url($item->data['link']):'#' }}">{{$item->data['message']}}</a>
                                     {{$item->markAsRead()}}
                                   @endforeach
                                 
                                </div>
                               </li>
                   
                    <li class="nav-item">
                    <a class="nav-link" href="#"data-toggle="modal" data-target="#wishlist"><i class="fas fa-heart text-danger fa-lg">
                    <span class="badge badge-warning">{{App\Wishlist::totalItem()}}</span></i>
                    </a>
                     </li> 
                   
                     <li class="nav-item">
                    <a class="nav-link" href="#"data-toggle="modal" data-target="#cart"><i class="fas fa-shopping-cart text-danger fa-lg">
                    <span class="badge badge-warning">{{App\Cart::totalItem()}}</span></i>
                    </a>
                     </li>        
                  
                    <li class="nav-item">
                        <a class="nav-link text-danger"href="#" title="Logout"  data-toggle="modal" data-target="#logout"><i class="fas fa-sign-out-alt"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <i class="fas fa-user-circle text-danger fa-lg"></i>Wellcome Back {{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu mt-4 bg-warning">
                        <a class="dropdown-item" href="{{url('customer/order_history/'.Auth::user()->id)}}"><i class="fas fa-shopping-cart"><span class="badge badge-warning">{{App\Order::totalItem()}}</span></i>Order History</a>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('customer/order_summary/'.Auth::user()->id)}}"><i class="fas fa-shopping-cart pr-2"></i>My Orders</a>
                             <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{url('customer/settings/'.Auth::user()->id)}}"><i class="fas fa-wrench pr-2"></i>Settings</a>
                         <div class="dropdown-divider"></div>
                            <div class="dropdown-item dropleft dropdown-toggle" data-toggle="dropdown" href="#"><i class="fas fa-bell pr-2">
                            <span class="badge badge-danger">{{Auth::user()->unreadNotifications->count()}}</span></i>Notifications
                             <div class="dropdown-menu notification">
                                 @foreach (Auth::user()->unreadNotifications as $item)
                             <a class="dropdown-item" href="{{$item ? url($item->data['link']):'#' }}">{{$item->data['message']}}</a> 
                              {{$item->markAsRead()}}
                                 @endforeach
                                
                            
                             </div>
                                   
                              </div>
                               <div class="dropdown-divider">
                               
                              </div> <a class="dropdown-item" href="{{url('/customer_payment')}}"> <i class="fas fa-money-bill-alt pr-2"></i> Online Payment</a> 
                              <div class="dropdown-divider">
                               
                              </div> <a class="dropdown-item" href="{{url('/logout')}}"> <i class="fas fa-power-off pr-2"></i> Logout</a> 
                      
                           
                        </div>
                    </li>
       
                </ul>
        
            </div>
  </nav>
 </div>

 <script>
      function openSidebar() {
    document.getElementById('sidebar').style.width = '250px';
    document.getElementById('main').style.marginLeft = '250px';
  }
  function closeSidebar() {
    document.getElementById('sidebar').style.width = '0px';
    document.getElementById('main').style.marginLeft = '0px';
  }
 </script>