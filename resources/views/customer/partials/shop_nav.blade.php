<style>
      .notification{
        width: 500px;
        background: #FFFFFF;
        height: auto;
        margin-top: 5px;
      
        border: 1px solid black;
      
    }
    .notification a{
        color:#ef4532;
        text-decoration: none;
        padding: 5px;
        margin-bottom: 2px; 
        margin-right: 5px; 
        border-bottom: 1px groove orangered;
    }
</style>


<nav class="navbar navbar-expand-md navbar-light">
     <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#myNavbar">
     <span class="navbar-toggler-icon"></span>

     </button>
     <div class="collapse navbar-collapse" id="myNavbar">
         <div class="container-fluid">
             <div class="row">
                 <!-- sidebar-->
                 <div class="col-xl-2 col-md-4 col-lg-3 sidebar fixed-top">
                    <a href="{{url('customer/shop')}}" class="navbar-brand text-white d-block 
                    mx-auto text-center py-3 mb-2 bottom-border">Farmer Zone</a>
                    <div class="bottom-border pb-2">
                    <i class="fas fa-user-circle fa-3x text-danger"></i>
                    <a href="{{url('customer/profile/'.Auth::user()->id)}}" class="text-white">{{Auth::user()->name}}</a>
                    </div>
                    <ul class="navbar-nav flex-column mt-3">
                    <li class="nav-item"><a href="{{url('customer/shop')}}" class="nav-link text-white p-3 mb-2 sidebar-link current">
                         <i class="fas fa-home text-light fa-lg mr-4"></i> Dashboard </a>
                        </li>
                        <li class="nav-item "><a href="{{url('customer/view_product')}}" class="nav-link text-white p-3 mb-2 sidebar-link ">
                            <i class="fas fa-edit text-light fa-lg mr-4"></i>Products</a>
                         </li>
                        <li class="nav-item "><a href="{{url('customer/profile/'.Auth::user()->id)}}" class="nav-link text-white p-3 mb-2 sidebar-link ">
                            <i class="fas fa-user text-light fa-lg mr-4"></i>Profile</a>
                         </li>
                        
                    <li class="nav-item"><a href="{{url('customer/view_message')}}" class="nav-link text-white p-3 mb-2 sidebar-link">
                        <i class="fas fa-shopping-cart text-light fa-lg mr-4"></i>Orders</a>
                        </li>
                       
                    <li class="nav-item"><a href="{{url('/logout')}}" class="nav-link text-white p-3 mb-2 sidebar-link">
                                <i class="fas fa-power-off text-light fa-lg mr-4"></i> Log Out </a>
                     </li>
                      
                        

                    </ul>
                 </div>
                <!-- End sidebar-->
                <div class="col-xl-10 col-md-8 col-lg-9 ml-auto bg-dark fixed-top py-3 top-nav">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                        <a href="{{url('customer/shop')}}"> <h4 class="text-white text-uppercase">Dashboard</h4></a>
                        </div>
                        <div class="col-md-5">
                        <form action="{{route('shop.search')}}" method="GET">
                            @csrf
                               <div class="input-group">
                               <input type="text" class="form-control search-input" placeholder="Search.." name="query" value="{{request()->input('query')}}">
                                   <button type="submit" class="btn btn-white search-button">
                                       <i class="fas fa-search text-danger"></i>
                                   </button>
                               </div>
                           </form>
                        </div>
                        <div class="col-md-3">
                          <ul class="navbar-nav"> 
                              <li class="nav-item mr-3"><a href="{{url('customer/view_message')}}" class="nav-link ">
                                  <i class="fas fa-envelope text-danger fa-lg">
                                     
                                  </i>
                              </a>
                             </li>
                               <li class="nav-item  dropleft">
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
                             
                           
                              
                            <li class="nav-item ml-md-auto"><a href="#" class="nav-link" data-toggle="modal"
                                    data-target="#logout">
                                    <i class="fas fa-sign-out-alt fa-lg text-danger"></i>
                                </a>
                            </li>
                          </ul>
                        </div>
                    </div>
                </div>
             </div>
         </div>
     </div>
    </nav>
