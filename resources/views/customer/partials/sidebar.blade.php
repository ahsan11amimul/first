<div id="sidebar" class="side-nav">
<span class="btn-close" onclick="closeSidebar()">&times;</span>
        <ul class="list-unstyled components">
            @foreach ($categories as $item)
                
            
            <li>
            <a href="{{url('customer/details/'.$item->id)}}" data-target="#{{$item->name}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-weight-bold text-capitalize">{{$item->name}} <span class="badge badge-danger">{{$item->products->count()}}</span></a>
            
                <ul class="collapse list-unstyled" id="{{$item->name}}">
                    @foreach ($item->products as $subitem)
                     <li>
                     <a href="{{url('customer/product/'.$subitem->id)}}">{{$subitem->name}}</a>
                    </li>    
                    @endforeach
                   
                   
                </ul>
            </li>
            @endforeach
            
        </ul>
        <hr>
        <ul class="list-unstyled components">
        <li><a href="{{url('customer/index')}}"><i class="fas fa-home pr-1"></i>Home Page</a></li>
        <li><a href="{{url('customer/settings/'.Auth::user()->id)}}"><i class="fas fa-wrench pr-1"></i>Profile</a></li>
        <li><a href="{{url('customer/order_history/'.Auth::user()->id)}}"><i class="fas fa-user-circle pr-1"></i>My Orders</a></li>
           

        </ul>
                
        
</div>  