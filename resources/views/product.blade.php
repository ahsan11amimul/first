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
   <h5>{{$product->name}}</h5>
   </div>
<div class="row mb-4">
@if ($product->status==1 && $product->is_verified==1)
<div class="col-md-3 col-6">
  <div class="card" style="width: 18rem;">
    <a href="{{url('/product/'.$product->id)}}"  title="Visit {{$product->name}} details page"> <img src="{{asset('storage/uploads/'.$product->image)}}" class="card-img-top" alt="..."></a>
        <div class="card-body">
        <h5 class="card-title text-center">{{$product->name}}</h5>
          <h6 class="card-subtitle mb-2 text-muted text-center">Price BDT:<strong class="text-danger">{{$product->price}}</strong> tk ({{$product->unit}})</h6>
         <form action="{{route('add_cart')}}" method="POST">
          @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}"> 
        <button type="submit" class="btn btn-outline-warning float-right"><i class="fas fa-shopping-cart pr-2"></i>Add to cart</button>
        </form>
        
          <form action="{{route('add_wishlist')}}" method="POST">
          @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}"product_id="{{$product->id}}"> 
        <button type="submit" class=" btn btn-outline-danger float-left"><i class="fas fa-heart pr-2"></i>Wishlist</button>
        </form>
      
     
        </div>
    </div> 
  </div>
    <div class="col-md-3 col-6">
       <div class="card bg-light text-muted" style="width: 18rem;">
          <div class="card-body">
           <h5 class="card-title">Category Name: {{$product->category->name}}</h5>
           <h5>Product Name: {{$product->name}}</h5>
           <h5>Price: {{$product->price}} Tk({{$product->unit}})</h5>
           <h5>Description </h5><p>{{$product->description}}</p>
           <h5> In Stock: </h5><p>{{$product->quantity}} {{$product->unit}}</p>
          </div>
      </div>
    </div>

@endif  
 </div>
</div>
   
      
    
   
  
 
 
{{-- end featured category --}}
{{--On sale--}}
<div class="container">
   <div class="title-box">
       <h5>Similar Items</h5>
     </div>
<div class="row mb-4">
 @foreach ($similar as $item)
 @if ($item->status==1)
   <div class="col-md-3 col-6">
    <div class="card" style="width: 18rem;">
    <a href="{{url('/product/'.$item->id)}}"  title="Visit {{$item->name}} details page"> <img src="{{asset('storage/uploads/'.$item->image)}}" class="card-img-top" alt="..."></a>
        <div class="card-body">
        <h5 class="card-title text-center">{{$item->name}}</h5>
          <h6 class="card-subtitle mb-2 text-muted text-center">Price BDT:<strong class="text-danger">{{$item->price}}</strong> tk ({{$item->unit}})</h6>
          
        <form action="{{route('add_cart')}}" method="POST">
          @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}"> 
        <button type="submit" class="add_cart btn btn-outline-warning float-right"><i class="fas fa-shopping-cart pr-2"></i>Add to cart</button>
        </form>
           
          <form action="{{route('add_wishlist')}}" method="POST">
          @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}"product_id="{{$product->id}}"> 
        <button type="submit" class=" btn btn-outline-danger float-left"><i class="fas fa-heart pr-2"></i>Wishlist</button>
        </form>
        </div>
    </div>
    </div>
     
    
   
  

 @endif 
 @endforeach
  </div> 
 </div> 
{{--end On sale--}}
{{-- New --}}

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
