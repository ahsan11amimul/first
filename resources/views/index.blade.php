@extends('layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')

{{--topnav--}}
@include('partials.top_nav')
{{--end topnav--}}
{{--mainnav--}}
@include('partials.nav')
{{-- end mainnav--}}
@if (Session::has('success'))
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>{{Session('success')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
@endif

@if (Session::has('error'))
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>{{Session('error')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
@endif
{{--main content--}}
<div class="container mt-3">

<div class="row">
{{-- sidebar --}}
@include('partials.sidebar')
{{--end sidebar--}}
{{-- slider --}}
@include('partials.slider')
{{--end slider--}}
</div>
</div>
{{--end maincontent--}}

{{-- featured category --}}
<div class="container">
 
    <div class="title-box">
       <h5>Featured categories</h5>
     </div>
  <div class="row mb-4">
     @foreach ($categories as $item)
    <div class="col-md-3 col-6 p-3">
    <a href="{{url('/category/'.$item->id)}}" title="Visit {{$item->name}} details Page"><img src="{{asset('storage/uploads/'.$item->image)}}" alt="" class="custom-image"></a> 
    </div>
     
     @endforeach
    
  </div>
</div>
{{-- end featured category --}}
{{--On sale--}}
<div class="container">
   <div class="title-box">
       <h5>On Sale</h5>
     </div>
<div class="row mb-4">
     @foreach ($products as $item)
 <div class="col-md-3 col-6">
    <div class="card" style="width: 18rem;">
    <a href="{{url('/product/'.$item->id)}}"  title="Visit {{$item->name}} details page"> <img src="{{asset('storage/uploads/'.$item->image)}}" class="card-img-top" alt="..."></a>
        <div class="card-body">
        <h5 class="card-title text-center">{{$item->name}}</h5>
          <h6 class="card-subtitle mb-2 text-muted text-center">Price BDT:<strong class="text-danger">{{$item->price}}</strong> tk ({{$item->unit}})</h6>
        <form action="{{route('add_cart')}}" method="POST">
         @csrf
        <input type="hidden" name="product_id" value="{{$item->id}}" > 
        <button type="submit" class="btn btn-outline-warning float-right"><i class="fas fa-shopping-cart pr-2"></i>Add to cart</button>
        </form>
        <form action="{{route('add_wishlist')}}" method="POST">
          @csrf
        <input type="hidden" name="product_id" value="{{$item->id}}"product_id="{{$item->id}}"> 
        <button type="submit" class=" btn btn-outline-danger float-left"><i class="fas fa-heart pr-2"></i>Wishlist</button>
        </form>
      
        </div>
    </div>
    </div>
      @endforeach
  </div>   
   
     <!-- Button trigger modal -->
   
</div>
{{--end On sale--}}


{{--end popular--}}




<!-- Modal -->
@include('../partials.login_modal');
  <button type="button" class="btn btn-danger fixed-bottom" data-toggle="modal" data-target="#cart">
    <i class="fas fa-shopping-cart"></i>My Bag <span class="badge badge-light">{{App\Cart::totalItem()}}</span>
   Total Tk: <span class="badge badge-warning">{{App\Cart::totalPrice()}}</span>
    </button>
    
    <!-- cart Modal -->
   @include('partials.cart_modal')
   @include('partials.wishlist_modal')


{{--footer--}}
@include('partials.footer')



    
@endsection
