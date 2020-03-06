@extends('customer.layouts.master')
@section('title')
    OrganicStore
@endsection
@section('content')

{{--topnav--}}

{{--end topnav--}}
{{--mainnav--}}
@include('customer.partials.nav')
{{-- end mainnav--}}
{{--sidebar--}}

@include('customer.partials.sidebar')



{{--end sidebar--}}
 @if (Session::has('success'))
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>{{Session('success')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
@endif
{{--main content--}}
<div id="main" class="container-fluid">
     <a href="{{url('/message')}}" class="btn btn-outline-warning" id="fixedbtn">
        Live Chat  <i class="fas fa-comment-alt"></i>
    </a>
   
    <!-- Button trigger modal -->
   <button type="button" class="btn btn-danger fixed-bottom" data-toggle="modal" data-target="#cart">
    <i class="fas fa-shopping-cart"></i>My Bag <span class="badge badge-light">{{App\Cart::totalItem()}}</span>
   Total Tk: <span class="badge badge-warning">{{App\Cart::totalPrice()}}</span>
    </button>
    <!-- cart Modal -->
    @include('customer.partials.cart_modal')
     @include('customer.partials.wishlist_modal')
    
    @include('customer.partials.slider')
    @if (Session::has('success'))
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>{{Session('success')}}!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>  
@endif
   
<div class="row">
    <div class="container">
      {{-- Single product--}}
        <div class="row mt-5">
            <div class="col-md-5">
                <div class="underline">
                    <h6></h6>
                </div>
            </div>
            <div class="col-md-2">
                <div class="category">
                <h6>{{$product->name}}</h6>
                </div>
            </div>
            <div class="col-md-5">
                <div class="underline">
                    <h6></h6>
                </div>
            </div>
        </div>
        <div class="row mt-5">
           @if ($product->status==1 && $product->is_verified==1)
              <div class="col-md-3 p-3">
                <div class="products">
                    <div class="image-box">
                    <img src="{{asset('storage/uploads/'.$product->image)}}" alt="" class="image">
                        <div class="overlay">
                            <div class="text">
                            <p>{{$product->name}}</p>
                            <p class="currency">BDT: {{$product->price}}-tk per {{$product->unit}}</p>
                            <p>{{$product->description}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="products-footer">
                        <div>
                        <h5 class="text-center text-muted">{{$product->name}}</h5>
                        <p class="text-center text-muted">BDT: <strong class="text-danger">{{$product->price}}</strong>-tk per({{$product->unit}})</p>
                        </div>
                       <form action="{{route('add_cart')}}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}"product_id="{{$product->id}}"> 
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
          
           
           
          
        </div>
        {{-- similar product--}}
        <div class="row mt-5">
            <div class="col-md-5">
                <div class="underline">
                    <h6></h6>
                </div>
            </div>
            <div class="col-md-2">
                <div class="category">
                <h6>Similar Items</h6>
                </div>
            </div>
            <div class="col-md-5">
                <div class="underline">
                    <h6></h6>
                </div>
            </div>
        </div>
        <div class="row mt-5">
          @foreach ($similars as $product)
           @if ($product->status==1)
              <div class="col-md-3 p-3">
                <div class="products">
                    <div class="image-box">
                    <img src="{{asset('storage/uploads/'.$product->image)}}" alt="" class="image">
                        <div class="overlay">
                            <div class="text">
                            <p>{{$product->name}}</p>
                            <p class="currency">BDT: {{$product->price}}-tk per {{$product->unit}}</p>
                            <p>{{$product->description}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="products-footer">
                        <div>
                        <h5 class="text-center text-muted">{{$product->name}}</h5>
                        <p class="text-center text-muted">BDT: <strong class="text-danger">{{$product->price}}</strong>-tk per({{$product->unit}})</p>
                        </div>
                       <form action="{{route('add_cart')}}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}"product_id="{{$product->id}}"> 
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
    
          
        
    </div>

{{-- end New --}}
{{--popular--}}

{{--end popular--}}




<!-- Modal -->
@include('customer.partials.logout_modal');


{{--footer--}}

@include('customer.partials.footer')


    
@endsection