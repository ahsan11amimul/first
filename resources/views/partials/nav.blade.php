<nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <div class="container py-2">
  <a class="navbar-brand" href="{{url('/')}}">OrganicStore</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
   
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
       
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-calendar-alt text-info fa-lg"></i> Categories
        </a>
        <div class="dropdown-menu mega-menu" aria-labelledby="navbarDropdown">
            <div class="row">
              @foreach ($categories as $item)
                <div class="col-md-3">
                <h5><a href="{{url('/category/'.$item->id)}}" class=" font-weight-bold text-capitalize">{{$item->name}}<span class="badge badge-warning ml-2">{{$item->products->count()}}</span></a></h5>
                 @foreach ($item->products as $sub_item)
                <p><a href="{{url('/product/'.$sub_item->id)}}">{{$sub_item->name}}</a></p>
                 @endforeach 
                  </div>
                
                 @endforeach
            </div>
         </div>
      </li>
      </ul>
    <form action="{{route('search')}}" method="GET"class="form-inline my-3 my-lg-0">
       <div class="input-group">
       <input type="text" class="form-control" placeholder="Search.." size="65" id="query" name="query" value="{{request()->input('query')}}">
        <div class="input-group-append">
            <button class="btn btn-outline-warning" type="submit" ><i class="fas fa-search"></i></button>
        </div>
        </div>
    </form>
    <ul class="navbar-nav ml-auto">
        
      <li class="nav-item">
      <a class="nav-link" title="Visit Your Wishlist" href="#"data-toggle="modal" data-target="#wishlist"><i class="fas fa-heart text-danger fa-lg">
      <span class="badge badge-warning">{{App\Wishlist::totalItem()}}</span></i>
      </a>
      </li>
     
      <li class="nav-item">
      <a class="nav-link"  href="#" title="Visit Your Cart" data-toggle="modal" data-target="#cart"><i class="fas fa-shopping-cart text-warning fa-lg">
      <span class="badge badge-warning" >{{App\Cart::totalItem()}}</span></i>
      </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#login"><i class="fas fa-sign-in-alt fa-lg text-warning"></i></a>
      </li>
    </ul>
    
  </div>
</div>
</nav>